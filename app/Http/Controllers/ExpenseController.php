<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\admin_branch_info;
use App\Models\branch_info;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;


class ExpenseController extends Controller
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

            $data = DB::table("expenses")
            ->leftjoin("income_titles",'income_titles.id','expenses.title_id')
            ->leftjoin("branch_infos",'branch_infos.id','expenses.branch_id')
            ->select("expenses.*",'income_titles.title','branch_infos.branch_name')
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
                        return '<a id="" style="float: left;margin-right:10px;" href="'.route('add_expense.edit',$d->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                        <form action="'.route('add_expense.destroy',$d->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';
                    }
                    else
                    {
                        return '';
                    }
                })
                ->rawColumns(['status','action'])
                ->make(true);
            }
        }
        else{


            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('expenses','expenses.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','admin_branch_infos.branch_id')
            ->leftjoin("income_titles",'income_titles.id','expenses.title_id')
            ->select('branch_infos.branch_name','expenses.*','income_titles.title')
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
                        return '<a id="" style="float: left;margin-right:10px;" href="'.route('add_expense.edit',$d->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                        <form action="'.route('add_expense.destroy',$d->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';
                    }
                    else
                    {
                        return '';
                    }
                })
                ->rawColumns(['status','action'])
                ->make(true);
            }


        }


        return view('Backend.User.Expense.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.Expense.create');
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

        $data = array(
          'sl'=>$request->sl,
          'title_id'=>$request->title_id,
          'branch_id'=>$request->branch_id,
          'date'=>$date,
          'amount'=>$request->amount,
          'details'=>$request->details,
          'status'=>$request->status,
          'comment'=>$request->comment,
          'admin_id'=>$request->admin_id,
        );

        $insert = expense::create($data);
        if($insert)
        {
            return redirect('add_expense')->with('success','ব্যায় যু্ক্ত করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','ব্যায় যু্ক্ত করা হয়নি');
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
        $data = expense::find($id);

        return view('Backend.User.Expense.edit',compact('data'));
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

        $data = array(
          'sl'=>$request->sl,
          'title_id'=>$request->title_id,
          'branch_id'=>$request->branch_id,
          'date'=>$date,
          'amount'=>$request->amount,
          'details'=>$request->details,
          'status'=>$request->status,
          'comment'=>$request->comment,
          'admin_id'=>$request->admin_id,
        );

        $update = expense::where('id',$id)->update($data);

        if($update)
        {
            return redirect('add_expense')->with('success','ব্যায় তথ্য আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','ব্যায় তথ্য আপডেট করা হয়নি');
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
       $delete = expense::where('id',$id)->delete();
       if($delete)
       {
        return redirect()->back()->with('success','ব্যায় তথ্য ডিলিট করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','ব্যায় তথ্য ডিলিট করা হয়নি');
    }
}

public function new_expense()
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

        $data = DB::table("expenses")
        ->leftjoin("income_titles",'income_titles.id','expenses.title_id')
        ->leftjoin("branch_infos",'branch_infos.id','expenses.branch_id')
        ->where('expenses.approval',0)
        ->select("expenses.*",'income_titles.title','branch_infos.branch_name')
        ->get();
    }
    else{


        $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
        ->join('expenses','expenses.branch_id','=','admin_branch_infos.branch_id')
        ->leftjoin('branch_infos','branch_infos.id','admin_branch_infos.branch_id')
        ->leftjoin("income_titles",'income_titles.id','expenses.title_id')
        ->where('expenses.approval',0)
        ->select('branch_infos.branch_name','expenses.*','income_titles.title')
        ->get();

    }
    return view('Backend.User.Expense.new_data',compact('data','branch'));
}

public function approved_expense($id)
{
    $approved = DB::table('expenses')->where('id',$id)->update([
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

public function approveAllExpense(Request $request)
{
    for ($i=0; $i < count($request->new_expense) ; $i++)
    {
        $approve = DB::table('expenses')->where('id',$request->new_expense[$i])->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);
    }

    return 1;
}

public function loadBranchExpenseNew(Request $request)
{
    $data = DB::table("expenses")
    ->leftjoin("income_titles",'income_titles.id','expenses.title_id')
    ->leftjoin("branch_infos",'branch_infos.id','expenses.branch_id')
    ->where('expenses.approval',0)
    ->where('expenses.branch_id',$request->branch_id)
    ->select("expenses.*",'income_titles.title','branch_infos.branch_name')
    ->get();

    return view('Backend.User.Expense.load_branch_expense',compact('data'));
}



public function expense_statement_reports()
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

    $expense_titles = DB::table('expense_titles')->where('status',1)->get();
    return view('Backend.User.Expense.expense_report',compact('branch','expense_titles'));
}

public function expense_statement_reportsShow(Request $request)
{
    $explode = explode('/',$request->from_date);
    $from_date = $explode[2].'-'.$explode[1].'-'.$explode[0];

    $explode1 = explode('/',$request->to_date);
    $to_date = $explode1[2].'-'.$explode1[1].'-'.$explode1[0];


    if($request->report_type == 'all')
    {
        $data = expense::join('branch_infos','branch_infos.id','=','expenses.branch_id')
        ->join('expense_titles','expense_titles.id','=','expenses.title_id')
        ->join('users','users.id','=','expenses.admin_id')
        ->where('expenses.status',1)
        ->where('expenses.branch_id',$request->branch_id)
        ->select('expenses.*','branch_infos.branch_name','expense_titles.title','users.name','users.last_name')
        ->get();

        $total = expense::join('branch_infos','branch_infos.id','=','expenses.branch_id')
        ->join('expense_titles','expense_titles.id','=','expenses.title_id')
        ->join('users','users.id','=','expenses.admin_id')
        ->where('expenses.branch_id',$request->branch_id)
        ->where('expenses.status',1)
        ->sum('expenses.amount');
        $report_type = 1;
    }
    elseif($request->report_type == 'date_to_date')
    {


        $data = expense::join('branch_infos','branch_infos.id','=','expenses.branch_id')
        ->join('expense_titles','expense_titles.id','=','expenses.title_id')
        ->join('users','users.id','=','expenses.admin_id')
        ->where('expenses.status',1)
        ->where('expenses.branch_id',$request->branch_id)
        ->whereBetween('expenses.date',[$from_date,$to_date])
        ->select('expenses.*','branch_infos.branch_name','expense_titles.title','users.name','users.last_name')
        ->get();

        $total = expense::join('branch_infos','branch_infos.id','=','expenses.branch_id')
        ->join('expense_titles','expense_titles.id','=','expenses.title_id')
        ->join('users','users.id','=','expenses.admin_id')
        ->where('expenses.status',1)
        ->where('expenses.branch_id',$request->branch_id)
        ->whereBetween('expenses.date',[$from_date,$to_date])
        ->sum('expenses.amount');

        $report_type = 2;
    }

    $sl=1;
    return view('Backend.User.Expense.expense_statement_reportsShow',compact('data','sl','total','report_type','from_date','to_date'));
}


    public function showNewExpenseReport(Request $request)
    {


        $data = DB::table("expenses")
        ->leftjoin("income_titles",'income_titles.id','expenses.title_id')
        ->leftjoin("branch_infos",'branch_infos.id','expenses.branch_id')
        ->where('expenses.branch_id',$request->branch_id)
        ->select("expenses.*",'income_titles.title','branch_infos.branch_name')
        ->get();

        $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();

        $total = DB::table("expenses")
        ->where('expenses.branch_id',$request->branch_id)
        ->sum('expenses.amount');

        return view('Backend.User.Expense.show_new_data_report',compact('data','branch','total'));

    }


}
