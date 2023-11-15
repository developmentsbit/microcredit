<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_main_menu;
use App\Models\admin_sub_menu;
use App\Models\main_menu_priority;
use App\Models\sub_menu_priority;

class SubMenuController extends Controller
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
        $data = admin_sub_menu::join('admin_main_menus','admin_main_menus.id','=','admin_sub_menus.main_menu_id')
        ->select('admin_main_menus.main_menu','admin_sub_menus.*')
        ->get();
        return view('Backend.User.SubMenu.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_menu = admin_main_menu::where('status',1)->get();
        return view('Backend.User.SubMenu.create',compact('main_menu'));
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
            'main_menu_id'=>'required',
            'sub_menu'=>'required',
            'route_name'=>'required',
            'status'=>'required',
        ],
        [
            'serial_no.required'=>'Please Give A Serial Number',
            'main_menu_id.required'=>'Please Select A Main Menu',
            'sub_menu.required'=>'Please Give Sub Menu Name',
            'route_name.required'=>'Please Give Route Name',
            'status'=>'Please Select Status',
        ]);

        $insert = admin_sub_menu::create($request->except('_token'));

        if($insert)
        {
            return redirect('/sub_menu')->with('success','Sub Menu Create Successfull');
        }
        else
        {
            return redirect()->back()->with('error','Sub Menu Create Unsuccessfull');
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
        $main_menu = admin_main_menu::where('status',1)->get();
        $data = admin_sub_menu::find($id);
        return view('Backend.User.SubMenu.edit',compact('data','main_menu'));
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
            'main_menu_id'=>'required',
            'sub_menu'=>'required',
            'route_name'=>'required',
            'status'=>'required',
        ],
        [
            'serial_no.required'=>'Please Give A Serial Number',
            'main_menu_id.required'=>'Please Select A Main Menu',
            'sub_menu.required'=>'Please Give Sub Menu Name',
            'route_name.required'=>'Please Give Route Name',
            'status'=>'Please Select Status',
        ]);

        $update = admin_sub_menu::find($id)->update($request->except('_token'));

        if($update)
        {
            return redirect('sub_menu')->with('success','Sub Menu Update Successfull');
        }
        else
        {
            return redirect()->back()->with('error','Sub Menu Update Unsuccessfull');
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
        $check_prio = sub_menu_priority::where('sub_menu_id',$id)->count();
        if($check_prio > 0)
        {
            return redirect()->back()->with('error','This Sub Menu Has Priorirty');
        }
        else
        {
            $delete = admin_sub_menu::find($id)->delete();
            if($delete)
            {
                return redirect('sub_menu')->with('success','Sub Menu Delete Successfull');
            }
            else
            {
                return redirect()->back()->with('error','Sub Menu Delete Unsuccessfull');
            }
        }
    }
}
