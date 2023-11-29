<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\branch_info;
use App\Models\area_info;
use App\Models\member;
use App\Models\fixed_deposit_collection;
use App\Models\fixed_deposit_return;
use App\Models\admin_branch_info;
use App\Models\fixed_deposit_registration;
use App\Models\deposit_profit;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;


class FixedDepositReturn extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->user_role == 1)
        {
            $branch = branch_info::where('status',1)->get();

        }
        else
        {

            $branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                      ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                      ->where('branch_infos.status',1)
                      ->select('branch_infos.*')
                      ->get();
        }
        if(Auth::user()->user_role == 1)
        {

            $member = fixed_deposit_registration::where('fixed_deposit_registrations.status',1)
                        ->join('members','members.id','=','fixed_deposit_registrations.member_id')
                        ->select('fixed_deposit_registrations.*','members.aplicant_name')
                        ->get();
        }
        else
        {
            $member = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('fixed_deposit_registrations','fixed_deposit_registrations.branch_id','=','admin_branch_infos.branch_id')
                    ->join('members','members.id','=','fixed_deposit_registrations.member_id')
                    ->where('fixed_deposit_registrations.status',1)
                    ->select('fixed_deposit_registrations.*','members.aplicant_name')
                    ->get();

        }
        return view('Backend.User.FixedDepositReturn.create',compact('branch','member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'return_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
        ],[
            'return_date.required'=>'ফেরতের তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
        ]);

        $explode = explode('/',$request->return_date);

        $return_date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $insert = fixed_deposit_collection::insert([
            'collection_date'=>$return_date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'return_deposit'=>$request->deposit_return_ammount,
            'return_profit'=>$request->profit_ammount,
            'comment'=>$request->comment,
            'status'=>1,
            'admin_id'=>$request->admin_id,
            'deposit_ammount'=>$request->deposit_ammount,
            'service_charge'=>$request->service_charge,
        ]);

        if($insert)
        {
            return redirect('/fixed_deposit_coll_return')->with('success','ফিক্সড ডিপোজিট ফেরত সম্পন্ন করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট ফেরত সম্পন্ন করা হয়নি');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->user_role == 1)
        {
            $branch = branch_info::where('status',1)->get();

        }
        else
        {

            $branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                      ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                      ->where('branch_infos.status',1)
                      ->select('branch_infos.*')
                      ->get();
        }
        $data = fixed_deposit_return::find($id);
        $area = area_info::where('branch_id',$data->branch_id)->get();
        if(Auth::user()->user_role == 1)
        {

            $member = fixed_deposit_registration::where('fixed_deposit_registrations.status',1)
                        ->join('members','members.id','=','fixed_deposit_registrations.member_id')
                        ->select('fixed_deposit_registrations.*','members.aplicant_name')
                        ->get();
        }
        else
        {
            $member = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('fixed_deposit_registrations','fixed_deposit_registrations.branch_id','=','admin_branch_infos.branch_id')
                    ->join('members','members.id','=','fixed_deposit_registrations.member_id')
                    ->where('fixed_deposit_registrations.status',1)
                    ->select('fixed_deposit_registrations.*','members.aplicant_name')
                    ->get();

        }
        return view('Backend.User.FixedDepositReturn.edit',compact('branch','area','member','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'return_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            'deposit_return_ammount'=>'required',
            'profit_ammount'=>'required',
            'total'=>'required',
            'status'=>'required',
        ],[
            'return_date.required'=>'ফেরতের তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'deposit_return_ammount.required'=>'ফেরত পরিমাণ প্রদান করুন',
            'profit_ammount.required'=>'লাভের পরিমাণ প্রদান করুন',
            'total.required'=>'মোট টাকা প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $explode = explode('/',$request->return_date);

        $return_date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $update = fixed_deposit_return::find($id)->update([
            'return_date'=>$return_date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'deposit_return_ammount'=>$request->deposit_return_ammount,
            'profit_ammount'=>$request->profit_ammount,
            'total'=>$request->total,
            'comment'=>$request->comment,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
        ]);

        if($update)
        {
            return redirect('/fixeddeposit_return')->with('success','ফিক্সড ডিপোজিট ফেরত তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট ফেরত তথ্য আপডেট করা হয়নি');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = fixed_deposit_collections::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','ফিক্সড ডিপোজিট ফেরত তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট ফেরত তথ্য ডিলিট করা হয়নি');
        }
    }

    public function calculateFixedDepositProfit(Request $request)
    {

        $schema_id = DB::table('fixed_deposit_registrations')->where('registration_id',$request->member_id)->first();

        // return $schema_id->schema_id;

        $schema_per = DB::table('fixed_deposit_schemas')->where('id',$schema_id->schema_id)->first();

        $result = $request->deposit_return_ammount * $schema_per->percantage / 100;

        return $result;

    }

    public function new_fixed_deposit_return()
    {

        if(Auth::user()->user_role == 1)
        {
            $branch = branch_info::where('status',1)->get();

        }
        else
        {

            $branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                      ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                      ->where('branch_infos.status',1)
                      ->select('branch_infos.*')
                      ->get();
        }

        if(Auth::user()->user_role == 1)
        {

            $data = fixed_deposit_return::leftjoin('branch_infos','branch_infos.id','fixed_deposit_returns.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_returns.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_returns.member_id')
            ->join('members','members.id','=','fixed_deposit_registrations.member_id')
            ->where('fixed_deposit_returns.approval',0)
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_returns.*')
            ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('fixed_deposit_returns','fixed_deposit_returns.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','fixed_deposit_returns.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_returns.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_returns.member_id')
            ->join('members','members.id','=','fixed_deposit_registrations.member_id')
            ->where('fixed_deposit_returns.approval',0)
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_returns.*')
            ->get();

        }
        $sl=1;
        return view('Backend.User.FixedDepositReturn.new_data',compact('data','sl','branch'));
    }

    public function approved_fixed_depositret($id)
    {
        $approval = DB::table('fixed_deposit_returns')->where('id',$id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function approveAllFixedDepoReturn(Request $request)
    {
        for ($i=0; $i < count($request->fixed_depo_return_id) ; $i++)
        {
            $approve = fixed_deposit_return::where('id',$request->fixed_depo_return_id[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }

    public function loadDepositReturnBranch(Request $request)
    {

        $data = fixed_deposit_return::leftjoin('branch_infos','branch_infos.id','fixed_deposit_returns.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_returns.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_returns.member_id')
            ->join('members','members.id','=','fixed_deposit_registrations.member_id')
            ->where('fixed_deposit_returns.approval',0)
            ->where('fixed_deposit_returns.branch_id',$request->branch_id)
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_returns.*')
            ->get();

            $sl = 1;

        return view('Backend.User.FixedDepositReturn.load_new_data',compact('data','sl'));

    }


    public function loadAreaDepositReturn(Request $request)
    {

        $data = fixed_deposit_return::leftjoin('branch_infos','branch_infos.id','fixed_deposit_returns.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_returns.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_returns.member_id')
            ->join('members','members.id','=','fixed_deposit_registrations.member_id')
            ->where('fixed_deposit_returns.approval',0)
            ->where('fixed_deposit_returns.area_id',$request->area_id)
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_returns.*')
            ->get();

            $sl = 1;

        return view('Backend.User.FixedDepositReturn.load_new_data',compact('data','sl'));

    }

    public function showNewDepositReturnReport(Request $request)
    {
        $data = fixed_deposit_return::leftjoin('branch_infos','branch_infos.id','fixed_deposit_returns.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_returns.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_returns.member_id')
            ->join('members','members.id','=','fixed_deposit_registrations.member_id')
            ->where('fixed_deposit_returns.approval',0)
            ->where('fixed_deposit_returns.branch_id',$request->branch_id)
            ->where('fixed_deposit_returns.area_id',$request->area_id)
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_returns.*')
            ->get();

            $branch = branch_info::where('id',$request->branch_id)->first();
            $area = area_info::where('id',$request->area_id)->first();

            $total = fixed_deposit_return::where('fixed_deposit_returns.approval',0)
            ->where('fixed_deposit_returns.branch_id',$request->branch_id)
            ->where('fixed_deposit_returns.area_id',$request->area_id)
            ->sum('fixed_deposit_returns.deposit_return_ammount');

            $sl = 1;

        return view('Backend.User.FixedDepositReturn.show_new_return_report',compact('data','sl','total','branch','area'));
    }

    public function fixed_deposit_coll_return(Request $request)
    {
        if(Auth::user()->user_role == 1)
        {

            $data = fixed_deposit_collection::leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
            ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_collections.*')
            ->get();
            // return $data;
            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('applicant_name_id',function($v){
                    return $v->aplicant_name.' - '.$v->member_id;
                })
                ->addColumn('status',function($v){
                    if($v->status == 1)
                    {
                        return '<span class="badge badge-success">Active</span>';
                    }
                    else
                    {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action',function($v){
                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                    {
                        $delete = '<form action="'.route('fixeddeposit_collection.destroy',$v->id).'" method="post">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                    </form>';

                    }
                    else
                    {
                        $delete = '';
                    }

                    return $delete;
                })
                ->rawColumns(['applicant_name_id','status','action'])
                ->make(true);
            }

        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('fixed_deposit_collections','fixed_deposit_collections.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
            ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_collections.*')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('applicant_name_id',function($v){
                    return $v->aplicant_name.' - '.$v->member_id;
                })
                ->addColumn('status',function($v){
                    if($v->status == 1)
                    {
                        return '<span class="badge badge-success">Active</span>';
                    }
                    else
                    {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action',function($v){
                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                    {
                        $delete = '<form action="'.route('fixeddeposit_return.destroy',$v->id).'" method="post">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                    </form>';

                    }
                    else
                    {
                        $delete = '';
                    }

                    return $delete;
                })
                ->rawColumns(['applicant_name_id','status','action'])
                ->make(true);
            }

        }
        $sl=1;
        return view('Backend.User.FixedDepositReturn.index',compact('data','sl'));
    }

    public function profitCalculate(Request $request)
    {
        $total_profit = DB::table('fixed_deposit_collections')->where('member_id',$request->member_id)->sum('profit');

       $total_return_profit = DB::table('fixed_deposit_collections')->where('member_id',$request->member_id)->sum('return_profit');

       return $total_profit - $total_return_profit;
    }

    public function profit_withdraw()
    {
        if(Auth::user()->user_role == 1)
        {
            $branch = branch_info::where('status',1)->get();

        }
        else
        {

            $branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                      ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                      ->where('branch_infos.status',1)
                      ->select('branch_infos.*')
                      ->get();
        }

        return view('Backend.User.ProfitWithdraw.create',compact('branch'));
    }

    public function getProfitAmount(Request $request)
    {
        $profit_amount = deposit_profit::where('deposit_id',$request->deposit_id)->sum('profit');
        $return_profit = fixed_deposit_return::where('member_id',$request->deposit_id)->sum('profit_ammount');
        $result = $profit_amount - $return_profit;
        return $result;
    }

    public function profitStore(Request $request)
    {
        $explode = explode('/',$request->return_date);

        $return_date = $explode[2].'-'.$explode[1].'-'.$explode[0];
        $insert = fixed_deposit_return::create([
            "return_date" => $return_date,
            "branch_id" => $request->branch_id,
            "area_id" => $request->area_id,
            "member_id" => $request->member_id,
            "profit_ammount" => $request->profit_amount,
            "comment" => $request->comment,
            'status' => 1,
            "admin_id" => $request->admin_id,
            'deposit_return_ammount' => '0.00',
            'total' => '0.00',
        ]);

        if($insert)
        {
            return redirect()->back()->with('success','ফিক্সড ডিপোজিট লাভ উত্তোলন সম্পন্ন করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট লাভ উত্তোলন সম্পন্ন করা হয়নি');
        }
    }
}
