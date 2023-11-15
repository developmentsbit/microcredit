<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fixed_deposit_schema;

class FixedDepositSchema extends Controller
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
        $data = fixed_deposit_schema::all();
        return view('Backend.User.FixedDepositSchema.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.FixedDepositSchema.create');
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
            'sl'=>'required',
            'fixed_deposit_name'=>'required',
            'short_name'=>'required',
            'duration'=>'required',
            'percantage'=>'required',
        ],
        [
            'sl.requried'=>'সিরিয়াল নাম্বার দিন',
            'fixed_deposit_name.requried'=>'ফিক্সড ডিপোজিট নাম দিন',
            'short_name.requried'=>'শর্ট নাম দিন',
            'duration.requried'=>'মেয়াদকাল দিন',
            'percantage.requried'=>'শতকরা হিসাব দিন',
        ]);

        $insert = fixed_deposit_schema::insert($request->except('_token','submit'));
        if($insert)
        {
            return redirect('fixed_deposit_schema')->with('success','Data Insert Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Insert Unsuccessfully');
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
        $data = fixed_deposit_schema::find($id);
        return view('Backend.User.FixedDepositSchema.edit',compact('data'));
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
            'sl'=>'required',
            'fixed_deposit_name'=>'required',
            'short_name'=>'required',
            'duration'=>'required',
            'percantage'=>'required',
        ],
        [
            'sl.requried'=>'সিরিয়াল নাম্বার দিন',
            'fixed_deposit_name.requried'=>'ফিক্সড ডিপোজিট নাম দিন',
            'short_name.requried'=>'শর্ট নাম দিন',
            'duration.requried'=>'মেয়াদকাল দিন',
            'percantage.requried'=>'শতকরা হিসাব দিন',
        ]);

        $update = fixed_deposit_schema::where('id',$id)->update($request->except('_token','_method','submit'));
        if($update)
        {
            return redirect('fixed_deposit_schema')->with('success','Data Update Sunccessfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Update Unsuccessfully');
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
        $delete = fixed_deposit_schema::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','Data Delete Sucessfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Delete Unsuccessfully');
        }
    }
}
