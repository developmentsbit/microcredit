<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\internal_loan_collection;
use App\Models\branch_info;
use App\Models\internalloan;
use App\Models\admin_branch_info;
use Auth;
use DB;

class InternalLoanCollection extends Controller
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
            $data = internal_loan_collection::join('branch_infos','branch_infos.id','=','internal_loan_collections.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_collections.member_id')
                    ->join('users','users.id','=','internal_loan_collections.admin_id')
                    ->select('internal_loan_collections.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('internal_loan_collections','internal_loan_collections.branch_id','=','admin_branch_infos.branch_id')
                    ->join('branch_infos','branch_infos.id','=','internal_loan_collections.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_collections.member_id')
                    ->join('users','users.id','=','internal_loan_collections.admin_id')
                    ->select('internal_loan_collections.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }
        return view('Backend.User.InternalLoanCollection.index',compact('data'));
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
        return view('Backend.User.InternalLoanCollection.create',compact('branch'));
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

        $insert = internal_loan_collection::insert([
            'serial_no'=>$request->serial_no,
            'date'=>$date,
            'branch_id'=>$request->branch_id,
            'member_id'=>$request->member_id,
            'ammount'=>$request->ammount,
            'description'=>$request->description,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,

        ]);

        // $insert = internal_loan_collection::insert($request->except('_token','submit'));

        if($insert)
        {
            return redirect('/internal_loan_collection')->with('success','অভ্যন্তরীণ লোন আদায় করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন আদায় করা হয়নি');
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
        $data = internal_loan_collection::find($id);
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
        $member = internalloan::where('branch_id',$data->branch_id)->get();
        return view('Backend.User.InternalLoanCollection.edit',compact('data','branch','member'));
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

        $update = internal_loan_collection::find($id)->update([
            'serial_no'=>$request->serial_no,
            'date'=>$date,
            'branch_id'=>$request->branch_id,
            'member_id'=>$request->member_id,
            'ammount'=>$request->ammount,
            'description'=>$request->description,
            'status'=>$request->status,
            'admin_id'=>$request->admin_id,
        ]);

        if($update)
        {
            return redirect('/internal_loan_collection')->with('success','অভ্যন্তরীণ লোন আদায় তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন আদায় তথ্য আপডেট করা হয়নি');
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
        $delete = internal_loan_collection::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','অভ্যন্তরীণ লোন আদায় তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন আদায় তথ্য ডিলিট করা হয়নি');
        }
    }

    public function new_internalloan_collection()
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
            $data = internal_loan_collection::join('branch_infos','branch_infos.id','=','internal_loan_collections.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_collections.member_id')
                    ->join('users','users.id','=','internal_loan_collections.admin_id')
                    ->where('internal_loan_collections.approval',0)
                    ->select('internal_loan_collections.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('internal_loan_collections','internal_loan_collections.branch_id','=','admin_branch_infos.branch_id')
                    ->join('branch_infos','branch_infos.id','=','internal_loan_collections.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_collections.member_id')
                    ->where('internal_loan_collections.approval',0)
                    ->join('users','users.id','=','internal_loan_collections.admin_id')
                    ->select('internal_loan_collections.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();
        }
        return view('Backend.User.InternalLoanCollection.new_data',compact('data','branch'));
    }

    public function approved_internalloan_collection($id)
    {
        $approved = internal_loan_collection::where('id',$id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);
        return redirect()->back();
    }

    public function approveAllinterLoanColl(Request $request)
    {
        for ($i=0; $i < count($request->new_interloan_collection) ; $i++)
        {
            $approve = DB::table('internal_loan_collections')->where('id',$request->new_interloan_collection[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }

    public function loadInternalLoanColl(Request $request)
    {
        $data = internal_loan_collection::join('branch_infos','branch_infos.id','=','internal_loan_collections.branch_id')
                    ->join('internalloans','internalloans.id','=','internal_loan_collections.member_id')
                    ->join('users','users.id','=','internal_loan_collections.admin_id')
                    ->where('internal_loan_collections.approval',0)
                    ->where('internal_loan_collections.branch_id',$request->branch_id)
                    ->select('internal_loan_collections.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
                    ->get();

        return view('Backend.User.InternalLoanCollection.load_data',compact('data'));
    }

    public function showNewInternalLoanCollectionReport(Request $request)
    {

        $data = internal_loan_collection::join('branch_infos','branch_infos.id','=','internal_loan_collections.branch_id')
        ->join('internalloans','internalloans.id','=','internal_loan_collections.member_id')
        ->join('users','users.id','=','internal_loan_collections.admin_id')
        ->where('internal_loan_collections.branch_id',$request->branch_id)
        ->select('internal_loan_collections.*','branch_infos.branch_name','internalloans.name','users.name as first_name','users.last_name')
        ->get();

        $branch = DB::table('branch_infos')->where('id',$request->branch_id)->first();

        $total = internal_loan_collection::where('internal_loan_collections.branch_id',$request->branch_id)
        ->sum('internal_loan_collections.ammount');

        return view('Backend.User.InternalLoanCollection.show_new_collection_report',compact('data','branch','total'));



    }

}
