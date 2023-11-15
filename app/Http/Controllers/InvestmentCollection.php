<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\investment_collection;
use App\Models\admin_branch_info;
use App\Models\branch_info;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;


class InvestmentCollection extends Controller
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
        if(Auth::user()->user_role ==1)
        {

            $data = DB::table("investment_collections")
            ->leftjoin("branch_infos",'branch_infos.id','investment_collections.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_collections.area_id')
            ->leftjoin("members",'members.id','investment_collections.member_id')
            ->select("investment_collections.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->get();


            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($d){
                    return '<form action="'.route('investment_collection.destroy',$d->id).'" method="post">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
            }


        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('investment_collections','investment_collections.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin("branch_infos",'branch_infos.id','investment_collections.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_collections.area_id')
            ->leftjoin("members",'members.id','investment_collections.member_id')
            ->select("investment_collections.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->get();
            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($d){
                    return '<form action="'.route('investment_collection.destroy',$d->id).'" method="post">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }
        return view('Backend.User.InvestmentCollection.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.InvestmentCollection.create');
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

        $explode = explode('/',$request->date);

        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $data = array(
            'date'=>$date,
            'entry_date'=>$request->entry_date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'schema_id'=>$request->schema_id,
            'member_id'=>$request->member_id,
            'investment_collection'=>$request->investment_collection,
            'originalamount'=>$request->main_balance,
            'profit'=>$request->profit_ammount,
            'comment'=>$request->comment,
            'admin_id'=>$request->admin_id,
        );

        $insert = investment_collection::create($data);

        $saving_id = DB::table('investor_registrations')->where('registration_id',$request->member_id)->select('deposite')->first();


        if($request->deposit_ammount > 0)
        {
            DB::table('saving_transactions')->insert([
                'date'=>$date,
                'transaction_type'=>1,
                'branch_id'=>$request->branch_id,
                'area_id'=>$request->area_id,
                'member_id'=>$saving_id->deposite,
                'deposit_ammount'=>$request->deposit_ammount,
                'admin_id'=>$request->admin_id,
                'approval'=>0,
            ]);
        }


        if($insert)
        {
            return redirect('investment_collection')->with('success','বিনিয়োগ আদায় সম্পন্ন হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ আদায় সম্পন্ন হয়নি');
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
        $data = investment_collection::find($id);
        return view('Backend.User.InvestmentCollection.edit',compact('data'));
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
        $update = investment_collection::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('investment_collection')->with('success','বিনিয়োগ আদায় তথ্য আপডেট হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ আদায় তথ্য আপডেট করা হয়নি');
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
        $delete = investment_collection::where('id',$id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','বিনিয়োগ আদায় তথ্য ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ আদায় তথ্য ডিলিট করা হয়নি');
        }
    }







    public function investment_collections_show()
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

        if(Auth::user()->user_role ==1)
        {

            $data = DB::table("investment_collections")
            ->leftjoin("branch_infos",'branch_infos.id','investment_collections.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_collections.area_id')
            ->leftjoin("members",'members.id','investment_collections.member_id')
            ->select("investment_collections.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->where("investment_collections.approval",0)
            ->get();
        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('investment_collections','investment_collections.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin("branch_infos",'branch_infos.id','investment_collections.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_collections.area_id')
            ->leftjoin("members",'members.id','investment_collections.member_id')
            ->select("investment_collections.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->where("investment_collections.approval",0)
            ->get();
        }


        $sl = 1;
        return view('Backend.User.InvestmentRegistration.investment_collections_show',compact('data','sl','branch'));
    }


    public function investment_collections_show_approve($id)
    {
        $approve = investment_collection::where('id',$id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        if($approve)
        {
            return redirect()->back()->with('success','বিনিয়োগ আদায়  অ্যাপ্রুভ হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ আদায়  অ্যাপ্রুভ হয়নি');
        }
    }


    public function approve_all_investor_collection(Request $request)
    {

        for ($i=0; $i < count($request->saving_id) ; $i++)
        {
            $approve = investment_collection::where('id',$request->saving_id[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }


    public function loadInvestmentCollBranch(Request $request)
    {

        $data = DB::table("investment_collections")
            ->leftjoin("branch_infos",'branch_infos.id','investment_collections.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_collections.area_id')
            ->leftjoin("members",'members.id','investment_collections.member_id')
            ->select("investment_collections.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->where("investment_collections.approval",0)
            ->where('investment_collections.branch_id',$request->branch_id)
            ->get();

        return view('Backend.User.InvestmentCollection.load_data',compact('data'));

    }


    public function loadInvestmentCollArea(Request $request)
    {

        $data = DB::table("investment_collections")
            ->leftjoin("branch_infos",'branch_infos.id','investment_collections.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_collections.area_id')
            ->leftjoin("members",'members.id','investment_collections.member_id')
            ->select("investment_collections.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->where("investment_collections.approval",0)
            ->where('investment_collections.area_id',$request->area_id)
            ->get();

        return view('Backend.User.InvestmentCollection.load_data',compact('data'));

    }

    public function showInvestmentCollReport(Request $request)
    {

        $data = DB::table("investment_collections")
            ->leftjoin("branch_infos",'branch_infos.id','investment_collections.branch_id')
            ->leftjoin("area_infos",'area_infos.id','investment_collections.area_id')
            ->leftjoin("members",'members.id','investment_collections.member_id')
            ->select("investment_collections.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
            ->where("investment_collections.approval",0)
            ->where('investment_collections.branch_id',$request->branch_id)
            ->where('investment_collections.area_id',$request->area_id)
            ->get();


        $total = DB::table("investment_collections")
            ->where("investment_collections.approval",0)
            ->where('investment_collections.branch_id',$request->branch_id)
            ->where('investment_collections.area_id',$request->area_id)
            ->sum('investment_collections.investment_collection');

        $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();
        $area = DB::table('area_infos')->where('id',$request->area_id)->first();

        $i = 1;

        return view('Backend.User.InvestmentCollection.show_investment__collection_report',compact('data','branch','area','total','i'));

    }

    public function multiple_investment_collection()
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

        $schemas = DB::table('investmentschemas')->get();
        return view('Backend.User.InvestmentCollection.multiple_investment_collection',compact('branch','schemas'));
    }


}
