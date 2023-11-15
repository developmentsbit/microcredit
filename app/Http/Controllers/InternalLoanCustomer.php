<?php

namespace App\Http\Controllers;
use App\Models\internalloan;
use App\Models\admin_branch_info;
use Illuminate\Http\Request;
use DB;
use Auth;

class InternalLoanCustomer extends Controller
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

            $data = DB::table("internalloans")
            ->leftjoin("branch_infos",'branch_infos.id','internalloans.branch_id')
            ->select("internalloans.*",'branch_infos.branch_name')
            ->get();
        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('internalloans','internalloans.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin("branch_infos",'branch_infos.id','internalloans.branch_id')
            ->select("internalloans.*",'branch_infos.branch_name')
            ->get();
        }
        return view('Backend.User.InternalLoanCustomer.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.InternalLoanCustomer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = internalloan::create($request->except('_token'));
        if($insert)
        {
            return redirect('internal_loan_customer')->with('success','অভ্যন্তরীণ লোন গ্রাহকের তথ্য যু্ক্ত করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন গ্রাহকের তথ্য যু্ক্ত করা হয়নি');
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
         $data = internalloan::find($id);
        return view('Backend.User.InternalLoanCustomer.edit',compact('data'));
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
        $update = internalloan::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('internal_loan_customer')->with('success','অভ্যন্তরীণ লোন গ্রাহকের তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অভ্যন্তরীণ লোন গ্রাহকের তথ্য আপডেট করা হয়নি');
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
     $delete = internalloan::where('id',$id)->delete();
     if($delete)
     {
        return redirect()->back()->with('success','অভ্যন্তরীণ লোন গ্রাহকের তথ্য ডিলিট করা হলো');
    }
    else
    {
        return redirect()->back()->with('error','অভ্যন্তরীণ লোন গ্রাহকের তথ্য ডিলিট করা হয়নি');
    }
}
}
