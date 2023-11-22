<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\area_info;

class AreaController extends Controller
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
        $data = area_info::join('branch_infos','branch_infos.id','=','area_infos.branch_id')
                ->select('area_infos.*','branch_infos.branch_name')
                ->orderBy('area_infos.sl','ASC')
                ->get();
        return view('Backend.User.Area.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = branch_info::where('status',1)->get();
        return view('Backend.User.Area.create',compact('branch'));
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
            'branch_id'=>'required',
            'area_name'=>'required',
        ],[
            'sl.required'=>'সিরিয়াল নাম্বার দিন',
            'branch_id.required'=>'একটি ব্রাঞ্চ নির্বাচন করুন',
            'area_name.required'=>'একটি এরিয়া নাম দিন',
        ]);

        $insert = area_info::create($request->except('_token'));
        if($insert)
        {
            return redirect('area_info')->with('success','কেন্দ্র যুক্ত করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','কেন্দ্র যুক্ত করা হয়নি');
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
        $branch = branch_info::where('status',1)->get();
        $data = area_info::find($id);
        return view('Backend.User.Area.edit',compact('branch','data'));
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
            'branch_id'=>'required',
            'area_name'=>'required',
        ],[
            'sl.required'=>'সিরিয়াল নাম্বার দিন',
            'branch_id.required'=>'একটি ব্রাঞ্চ নির্বাচন করুন',
            'area_name.required'=>'একটি এরিয়া নাম দিন',
        ]);

        $update = area_info::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('area_info')->with('success','কেন্দ্র তথ্য আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','কেন্দ্র তথ্য আপডেট করা হয়নি');
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
        $delete = area_info::where('id',$id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','কেন্দ্র ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','কেন্দ্র ডিলিট করা হয়নি');
        }
    }
}
