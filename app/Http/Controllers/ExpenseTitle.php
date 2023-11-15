<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\expense_title;

class ExpenseTitle extends Controller
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
         $data = expense_title::all();
        return view('Backend.User.ExpenseTitle.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.ExpenseTitle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = expense_title::create($request->except('_token'));
        if($insert)
        {
            return redirect('add_expense_title')->with('success','ব্যায় খাত যুক্ত করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','ব্যায় খাত যুক্ত করা হয়নি');
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
        $data = expense_title::find($id);
        return view('Backend.User.ExpenseTitle.edit',compact('data'));
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
        $update = expense_title::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('add_expense_title')->with('success','ব্যায় খাত তথ্য আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','ব্যায় খাত তথ্য আপডেট করা হয়নি');
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
         $delete = expense_title::where('id',$id)->delete();
     if($delete)
     {
        return redirect()->back()->with('success','ব্যায় খাত ডিলিট করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','ব্যায় খাত ডিলিট করা হয়নি');
    }
    }
}
