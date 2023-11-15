<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\income_title;

class IncomeTitle extends Controller
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

        $data = income_title::all();
        return view('Backend.User.IncomeTitle.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.IncomeTitle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insert = income_title::create($request->except('_token'));
        if($insert)
        {
            return redirect('add_income_title')->with('success','আয় খাত যোগ করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','আয় খাত যোগ করা হয়নি');
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
        $data = income_title::find($id);
        return view('Backend.User.IncomeTitle.edit',compact('data'));
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
        $update = income_title::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('add_income_title')->with('success','আয় খাত আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','আয় খাত আপডেট করা হয়নি');
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
     $delete = income_title::where('id',$id)->delete();
     if($delete)
     {
        return redirect()->back()->with('success','আয় খাত ডিলিট করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','আয় খাত ডিলিট করা হয়নি');
    }
}
}
