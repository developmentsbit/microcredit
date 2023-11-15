<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\area_info;
class BranchController extends Controller
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
        $data = branch_info::all();
        $sl = 1;
        return view('Backend.User.Branch.index',compact('data','sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.Branch.create');
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
            'branch_name'=>'required',
        ],[
            'branch_name.required'=>'একটি ব্রাঞ্চ নাম দিন',
        ]);

        $insert = branch_info::create($request->except('_token'));

        if($insert)
        {
            return redirect('/branch_info')->with('success','নতুন ব্রাঞ্চ যুক্ত করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','নতুন ব্রাঞ্চ যুক্ত করা হয়নি');
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
        // return $id;
        $data = branch_info::find($id);
        return view('Backend.User.Branch.edit',compact('data'));
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
            'branch_name'=>'required',
        ],[
            'branch_name.required'=>'একটি ব্রাঞ্চ নাম দিন',
        ]);

        $update = branch_info::where('id',$id)->update($request->except('_token','_method'));
        if($update)
        {
            return redirect('branch_info')->with('success','ব্রাঞ্চ তথ্য আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','ব্রাঞ্চ তথ্য আপডেট করা হয়নি');
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
        $count = area_info::where('branch_id',$id)->count();
        if($count > 0)
        {
            return redirect()->back()->with('info','এই ব্রাঞ্চ এর '.$count.' টি কেন্দ্র রয়েছে');
        }
        else
        {
            $delete = branch_info::where('id',$id)->delete();
            if($delete)
            {
                return redirect()->back()->with('success','ব্রাঞ্চ ডিলিট করা হয়েছে');
            }
            else
            {
                return redirect()->back()->with('error','ব্রাঞ্চ ডিলিট করা হয়নি');
            }
        }
    }
}
