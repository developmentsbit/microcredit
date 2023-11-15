<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\loan_collection;
use App\Models\branch_info;
use App\Models\loan;
use App\Models\admin_branch_info;
use Auth;
use DB;

class LoanCollection extends Controller
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
            $data = DB::table('loancollections')->join('branch_infos','branch_infos.id','=','loancollections.branch_id')
            ->join('loans','loans.id','=','loancollections.member_id')
            ->join('users','users.id','=','loancollections.admin_id')
            ->select('loancollections.*','branch_infos.branch_name','loans.name','users.name as first_name','users.last_name')
            ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('loancollections','loancollections.branch_id','=','admin_branch_infos.branch_id')
            ->join('branch_infos','branch_infos.id','=','loancollections.branch_id')
            ->join('loans','loans.id','=','loancollections.member_id')
            ->join('users','users.id','=','loancollections.admin_id')
            ->select('loancollections.*','branch_infos.branch_name','loans.name','users.name as first_name','users.last_name')
            ->get();
        }
        return view('Backend.User.LoanCollection.index',compact('data'));
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
    return view('Backend.User.LoanCollection.create',compact('branch'));
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

     $insert = DB::table('loancollections')->insert([
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
        return redirect('/loan_collection')->with('success',' লোন আদায় করা হলো');
    }
    else
    {
        return redirect()->back()->with('error',' লোন আদায় করা হয়নি');
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
        $data = DB::table('loancollections')->find($id);
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
        $member = loan::where('branch_id',$data->branch_id)->get();
        return view('Backend.User.LoanCollection.edit',compact('data','branch','member'));
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

        $update = DB::table('loancollections')->where('id',$id)->update([
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
            return redirect('/loan_collection')->with('success',' লোন আদায় তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error',' লোন আদায় তথ্য আপডেট করা হয়নি');
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
         $delete = DB::table('loancollections')->where('id',$id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success',' লোন আদায় তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error',' লোন আদায় তথ্য ডিলিট করা হয়নি');
        }
    }
}
