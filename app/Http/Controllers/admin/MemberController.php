<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use DataTables;
use Validator;
use Auth;
use Mail;

class MemberController extends Controller
{
    public function add(Request $request, $id = Null)
    {
        $decrypted_id = get_decrypted_value($id, true);
        $getdata = User::find($decrypted_id);
        if ($id != "") {
            $saveurl = url('admin/member/save/' . $id);
            $button = 'Update';
            $page_title = 'Update member';
        } else {
            $saveurl = url('admin/member/save');
            $button = 'Add';
            $page_title = 'Add member';
        }
        $data = array(
            'getdata'    => $getdata,
            'saveurl'    => $saveurl,
            'button'     => $button,
            'title'      => $page_title,
        );
        return view('admin.member.add')->with($data);
    }
    public function save(Request $request, $id = NUll)
    {
        if (!empty($id)) {
            $decrypted_id  = get_decrypted_value($id, true);
            $data          = User::find($decrypted_id);
            $success_msg   = 'Member Updated Successfully.';
            $emailValidator = 'required|unique:users,email,' . $decrypted_id . ',id,status,1';
            $Validatior = Validator::make($request->all(), [
                'email' => $emailValidator,
                'name'              => 'required',
            ]);
        } else {
            $data          = new User;
            $success_msg   = 'Member invited Successfully.';
            $emailValidator = 'required|unique:users';
            $Validatior = Validator::make($request->all(), [
                'email' => $emailValidator,
                'name'              => 'required',
                
            ]);
        }

        if ($Validatior->fails()) {
            return back()->withInput()->withErrors($Validatior);
        } else {

            DB::beginTransaction();
            try {

                $user = Auth::guard('web')->user();
            
                $data->name = $request->name;
                $data->email = $request->email;
                $data->role =  $request->role;
                $data->invited_by =  $user->id;
                $data->password =  Hash::make('12345678');
                $data->save();

                if (empty($id)) {
                    try {
                        $mailData = [
                            'user' => $data->name,
                            'subject' => 'Welcome to Sembark',
                            'email' => $data->email,
                            'password' => '12345678',
                            'message' => 'Welcome to <strong>Sembark</strong>. Your account has been created successfully.'
                        ];

                        Mail::to($data->email)->send(new WelcomeEmail($mailData));

                    } catch (\Exception $e) {
                        \Log::error('Welcome email failed: '.$e->getMessage());
                    }
                }
                
                
            } catch (\Exception $e) {
                DB::rollback();
                $error_message = $e->getMessage();
                return back()->withInput()->withErrors($error_message);
            }
            DB::commit();
        }
        return redirect()->route('member')->withSuccess($success_msg);
    }

    public function index()
    {
        $data = array(
            'title' => 'View Member',
            'page_title' => 'View Member',
        );
        return view('admin.member.view')->with($data);
    }

    public function anydata(Request $request)
    {
        $user = Auth::guard('web')->user();
        $query = User::where('status', '!=', 3)
            ->where('role', 3)
            
            ->orderBy('id', 'DESC');

        if($user->role != 1){
            $query->where('invited_by',$user->id);
        }
            

        return DataTables::eloquent($query)
            
            ->addColumn('action', function ($anydata) {
                $admin = Auth::guard('web')->user();
                
                    $encrypted_id = get_encrypted_value($anydata->id, true);
                return '<a href="' . url('/admin/member/add/' . $encrypted_id) . '"><i class="fas fa-edit" title="Edit"></i></a>&nbsp;&nbsp;
                    <i class="fas fa-trash-alt text-danger delete-button" data-id="' . $anydata->id . '" title="Delete"></i>'; 
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found!',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Member deleted successfully!',
        ]);
    }
}
