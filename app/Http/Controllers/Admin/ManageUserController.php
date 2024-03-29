<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\KycVerify;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserInterest;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index()
    {

        $data['pageTitle'] = 'All Users';
        $data['navManageUserActiveClass'] = 'active';
        $data['subNavManageUserActiveClass'] = 'active';

        $data['users'] = User::latest()->paginate();

        return view('backend.users.index')->with($data);
    }

    public function userDetails(Request $request)
    {
        $user = User::where('id', $request->user)->firstOrFail();

        $totalRef = $user->refferals->count();

        $userInterest = $user->interest->sum('interest_amount');

        $userCommission = $user->commissions->sum('amount');

        $withdrawTotal = Withdraw::where('user_id', $user->id)->where('status', 1)->sum('withdraw_amount');

        $totalDeposit = $user->deposits()->where('payment_status', 1)->sum('amount');

        $totalInvest = $user->payments()->where('payment_status', 1)->sum('amount');

        $tradingProfit = $user->tradingProfit()->sum('amount');
        $tradingLose = $user->tradingLose()->sum('amount');

        $totalTicket = $user->tickets->count();



        $payment = Payment::with('plan')->where('user_id', $user->id)->where('payment_status', 1)->latest()->first();

        if ($payment) {
            $plan = $payment->plan->plan_name;
        } else {
            $plan = 'N/A';
        }


        $pageTitle = "User Details";

        return view('backend.users.details', compact('pageTitle', 'user', 'plan', 'totalRef', 'userInterest', 'userCommission', 'withdrawTotal', 'totalDeposit', 'totalInvest', 'totalTicket', 'tradingProfit', 'tradingLose'));
    }

    public function userUpdate(Request $request, User $user)
    {



        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'unique:users,phone,' . $user->id
        ]);

        $data = [
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'state' => $request->state,
        ];


        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->phone = $request->phone;
        $user->withdraw_pass = @$request->withdraw_pass ? @$request->withdraw_pass : null;
        $user->bdt_wallet_number = @$request->bdt_wallet_number ? @$request->bdt_wallet_number : null;
        $user->usdt_wallet_address = @$request->usdt_wallet_address ? @$request->usdt_wallet_address : null;
        $user->address = $data;
        $user->status = $request->status == 'on' ? 1 : 0;
        $user->withdrawStatus = $request->withdrawStatus == 'on' ? 1 : 0;
        $user->sv = $request->sms_status == 'on' ? 1 : 0;
        $user->ev = $request->email_status == 'on' ? 1 : 0;
        $user->kyc = $request->kyc_status == 'on' ? 1 : 0;

        if (@$request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $notify[] = ['success', 'User Updated Successfully'];

        return back()->withNotify($notify);
    }

    public function sendUserMail(Request $request, User $user)
    {
        $data = $request->validate([
            'subject' => 'required',
            "message" => 'required',
        ]);

        $data['name'] = $user->fullname;
        $data['email'] = $user->email;

        sendGeneralMail($data);

        $notify[] = ['success', 'Send Email To user Successfully'];

        return back()->withNotify($notify);
    }

    public function disabled(Request $request)
    {
        $pageTitle = 'Disabled Users';

        $search = $request->search;

        $users = User::when($search, function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->where('status', 0)->latest()->paginate();

        return view('backend.users.index', compact('pageTitle', 'users'));
    }

    public function userStatusWiseFilter(Request $request)
    {
        $data['pageTitle'] = ucwords($request->status) . ' Users';
        $data['navManageUserActiveClass'] = 'active';

        $users = User::query();

        if ($request->status == 'active') {
            $data['subNavActiveUserActiveClass'] = 'active';
            $users->where('status', 1);
        } elseif ($request->status == 'deactive') {
            $data['subNavDeactiveUserActiveClass'] = 'active';
            $users-> where('status', 0);
        }


        $data['users'] = $users->paginate();


        return view('backend.users.index')->with($data);
    }

    public function interestLog($user = '')
    {

        $interestLogs = UserInterest::query();

        $user = User::find($user);

        $pageTitle = "User Interest Log";

        if ($user) {

            $interestLogs->where('user_id', $user->id);
        }

        $interestLogs = $interestLogs->latest()->paginate();


        return view('backend.userinterestlog', compact('interestLogs', 'pageTitle'));
    }

    public function userBalanceUpdate(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        if ($request->type == 'add') {
            $user->balance =  $user->balance + $request->balance;
        } else {
            if ($user->balance < $request->balance) {
                $notify[] = ['error', 'Insufficient balance'];

                return back()->withNotify($notify);
            }
            $user->balance =  $user->balance - $request->balance;
        }

        $user->save();

        $notify[] = ['success', 'Successfully ' . $request->type . ' balance'];

        return back()->withNotify($notify);
    }

    public function loginAsUser($id)
    {
        $user = User::findOrFail($id);

        Auth::loginUsingId($user->id);

        return redirect()->route('user.dashboard');
    }


    public function kyc()
    {
        $data['subNavkycUserActiveClass'] = 'active';

        $data['pageTitle'] = 'KYC Settings';

        return view('backend.users.kyc')->with($data);
    }


    public function kycUpdate(Request $request)
    {
        $request->validate([
            "kyc" => 'required|array',
        ]);

        $general = GeneralSetting::first();


        $general->kyc = $request->kyc;

        $general->save();


        return back()->with('success', 'Kyc settings updated successfully');
    }

    public function kycAll()
    {
        $data['infos'] = User::where('kyc', 2)->paginate();

        $data['pageTitle'] = 'KYC Requests';
        $data['subNavkycReqUserActiveClass'] = 'active';
        $data['navManageUserActiveClass'] = 'active';

        return view('backend.users.kyc_req')->with($data);
    }

    public function kycDetails($id)
    {
        $data['user'] = User::findOrFail($id);

        $data['pageTitle']  = 'KYC Details';


        $data['subNavkycReqUserActiveClass'] = 'active';
        $data['navManageUserActiveClass'] = 'active';

        return view('backend.users.kyc_details')->with($data);
    }

    public function kycStatus($status, $id)
    {
        $kyc=KycVerify::findOrFail($id);
        $user = User::findOrFail($kyc->user_id);

        if ($status === 'approve') {
            $user->kyc = 1;
            $kyc->status=1;
        } else {
            $user->kyc = 3;
            $kyc->status=2;
        }

       

        $kyc->save();
        $user->save();

        return redirect()->route('admin.user.kyc.requiest')->with('success', 'Successfull');
    }

    public function kycIndex(){
        $pageTitle='KYC Request';

        $userdata=DB::table('users')
        ->join('kyc_verifies', function($join)
        {
            $join->on('users.id', '=', 'kyc_verifies.user_id')
                 ->where('kyc_verifies.status', '<',1)->orderBy('kyc_verifies.id','desc');
        })->paginate(15);

    
        //dd($userdata);
        return view('backend.admins.kyc.requestkyc',compact('pageTitle','userdata'));
    }


    public function kycUserDetails($id){
        $pageTitle = 'KYC Details';

        $kyc=KycVerify::where('id',$id)->get()->first();
        $user=User::where('id',$kyc->user_id)->get()->first();
       
      return view('backend.admins.kyc.kycdetails',compact('pageTitle','user','kyc'));
    }
}
