<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\Account;
use App\Models\Withdrawal;
use App\Models\Deposit;
use App\Models\Convenien;
use App\Models\Feature;
use App\Models\PaymentHistory;
use App\Models\Faq;
use DB;
use Carbon\Carbon;
use Session;
use Stripe\Stripe; // Import the Stripe class
use Stripe\StripeClient;
use Stripe\Transfer;


class dashboardController extends Controller
{
    public function index()
    {
        

        $data = array(
            'title' => 'Dashboard',
            
            
        );
        return view('admin.dashboard')->with($data);
    }
}
