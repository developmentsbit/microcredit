<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\asset_categorey;
use App\Models\asset_expense;
use App\Models\admin_branch_info;
use Auth;
use DB;
class AssetExpense extends Controller
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
    public function index()
    {
        if(Auth::user()->user_role == 1)
        {
            $data = asset_expense::join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                ->join('users','users.id','=','asset_expenses.admin_id')
                ->select('users.name','users.last_name','asset_categoreys.asset_title','branch_infos.branch_name','asset_expenses.*')
                ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                ->join('asset_expenses','asset_expenses.branch_id','=','admin_branch_infos.branch_id')
                ->join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                ->join('users','users.id','=','asset_expenses.admin_id')
                ->select('users.name','users.last_name','asset_categoreys.asset_title','branch_infos.branch_name','asset_expenses.*')
                ->get();
        }
        
        return view('Backend.User.AssetExpense.index',compact('data'));
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
        $asset_title = asset_categorey::where('status',1)->get();
        return view('Backend.User.AssetExpense.create',compact('branch','asset_title'));
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
            'serial_no'=>'required',
            'date'=>'required',
            'branch_id'=>'required',
            'asset_title_id'=>'required',
            'taka_ammount'=>'required',
            'status'=>'required',
        ],
        [
            'serial_no.required'=>'সিরিয়াল নং প্রদান করুন',
            'date.required'=>'তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'asset_title_id.required'=>'অ্যাসেট টাইটেল নির্বাচন করুন',
            'taka_ammount.required'=>'টাকার পরিমাণ প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $explode = explode('/',$request->date);

        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $insert = asset_expense::create([
            'serial_no'=>$request->serial_no,
            'date'=>$date,
            'branch_id'=>$request->branch_id,
            'asset_title_id'=>$request->asset_title_id,
            'taka_ammount'=>$request->taka_ammount,
            'status'=>$request->status,
            'description'=>$request->description,
            'admin_id'=>$request->admin_id,
        ]);

        if($insert)
        {
            return redirect('/add_asset_expense')->with('success','অ্যাসেট সংক্রান্ত ব্যায় যু্ক্ত করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট সংক্রান্ত ব্যায় যু্ক্ত করা হয়নি');
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
        $asset_title = asset_categorey::where('status',1)->get();
        $data = asset_expense::find($id);
        return view('Backend.User.AssetExpense.edit',compact('branch','asset_title','data'));
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
            'serial_no'=>'required',
            'date'=>'required',
            'branch_id'=>'required',
            'asset_title_id'=>'required',
            'taka_ammount'=>'required',
            'status'=>'required',
        ],
        [
            'serial_no.required'=>'সিরিয়াল নং প্রদান করুন',
            'date.required'=>'তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'asset_title_id.required'=>'অ্যাসেট টাইটেল নির্বাচন করুন',
            'taka_ammount.required'=>'টাকার পরিমাণ প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $explode = explode('/',$request->date);

        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $update = asset_expense::find($id)->update([
            'serial_no'=>$request->serial_no,
            'date'=>$date,
            'branch_id'=>$request->branch_id,
            'asset_title_id'=>$request->asset_title_id,
            'taka_ammount'=>$request->taka_ammount,
            'status'=>$request->status,
            'description'=>$request->description,
            'admin_id'=>$request->admin_id,
        ]);

        if($update)
        {
            return redirect('/add_asset_expense')->with('success','অ্যাসেট সংক্রান্ত ব্যায় আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট সংক্রান্ত ব্যায় আপডেট করা হয়নি');
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
        $delete = asset_expense::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','অ্যাসেট সংক্রান্ত ব্যায় ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট সংক্রান্ত ব্যায় ডিলিট করা হয়নি');
        }
    }

    public function new_asset_expense()
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
            $data = asset_expense::join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                ->join('users','users.id','=','asset_expenses.admin_id')
                ->where('asset_expenses.approval',0)
                ->select('users.name','users.last_name','asset_categoreys.asset_title','branch_infos.branch_name','asset_expenses.*')
                ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                ->join('asset_expenses','asset_expenses.branch_id','=','admin_branch_infos.branch_id')
                ->join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                ->join('users','users.id','=','asset_expenses.admin_id')
                ->where('asset_expenses.approval',0)
                ->select('users.name','users.last_name','asset_categoreys.asset_title','branch_infos.branch_name','asset_expenses.*')
                ->get();
        }
        return view('Backend.User.AssetExpense.new_asset_expense',compact('data','branch'));
    }

    public function approved_assetexpense($id)
    {
        asset_expense::find($id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        return redirect()->back();

    }

    public function approveNewAssetExpense(Request $request)
    {

        for ($i=0; $i < count($request->new_asset_expense) ; $i++) 
        { 
            $approve = DB::table('asset_expenses')->where('id',$request->new_asset_expense[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;

    }

    public function loadBranchAssetExpense(Request $request)
    {

        $data = asset_expense::join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                ->join('users','users.id','=','asset_expenses.admin_id')
                ->where('asset_expenses.approval',0)
                ->where('asset_expenses.branch_id',$request->branch_id)
                ->select('users.name','users.last_name','asset_categoreys.asset_title','branch_infos.branch_name','asset_expenses.*')
                ->get();

        return view('Backend.User.AssetExpense.load_new_expense',compact('data'));

    }

    public function assetExpenseReport()
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
        $asset_title = asset_categorey::where('status',1)->get();

        return view('Backend.User.AssetExpense.asset_expense_report',compact('branch','asset_title'));
    }

    public function assetExpenseReportShow(Request $request)
    {
        // dd($request->all());

        $explode1 = explode('/',$request->from_date);

            $from_date = $explode1[2].'-'.$explode1[1].'-'.$explode1[0];

            $explode2 = explode('/',$request->to_date);

            $to_date = $explode2[2].'-'.$explode2[1].'-'.$explode2[0];

        $validated = $request->validate([
            'branch_id'=>'required',
            'asset_title_id'=>'required',
        ],
        [
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'asset_title_id.required'=>'অ্যাসেট টাইটেল নির্বাচন করুন',
        ]);

        if($request->report_type == 'all')
        {
            $data = asset_expense::join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                    ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                    ->join('users','users.id','=','asset_expenses.admin_id')
                    ->where('asset_expenses.branch_id',$request->branch_id)
                    ->where('asset_expenses.asset_title_id',$request->asset_title_id)
                    ->where('asset_expenses.status',1)
                    ->select('asset_expenses.*','branch_infos.branch_name','asset_categoreys.asset_title','users.name','users.last_name')
                    ->get();

            $total = asset_expense::join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                    ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                    ->join('users','users.id','=','asset_expenses.admin_id')
                    ->where('asset_expenses.branch_id',$request->branch_id)
                    ->where('asset_expenses.asset_title_id',$request->asset_title_id)
                    ->where('asset_expenses.status',1)
                    ->sum('asset_expenses.taka_ammount');

            $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();
            $asset_title = DB::table('asset_categoreys')->where('id',$request->asset_title_id)->first();

            $report_type = 1;

         }
         else
         {

            

            $data = asset_expense::join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                    ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                    ->join('users','users.id','=','asset_expenses.admin_id')
                    ->where('asset_expenses.branch_id',$request->branch_id)
                    ->where('asset_expenses.asset_title_id',$request->asset_title_id)
                    ->where('asset_expenses.status',1)
                    ->whereBetween('asset_expenses.date',[$from_date,$to_date])
                    ->select('asset_expenses.*','branch_infos.branch_name','asset_categoreys.asset_title','users.name','users.last_name')
                    ->get();

            $total = asset_expense::join('branch_infos','branch_infos.id','=','asset_expenses.branch_id')
                    ->join('asset_categoreys','asset_categoreys.id','=','asset_expenses.asset_title_id')
                    ->join('users','users.id','=','asset_expenses.admin_id')
                    ->where('asset_expenses.branch_id',$request->branch_id)
                    ->where('asset_expenses.asset_title_id',$request->asset_title_id)
                    ->where('asset_expenses.status',1)
                    ->whereBetween('asset_expenses.date',[$from_date,$to_date])
                    ->sum('asset_expenses.taka_ammount');

            $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();
            $asset_title = DB::table('asset_categoreys')->where('id',$request->asset_title_id)->first();

            $report_type = 2;
         }
                
                return view('Backend.User.AssetExpense.asset_expense_reporttab',compact('data','branch','asset_title','total','report_type','from_date','to_date'));
    }

}
