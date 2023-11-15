<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\investment_handover;
use App\Models\admin_branch_info;
use App\Models\branch_info;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class InvestmentHandover extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dateformate($x)
    {
        $d=explode('/', $x);
        return $d[2].'-'.$d[1].'-'.$d[0];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->user_role == 1)
        {
            $data = DB::table("investment_handovers")
            ->leftjoin("branch_infos",'branch_infos.id','investment_handovers.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_handovers.area_id')
            ->leftjoin("investor_registrations","investor_registrations.registration_id","investment_handovers.member_id")
            ->leftjoin("members",'members.member_id','investor_registrations.member_id')
            ->select("investment_handovers.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('member_name',function($row){
                    return $row->aplicant_name;
                })
                ->addColumn('action',function($d){
                    return '<form id="" action="'.route('investment_handover.destroy',$d->id) .'" method="post" onsubmit="showAlert()">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" class="cofirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                </form>';
                })
                ->addColumn('risk_amount',function($d){
                    $total_risk = DB::table('investor_riskamount')->where('registration_id',$d->member_id)->sum('risk_amount');

                    $total_withdraw = DB::table('investor_riskamount')->where('registration_id',$d->member_id)->sum('withdraw');
                    $risk_amount = $total_risk - $total_withdraw;

                    return $risk_amount;
                })
                ->rawColumns(['action','member_name'])
                ->make(true);
            }
        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('investment_handovers','investment_handovers.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin("branch_infos",'branch_infos.id','investment_handovers.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_handovers.area_id')
            ->leftjoin("investor_registrations","investor_registrations.registration_id","investment_handovers.member_id")
            ->leftjoin("members",'members.member_id','investor_registrations.member_id')
            ->select("investment_handovers.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('member_name',function($row){
                    return $member->aplicant_name;
                })
                ->addColumn('action',function($d){
                    return '<form id="" action="'.route('investment_handover.destroy',$d->id) .'" method="post" onsubmit="showAlert()">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" class="cofirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                </form>';
                })
                ->addColumn('risk_amount',function($d){
                    $total_risk = DB::table('investor_riskamount')->where('registration_id',$d->member_id)->sum('risk_amount');

                    $total_withdraw = DB::table('investor_riskamount')->where('registration_id',$d->member_id)->sum('withdraw');

                    $risk_amount = $total_risk - $total_withdraw;

                    return $risk_amount;
                })
                ->rawColumns(['action','risk_amount','member_name'])
                ->make(true);
            }
        }

        return view('Backend.User.InvestmentHandover.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.InvestmentHandover.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insert = investment_handover::create($request->except('_token','date'));
        $date = $this->dateformate($request->date);
        investment_handover::find($insert->id)->update(['date'=>$date]);

       $m_id =  DB::table('investor_registrations')->where('registration_id',$request->member_id)->select('member_id')->first();


        if ($request->risk_amount > 0) {
            DB::table("investor_riskamount")->insert([
              'date'            => date('Y-m-d'),
              'member_id'       => $m_id->member_id,
              'registration_id' => $request->member_id,
              'risk_amount'     => $request->risk_amount


          ]);
        }

        if($insert)
        {
            return redirect('investment_handover')->with('success','বিনিয়োগ প্রদান সম্পন্ন হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ প্রদান সম্পন্ন হয়নি');
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
        $data = investment_handover::find($id);
        return view('Backend.User.InvestmentHandover.edit',compact('data'));
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
        $update = investment_handover::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('investment_handover')->with('success','বিনিয়োগ প্রদান তথ্য আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ প্রদান তথ্য আপডেট করা হয়নি');
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
       $delete = investment_handover::where('id',$id)->delete();
       if($delete)
       {
        return redirect()->back()->with('success','বিনিয়োগ প্রদান ডিলিট করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','বিনিয়োগ প্রদান ডিলিট করা হয়নি');
    }
}












public function investment_handovers_show(){

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
        $data = DB::table("investment_handovers")
        ->leftjoin("branch_infos",'branch_infos.id','investment_handovers.branch_id')
        ->leftjoin("area_infos",'area_infos.id','investment_handovers.area_id')
        ->leftjoin("investor_registrations",'investor_registrations.registration_id','investment_handovers.member_id')
        ->leftjoin("members",'members.member_id','investor_registrations.member_id')
        ->select("investment_handovers.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
        ->where("investment_handovers.approval",0)
        ->get();
    }
    else
    {
        $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
        ->join('investment_handovers','investment_handovers.branch_id','=','admin_branch_infos.branch_id')
        ->leftjoin("branch_infos",'branch_infos.id','investment_handovers.branch_id')
        ->leftjoin("area_infos",'area_infos.id','investment_handovers.area_id')
        ->leftjoin("members",'members.member_id','investment_handovers.member_id')
        ->select("investment_handovers.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
        ->where("investment_handovers.approval",0)
        ->get();
    }

    return view('Backend.User.InvestmentHandover.investment_handovers_show',compact('data','branch'));


}





public function investment_handovers_show_approve($id)
{
    $approve = investment_handover::where('id',$id)->update([
        'approval'=>1,
        'approved_by'=>Auth::user()->id,
        'status' => 1,
    ]);

    if($approve)
    {
        return redirect()->back()->with('success','বিনিয়োগ প্রদান  অ্যাপ্রুভ হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','বিনিয়োগ প্রদান  অ্যাপ্রুভ হয়নি');
    }
}


public function approve_all_investor_handovers(Request $request)
{

    for ($i=0; $i < count($request->saving_id) ; $i++)
    {
        $approve = investment_handover::where('id',$request->saving_id[$i])->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
            'status' => 1,
        ]);
    }

    return 1;
}

