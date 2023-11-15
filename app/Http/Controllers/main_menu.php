<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin_main_menu;
use App\Models\admin_sub_menu;
use App\Models\main_menu_priority;
use App\Models\sub_menu_priority;

class main_menu extends Controller
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
        $data = admin_main_menu::all();
        return view('Backend.User.MainMenu.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.MainMenu.create');
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
            'serial_no'=>'required',
            'main_menu'=>'required|min:3',
            'icon'=>'required',
            'status'=>'required',
        ],[
            'serial_no.required'=>'Serial Number Is Required',
            'main_menu.rquired'=>'Please Give a Main Menu Name',
            'main_menu.min'=>'Main Menu Name Must Be At Least 3 Character',
            'icon.requried'=>'Please Give Icon',
            'status.required'=>'Please Select Stats',
        ]);

        $insert = admin_main_menu::create($request->except('_token'));

        if($insert)
        {
            return redirect('/main_menu/')->with('success','Data Insert Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Insert Unsuccessfull');
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
        $data = admin_main_menu::find($id);
        // return $data;
        return view('Backend.User.MainMenu.edit',compact('data'));
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
            'main_menu'=>'required|min:3',
            'icon'=>'required',
            'status'=>'required',
        ],
        [
            'serial_no.required'=>'Serial Number Is Required',
            'main_menu.rquired'=>'Please Give a Main Menu Name',
            'main_menu.min'=>'Main Menu Name Must Be At Least 3 Character',
            'icon.requried'=>'Please Give Icon',
            'status.required'=>'Please Select Stats',
        ]);

        $update = admin_main_menu::find($id)->update($request->except('_token'));

        if($update)
        {
            return redirect('/main_menu')->with('success','Data Update Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Data Update Unsucccessfull');
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
        $check = admin_sub_menu::where('main_menu_id',$id)->count();

        $check_prio = sub_menu_priority::where('main_menu_id',$id)->count();
        // return $check;
        if($check > 0)
        {
            return redirect()->back()->with('info','This Menu Has '.$check.' Sub Menu');
        }
        elseif($check_prio > 0)
        {
            return redirect()->back()->with('info','This Menu Has Priority '.$check.' Sub Menu');
        }
        else
        {
            $delete = admin_main_menu::find($id)->delete();
    
            if($delete)
            {
                return redirect('main_menu')->with('success','Main Menu Removed');
            }
            else
            {
                return redirect()->back()->wiht('error','Main Menu Delete Unsuccesfull');
            }
        }
    }
}
