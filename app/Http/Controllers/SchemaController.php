<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\investmentschema;
use Yajra\DataTables\Facades\DataTables;

class SchemaController extends Controller
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
        $data = investmentschema::all();
        return view('Backend.User.InvestmentSchema.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.InvestmentSchema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = investmentschema::create($request->except('_token'));
        if($insert)
        {
            return redirect('add_schema')->with('success','বিনিয়োগ স্কিমা যুক্ত করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ স্কিমা যুক্ত করা হয়নি');
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
        $data = investmentschema::find($id);
        return view('Backend.User.InvestmentSchema.edit',compact('data'));
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
        $update = investmentschema::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('add_schema')->with('success','বিনিয়োগ স্কিমা আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ স্কিমা আপডেট করা হয়নি');
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
        $delete = investmentschema::where('id',$id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','বিনিয়োগ স্কিমা ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ স্কিমা ডিলিট করা হয়নি');
        }
    }
}
