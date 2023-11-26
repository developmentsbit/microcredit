<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\income;
use App\Models\admin_branch_info;
use App\Models\branch_info;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;


class IncomeController extends Controller
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
        if(Auth::user()->user_role == 1){

            $data = DB::table("incomes")
            ->leftjoin("income_titles",'income_titles.id','incomes.title_id')
            ->leftjoin("branch_infos",'branch_infos.id','incomes.branch_id')
            ->where('incomes.details','!=','সঞ্চয় রেজিষ্ট্রেশন সার্ভিস চার্জ')
            ->select("incomes.*",'income_titles.title','branch_infos.branch_name')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
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
                ->addColumn('action',function($d){
                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $d->approval == 0)
                    {
                        return '<a id="" style="float: left;margin-right:10px;" href="'.route('add_income.edit',$d->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                        <form action="'.route('add_income.destroy',$d->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';
                    }
                })
                ->rawColumns(['status','action'])
                ->make(true);
            }

        }
        else{


            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('incomes','incomes.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','admin_branch_infos.branch_id')
            ->leftjoin("income_titles",'income_titles.id','incomes.title_id')
            ->select('branch_infos.branch_name','incomes.*','income_titles.title')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
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
                ->addColumn('action',function($d){
                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $d->approval == 0)
                    {
                        return '<a id="" style="float: left;margin-right:10px;" href="'.route('add_income.edit',$d->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                        <form action="'.route('add_income.destroy',$d->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';
                    }
                })
                ->rawColumns(['status','action'])
                ->make(true);
            }

        }



        return view('Backend.User.Income.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.Income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $explode = explode('/',$request->date);

        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];



        $insert = income::create([
            'sl'=>$request->sl,
            'date'=>$date,
            'title_id'=>$request->title_id,
            'branch_id'=>$request->branch_id,
            'amount'=>$request->amount,
            'details'=>$request->details,
            'status'=>$request->status,
            'comment'=>$request->comment,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
        ]);
        if($insert)
        {
            return redirect('add_income')->with('success','আয় যুক্ত করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','আয় যুক্ত করা হয়নি');
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
       $data = income::find($id);
       return view('Backend.User.Income.edit',compact('data'));
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

        $explode = explode('/',$request->date);

        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

       $update = income::where('id',$id)->update([
        'sl'=>$request->sl,
            'date'=>$date,
            'title_id'=>$request->title_id,
            'branch_id'=>$request->branch_id,
            'amount'=>$request->amount,
            'details'=>$request->details,
            'status'=>$request->status,
            'comment'=>$request->comment,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
       ]);

       if($update)
       {
        return redirect('add_income')->with('success','আয় আপডেট করা হলো');
    }
    else
    {
        return redirect()->back()->with('error','আয় আপডেট করা হয়নি');
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
        $delete = income::where('id',$id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','আয় ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','আয় ডিলিট করা হয়নি');
        }
    }

    public function new_income()
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
        if(Auth::user()->user_role == 1){

            $data = DB::table("incomes")
            ->leftjoin("income_titles",'income_titles.id','incomes.title_id')
            ->leftjoin("branch_infos",'branch_infos.id','incomes.branch_id')
            ->where('incomes.approval',0)
            ->select("incomes.*",'income_titles.title','branch_infos.branch_name')
            ->get();
        }
        else{


            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('incomes','incomes.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','admin_branch_infos.branch_id')
            ->leftjoin("income_titles",'income_titles.id','incomes.title_id')
            ->where('incomes.approval',0)
            ->select('branch_infos.branch_name','incomes.*','income_titles.title')
            ->get();

        }
        return view('Backend.User.Income.new_data',compact('data','branch'));
    }
    public function approved_income($id)
    {
        $approved = DB::table('incomes')->where('id',$id)->update([
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
    public function approveAllNewIcome(Request $request)
    {
        for ($i=0; $i < count($request->new_income) ; $i++)
        {
            $approve = DB::table('incomes')->where('id',$request->new_income[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }

    public function loadBranchIncomeNew(Request $request)
    {
        // return $request->branch_id;
        $data = DB::table("incomes")
            ->leftjoin("income_titles",'income_titles.id','incomes.title_id')
            ->leftjoin("branch_infos",'branch_infos.id','incomes.branch_id')
            ->where('incomes.branch_id',$request->branch_id)
            ->where('incomes.approval',0)
            ->select("incomes.*",'income_titles.title','branch_infos.branch_name')
            ->get();

        return view('Backend.User.Income.load_branch_income',compact('data'));
    }

    public function incomeReport()
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

        $income_title = DB::table('income_titles')->where('status',1)->get();
        return view('Backend.User.Income.income_report',compact('branch','income_title'));
    }

    public function incomeReportShow(Request $request)
    {
        $explode = explode('/',$request->from_date);
            $from_date = $explode[2].'-'.$explode[1].'-'.$explode[0];

            $explode1 = explode('/',$request->to_date);
            $to_date = $explode1[2].'-'.$explode1[1].'-'.$explode1[0];


        if($request->report_type == 'all')
        {
            $data = income::join('branch_infos','branch_infos.id','=','incomes.branch_id')
                    ->join('income_titles','income_titles.id','=','incomes.title_id')
                    ->join('users','users.id','=','incomes.admin_id')
                    ->where('incomes.status',1)
                    ->where('incomes.branch_id',$request->branch_id)
                    ->select('incomes.*','branch_infos.branch_name','income_titles.title','users.name','users.last_name')
                    ->get();

            $total = income::join('branch_infos','branch_infos.id','=','incomes.branch_id')
                    ->join('income_titles','income_titles.id','=','incomes.title_id')
                    ->join('users','users.id','=','incomes.admin_id')
                    ->where('incomes.branch_id',$request->branch_id)
                    ->where('incomes.status',1)
                    ->sum('incomes.amount');
        $report_type = 1;
        }
        elseif($request->report_type == 'date_to_date')
        {


            $data = income::join('branch_infos','branch_infos.id','=','incomes.branch_id')
                    ->join('income_titles','income_titles.id','=','incomes.title_id')
                    ->join('users','users.id','=','incomes.admin_id')
                    ->where('incomes.status',1)
                    ->where('incomes.branch_id',$request->branch_id)
                    ->whereBetween('incomes.date',[$from_date,$to_date])
                    ->select('incomes.*','branch_infos.branch_name','income_titles.title','users.name','users.last_name')
                    ->get();

            $total = income::join('branch_infos','branch_infos.id','=','incomes.branch_id')
                    ->join('income_titles','income_titles.id','=','incomes.title_id')
                    ->join('users','users.id','=','incomes.admin_id')
                    ->where('incomes.status',1)
                    ->where('incomes.branch_id',$request->branch_id)
                    ->whereBetween('incomes.date',[$from_date,$to_date])
                    ->sum('incomes.amount');

            $report_type = 2;
        }

        $sl=1;
        return view('Backend.User.Income.income_reporttab',compact('data','sl','total','report_type','from_date','to_date'));
    }

    public function showNewIncomeReport(Request $request)
    {

        $data = DB::table("incomes")
            ->leftjoin("income_titles",'income_titles.id','incomes.title_id')
            ->leftjoin("branch_infos",'branch_infos.id','incomes.branch_id')
            ->where('incomes.branch_id',$request->branch_id)
            ->select("incomes.*",'income_titles.title','branch_infos.branch_name')
            ->get();

            $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();

            $total = DB::table("incomes")
                ->where('incomes.branch_id',$request->branch_id)
                ->sum('incomes.amount');

            return view('Backend.User.Income.show_new_income_report',compact('data','branch','total'));

    }

}
