<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asset_categorey;
use App\Models\asset_depreciation;
use App\Models\admin_branch_info;
use Auth;

class AssetDepreciation extends Controller
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
        $data = asset_depreciation::join('asset_categoreys','asset_categoreys.id','=','asset_depreciations.asset_title_id')
                ->join('users','asset_categoreys.admin_id','=','users.id')
                ->select('users.name','users.last_name','asset_categoreys.asset_title','asset_depreciations.*')
                ->get();
        return view('Backend.User.AssetDepreciation.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asset_title = asset_categorey::where('status',1)->get();
        return view('Backend.User.AssetDepreciation.create',compact('asset_title'));
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
            'asset_title_id'=>'required',
            'depreciation_value_per'=>'required',
            'status'=>'required',
        ],[
            'sl.required'=>'সিরিয়াল নং প্রদান করুন',
            'asset_title_id.required'=>'অ্যাসেট টাইটেল নির্বাচন করুন',
            'depreciation_value_per.required'=>'ডিপ্রেসিয়েশন ভ্যালু পার্সেন্টেজ প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $insert = asset_depreciation::create($request->except('_token','submit'));

        if($insert)
        {
            return redirect('/add_asset_depreciation')->with('success','অ্যাসেট ডিপ্রেসিয়েশন যুক্ত করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট ডিপ্রেসিয়েশন যুক্ত করা হয়নি');
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
        $asset_title = asset_categorey::where('status',1)->get();
        $data = asset_depreciation::find($id);
        return view('Backend.User.AssetDepreciation.edit',compact('asset_title','data'));
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
            'asset_title_id'=>'required',
            'depreciation_value_per'=>'required',
            'status'=>'required',
        ],[
            'sl.required'=>'সিরিয়াল নং প্রদান করুন',
            'asset_title_id.required'=>'অ্যাসেট টাইটেল নির্বাচন করুন',
            'depreciation_value_per.required'=>'ডিপ্রেসিয়েশন ভ্যালু পার্সেন্টেজ প্রদান করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $update = asset_depreciation::find($id)->update($request->except('_token','_method','submit'));

        if($update)
        {
            return redirect('/add_asset_depreciation')->with('success','অ্যাসেট ডিপ্রেসিয়েশন তথ্য আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট ডিপ্রেসিয়েশন তথ্য আপডেট করা হয়নি');
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
        $delete = asset_depreciation::find($id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success','অ্যাসেট ডিপ্রেসিয়েশন ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','অ্যাসেট ডিপ্রেসিয়েশন ডিলিট করা হয়নি');
        }
    }

    public function assetDepreciationReport()
    {
        $asset_title = asset_categorey::where('status',1)->get();
        return view('Backend.User.AssetDepreciation.asset_depreciation_report',compact('asset_title'));
    }

    public function assetDepreciationReportShow(Request $request)
    {
        if($request->asset_title_id == 'all')
        {
            $data = asset_depreciation::join('asset_categoreys','asset_categoreys.id','=','asset_depreciations.asset_title_id')
                ->join('users','asset_categoreys.admin_id','=','users.id')
                ->select('users.name','users.last_name','asset_categoreys.asset_title','asset_depreciations.*')
                ->get();
            
            
        }
        else
        {
            $data = asset_depreciation::join('asset_categoreys','asset_categoreys.id','=','asset_depreciations.asset_title_id')
                ->join('users','asset_categoreys.admin_id','=','users.id')
                ->where('asset_title_id',$request->asset_title_id)
                ->select('users.name','users.last_name','asset_categoreys.asset_title','asset_depreciations.*')
                ->get();
        }

        $asset_title = $request->asset_title_id;
        

        return view('Backend.User.AssetDepreciation.asset_depreciation_reporttab',compact('data','asset_title'));
    }

}
