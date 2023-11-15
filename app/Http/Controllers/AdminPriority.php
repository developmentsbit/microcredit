<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\admin_main_menu;
use App\Models\admin_sub_menu;
use App\Models\main_menu_priority;
use App\Models\sub_menu_priority;
use App\Models\admin_branch_info;
use App\Models\admin_area_info;


class AdminPriority extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = User::where('status',1)->get();
        $main_menu = admin_main_menu::where('status',1)->get();
        $sub_menu = admin_sub_menu::where('status',1)->get();
        return view('Backend.User.AdminPriority.create',compact('admin','main_menu','sub_menu'));
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

        admin_area_info::where('admin_id',$request->admin_id)->delete();
        admin_branch_info::where('admin_id',$request->admin_id)->delete();
        main_menu_priority::where('admin_id',$request->admin_id)->delete();
        sub_menu_priority::where('admin_id',$request->admin_id)->delete();
    
        if($request->branch_id)
        {
            for ($i=0; $i < count($request->branch_id) ; $i++) { 
                admin_branch_info::create([
                    'admin_id'=>$request->admin_id,
                    'branch_id'=>$request->branch_id[$i],
                ]); 
            }
        }

        if($request->area_id)
        {
            for ($i=0; $i < count($request->area_id) ; $i++) 
            { 
                $explode = explode('and',$request->area_id[$i]);

                admin_area_info::insert([
                    'admin_id'=>$request->admin_id,
                    'branch_id'=>$explode[0],
                    'area_id'=>$explode[1],
                ]);
            }
        }
            if($request->main_menu_id)
            {
                for ($i=0; $i < count($request->main_menu_id) ; $i++) { 
                    main_menu_priority::insert([
                        'admin_id'=>$request->admin_id,
                        'main_menu_id'=>$request->main_menu_id[$i],
                    ]);
                }
            }


            if($request->sub_menu_id)
            {
                for ($i=0; $i < count($request->sub_menu_id) ; $i++) {

                    $explode = explode('and',$request->sub_menu_id[$i]);

                    sub_menu_priority::insert([
                        'admin_id'=>$request->admin_id,
                        'main_menu_id'=>$explode[0],
                        'sub_menu_id'=>$explode[1],
                    ]);
                }
            }

            return redirect()->back()->with('success','ব্রাঞ্চ ও মেনু প্রায়োরিটি দেওয়া হয়েছে');
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
        //
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
        //
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
