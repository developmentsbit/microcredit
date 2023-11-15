<?php

namespace App\Http\Controllers;

use App\Models\loan;
use App\Models\admin_branch_info;
use Illuminate\Http\Request;
use DB;
use Auth;

class LoanCustomer extends Controller
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

        $data = DB::table("loans")
        ->leftjoin("branch_infos",'branch_infos.id','loans.branch_id')
        ->select("loans.*",'branch_infos.branch_name')
        ->get();
    }
    else
    {
        $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
        ->join('loans','loans.branch_id','=','admin_branch_infos.branch_id')
        ->leftjoin("branch_infos",'branch_infos.id','loans.branch_id')
        ->select("loans.*",'branch_infos.branch_name')
        ->get();
    }
    return view('Backend.User.LoanCustomer.index',compact('data'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.LoanCustomer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $insert = loan::create($request->except('_token'));
     if($insert)
     {
        return redirect('loan_customer')->with('success','লোন গ্রাহকের তথ্য যু্ক্ত করা হলো');
    }
    else
    {
        return redirect()->back()->with('error','লোন গ্রাহকের তথ্য যু্ক্ত করা হয়নি');
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
        $data = loan::find($id);
        return view('Backend.User.LoanCustomer.edit',compact('data'));
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
       $update = loan::where('id',$id)->update($request->except('_token','_method'));

       if($update)
       {
        return redirect('loan_customer')->with('success','লোন গ্রাহকের তথ্য আপডেট করা হলো');
    }
    else
    {
        return redirect()->back()->with('error','লোন গ্রাহকের তথ্য আপডেট করা হয়নি');
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
     $delete = loan::where('id',$id)->delete();
     if($delete)
     {
        return redirect()->back()->with('success',' লোন গ্রাহকের তথ্য ডিলিট করা হলো');
    }
    else
    {
        return redirect()->back()->with('error',' লোন গ্রাহকের তথ্য ডিলিট করা হয়নি');
    }
}
}
