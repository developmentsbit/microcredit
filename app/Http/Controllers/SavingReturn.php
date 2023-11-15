<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\area_info;
use App\Models\member;
use App\Models\saving_schema;
use App\Models\saving_registration;
use App\Models\savings_registration_nominee;
use App\Models\User;
use App\Models\saving_transaction;
use App\Models\admin_branch_info;
use DB;
use lemonpatwari\BanglaNumber\NumberToBangla;
use Yajra\DataTables\Facades\DataTables;


use Auth;

class SavingReturn extends Controller
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
        if(Auth::user()->user_role == 1)
        {
            $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
                    ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
                    ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
                    ->join('members','members.member_id','=','saving_registrations.member_id')
                    ->join('users','users.id','=','saving_transactions.admin_id')
                    ->where('saving_transactions.transaction_type',2)
                    ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*')
                    ->get();

                    if ($request->ajax()) {
                        return Datatables::of($data)
                                ->addIndexColumn()
                                ->addColumn('applicant_name_id',function($row){
                                    return $row->aplicant_name.' - '.$row->member_id;
                                })
                                ->addColumn('action',function($v){
                                    $edit = '<a id="" target="blank" href="'.route('saving_return.show',$v->id).'" class="btn btn-dark btn-sm" style="float: left;margin-right:10px;"><i class="feather icon-file"></i></a>';

                                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                                    {
                                        $delete = '<form action="'.route('saving_return.destroy',$v->id).'" method="post">
                                            '.csrf_field().'
                                            '.method_field("DELETE").'
                                            <button  id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>';
                                    }
                                    else
                                    {
                                        $delete = '';
                                    }

                                    return $edit." ".$delete;

                                })
                                ->rawColumns(['applicant_name_id','action'])
                                ->make(true);
                    }

        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('saving_transactions','saving_transactions.branch_id','=','admin_branch_infos.branch_id')
                    ->leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
                    ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
                    ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
                    ->join('members','members.member_id','=','saving_registrations.member_id')
                    ->join('users','users.id','=','saving_transactions.admin_id')
                    ->where('saving_transactions.transaction_type',2)
                    ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*')
                    ->get();
                    if ($request->ajax()) {
                        return Datatables::of($data)
                                ->addIndexColumn()
                                ->addColumn('applicant_name_id',function($row){
                                    return $row->aplicant_name.' - '.$row->member_id;
                                })
                                ->addColumn('action',function($v){
                                    $edit = '<a id="" target="blank" href="'.route('saving_return.show',$v->id).'" class="btn btn-dark btn-sm" style="float: left;margin-right:10px;"><i class="feather icon-file"></i></a>';

                                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                                    {
                                        $delete = '<form action="'.route('saving_return.destroy',$v->id).'" method="post">
                                            '.csrf_field().'
                                            '.method_field("DELETE").'
                                            <button  id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>';
                                    }
                                    else
                                    {
                                        $delete = '';
                                    }

                                    return $edit." ".$delete;

                                })
                                ->rawColumns(['applicant_name_id','action'])
                                ->make(true);
                    }


        }
        $sl = 1;
        return view("Backend.User.SavingReturn.index",compact('data','sl'));
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
            // $member = member::where('status',1)->get();
            $member = saving_registration::join('members','members.id','=','saving_registrations.member_id')
                      ->where('members.status',1)
                      ->select('members.aplicant_name','members.id as member_id','saving_registrations.*')
                      ->get();

            // return $member;
        }
        else
        {
            $member = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                     ->join('members','members.branch_id','=','admin_branch_infos.branch_id')
                     ->join('saving_registrations','saving_registrations.member_id','=','members.id')
                     ->where('members.status',1)
                     ->select('members.aplicant_name','members.id as member_id','saving_registrations.*')
                     ->get();
        }
        return view('Backend.User.SavingReturn.create',compact('branch','member'));
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
            'return_ammount'=>'required',
            'profit_ammount'=>'required',
            // 'total'=>'required',
        ],
        [
            'return_date.required'=>'ফেরত তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'return_ammount.required'=>'ফেরত পরিমাণ প্রদান করুন',
            'profit_ammount.required'=>'লাভ পরিমাণ প্রদান করুন',
            // 'total.required'=>'মোট টাকা প্রদান করুন',
        ]);

        $explode = explode('/',$request->return_date);
        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $insert = saving_transaction::insert([
            'date'=>$date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'return_ammount'=>$request->return_ammount,
            'profit_ammount'=>$request->profit_ammount,
            'admin_id'=>$request->admin_id,
            'transaction_type'=>2,
        ]);

        if($insert)
        {
            return redirect('saving_return')->with('success','সঞ্চয় ফেরত সম্পন্ন করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় ফেরত সম্পন্ন করা হয়নি');
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
        $data = saving_transaction::where('saving_transactions.transaction_type',2)
        ->where('saving_transactions.id',$id)
        ->join('branch_infos','branch_infos.id','=','saving_transactions.branch_id')
        ->join('area_infos','area_infos.id','=','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.id','=','saving_registrations.member_id')
        ->select('saving_transactions.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_transactions.date as transaction_date','saving_registrations.registration_id as aplicant_id')
        ->first();

        $numberToBangla = new NumberToBangla();

        $totalReturnWord = $numberToBangla->bnWord($data->return_ammount);

        // return $data;

        return view('Backend.User.SavingReturn.voucher',compact('data','totalReturnWord'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = saving_transaction::find($id);
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
        $area = area_info::where('branch_id',$data->branch_id)->get();
        $member = member::where('branch_id',$data->branch_id)->where('area_id',$data->area_id)->get();
        return view('Backend.User.SavingReturn.edit',compact('branch','data','area','member'));
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
            'return_ammount'=>'required',
            'profit_ammount'=>'required',
            'total'=>'required',
        ],
        [
            'return_date.required'=>'ফেরত তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'return_ammount.required'=>'ফেরত পরিমাণ প্রদান করুন',
            'profit_ammount.required'=>'লাভ পরিমাণ প্রদান করুন',
            'total.required'=>'মোট টাকা প্রদান করুন',
        ]);

        $update = saving_transaction::find($id)->update($request->except('_token','_method'));
        if($update)
        {
            return redirect('saving_return')->with('success','সঞ্চয় ফেরত তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় ফেরত তথ্য আপডেট করা হয়নি');
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
        $delete = saving_transaction::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','সঞ্চয় ফেরত তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় ফেরত তথ্য ডিলিট করা হয়নি');
        }
    }

    public function calCulateProfit(Request $request)
    {

        $member = saving_registration::where('registration_id',$request->member_id)->first();

        $schema_info = saving_schema::where('id',$member->schema_id)->first();

        return $schema_info->percantage;

    }

    public function saving_return_new()
    {
        if(Auth::user()->user_role == 1)
        {
            $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
                    ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
                    ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
                    ->join('members','members.member_id','=','saving_registrations.member_id')
                    ->join('users','users.id','=','saving_transactions.admin_id')
                    ->where('saving_transactions.approval',0)
                    ->where('saving_transactions.transaction_type',2)
                    ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*')
                    ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('saving_transactions','saving_transactions.branch_id','=','admin_branch_infos.branch_id')
                    ->leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
                    ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
                    ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
                    ->join('members','members.member_id','=','saving_registrations.member_id')
                    ->join('users','users.id','=','saving_transactions.admin_id')
                    ->where('saving_transactions.approval',0)
                    ->where('saving_transactions.transaction_type',2)
                    ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*')
                    ->get();

        }
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
        $sl = 1;
        return view('Backend.User.SavingReturn.new_data',compact('data','sl','branch'));
    }
    public function approved_returns($id)
    {
        $approved = saving_transaction::find($id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        if($approved)
        {
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }

    public function approveAllSavingReturns(Request $request)
    {
        for ($i=0; $i < count($request->saving_return_id) ; $i++)
        {
            $approve = saving_transaction::where('id',$request->saving_return_id[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }

    public function savingsMemberStatementShow(Request $request)
    {

        $saving = DB::table("saving_registrations")
		->where("saving_registrations.registration_id",$request->member_id)
		->join('members','members.id','saving_registrations.member_id')
		->select("saving_registrations.*",'members.aplicant_name')
		->first();

		$savings_collections = DB::table("saving_transactions")
		->where("member_id",$request->member_id)
		->select('date')
		->groupBy("date")
		->get();


        $member_id = $request->member_id;



		$branch = DB::table('branch_infos')
		->where("id",$request->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$request->area_id)
		->first();

		return view("Backend.User.SavingReturn.show_savings_statement_reports",compact('saving','savings_collections','branch','area','member_id'));

    }

    public function loadSavingReturnMember(Request $request)
    {
        $member = saving_registration::join('members','members.member_id','=','saving_registrations.member_id')
        ->where('members.branch_id',$request->branch_id)
        ->where('members.area_id',$request->area_id)
        ->where('saving_registrations.status',1)
        ->select('members.aplicant_name','members.id as member_id','saving_registrations.*')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                $check = DB::table('saving_transactions')->where('member_id',$v->registration_id)->sum('deposit_ammount');

                if($check > 0)
                {

                    echo "<option value='".$v->registration_id."'>".$v->aplicant_name. "-". $v->registration_id ."</option>";
                }

            }
        }
    }

    public function loadSavingReturnBranch(Request $request)
    {

        $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
        ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.id','=','saving_registrations.member_id')
        ->join('users','users.id','=','saving_transactions.admin_id')
        ->where('saving_transactions.branch_id',$request->branch_id)
        ->where('saving_transactions.approval',0)
        ->where('saving_transactions.transaction_type',2)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
        ->get();

        $sl = 1;

        return view('Backend.User.SavingReturn.load_new_data',compact('data','sl'));

    }

    public function loadAreaSavingReturn(Request $request)
    {
        $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
        ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.id','=','saving_registrations.member_id')
        ->join('users','users.id','=','saving_transactions.admin_id')
        ->where('saving_transactions.area_id',$request->area_id)
        ->where('saving_transactions.approval',0)
        ->where('saving_transactions.transaction_type',2)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
        ->get();
        $sl = 1;

        return view('Backend.User.SavingReturn.load_new_data',compact('data','sl'));

    }

    public function showNewSavingReturnReport(Request $request)
    {

        $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
        ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.id','=','saving_registrations.member_id')
        ->join('users','users.id','=','saving_transactions.admin_id')
        ->where('saving_transactions.branch_id',$request->branch_id)
        ->where('saving_transactions.area_id',$request->area_id)
        ->where('saving_transactions.approval',0)
        ->where('saving_transactions.transaction_type',2)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
        ->get();

        $total_return = saving_transaction::where('saving_transactions.branch_id',$request->branch_id)
        ->where('saving_transactions.area_id',$request->area_id)
        ->where('saving_transactions.approval',0)
        ->where('saving_transactions.transaction_type',2)
        ->sum('saving_transactions.return_ammount');

        $total_profit = saving_transaction::where('saving_transactions.branch_id',$request->branch_id)
        ->where('saving_transactions.area_id',$request->area_id)
        ->where('saving_transactions.approval',0)
        ->where('saving_transactions.transaction_type',2)
        ->sum('saving_transactions.profit_ammount');

        $branch = branch_info::where('id',$request->branch_id)->first();
        $area = area_info::where('id',$request->area_id)->first();

        $sl = 1;

        return view('Backend.User.SavingReturn.new_data_report',compact('data','branch','area','total_return','sl','total_profit'));


    }

}