public function loadInvestmentHnadoverBranch(Request $request)
{

    $data = DB::table("investment_handovers")
    ->leftjoin("branch_infos",'branch_infos.id','investment_handovers.branch_id')
    ->leftjoin("area_infos",'area_infos.id','investment_handovers.area_id')
    ->leftjoin("members",'members.id','investment_handovers.member_id')
    ->select("investment_handovers.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
    ->where("investment_handovers.approval",0)
    ->where('investment_handovers.branch_id',$request->branch_id)
    ->get();

    return view('Backend.User.InvestmentHandover.load_data',compact('data'));

}


public function loadAreaInvestmentHandover(Request $request)
{

    $data = DB::table("investment_handovers")
    ->leftjoin("branch_infos",'branch_infos.id','investment_handovers.branch_id')
    ->leftjoin("area_infos",'area_infos.id','investment_handovers.area_id')
    ->leftjoin("members",'members.id','investment_handovers.member_id')
    ->select("investment_handovers.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
    ->where("investment_handovers.approval",0)
    ->where('investment_handovers.area_id',$request->area_id)
    ->get();

    return view('Backend.User.InvestmentHandover.load_data',compact('data'));

}

public function showInvestmentHandoverReport(Request $request)
{

    $data = DB::table("investment_handovers")
    ->leftjoin("branch_infos",'branch_infos.id','investment_handovers.branch_id')
    ->leftjoin("area_infos",'area_infos.id','investment_handovers.area_id')
    ->leftjoin("members",'members.id','investment_handovers.member_id')
    ->where('investment_handovers.branch_id',$request->branch_id)
    ->where('investment_handovers.area_id',$request->area_id)
    ->select("investment_handovers.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
    ->get();


    $total = DB::table("investment_handovers")
    ->where('investment_handovers.branch_id',$request->branch_id)
    ->where('investment_handovers.area_id',$request->area_id)
    ->sum('investment_handovers.investment_amount');

    $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();
    $area = DB::table('area_infos')->where('id',$request->area_id)->first();

    $sl = 1;

    return view('Backend.User.InvestmentHandover.show_investment_handover_report',compact('data','branch','area','sl','total'));

}

public function getRiskAmount(Request $request)
{
    // return $request->register_id;

    $total_risk_amount = DB::table('investor_riskamount')->where('registration_id',$request->register_id)->sum('risk_amount');

    return $total_risk_amount;
}


}
