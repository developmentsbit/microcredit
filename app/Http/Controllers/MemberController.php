<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use App\Models\admin_branch_info;
use App\Models\area_info;
use App\Models\branch_info;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AutoCode($table, $fildname, $prefix, $length)
    {
        $id_length = $length;
        $max_id = DB::table($table)->max($fildname);
        $prefix = $prefix;
        $prefix_length = strlen($prefix);
        $only_id = substr($max_id, $prefix_length);
        $new = (int)($only_id);
        $new++;
        $number_of_zero = $id_length - $prefix_length - strlen($new);
        $zero = str_repeat("0", $number_of_zero);
        $made_id = $prefix . $zero . $new;
        return $made_id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(Auth::user()->user_role == 1)
        {
            $data = member::join('branch_infos','branch_infos.id','=','members.branch_id')
            ->leftjoin('area_infos','area_infos.id','members.area_id')
            ->leftjoin('division_informations','division_informations.id','members.division')
            ->leftjoin('district_informations','district_informations.id','members.district')
            ->leftjoin('upazila_informations','upazila_informations.id','members.upazila')
            ->select('members.*','branch_infos.branch_name','division_informations.division_name','district_informations.district_name','upazila_informations.upazila_name','area_infos.area_name')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status',function($row){
                            if($row->status == 1)
                            {
                                return '<span class="badge badge-success">Active</span>';
                            }
                            else
                            {
                                return "<span class='badge badge-danger'>Inactive</span>";
                            }
                        })
                        ->addColumn('image',function($row){
                            return '<img src="'.asset('Backend/images/MemberImage').'/'.$row->image.'" class="img-fluid" style="max-height: 50px;">';

                        })
                        ->addColumn('action',function($row){
                            $update = '<a id="" style="float: left;margin-right:10px;" href="'.route('add_member.edit',$row->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>';

                            $delete = '<form action="'.route('add_member.destroy',$row->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="return confirm("Are Your Sure?")" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                            </form>';

                            return $update."".$delete;
                        })
                        ->rawColumns(['status','image','action'])
                        ->make(true);
            }

        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('members','members.branch_id','=','admin_branch_infos.branch_id')
            ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
            ->leftjoin('area_infos','area_infos.id','members.area_id')
            ->leftjoin('division_informations','division_informations.id','members.division')
            ->leftjoin('district_informations','district_informations.id','members.district')
            ->leftjoin('upazila_informations','upazila_informations.id','members.upazila')
            ->select('branch_infos.branch_name','members.*','division_informations.division_name','district_informations.district_name','upazila_informations.upazila_name','area_infos.area_name')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status',function($row){
                            if($row->status == 1)
                            {
                                return '<span class="badge badge-success">Active</span>';
                            }
                            else
                            {
                                return "<span class='badge badge-danger'>Inactive</span>";
                            }
                        })
                        ->addColumn('image',function($row){
                            return '<img src="'.asset('Backend/images/MemberImage').'/'.$row->image.'" class="img-fluid" style="max-height: 50px;">';

                        })
                        ->addColumn('action',function($row){
                            $update = '<a id="" style="float: left;margin-right:10px;" href="'.route('add_member.edit',$row->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>';

                            $delete = '<form action="'.route('add_member.destroy',$row->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="return confirm("Are Your Sure?")" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                            </form>';

                            return $update."".$delete;
                        })
                        ->rawColumns(['status','image','action'])
                        ->make(true);
            }
        }



        return view('Backend.User.Member.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $division = division_information::where('status',1)->get();

        if(Auth::user()->user_role == 1)
        {
            $admin_branch = branch_info::where('status',1)->get();
        }
        else
        {

            $admin_branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                                                ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                                                ->select('branch_infos.*')
                                                ->get();
        }
        return view('Backend.User.Member.create',compact('admin_branch','division'));
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

        $member_id = $this->AutoCode('members', 'member_id', 'M-', '8');

        $data = array(
            'member_id'=> $member_id,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'apply_date'=>$request->apply_date,
            'aplicant_name'=>$request->aplicant_name,
            'husband_wife'=>$request->husband_wife,
            'father_name'=>$request->father_name,
            'mother_name'=>$request->mother_name,
            'gender'=>$request->gender,
            'religion'=>$request->religion,
            'date_of_birth'=>$request->date_of_birth,
            'nid_no'=>$request->nid_no,
            'occupation'=>$request->occupation,
            'phone'=>$request->phone,
            'present_address'=>$request->present_address,
            'permenant_address'=>$request->permenant_address,
            'status'=>$request->status,
            'applicant_nid'=>'0',
            'division'=>$request->division,
            'district'=>$request->district,
            'upazila'=>$request->upazila,
            'image'=>'0',
            'signature'=>'0',
        );

        $insert = member::create($data);

        if($insert)
        {
            $id = $insert->id;
            // return $id;
            $file = $request->file('image');
            $file2 = $request->file('signature');
            $file3 = $request->file('applicant_nid');
            if($file)
            {
                $imageName = rand().'.'.$file->getClientOriginalExtension();

                $file->move(base_path().'/Backend/images/MemberImage',$imageName);

                member::where('id',$id)->update(['image'=>$imageName]);
            }


            if($file2)
            {
                $imageName = rand().'.'.$file2->getClientOriginalExtension();

                $file2->move(base_path().'/Backend/images/MemberImage',$imageName);

                member::where('id',$id)->update(['signature'=>$imageName]);
            }

            if($file3)
            {
                $imageName = rand().'.'.$file3->getClientOriginalExtension();

                $file3->move(base_path().'/Backend/images/MemberNid',$imageName);

                member::where('id',$id)->update(['applicant_nid'=>$imageName]);
            }




            return redirect()->back()->with('success','গ্রাহক যুক্ত করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','গ্রাহক যুক্ত করা হয়নি');
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
        $data = member::find($id);
        $division = division_information::where('status',1)->get();
        // return $data->branch_id;
        $areas = area_info::where('branch_id',$data->branch_id)->get();

        $district = district_information::where('division_id',$data->division)->get();
        $upazila = upazila_information::where('district_id',$data->district)->get();

        return view('Backend.User.Member.edit',compact('data','areas','division','district','upazila'));

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
      $data = array(
        'branch_id'=>$request->branch_id,
        'area_id'=>$request->area_id,
        'apply_date'=>$request->apply_date,
        'aplicant_name'=>$request->aplicant_name,
        'husband_wife'=>$request->husband_wife,
        'father_name'=>$request->father_name,
        'mother_name'=>$request->mother_name,
        'gender'=>$request->gender,
        'religion'=>$request->religion,
        'date_of_birth'=>$request->date_of_birth,
        'nid_no'=>$request->nid_no,
        'occupation'=>$request->occupation,
        'phone'=>$request->phone,
        'present_address'=>$request->present_address,
        'permenant_address'=>$request->permenant_address,
        'status'=>$request->status,
        'division'=>$request->division,
            'district'=>$request->district,
            'upazila'=>$request->upazila,
    );

      $update = member::where('id',$id)->update($data);
      $file = $request->file('image');
      $file2 = $request->file('signature');
      $file3 = $request->file('applicant_nid');
      if($file)
      {
        $pathImage = member::find($id);

        $path = base_path().'/Backend/images/MemberImage/'.$pathImage->image;

        if(file_exists($path))
        {
            unlink($path);
        }
    }

    if($file2)
    {
        $pathImage = member::find($id);

        $path2 = base_path().'/Backend/images/MemberImage/'.$pathImage->signature;

        if(file_exists($path2))
        {
            unlink($path2);
        }
    }


    if($file3)
    {
        $pathImage = member::find($id);

        $path3 = base_path().'/Backend/images/MemberNid/'.$pathImage->applicant_nid;

        if(file_exists($path3))
        {
            unlink($path3);
        }
    }

    if($file)
    {
        $imageName = rand().'.'.$file->getClientOriginalExtension();

        $file->move(base_path().'/Backend/images/MemberImage',$imageName);

        member::where('id',$id)->update(['image'=>$imageName]);

    }

    if($file2)
    {
        $imageName = rand().'.'.$file2->getClientOriginalExtension();

        $file2->move(base_path().'/Backend/images/MemberImage',$imageName);

        member::where('id',$id)->update(['signature'=>$imageName]);

    }

    if($file3)
    {
        $imageName = rand().'.'.$file3->getClientOriginalExtension();

        $file3->move(base_path().'/Backend/images/MemberNid',$imageName);

        member::where('id',$id)->update(['applicant_nid'=>$imageName]);
    }

    if($update)
    {
        return redirect('add_member')->with('success','গ্রাহক তথ্য আপডেট করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','গ্রাহক তথ্য আপডেট করা হয়নি');
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

        $pathImage = member::find($id);

        // $path = base_path().'/Backend/images/MemberImage/'.$pathImage->image;
        // $path2 = base_path().'/Backend/images/MemberImage/'.$pathImage->signature;
        // $path3 = base_path().'/Backend/images/MemberNid/'.$pathImage->applicant_nid;

        // if(file_exists($path))
        // {
        //     unlink($path);
        // }
        // if (file_exists($path2)) {
        //     unlink($path2);
        // }
        // if (file_exists($path3)) {
        //     unlink($path3);
        // }

        $delete = member::find($id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success','গ্রাহক ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','গ্রাহক ডিলিট করা হয়নি');
        }


    }
}
