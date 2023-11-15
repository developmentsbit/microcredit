<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\internalloan;
use App\Models\internal_loan_handover;
use App\Models\admin_branch_info;
use Auth;
use DB;

class InternalLoanHandover extends Controller
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

            $data = internal_loan_handover::join('branch_infos','branch_infos.id','=','internal_loan_handovers.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_handovers.member_id')
                    ->join('users','users.id','=','internal_loan_handovers.admin_id')
                    ->select('internal_loan_handovers.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('internal_loan_handovers','internal_loan_handovers.branch_id','=','admin_branch_infos.branch_id')
                    ->join('branch_infos','branch_infos.id','=','internal_loan_handovers.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_handovers.member_id')
                    ->join('users','users.id','=','internal_loan_handovers.admin_id')
                    ->select('internal_loan_handovers.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }
        return view('Backend.User.InternalLoanHandover.index',compact('data'));
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
        return view('Backend.User.InternalLoanHandover.create',compact('branch'));
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
            'serial_no'=>'required',
            'date'=>'required',
            'branch_id'=>'required',
            'member_id'=>'required',
            'ammount'=>'required',
            'status'=>'required',
        ],[
            'serial_no.required'=>'সিরিয়াল নম্বার প্রদান করুন',
            'date.required'=>'তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'ammount.required'=>'টকার পরিমাণ করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $explode = explode('/',$request->date);

        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $insert = internal_loan_handover::insert([
            'serial_no'=>$request->serial_no,
            'date'=>$date,
            'branch_id'=>$request->branch_id,
            'member_id'=>$request->member_id,
            'ammount'=>$request->ammount,
            'description'=>$request->description,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
            'description'=>$request->description,

        ]);

        if($insert)
        {
            return redirect('/internal_loan_handover')->with('success','অভ্যন্তরীণ লোন প্রদান করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন প্রদান করা হয়নি');
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
        $data = internal_loan_handover::find($id);
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
        $member = internalloan::where('branch_id',$id)->get();
        return view('Backend.User.InternalLoanHandover.edit',compact('data','branch','member'));
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
            'member_id'=>'required',
            'ammount'=>'required',
            'status'=>'required',
        ],[
            'serial_no.required'=>'সিরিয়াল নম্বার প্রদান করুন',
            'date.required'=>'তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'ammount.required'=>'টকার পরিমাণ করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);


            $explode = explode('/',$request->date);

            $date = $explode[2].'-'.$explode[1].'-'.$explode[0];


        $update = internal_loan_handover::find($id)->update([
            'serial_no'=>$request->serial_no,
            'date'=>$date,
            'branch_id'=>$request->branch_id,
            'member_id'=>$request->member_id,
            'ammount'=>$request->ammount,
            'description'=>$request->description,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
            'description'=>$request->description,
        ]);

        if($update)
        {
            return redirect('/internal_loan_handover')->with('success','অভ্যন্তরীণ লোন প্রদান তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন প্রদান তথ্য আপডেট করা হয়নি');
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
        $delete = internal_loan_handover::find($id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success','অভ্যন্তরীণ লোন প্রদান তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন প্রদান তথ্য ডিলিট করা হয়নি');
        }
    }

    public function new_internalloan_handover()
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

            $data = internal_loan_handover::join('branch_infos','branch_infos.id','=','internal_loan_handovers.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_handovers.member_id')
                    ->join('users','users.id','=','internal_loan_handovers.admin_id')
                    ->where('internal_loan_handovers.approval',0)
                    ->select('internal_loan_handovers.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('internal_loan_handovers','internal_loan_handovers.branch_id','=','admin_branch_infos.branch_id')
                    ->join('branch_infos','branch_infos.id','=','internal_loan_handovers.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_handovers.member_id')
                    ->join('users','users.id','=','internal_loan_handovers.admin_id')
                    ->where('internal_loan_handovers.approval',0)
                    ->select('internal_loan_handovers.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }

        return view('Backend.User.InternalLoanHandover.new_data',compact('data','branch'));
    }

    public function approved_internalloan_handover($id)
    {
        $approved = DB::table('internal_loan_handovers')->where('id',$id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function approveAllinterLoanHandover(Request $request)
    {
        for ($i=0; $i < count($request->new_interloan_handover) ; $i++)
        {
            $approve = DB::table('internal_loan_handovers')->where('id',$request->new_interloan_handover[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }

    public function loadBranchIntLoanHandNew(Request $request)
    {

        $data = internal_loan_handover::join('branch_infos','branch_infos.id','=','internal_loan_handovers.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_handovers.member_id')
                    ->join('users','users.id','=','internal_loan_handovers.admin_id')
                    ->where('internal_loan_handovers.approval',0)
                    ->where('internal_loan_handovers.branch_id',$request->branch_id)
                    ->select('internal_loan_handovers.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();

        return view('Backend.User.InternalLoanHandover.load_data',compact('data'));
    }


    public function gettotalloan($member_id){

        $data = DB::table("internal_loan_collections")->where('member_id',$member_id)->sum('ammount');
        $data2 = DB::table("internal_loan_handovers")->where('member_id',$member_id)->sum('ammount');
        return response()->json($data-$data2);
    }

    public function showNewInternalLoanHandoverReport(Request $request)
    {

        $data = internal_loan_handover::join('branch_infos','branch_infos.id','=','internal_loan_handovers.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_handovers.member_id')
                    ->join('users','users.id','=','internal_loan_handovers.admin_id')
                    ->where('internal_loan_handovers.branch_id',$request->branch_id)
                    ->select('internal_loan_handovers.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();

        $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();
        $total = internal_loan_handover::where('branch_id',$request->branch_id)
                    ->sum('ammount');

        return view('Backend.User.InternalLoanHandover.show_new_handover_report',compact('data','branch','total'));

    }


}
