<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;
use Auth;

class ShortUrlController extends Controller
{
    public function add(Request $request, $id = Null)
    {
        $decrypted_id = get_decrypted_value($id, true);
        $getdata = ShortUrl::find($decrypted_id);
        if ($id != "") {
            $saveurl = url('admin/short_url/save/' . $id);
            $button = 'Update';
            $page_title = 'Update Short Url';
        } else {
            $saveurl = url('admin/short_url/save');
            $button = 'Add';
            $page_title = 'Add Short Url';
        }
        $data = array(
            'getdata'    => $getdata,
            'saveurl'    => $saveurl,
            'button'     => $button,
            'title'      => $page_title,
        );
        return view('admin.short_url.add')->with($data);
    }
    public function save(Request $request, $id = NUll)
    {
        if (!empty($id)) {
            $decrypted_id  = get_decrypted_value($id, true);
            $data          = ShortUrl::find($decrypted_id);
            $success_msg   = 'Short Url Updated Successfully.';
            $Validatior = Validator::make($request->all(), [
                'title'              => 'required',
            ]);
        } else {
            $data          = new ShortUrl;
            $success_msg   = 'Short Url Added Successfully.';
            $Validatior = Validator::make($request->all(), [
                'title'              => 'required',
                
            ]);
        }

        if ($Validatior->fails()) {
            return back()->withInput()->withErrors($Validatior);
        } else {

            DB::beginTransaction();
            try {

                $user = Auth::guard('web')->user();
            
                $data->title = $request->title;
                $data->created_by =  $user->id;
                $data->short_code =  generate_short_url_code();
                $data->save();
                
                
            } catch (\Exception $e) {
                DB::rollback();
                $error_message = $e->getMessage();
                return back()->withInput()->withErrors($error_message);
            }
            DB::commit();
        }
        return redirect()->route('short_url')->withSuccess($success_msg);
    }
    public function index()
    {
        $data = array(
            'title' => 'View Short Url',
            'page_title' => 'View Short Url',
        );
        return view('admin.short_url.view')->with($data);
    }

    public function anydata(Request $request)
    {
    $user = Auth::guard('web')->user();
    $query = ShortUrl::orderBy('id', 'DESC');

    if($user->role != 1){
        $query->where('created_by',$user->id);
    }
        

    return DataTables::eloquent($query)
        
        ->addColumn('short_url', function ($anydata) {
               
            return url('/s/' . $anydata->short_code);
        })

        ->addColumn('action', function ($anydata) {
             $admin = Auth::guard('web')->user();
            
                $encrypted_id = get_encrypted_value($anydata->id, true);
            return '<a href="' . url('/admin/short_url/add/' . $encrypted_id) . '"><i class="fas fa-edit" title="Edit"></i></a>&nbsp;&nbsp;
                <i class="fas fa-trash-alt text-danger delete-button" data-id="' . $anydata->id . '" title="Delete"></i>'; 
        })
        ->rawColumns(['action','short_url'])
        ->addIndexColumn()
        ->make(true);
    }
    public function delete(Request $request)
    {
        $short_url = ShortUrl::find($request->id);

        if (!$short_url) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Short Url not found!',
            ], 404);
        }

        $short_url->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Short Url deleted successfully!',
        ]);
    }

    public function redirect($code)
    {
        try {
            $url = ShortUrl::where('short_code', $code)
                ->first();

            if (!$url) {
                abort(404, 'Short URL not found');
            }

            return redirect()->away($url->title);

        } catch (\Exception $e) {
             $error_message = $e->getMessage();
                return back()->withInput()->withErrors($error_message);
        }
    }

    public function denied()
    {
        $data = array(

            'page_title' => 'Dashboard',
            'title' => 'Dashboard',
        );
        return view('admin.denied')->with($data);
    }
}
