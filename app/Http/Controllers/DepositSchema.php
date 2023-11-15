<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\saving_schema;

class DepositSchema extends Controller
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
        $data = saving_schema::all();
        return view('Backend.User.SavingSchema.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.SavingSchema.create');
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
            'sl'=>'required',
            'deposit_name'=>'required',
            'short_name'=>'required',
            'duration'=>'required',
            'percantage'=>'required',
        ],
        [
            'sl.requried'=>'সিরিয়াল নাম্বার দিন',
            'deposit_name.requried'=>'সঞ্চয় নাম দিন',
            'short_name.requried'=>'শর্ট নাম দিন',
            'duration.requried'=>'মেয়াদকাল দিন',
            'percantage.requried'=>'শতকরা হিসাব দিন',
        ]);

        $insert = saving_schema::insert($request->except('_token','submit'));

        if($insert)
        {
            return redirect('/add_saving_schema')->with('success','সঞ্চয় স্কিমা যুক্ত করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় স্কিমা যুক্ত করা হয়নি');
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
        $data = saving_schema::find($id);
        return view('Backend.User.SavingSchema.edit',compact('data'));
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
        // dd($request->all());
        $validated = $request->validate([
            'sl'=>'required',
            'deposit_name'=>'required',
            'short_name'=>'required',
            'duration'=>'required',
            'percantage'=>'required',
        ],
        [
            'sl.requried'=>'সিরিয়াল নাম্বার দিন',
            'deposit_name.requried'=>'সঞ্চয় নাম দিন',
            'short_name.requried'=>'শর্ট নাম দিন',
            'duration.requried'=>'মেয়াদকাল দিন',
            'percantage.requried'=>'শতকরা হিসাব দিন',
        ]);

        $update = saving_schema::find($id)->update($request->except('_token','_method','submit'));
        if($update)
        {
            return redirect('/add_saving_schema')->with('success','সঞ্চয় স্কিমা আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় স্কিমা আপডেট করা হয়নি');
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
        $delete = saving_schema::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','সঞ্চয় স্কিমা ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় স্কিমা ডিলিট করা হয়নি');
        }
    }
}
