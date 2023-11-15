<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_sub_menu;
use App\Models\admin_main_menu;
use App\Models\main_menu_priority;
use App\Models\sub_menu_priority;
use App\Models\User;
use App\Models\branch_info;
use App\Models\admin_branch_info;
use App\Models\admin_area_info;
use App\Models\employee_info;
use Hash;

class adminController extends Controller
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
        $data = User::all();
        $sl = 1;
        return view('Backend.User.Admin.index',compact('data','sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $employee = employee_info::where('status',1)->get();
        return view('Backend.User.Admin.create',compact('employee'));
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

        // return $request->user_role;
        $validated = $request->validate([
            'user_role'=>'required',
            'first_name'=>'required|min:3',
            // 'last_name'=>'required|min:3',
            'phone'=>'required|min:11',
            'email'=>'required|unique:users',
            'password'=>'required|min:3',
            'status'=>'required',
        ],[
            'user_role.required'=>'একটি ইউজার রোল নির্বাচন করুন',
            'first_name.requried'=>'প্রথম নাম প্রদান করুন',
            'first_name.min'=>'প্রথম নাম সর্বনিম্ন ৩ টি ক্যারেক্টার হতে হবে',
            // 'last_name.required'=>'শেষ নাম প্রদান করুন',
            // 'last_name.min'=>'শেষ নাম সর্বনিম্ন ৩ টি ক্যারেক্টার হতে হবে',
            'phone.required'=>'ফোন নাম্বার প্রদান করুন',
            'phone.min'=>'ফোন নাম্বার অবশ্যই ১১ ডিজিটের হতে হবে',
            'email.required'=>'ই-মেইল প্রদান করুন',
            'email.unique'=>'এই ইমেইল ব্যবহার করা হয়েছে',
            'password.required'=>'পাসওয়ার্ড প্রদান করুন',
            'password.min'=>'পাসওয়ার্ড সর্বনিম্ন ৩ টি ডিজিটের হতে হবে',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);
        // dd($request->all());
        $insert = User::insert([
            'employee_id'=>$request->employee_id,
            'user_role'=>$request->user_role,
            'name'=>$request->first_name,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'password_recover'=>$request->password,
            'status'=>$request->status,
            'image'=>$request->image,
            'email'=>$request->email,
        ]);

        if($insert)
        {
            return redirect('create_admin')->with('success','নতুন অ্যাডমিন তৈরি সম্পন্ন হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','নতুন অ্যাডমিন তৈরি করা হয়নি');
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
        $data = User::find($id);
        return view('Backend.User.Admin.user_profile',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('Backend.User.Admin.edit',compact('data'));
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
            'user_role'=>'required',
            'first_name'=>'required|min:3',
            'phone'=>'required|min:11',
            'email'=>'required',
            'status'=>'required',
        ],[
            'user_role.required'=>'Please Select A User Role',
            'first_name.requried'=>'Please Give First Name',
            'first_name.min'=>'First Name Must Be At Least 3 Character',
            'phone.required'=>'Please Give phone Number',
            'phone.min'=>'Phone Number At Least 11 Digit',
            'email.required'=>'Please Give Email',
            'status.required'=>'Status Must Be Requried',
        ]);
        // dd($request->all());

        $update = User::where('id',$id)->update([
            'user_role'=>$request->user_role,
            'name'=>$request->first_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'status'=>$request->status,
        ]);

        if($update)
        {
            return redirect('/create_admin')->with('success','অ্যাডমিন এর তথ্যসমূহ আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাডমিন এর তথ্যসমূহ আপডেট করা হয়নি');
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
        main_menu_priority::where('admin_id',$id)->delete();
        sub_menu_priority::where('admin_id',$id)->delete();
        admin_branch_info::where('admin_id',$id)->delete();
        admin_area_info::where('admin_id',$id)->delete();

        $delete = User::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','অ্যাডমিন ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাডমিন ডিলিট করা হয়নি');
        }
    }


}
