<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\admin_branch_info;
use App\Models\branch_info;
use App\Models\employee_info;
use App\Models\admin_main_menu;
use App\Models\admin_sub_menu;
use App\Models\sub_menu_priority;
use App\Models\main_menu_priority;
use App\Models\User;
use App\Models\area_info;
use App\Models\member;
use App\Models\internalloan;
use App\Models\loan;
use App\Models\investmentschema;
use App\Models\saving_schema;
use App\Models\fixed_deposit_schema;
use App\Models\admin_area_info;
use App\Models\investment_collection;
use App\Models\investment_handover;
use App\Models\saving_transaction;
use App\Models\fixed_deposit_collection;
use App\Models\fixed_deposit_return;
use Hash;
use DB;


class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return redirect('/login');
    }
    // public function select_branch()
    // {
    //     $user_role = Auth::user()->user_role;
    //     if($user_role == 'Developer')
    //     {
    //         return redirect('/dashboard');
    //     }
    //     else
    //     {
    //         $branches = admin_branch_info::where('admin_id',Auth::user()->id)
    //                     ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
    //                     ->select('branch_infos.*')
    //                     ->get();
    //         // return $branches;
    //         return view('Backend.Layouts.branches',compact('branches'));
    //     }
    // }
    public function branch_dashboard($branch_name,$id)
    {
        $total_user = User::count();
        return view('Backend.Layouts.home',compact('total_user'));
    }
    public function dashboard()
    {

        // return base_path();

        $total_user = User::count();
        $investment_schema = investmentschema::count();
        $saving_schema = saving_schema::count();
        $fixed_deposit_schema = fixed_deposit_schema::count();
        return view('Backend.Layouts.home',compact('total_user','investment_schema','saving_schema','fixed_deposit_schema'));
    }
    public function loadEmployee(Request $request)
    {
        // return $request->emp_id;

        $empData = employee_info::find($request->emp_id);

        // echo $empData;
        return view('Backend.User.Admin.load_employee',compact('empData'));
    }

    public function loadBrnahcMenu(Request $request)
    {
        $main_menu = admin_main_menu::where('status',1)->get();
        $sub_menu = admin_sub_menu::where('status',1)->get();

        $admin_id = $request->admin_id;

        $branch = branch_info::where('status',1)->get();

        $area = area_info::where('status',1)->get();

        return view('Backend.User.AdminPriority.load_menu_branch',compact('main_menu','sub_menu','admin_id','branch','area'));
    }
    public function check_pass(Request $request)
    {
        // return $request->oldPwd;
        $cehck = User::where('password_recover',$request->oldPwd)->where('id',$request->admin_id)->count();
        if($cehck == 1)
        {
            return view('Backend.User.Admin.change_password_form');
        }
        else
        {
            return 0;
        }
    }
    public function change_password(Request $request)
    {
        $validated = $request->validate([
            'new_password'=>'required|min:3',
        ]);

        $insert = User::where('id',$request->admin_id)->update([
            'password'=>Hash::make($request->new_password),
            'password_recover'=>$request->new_password
        ]);

        if($insert)
        {
            return redirect()->back()->with('success','Passowrd Changed');
        }
        else
        {
            return redirect()->back()->with('error','Password Change Failed');
        }
    }


    public function loadArea(Request $request)
    {
        // return $request->branch_id;
        // $area = area_info::where('status',1)->where('branch_id',$request->branch_id)->get();
        if(Auth::user()->user_role == 1)
        {
            $area = area_info::where('branch_id',$request->branch_id)->where('area_infos.status',1)->get();
        }
        else
        {
            $area = admin_area_info::where('admin_area_infos.admin_id',Auth::user()->id)
            ->join('area_infos','area_infos.id','=','admin_area_infos.area_id')
            ->where('area_infos.status',1)->where('area_infos.branch_id',$request->branch_id)
            ->select('area_infos.*')
            ->get();
        }
        if($area)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach($area as $v)
            {
                echo "<option value='".$v->id."'>".$v->area_name."</option>";
            }
        }
    }
    public function loadMember4(Request $request)
    {
        // return $request->schema_id;
        $member = DB::table('investor_registrations')
        ->join('members','members.member_id','=','investor_registrations.member_id')
        ->where('members.branch_id',$request->branch_id)
        ->where('members.area_id',$request->area_id)
        ->where('investor_registrations.approval',1)
        ->select('members.aplicant_name','members.id as member_id','investor_registrations.*')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name. " - ". $v->registration_id."</option>";
            }
        }
    }
    public function loadInvestorMembers(Request $request)
    {
        // return $request->schema_id;
        $member = DB::table('investor_registrations')
        ->join('members','members.member_id','=','investor_registrations.member_id')
        ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
        ->where('members.branch_id',$request->branch_id)
        ->where('members.area_id',$request->area_id)
        ->where('investor_registrations.schema_id',$request->schema_id)
        ->where('investor_registrations.approval',1)
        ->select('members.aplicant_name','members.id as member_id','investor_registrations.*','investmentschemas.investment_name')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name. " - ". $v->registration_id." - ".$v->investment_name."</option>";
            }
        }
    }
    public function loadInvestorMembers2(Request $request)
    {
        // return $request->schema_id;
        $member = DB::table('investor_registrations')
        ->leftjoin('members','members.member_id','investor_registrations.member_id')
        ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
        ->where('investor_registrations.branch_id',$request->branch_id)
        ->where('investor_registrations.area_id',$request->area_id)
        ->where('investor_registrations.schema_id',$request->schema_id)
        ->where('investor_registrations.approval',1)
        ->select('members.aplicant_name','members.id as member_id','investor_registrations.*','investmentschemas.investment_name')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                // $check = DB::table('investment_handovers')->where('member_id',$v->registration_id)->count();
                // if($check == 0)
                // {

                    echo "<option value='".$v->registration_id."'>".$v->aplicant_name. " - ". $v->registration_id." - ".$v->investment_name."</option>";
                // }
            }
        }
    }
    public function loadMember(Request $request)
    {
        // return $request->schema_id;
        $member = DB::table('investor_registrations')
        ->join('members','members.id','=','investor_registrations.member_id')
        ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
        ->where('members.branch_id',$request->branch_id)
        ->where('members.area_id',$request->area_id)
        ->where('investor_registrations.schema_id',$request->schema_id)
        ->where('investor_registrations.approval',1)
        ->select('members.aplicant_name','members.id as member_id','investor_registrations.*','investmentschemas.investment_name')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name. " - ". $v->registration_id." - ".$v->investment_name."</option>";
            }
        }
    }

    public function loadInvestmentReportMember(Request $request)
    {
        // return $request->schema_id;
        $member = DB::table('investor_registrations')
        ->join('members','members.id','=','investor_registrations.member_id')
        ->where('members.branch_id',$request->branch_id)
        ->where('members.area_id',$request->area_id)
        ->where('investor_registrations.approval',1)
        ->select('members.aplicant_name','members.id as member_id','investor_registrations.*')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name. " - ". $v->registration_id."</option>";
            }
        }
    }


       public function loadMember2(Request $request)
    {
        $member = DB::table('saving_registrations')
        ->where('saving_registrations.branch_id',$request->branch_id)
        ->where('saving_registrations.area_id',$request->area_id)
        ->where('saving_registrations.approval',1)
        ->join('members','members.member_id','saving_registrations.member_id')
        ->select("saving_registrations.*",'members.aplicant_name')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name.'-'.$v->registration_id."</option>";
            }
        }
    }





       public function loadMember3(Request $request)
    {
        // return $request->schema_id;
        $member = DB::table('members')
        ->where('members.branch_id',$request->branch_id)
        ->where('members.area_id',$request->area_id)
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->member_id."'>".$v->aplicant_name. " - ". $v->member_id."</option>";
            }
        }
    }





    public function loadBranchMember(Request $request)
    {
        $member = internalloan::where('branch_id',$request->branch_id)
        ->where('status',1)
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->id."'>".$v->name."</option>";
            }
        }
    }



    public function loadBranchMember2(Request $request)
    {
        $member = loan::where('branch_id',$request->branch_id)
        ->where('status',1)
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->id."'>".$v->name."</option>";
            }
        }
    }



    public function getSchemaPer(Request $request)
    {
        // return $request->schema_id;
        $data = saving_schema::find($request->schema_id);

        return $data->percantage;
    }

    public function getSavingSchemaInstallment(Request $request)
    {
        // return $request->schema_id;
        $data = saving_schema::find($request->schema_id);

        return $data->installment_no.'and'.$data->duration;
    }


    public function getInvestmentSchemaInstallment(Request $request)
    {
        // return $request->schema_id;
        $data = investmentschema::find($request->schema_id);

        // return $data->id;

        return $data->installment_no.'and'.$data->duration;
    }

    public function incoming_data()
    {
        $totalNewSaving = DB::table('saving_registrations')->where('approval',0)->count();
        $totalinvestor  = DB::table('investor_registrations')->where('approval',0)->count();
        $totalSavingColl  = DB::table('saving_transactions')->where('transaction_type',1)->where('approval',0)->count();
        $totalSavingRet  = DB::table('saving_transactions')->where('transaction_type',2)->where('approval',0)->count();
        $totalNewIncome  = DB::table('incomes')->where('approval',0)->count();
        $totalNewExpense  = DB::table('expenses')->where('approval',0)->count();
        $totalHO_handover  = DB::table('ho_handovers')->where('approval',0)->count();
        $totalHO_coll  = DB::table('ho_collections')->where('approval',0)->count();
        $totalInterLoanHandover  = DB::table('internal_loan_handovers')->where('approval',0)->count();
        $totalInterLoanColl  = DB::table('internal_loan_collections')->where('approval',0)->count();
        $totalAssetExpense  = DB::table('asset_expenses')->where('approval',0)->count();
        $totalFixedDepositColl  = DB::table('fixed_deposit_collections')->where('approval',0)->count();
        $totalFixedDepositRet  = DB::table('fixed_deposit_returns')->where('approval',0)->count();

        $investment_collections  = DB::table('investment_collections')->where('approval',0)->count();

         $investment_handovers  = DB::table('investment_handovers')->where('approval',0)->count();

        return view('Backend.Layouts.incoming_data',compact('totalNewSaving','totalinvestor','totalSavingColl','totalSavingRet','totalNewIncome','totalNewExpense','totalHO_handover','totalHO_coll','totalInterLoanHandover','totalInterLoanColl','totalAssetExpense','totalFixedDepositColl','totalFixedDepositRet','investment_collections','investment_handovers'));
    }



    public function loaddeposite(Request $request)
    {
        $member = DB::table("saving_registrations")
        ->where('member_id',$request->member_id)
        ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
        ->where('saving_registrations.status',1)
        ->select('saving_registrations.*','saving_schemas.deposit_name')
        ->get();


        if($member)
        {
            foreach ($member as $v)
            {
                $check = DB::table('investor_registrations')->where('deposite',$v->registration_id)->where('status',1)->count();
                if($check == 0)
                {

                    echo "<option value='".$v->registration_id."'>".$v->registration_id." (".$v->deposit_name.")</option>";
                }
            }
        }
    }

    public function loadMobileNumber(Request $request)
    {
        $member = DB::table('members')->where('id',$request->member_id)->first();

        return $member->phone;
    }

    public function loadMemberId(Request $request)
    {
        $member = DB::table('members')->where('id',$request->member_id)->first();

        return $member->member_id;
    }


      public function getmemberphone($member_id)
    {
        $member = DB::table('members')->where('id',$member_id)->first();

        return response()->json($member->phone);
    }


      public function getinvestmentamount($member_id)
    {
        $member = DB::table('investor_registrations')->where('registration_id',$member_id)->first();

        return response()->json($member->amount);
    }


    public function loadDistrict(Request $request)
    {
        $district = DB::table('district_informations')->where('division_id',$request->division_id)->where('status',1)->get();

        if($district)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach($district as $v)
            {
                echo "<option value='".$v->id."'>".$v->district_name."</option>";
            }
        }

    }
    public function loadUpazila(Request $request)
    {
        $upazila = DB::table('upazila_informations')->where('district_id',$request->district_id)->where('status',1)->get();

        if($upazila)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach($upazila as $v)
            {
                echo "<option value='".$v->id."'>".$v->upazila_name."</option>";
            }
        }

    }


    public function fixed_deposit_reg_form()
    {
        return view('Backend.Others.fixed_deposit_reg_form');
    }
    public function investment_registration_form()
    {
        return view('Backend.Others.investment_registration_form');
    }
    public function check_letter()
    {
        return view('Backend.Others.check_letter');
    }
    public function gurantee_letter()
    {
        return view('Backend.Others.gurantee_letter');
    }
    public function check_lost_letter()
    {
        return view('Backend.Others.check_lost_letter');
    }
    public function member_reg_form()
    {
        return view('Backend.Others.member_reg_form');
    }
    public function saving_reg_form()
    {
        return view('Backend.Others.saving_reg_form');
    }

    public function company_structure()
    {
        if(Auth::user()->user_role == 1)
      {
        $data = employee_info::join('branch_infos','branch_infos.id','=','employee_infos.branch_id')
        ->select('employee_infos.*','branch_infos.branch_name')
        ->orderBy('sl','ASC')
        ->get();
    }
    else
    {
        $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
        ->join('employee_infos','employee_infos.branch_id','=','admin_branch_infos.branch_id')
        ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
        ->select('employee_infos.*','branch_infos.branch_name')
        ->get();
    }

        $total_user = User::count();
        $investment_schema = investmentschema::count();
        $saving_schema = saving_schema::count();
        $fixed_deposit_schema = fixed_deposit_schema::count();
        //total_transactions

        $grandtotals = [];
        //loan_recived
        $grandtotals['loan_recived'] = investment_collection::where('approval',1)->sum('investment_collection');
        $grandtotals['loan_provide'] = investment_handover::where('approval',1)->sum('investment_amount');
        //saving
        $grandtotals['saving_collection'] = saving_transaction::where('approval',1)->sum('deposit_ammount');
        $grandtotals['saving_provide'] = saving_transaction::where('approval',1)->sum('return_ammount');
        //deposit
        $grandtotals['deposit_collection'] = fixed_deposit_collection::where('approval',1)->sum('deposit_ammount');
        $grandtotals['deposit_provide']= fixed_deposit_return::where('approval',1)->sum('deposit_return_ammount');

        //total_loan_recived
        $totals = [];
        $totals['total_loan_recived'] = investment_collection::where('date',date('Y-m-d'))->where('approval',1)->sum('investment_collection');
        $totals['total_loan_provide'] = investment_handover::where('date',date('Y-m-d'))->where('approval',1)->sum('investment_amount');
        //saving
        $totals['total_saving_collection'] = saving_transaction::where('date',date('Y-m-d'))->where('approval',1)->sum('deposit_ammount');
        $totals['total_saving_provide'] = saving_transaction::where('date',date('Y-m-d'))->where('approval',1)->sum('return_ammount');
        //deposit
        $totals['total_deposit_collection'] = fixed_deposit_collection::where('collection_date',date('Y-m-d'))->where('approval',1)->sum('deposit_ammount');
        $totals['total_deposit_provide'] = fixed_deposit_return::where('return_date',date('Y-m-d'))->where('approval',1)->sum('deposit_return_ammount');
        return view('Backend.Layouts.company_structure',compact('data','total_user','investment_schema','saving_schema','fixed_deposit_schema','totals','grandtotals'));
    }


    public function getMemberData(Request $request)
    {
        // return $request->data;

        $member = DB::table('members')
        ->leftjoin('saving_registrations','members.member_id','saving_registrations.member_id')
        ->leftjoin('fixed_deposit_registrations','members.member_id','fixed_deposit_registrations.member_id')
        ->leftjoin('investor_registrations','members.member_id','investor_registrations.member_id')
        ->where('members.member_id','LIKE','%'.$request->data.'%')
        ->orWhere('members.aplicant_name','LIKE','%'.$request->data.'%')
        ->orWhere('members.phone','LIKE','%'.$request->data.'%')
        ->orWhere('saving_registrations.registration_id','LIKE','%'.$request->data.'%')
        ->orWhere('fixed_deposit_registrations.registration_id','LIKE','%'.$request->data.'%')
        ->orWhere('investor_registrations.registration_id','LIKE','%'.$request->data.'%')
        ->select('members.member_id','members.aplicant_name','members.phone','saving_registrations.registration_id as saving_id','saving_registrations.id as saving_pk_id','fixed_deposit_registrations.registration_id as fixed_deposit_id','investor_registrations.registration_id as investor_id','investor_registrations.id as invest_id')
        ->get();

        // return $member;

        return view('Backend.Layouts.search_data',compact('member'));
    }


    public function viewAllNotice()
    {
        $data = DB::table('notices')->orderBy('id','DESC')->paginate(15);
        return view('Backend.Layouts.all_notices',compact('data'));
    }

    public function fix_saving_schema()
    {
        $trans = DB::table('saving_transactions')->get();
        foreach($trans as $t)
        {
            // echo $t->member_id.'<br>';
            if($t->member_id != NULL)
            {
                $schema_id = DB::table('saving_registrations')->where('registration_id',$t->member_id)->first();
                DB::table('saving_transactions')->where('member_id',$t->member_id)->update([
                    'schema_id' => $schema_id->schema_id,
                ]);
            }
        }

        // return 'OK';
    }
    public function fix_deposit_schema()
    {
        $trans = DB::table('fixed_deposit_collections')->get();
        foreach($trans as $t)
        {
            // echo $t->member_id.'<br>';
            if($t->member_id != NULL)
            {
                $schema_id = DB::table('fixed_deposit_registrations')->where('registration_id',$t->member_id)->first();
                DB::table('fixed_deposit_collections')->where('member_id',$t->member_id)->update([
                    'schema_id' => $schema_id->schema_id,
                ]);
            }
        }

        // return 'OK';
    }
    public function fix_invest_schema()
    {
        $trans = DB::table('investment_collections')->get();
        foreach($trans as $t)
        {
            // echo $t->member_id.'<br>';
            if($t->member_id != NULL)
            {
                $schema_id = DB::table('investor_registrations')->where('registration_id',$t->member_id)->first();
                DB::table('investment_collections')->where('member_id',$t->member_id)->update([
                    'schema_id' => $schema_id->schema_id,
                ]);
            }
        }

        // return 'OK';
    }

    public function loadWeeklyArea(Request $request)
    {
        if(Auth::user()->user_role == 1)
        {
            $area = area_info::where('branch_id',$request->branch_id)->where('area_infos.status',1)
            ->where('type','weekly')
            ->get();
        }
        else
        {
            $area = admin_area_info::where('admin_area_infos.admin_id',Auth::user()->id)
            ->join('area_infos','area_infos.id','=','admin_area_infos.area_id')
            ->where('area_infos.status',1)->where('area_infos.branch_id',$request->branch_id)
            ->where('type','weekly')
            ->select('area_infos.*')
            ->get();
        }
        if($area)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach($area as $v)
            {
                echo "<option value='".$v->id."'>".$v->area_name."</option>";
            }
        }
    }
    public function loadWeeklyDayArea(Request $request)
    {
        if(Auth::user()->user_role == 1)
        {
            $area = area_info::where('branch_id',$request->branch_id)->where('area_infos.status',1)
            ->where('type','weekly')
            ->where('day',$request->day)
            ->get();
        }
        else
        {
            $area = admin_area_info::where('admin_area_infos.admin_id',Auth::user()->id)
            ->join('area_infos','area_infos.id','=','admin_area_infos.area_id')
            ->where('area_infos.status',1)->where('area_infos.branch_id',$request->branch_id)
            ->where('type','weekly')
            ->where('day',$request->day)
            ->select('area_infos.*')
            ->get();
        }
        if($area)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach($area as $v)
            {
                echo "<option value='".$v->id."'>".$v->area_name."</option>";
            }
        }
    }

    public function loadAreaData(Request $request)
    {
        $grandtotals = [];
        //loan_recived
        $grandtotals['loan_recived'] = investment_collection::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('investment_collection');
        $grandtotals['loan_provide'] = investment_handover::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('investment_amount');
        //saving
        $grandtotals['saving_collection'] = saving_transaction::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_ammount');
        $grandtotals['saving_provide'] = saving_transaction::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('return_ammount');
        //deposit
        $grandtotals['deposit_collection'] = fixed_deposit_collection::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_ammount');
        $grandtotals['deposit_provide']= fixed_deposit_return::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_return_ammount');

        //total_loan_recived
        $totals = [];
        $totals['total_loan_recived'] = investment_collection::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->sum('investment_collection');
        $totals['total_loan_provide'] = investment_handover::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->sum('investment_amount');
        //saving
        $totals['total_saving_collection'] = saving_transaction::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->sum('deposit_ammount');
        $totals['total_saving_provide'] = saving_transaction::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->sum('return_ammount');
        //deposit
        $totals['total_deposit_collection'] = fixed_deposit_collection::where('collection_date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->sum('deposit_ammount');
        $totals['total_deposit_provide'] = fixed_deposit_return::where('return_date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->sum('deposit_return_ammount');

        return view('Backend.Layouts.branch_data',compact('grandtotals','totals'));

    }
    public function loadBranchData(Request $request)
    {
        $grandtotals = [];
        //loan_recived
        $grandtotals['loan_recived'] = investment_collection::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('investment_collection');
        $grandtotals['loan_provide'] = investment_handover::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('investment_amount');
        //saving
        $grandtotals['saving_collection'] = saving_transaction::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_ammount');
        $grandtotals['saving_provide'] = saving_transaction::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('return_ammount');
        //deposit
        $grandtotals['deposit_collection'] = fixed_deposit_collection::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_ammount');
        $grandtotals['deposit_provide']= fixed_deposit_return::where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_return_ammount');

        //total_loan_recived
        $totals = [];
        $totals['total_loan_recived'] = investment_collection::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('investment_collection');
        $totals['total_loan_provide'] = investment_handover::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('investment_amount');
        //saving
        $totals['total_saving_collection'] = saving_transaction::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_ammount');
        $totals['total_saving_provide'] = saving_transaction::where('date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('return_ammount');
        //deposit
        $totals['total_deposit_collection'] = fixed_deposit_collection::where('collection_date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_ammount');
        $totals['total_deposit_provide'] = fixed_deposit_return::where('return_date',date('Y-m-d'))->where('approval',1)->where('branch_id',$request->branch_id)->where('area_id',$request->area_id)->sum('deposit_return_ammount');

        return view('Backend.Layouts.branch_data',compact('grandtotals','totals'));

    }



}
