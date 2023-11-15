<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\fixed_deposit_collection;
use App\Models\fixed_deposit_registration;
use App\Models\area_info;
use App\Models\member;
use Auth;
use App\Models\admin_branch_info;
use DB;
use Yajra\DataTables\Facades\DataTables;


class FixedDepositCollection extends Controller
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
            $data = fixed_deposit_collection::leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
            ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_registrations.registration_id','fixed_deposit_collections.*')
            ->get();


            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('applicant_name_id',function($v){
                    return $v->aplicant_name.' - '.$v->registration_id;
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
            ->join('fixed_deposit_collections','fixed_deposit_collections.branch_id','admin_branch_infos.branch_id')
                ->leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
                ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
                ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
                ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
                ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_collections.*','fixed_deposit_registrations.registration_id')
                ->get();

                if ($request->ajax()) {
                    return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('applicant_name_id',function($v){
                        return $v->aplicant_name.' - '.$v->registration_id;
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

        $sl=1;
        return view('Backend.User.FixedDepositCollection.index',compact('data','sl'));
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

        return view('Backend.User.FixedDepositCollection.create',compact('branch','member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'collection_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            'deposit_ammount'=>'required',
            'service_charge'=>'required',
            'status'=>'required',
        ],[
            'collection_date.required'=>'কালেকশান তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'deposit_ammount.required'=>'ডিপোজিট পরিমাণ প্রদান করুন',
            'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $explode = explode('/',$request->collection_date);

        $collection_date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $insert = fixed_deposit_collection::insert([
            'collection_date'=>$collection_date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'schema_id'=>$request->schema_id,
            'member_id'=>$request->member_id,
            'deposit_ammount'=>$request->deposit_ammount,
            'service_charge'=>$request->service_charge,
            'total'=>$request->total,
            'comment'=>$request->comment,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
        ]);


        if($insert)
        {
            return redirect('fixeddeposit_collection')->with('success','ফিক্সড ডিপোজিট আদায় করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট আদায় করা হয়নি');
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
        $data = fixed_deposit_collection::find($id);
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
        return view('Backend.User.FixedDepositCollection.edit',compact('branch','area','member','data'));
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
            'collection_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            'deposit_ammount'=>'required',
            'service_charge'=>'required',
            'status'=>'required',
        ],[
            'collection_date.required'=>'কালেকশান তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'deposit_ammount.required'=>'ডিপোজিট পরিমাণ প্রদান করুন',
            'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $explode = explode('/',$request->collection_date);

        $collection_date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $update = fixed_deposit_collection::find($id)->update([
            'collection_date'=>$collection_date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'deposit_ammount'=>$request->deposit_ammount,
            'service_charge'=>$request->service_charge,
            'total'=>$request->total,
            'comment'=>$request->comment,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
        ]);

        if($update)
        {
            return redirect('/fixeddeposit_collection')->with('success','ফিক্সড ডিপোজিট আদায় তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট আদায় তথ্য আপডেট করা হয়নি');
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
        $delete = fixed_deposit_collection::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','ফিক্সড ডিপোজিট আদায় তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট আদায় তথ্য ডিলিট করা হয়নি');
        }
    }
    public function loadFixedDepositMember(Request $request)
    {
        // return 1;
        $member = fixed_deposit_registration::where('fixed_deposit_registrations.status',1)
        ->leftjoin('fixed_deposit_schemas','fixed_deposit_schemas.id','fixed_deposit_registrations.schema_id')
        ->where('fixed_deposit_registrations.branch_id',$request->branch_id)
        ->where('fixed_deposit_registrations.area_id',$request->area_id)
        ->where('fixed_deposit_registrations.schema_id',$request->schema_id)
        ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
        ->select('fixed_deposit_registrations.*','members.aplicant_name','fixed_deposit_schemas.fixed_deposit_name')
        ->get();

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name."-".$v->registration_id." - ".$v->fixed_deposit_name."</option>";
            }
        }
    }


    public function loadFixedDepositMember1(Request $request)
    {
        $member = fixed_deposit_registration::where('fixed_deposit_registrations.status',1)
        ->where('fixed_deposit_registrations.branch_id',$request->branch_id)
        ->where('fixed_deposit_registrations.area_id',$request->area_id)
        ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
        ->select('fixed_deposit_registrations.*','members.aplicant_name')
        ->get();

        if($member)
        {
            echo "<option value=''>নির্বাচন করুন</option>";
            foreach($member as $v)
            {
                echo "<option value='".$v->registration_id."'>".$v->aplicant_name."-".$v->registration_id."</option>";
            }
        }
    }



    public function loadTotalFixedDeposit(Request $request)
    {
        $ammount = fixed_deposit_collection::where('member_id',$request->member_id)->sum('deposit_ammount');

        return $ammount;
    }

    public function new_fixed_deposit_coll()
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
            $data = fixed_deposit_collection::leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
            ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
            ->where('fixed_deposit_collections.approval',0)
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_collections.*')
            ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('fixed_deposit_collections','fixed_deposit_collections.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
            ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
            ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
            ->where('fixed_deposit_collections.approval',0)
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_collections.*')
            ->get();
        }

        $sl=1;
        return view('Backend.User.FixedDepositCollection.new_data',compact('data','sl','branch'));
    }

    public function approved_fixed_depositcoll($id)
    {
        $approved = DB::table('fixed_deposit_collections')->where('id',$id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        return redirect()->back();

    }

    public function approveAllFixedDepoColl(Request $request)
    {
        for ($i=0; $i < count($request->fixed_depo_coll_id) ; $i++)
        {
            $approve = fixed_deposit_collection::where('id',$request->fixed_depo_coll_id[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }


    public function loadDepositCollBranch(Request $request)
    {

        $data = fixed_deposit_collection::leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
        ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
        ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
        ->join('members','members.id','=','fixed_deposit_registrations.member_id')
        ->where('fixed_deposit_collections.branch_id',$request->branch_id)
        ->where('fixed_deposit_collections.approval',0)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_registrations.registration_id','fixed_deposit_collections.*')
        ->get();

        $sl = 1;

        return view('Backend.User.FixedDepositCollection.load_new_data',compact('data','sl'));

    }

    public function loadAreaFixedColl(Request $request)
    {
        $data = fixed_deposit_collection::leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
        ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
        ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
        ->join('members','members.id','=','fixed_deposit_registrations.member_id')
        ->where('fixed_deposit_collections.area_id',$request->area_id)
        ->where('fixed_deposit_collections.approval',0)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_registrations.registration_id','fixed_deposit_collections.*')
        ->get();

        $sl = 1;

        return view('Backend.User.FixedDepositCollection.load_new_data',compact('data','sl'));
    }

    public function showNewDepositCollReport(Request $request)
    {
        $data = fixed_deposit_collection::leftjoin('branch_infos','branch_infos.id','fixed_deposit_collections.branch_id')
        ->leftjoin('area_infos','area_infos.id','fixed_deposit_collections.area_id')
        ->join('fixed_deposit_registrations','fixed_deposit_registrations.registration_id','=','fixed_deposit_collections.member_id')
        ->join('members','members.id','=','fixed_deposit_registrations.member_id')
        ->where('fixed_deposit_collections.branch_id',$request->branch_id)
        ->where('fixed_deposit_collections.area_id',$request->area_id)
        ->where('fixed_deposit_collections.approval',0)
        ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_registrations.registration_id','fixed_deposit_collections.*')
        ->get();

        $total = fixed_deposit_collection::where('fixed_deposit_collections.branch_id',$request->branch_id)
        ->where('fixed_deposit_collections.area_id',$request->area_id)
        ->where('fixed_deposit_collections.approval',0)
        ->sum('fixed_deposit_collections.deposit_ammount');

        $branch = branch_info::where('id',$request->branch_id)->first();

        $area = area_info::where('id',$request->area_id)->first();

        $sl = 1;

        return view('Backend.User.FixedDepositCollection.show_fixed_deposit_collection',compact('data','sl','branch','area','total'));
    }

    public function multiple_deposit_collection()
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

        $investmentschema = DB::table('fixed_deposit_schemas')->get();
        return view('Backend.User.FixedDepositCollection.multiple_deposit_collection',compact('branch','investmentschema'));
    }

    public function profit_generate()
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

        $investmentschema = DB::table('fixed_deposit_schemas')->get();
        return view('Backend.User.FixedDepositCollection.profit_generate',compact('branch','investmentschema'));
    }

}
