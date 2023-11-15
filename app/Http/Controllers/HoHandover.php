<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ho_handover;
use DB;
use Auth;
use App\Models\branch_info;
use App\Models\admin_branch_info;
use Yajra\DataTables\Facades\DataTables;



class HoHandover extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dateformate($x)
    {
    $d=explode('/', $x);
    return $d[2].'-'.$d[1].'-'.$d[0];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table("ho_handovers")
        ->leftjoin("branch_infos",'branch_infos.id','ho_handovers.handover_branch_id')
        ->leftjoin("branch_infos as branch_infos2",'branch_infos2.id','ho_handovers.collection_branch_id')
        ->select("ho_handovers.*",'branch_infos.branch_name','branch_infos2.branch_name as branch_name2')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status',function($v){
                if($v->status == 1)
                {
                    return '<span class="badge badge-success">Active</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action',function($d){
                if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $d->approval == 0)
                {
                    return '<a id="" style="float: left;margin-right:10px;" href="'.route('ho_handover.edit',$d->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                    <form action="'.route('ho_handover.destroy',$d->id).'" method="post">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                    </form>';
                }
                else
                {
                    return '';
                }
            })
            ->rawColumns(['status','action'])
            ->make(true);
        }


        return view('Backend.User.HO_handover.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.HO_handover.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $insert = ho_handover::create($request->except('_token','date'));
      $date = $this->dateformate($request->date);

      ho_handover::find($insert->id)->update(['date'=>$date]);
      if($insert)
      {
        return redirect('ho_handover')->with('success','H/O প্রদান সম্পন্ন হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','H/O প্রদান সম্পন্ন হয়নি');
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
        $data = ho_handover::find($id);
        return view('Backend.User.HO_handover.edit',compact('data'));
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
        $update = ho_handover::where('id',$id)->update($request->except('_token','_method'));

        if($update)
        {
            return redirect('ho_handover')->with('success','H/O তথ্য আপডেট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','H/O তথ্য আপডেট করা হয়নি');
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
        $delete = ho_handover::where('id',$id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','H/O তথ্য ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','H/O তথ্য ডিলিট করা হয়নি');
        }
    }

    public function new_ho_handover()
    {
        $data = DB::table("ho_handovers")
        ->leftjoin("branch_infos",'branch_infos.id','ho_handovers.handover_branch_id')
        ->leftjoin("branch_infos as branch_infos2",'branch_infos2.id','ho_handovers.collection_branch_id')
        ->where('ho_handovers.approval',0)
        ->select("ho_handovers.*",'branch_infos.branch_name','branch_infos2.branch_name as branch_name2')
        ->get();

        return view('Backend.User.HO_handover.new_data',compact('data'));
    }
    public function approved_newho_handover($id)
    {
        $approved = DB::table('ho_handovers')->where('id',$id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
        ]);

        if($approved)
        {
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
    }

    public function approveAllhoHandover(Request $request)
    {
        for ($i=0; $i < count($request->new_ho_handover) ; $i++)
        {
            $approve = DB::table('ho_handovers')->where('id',$request->new_ho_handover[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }



    public function hoprodan_reports()
    {
        if(Auth::user()->user_role == 1)
        {
            $branch = branch_info::where('status',1)->get();

        }
        else
        {

            $branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
            ->where('branch_infos.status',1)
            ->select('branch_infos.*')
            ->get();
        }

        return view('Backend.User.HO_handover.hoprodan_reports',compact('branch'));
    }




    public function hoprodan_reportsShow(Request $request)
    {
        

        $branch = DB::table("branch_infos")->where("id",$request->branch_id)->first();


        if($request->report_type == 'all')
        {
            $data = DB::table("ho_handovers")
            ->where("handover_branch_id",$request->branch_id)
            ->get();

            $report_type = 1;
            $from_date = NULL;
            $to_date = NULL;
        }
        elseif($request->report_type == 'date_to_date')
        {
            $explode = explode('/',$request->from_date);
            $from_date = $explode[2].'-'.$explode[1].'-'.$explode[0];
    
            $explode1 = explode('/',$request->to_date);
            $to_date = $explode1[2].'-'.$explode1[1].'-'.$explode1[0];
            
            $data = DB::table("ho_handovers")
            ->where("handover_branch_id",$request->branch_id)
            ->whereBetween('ho_handovers.date',[$from_date,$to_date])
            ->get();

            $report_type = 2;
        }

        $sl=1;
        return view('Backend.User.HO_handover.hoprodan_reportsShow',compact('data','sl','report_type','from_date','to_date','branch'));
    }



}
