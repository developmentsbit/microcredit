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
use Auth;
use NumberToWords\NumberToWords;
use lemonpatwari\BanglaNumber\NumberToBangla;
use Yajra\DataTables\Facades\DataTables;

class SavingCollection extends Controller
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
                ->where('saving_transactions.transaction_type',1)
                ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
                ->get();

                if ($request->ajax()) {
                    return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('applicant_name_id',function($row){
                                return $row->aplicant_name.' - '.$row->registration_id;
                            })
                            ->addColumn('total',function($row){
                                $total_deposite = DB::table('saving_transactions')->where('member_id',$row->registration_id)->where('transaction_type',1)->sum('deposit_ammount');

                                $total_return = DB::table('saving_transactions')->where('member_id',$row->registration_id)->where('transaction_type',2)->sum('return_ammount');

                                $result = $total_deposite - $total_return;

                                return $result;
                            })
                            ->addColumn('action',function($row){
                                $edit = '<a id="" target="blank" href="'.route('saving_collection.show',$row->id).'" class="btn btn-dark btn-sm" style="float: left;margin-right:10px;"><i class="feather icon-file"></i></a>';

                                if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $row->approval == 0)
                                {
                                    $delete = '<form action="'.route('saving_collection.destroy',$row->id).'" method="post">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                    <button onclick="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                </form>';
                                }
                                else
                                {
                                    $delete ='';
                                }

                                return $edit." ".$delete;
                            })
                            ->rawColumns(['applicant_name_id','action','total'])
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
                ->where('saving_transactions.transaction_type',1)
                ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
                ->get();
                if ($request->ajax()) {
                    return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('applicant_name_id',function($row){
                                return $row->aplicant_name.' - '.$row->registration_id;
                            })

                            ->addColumn('total',function($row){
                                $total_deposite = DB::table('saving_transactions')->where('member_id',$row->registration_id)->where('transaction_type',1)->sum('deposit_ammount');

                                $total_return = DB::table('saving_transactions')->where('member_id',$row->registration_id)->where('transaction_type',2)->sum('return_ammount');

                                $result = $total_deposite - $total_return;

                                return $result;
                            })

                            ->addColumn('action',function($row){
                                $edit = '<a id="" target="blank" href="'.route('saving_collection.show',$row->id).'" class="btn btn-dark btn-sm" style="float: left;margin-right:10px;"><i class="feather icon-file"></i></a>';

                                if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $row->approval == 0)
                                {
                                    $delete = '<form action="'.route('saving_collection.destroy',$row->id).'" method="post">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                    <button onclick="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                </form>';
                                }
                                else
                                {
                                    $delete ='';
                                }

                                return $edit." ".$delete;
                            })
                            ->rawColumns(['applicant_name_id','total','action'])
                            ->make(true);
                }

        }
        $sl = 1;
        return view('Backend.User.SavingCollection.index',compact('data','sl'));
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

        return view('Backend.User.SavingCollection.create',compact('branch','member'));
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

        $explode = explode('/',$request->collection_date);
        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $validated = $request->validate([
            'collection_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            // 'savings_ammount'=>'required',
            // 'service_charge'=>'required',
            'deposit_ammount'=>'required',
            // 'total'=>'required',
        ],[
            'collection_date.required'=>'কালেকশান তারিখ দিন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            // 'savings_ammount.required'=>'সঞ্চয়ের পরিমাণ প্রদান করুন',
            // 'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
            'deposit_ammount.required'=>'ডিপোজিট পরিমাণ প্রদান করুন',
            // 'total.required'=>'মোট টাকা প্রদান করুন',
        ]);

        $data = array(
            'date'=>$date,
            'transaction_type'=>1,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'schema_id'=>$request->schema_id,
            // 'savings_ammount'=>$request->savings_ammount,
            // 'service_charge'=>$request->service_charge,
            'deposit_ammount'=>$request->deposit_ammount,
            'total'=>$request->total,
            'comment'=>$request->comment,
            'admin_id'=>$request->admin_id,
            'approval'=>0,
        );


        $insert = saving_transaction::insert($data);

        if($insert)
        {
            return redirect('/saving_collection')->with('success','সঞ্চয় আদায় সম্পন্ন করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় আদায় সম্পন্ন হয়নি');
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
        $data = saving_transaction::where('saving_transactions.transaction_type',1)
        ->where('saving_transactions.id',$id)
        ->join('branch_infos','branch_infos.id','=','saving_transactions.branch_id')
        ->join('area_infos','area_infos.id','=','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.member_id','=','saving_registrations.member_id')
        ->select('saving_transactions.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_transactions.date as transaction_date','saving_registrations.registration_id as aplicant_id')
        ->first();

        $numberToBangla = new NumberToBangla();

        $totalDepositWord = $numberToBangla->bnWord($data->deposit_ammount);

        // return $data;

        return view('Backend.User.SavingCollection.voucher',compact('data','totalDepositWord'));
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
        $data = savings_collection::find($id);
        $area = area_info::where('branch_id',$data->branch_id)->get();

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
        $savings_ammount = savings_collection::where('member_id',$data->member_id)->sum('saving_transactions.deposit_ammount');
        return view('Backend.User.SavingCollection.edit',compact('branch','data','area','member','savings_ammount'));
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
        $explode = explode('/',$request->collection_date);
        $collection_date = $explode[2].'-'.$explode[1].'-'.$explode[0];
        $validated = $request->validate([
            'collection_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            'savings_ammount'=>'required',
            'service_charge'=>'required',
            'deposit_ammount'=>'required',
            'total'=>'required',
        ],[
            'collection_date.required'=>'কালেকশান তারিখ দিন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'savings_ammount.required'=>'সঞ্চয়ের পরিমাণ প্রদান করুন',
            'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
            'deposit_ammount.required'=>'ডিপোজিট পরিমাণ প্রদান করুন',
            'total.required'=>'মোট টাকা প্রদান করুন',
        ]);

        $data = array(
            'collection_date'=>$collection_date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'savings_ammount'=>$request->savings_ammount,
            'service_charge'=>$request->service_charge,
            'deposit_ammount'=>$request->deposit_ammount,
            'total'=>$request->total,
            'comment'=>$request->comment,
            'admin_id'=>$request->admin_id,
        );

        $update = savings_collection::find($id)->update($data);

        if($update)
        {
            return redirect('/saving_collection')->with('success','সঞ্চয় আদায় তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় আদায় তথ্য আপডেট করা হয়নি');
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
            return redirect()->back()->with('success','সঞ্চয় আদায় ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় আদায় ডিলিট করা হয়নি');
        }
    }

    public function saving_coll_new()
    {
        if(Auth::user()->user_role == 1)
        {

        $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
                ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
                ->leftjoin('saving_registrations','saving_registrations.registration_id','saving_transactions.member_id')
                ->leftjoin('members','members.member_id','saving_registrations.member_id')
                ->leftjoin('users','users.id','saving_transactions.admin_id')
                ->where('saving_transactions.approval',0)
                ->where('saving_transactions.transaction_type',1)
                ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
                ->get();
        }
        else
        {

        $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                ->join('saving_transactions','saving_transactions.branch_id','=','admin_branch_infos.branch_id')
                ->leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
                ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
                ->leftjoin('saving_registrations','saving_registrations.registration_id','saving_transactions.member_id')
                ->leftjoin('members','members.member_id','saving_registrations.member_id')
                ->leftjoin('users','users.id','saving_transactions.admin_id')
                ->where('saving_transactions.approval',0)
                ->where('saving_transactions.transaction_type',1)
                ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
                ->get();
        }
        $sl = 1;
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
        // return $data;
        return view('Backend.User.SavingCollection.new_data',compact('data','sl','branch'));
    }

    public function approved_collection($id)
    {
        $update = saving_transaction::find($id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        if($update)
        {
            return redirect()->back();
        }
        else
        {
            return redirect()->back()->with('error','অ্যাপ্রুভ ফেইল');
        }
    }
    public function approveAllSavingColl(Request $request)
    {
        for ($i=0; $i < count($request->saving_coll_id) ; $i++)
        {
            $approve = saving_transaction::where('id',$request->saving_coll_id[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }

    public function loadSavingMember(Request $request)
    {
        $member = saving_registration::join('members','members.member_id','=','saving_registrations.member_id')
        ->leftjoin('saving_schemas','saving_schemas.id','saving_registrations.schema_id')
        ->where('members.branch_id',$request->branch_id)
        ->where('members.area_id',$request->area_id)
        ->where('saving_registrations.status',1)
        ->where('saving_registrations.schema_id',$request->schema_id)
        ->select('members.aplicant_name','members.id as member_id','saving_registrations.*','saving_schemas.deposit_name')
        ->get();

        // return $request->branch_id;

        // return $member;

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach ($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name. "-". $v->registration_id." - ".$v->deposit_name."</option>";
            }
        }
    }

    public function loadTotalSaving(Request $request)
    {
        $collection  = saving_transaction::where('member_id',$request->registration_id)->where('transaction_type',1)->sum('saving_transactions.deposit_ammount');

        $return = saving_transaction::where('member_id',$request->registration_id)->where('transaction_type',2)->sum('saving_transactions.return_ammount');

        $result = $collection - $return;

        return $result;
    }

    public function loadSavingCollBranch(Request $request)
    {

        $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
        ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.id','=','saving_registrations.member_id')
        ->join('users','users.id','=','saving_transactions.admin_id')
        ->where('saving_transactions.branch_id',$request->branch_id)
        ->where('saving_transactions.approval',0)
        ->where('saving_transactions.transaction_type',1)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
        ->get();

        $sl = 1;

        return view('Backend.User.SavingCollection.load_new_data',compact('data','sl'));

    }
    public function loadAreaSavingColl(Request $request)
    {


        $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
        ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.id','=','saving_registrations.member_id')
        ->join('users','users.id','=','saving_transactions.admin_id')
        ->where('saving_transactions.area_id',$request->area_id)
        ->where('saving_transactions.approval',0)
        ->where('saving_transactions.transaction_type',1)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
        ->get();
        $sl = 1;

        return view('Backend.User.SavingCollection.load_new_data',compact('data','sl'));

    }

    function loadInstalmentAmount(Request $request)
    {
        $instalment_ammount = DB::table('saving_registrations')->where('registration_id',$request->registration_id)->first();

        return $instalment_ammount->installment_ammount;

    }

    function loadSavingSchemaPercant(Request $request)
    {


        $schema_id = DB::table('saving_registrations')->where('registration_id',$request->member_id)->first();

        $schema_per = DB::table('saving_schemas')->where('id',$schema_id->schema_id)->first();

        return $schema_per->percantage;


    }

    public function showNewDataReport(Request $request)
    {

        $data = saving_transaction::leftjoin('branch_infos','branch_infos.id','saving_transactions.branch_id')
        ->leftjoin('area_infos','area_infos.id','saving_transactions.area_id')
        ->join('saving_registrations','saving_registrations.registration_id','=','saving_transactions.member_id')
        ->join('members','members.id','=','saving_registrations.member_id')
        ->join('users','users.id','=','saving_transactions.admin_id')
        ->where('saving_transactions.transaction_type',1)
        ->where('saving_transactions.branch_id',$request->branch_id)
        ->where('saving_transactions.area_id',$request->area_id)
        ->where('saving_transactions.approval','0')
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','users.name','saving_transactions.*','saving_registrations.registration_id')
        ->get();


        $total = saving_transaction::where('saving_transactions.transaction_type',1)
        ->where('saving_transactions.branch_id',$request->branch_id)
        ->where('saving_transactions.area_id',$request->area_id)
        ->where('saving_transactions.approval','0')
        ->sum('saving_transactions.deposit_ammount');

        $branch = branch_info::where('id',$request->branch_id)->first();

        $area = area_info::where('id',$request->area_id)->first();

        $sl = 1;

        return view('Backend.User.SavingCollection.new_data_report',compact('data','branch','area','sl','total'));

    }


    public function multiple_saving_collection()
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

        $schemas = DB::table('saving_schemas')->where('type','weekly')->get();
        $invest_schema = DB::table('investmentschemas')->where('type','weekly')->get();
        return view('Backend.User.SavingCollection.multiple_saving_collection',compact('branch','schemas','invest_schema'));
    }

}
