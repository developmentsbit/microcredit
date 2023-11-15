<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asset_categorey;

class AssetCategorey extends Controller
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
        $data = asset_categorey::join('users','users.id','=','asset_categoreys.admin_id')
                ->select('users.name','users.last_name','asset_categoreys.*')
                ->get();
        $sl = 1;
        return view('Backend.User.AssetCategorey.index',compact('data','sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.AssetCategorey.create');
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
            'serial_no'=>'required',
            'asset_title'=>'required',
            'status'=>'required',
        ],[
            'serial_no.required'=>'সিরিয়াল নম্বর প্রদান করুন',
            'asset_title.required'=>'অ্যাসেট টাইটেল প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $insert = asset_categorey::create($request->except('_token','submit'));

        if($insert)
        {
            return redirect('/add_asset_categorey')->with('success','অ্যাসেট ক্যাটাগরি যুক্ত করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট ক্যাটাগরি যুক্ত করা হয়নি');
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
        $data = asset_categorey::find($id);
        return view('Backend.User.AssetCategorey.edit',compact('data'));
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
            'serial_no'=>'required',
            'asset_title'=>'required',
            'status'=>'required',
        ],[
            'serial_no.required'=>'সিরিয়াল নম্বর প্রদান করুন',
            'asset_title.required'=>'অ্যাসেট টাইটেল প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $update = asset_categorey::find($id)->update($request->except('_token','_method','submit'));

        if($update)
        {
            return redirect('/add_asset_categorey')->with('success','অ্যাসেট ক্যাটাগরি তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট ক্যাটাগরি তথ্য আপডেট করা হয়নি');
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
        $delete = asset_categorey::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','অ্যাসেট ক্যাটাগরি তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট ক্যাটাগরি তথ্য ডিলিট করা হয়নি');
        }
    }
}
