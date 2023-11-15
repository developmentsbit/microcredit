<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company_information;

class CompanyInformation extends Controller
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
        $data = company_information::first();
        return view('Backend.User.Company.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            'company_name'=>'required',
            'title'=>'required',
            'phone'=>'required',
        ],[
            'company_name.required'=>'কোম্পানি নাম দিন',
            'title.required'=>'কোম্পানি টাইটেল দিন',
            'phone.required'=>'কোম্পানি ফোন দিন',
        ]);

        $update = company_information::where('id',$id)->update($request->except('_token','_method','submit','logo','short_logo'));

        $logo = $request->file('logo');

        $short_logo = $request->file('short_logo');



        if($logo)
        {

            $imageName = 'logo.'.$logo->getClientOriginalExtension();

            $logo->move(base_path().'/Backend/images/',$imageName);

            company_information::where('id',$id)->update(['logo'=>$imageName]);
        }


        if($short_logo)
        {


            $imageName = 'short_logo.'.$short_logo->getClientOriginalExtension();

            $short_logo->move(base_path().'/Backend/images/',$imageName);

            company_information::where('id',$id)->update(['short_logo'=>$imageName]);
        }

        if($update)
        {
            return redirect()->back()->with('success','Company Information Updated');
        }
        else
        {
            return redirect()->back()->with('error','Company Information Update Unsuccessfull');
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
        //
    }
}
