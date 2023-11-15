<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\fixed_deposit_registration;
use App\Models\fixed_deposit_nominee;
use App\Models\fixed_deposit_schema;
use App\Models\area_info;
use App\Models\member;
use App\Models\admin_branch_info;
use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;


class FixedDepositRegistration extends Controller
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
        // return Auth::user()->user_role;
        if(Auth::user()->user_role == 1)
        {
            $data = fixed_deposit_registration::join('branch_infos','branch_infos.id','=','fixed_deposit_registrations.branch_id')
            ->join('area_infos','area_infos.id','=','fixed_deposit_registrations.area_id')
            ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
            ->join('fixed_deposit_schemas','fixed_deposit_schemas.id','=','fixed_deposit_registrations.schema_id')
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_schemas.fixed_deposit_name','fixed_deposit_registrations.*')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status',function($v){
                            if($v->status == 1)
                            {
                                return '<a href='.url("/fixedDepositStatsChange/".$v->registration_id).' class="btn btn-sm btn-success confirm">Active</a>';
                            }
                            else
                            {
                                return '<a href='.url("/fixedDepositStatsChange/".$v->registration_id).' class="btn btn-sm btn-danger confirm">Inactive</a>';
                            }
                        })
                        ->addColumn('action',function($v){
                            $edit = '<a id="" style="float: left;margin-right:10px;" href="'.route('fixeddeposit_registration.edit',$v->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>';

                            $delete = '<form action="'.route('fixeddeposit_registration.destroy',$v->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';

                        return $edit." ".$delete;

                        })
                        ->rawColumns(['status','action'])
                        ->make(true);
            }

        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('fixed_deposit_registrations','fixed_deposit_registrations.branch_id','=','admin_branch_infos.branch_id')
            ->join('branch_infos','branch_infos.id','=','fixed_deposit_registrations.branch_id')
            ->join('area_infos','area_infos.id','=','fixed_deposit_registrations.area_id')
            ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
            ->join('fixed_deposit_schemas','fixed_deposit_schemas.id','=','fixed_deposit_registrations.schema_id')
            ->select('branch_infos.branch_name','area_infos.area_name','members.aplicant_name','fixed_deposit_schemas.fixed_deposit_name','fixed_deposit_registrations.*')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status',function($v){
                            if($v->status == 1)
                            {
                                return '<a href='.url("/fixedDepositStatsChange/".$v->registration_id).' class="btn btn-sm btn-success confirm">Active</a>';
                            }
                            else
                            {
                                return '<a href='.url("/fixedDepositStatsChange/".$v->registration_id).' class="btn btn-sm btn-danger confirm">Inactive</a>';
                            }
                        })
                        ->addColumn('action',function($v){
                            $edit = '<a id="" style="float: left;margin-right:10px;" href="'.route('fixeddeposit_registration.edit',$v->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>';

                            $delete = '<form action="'.route('fixeddeposit_registration.destroy',$v->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';

                        return $edit." ".$delete;

                        })
                        ->rawColumns(['status','action'])
                        ->make(true);
            }


        }
        $sl = 1;
        return view('Backend.User.FixedDepositRegistraiton.index',compact('data','sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $schema = fixed_deposit_schema::get();
        return view('Backend.User.FixedDepositRegistraiton.create',compact('branch','schema'));
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
            'registration_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            'schema_id'=>'required',
            // 'approval'=>'required',
            'deposit_ammount'=>'required',
            'service_charge'=>'required',
            'deposit_opening_date'=>'required',
            // 'deposit_exp_date'=>'required',
            'nominee_name'=>'required',
            // 'nid_no'=>'required',
        ],
        [
            'registration_date.required'=>'রেজিষ্ট্রেশন তারিখ প্রদান করুন',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'schema_id.required'=>'স্কিমা নির্বাচন করুন',
            // 'approval.required'=>'অ্যাপরুভাল নির্বাচন করুন',
            'deposit_ammount.required'=>'ডিপোজিট পরিমাণ প্রদান করুন',
            'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
            'deposit_opening_date.required'=>'ডিপোজিট খোলার তারিখ প্রদান করুন',
            // 'deposit_exp_date.required'=>'ডিপোজিট মেয়াদ উত্তীর্ণের তারিখ প্রদান করুন',
            'nominee_name.required'=>'নমীনি নাম প্রদান করুন',
            // 'nid_no.required'=>'জাতীয় পরিচয় পত্র নাম্বার প্রদান করুন',
        ]);


        $reg_date = explode('/',$request->registration_date);
        $registration_date = $reg_date[2].'-'.$reg_date[1].'-'.$reg_date[0];

        $opening_date = explode('/',$request->deposit_opening_date);
        $deposit_opening_date = $opening_date[2].'-'.$opening_date[1].'-'.$opening_date[0];
        
        if($request->deposit_exp_date)
        {
            
            $exp_date = explode('/',$request->deposit_exp_date);
            $deposit_exp_date = $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
        }
        else
        {
            $deposit_exp_date = NULL;
        }


        $registration_id = $this->AutoCode('fixed_deposit_registrations', 'registration_id', 'F-', '8');

        $insert = fixed_deposit_registration::insertGetId([
            'application_date'=>$registration_date,
            'registration_id'=>$registration_id,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'phone'=>$request->phone,
            'schema_id'=>$request->schema_id,
            'approval'=>'0',
            'deposit_ammount'=>$request->deposit_ammount,
            'service_charge'=>$request->service_charge,
            'deposit_opening_date'=>$deposit_opening_date,
            'deposit_exp_date'=>$deposit_exp_date,
            'risk_ammount'=>$request->risk_ammount,
            'comment'=>$request->comment,
            'status'=>$request->status,
            'applicants_signature'=>'0',
            'nid'=>'0',
        ]);

        if($insert)
        {

            $nominee_insert = DB::table('fixed_deposit_nominees2')->insertGetId([
                'fixed_deposit_regid'=>$insert,
                'nominee_name'=>$request->nominee_name,
                'email'=>$request->email,
                'present_address'=>$request->present_address,
                'permenant_address'=>$request->permanent_address,
                'nid_no'=>$request->nid_no,
                'relation'=>$request->relation,
                'nominee_image'=>'0',
                'nominee_signature'=>'0',
            ]);

            if($nominee_insert)
            {
                $nominee_image = $request->file('nominee_image');

                if($nominee_image)
                {
                    $imageName = rand().'.'.$nominee_image->getClientOriginalExtension();

                    $nominee_image->move(base_path().'/Backend/images/FixedDepositNominee/',$imageName);

                    DB::table('fixed_deposit_nominees2')->where('id',$nominee_insert)->update(['nominee_image'=>$imageName]);

                }

                $nominee_signature = $request->file('nominee_signature');

                if($nominee_signature)
                {
                    $imageName = rand().'.'.$nominee_signature->getClientOriginalExtension();

                    $nominee_signature->move(base_path().'/Backend/images/FixedDepositNomineeSign/',$imageName);

                    DB::table('fixed_deposit_nominees2')->where('id',$nominee_insert)->update(['nominee_signature'=>$imageName]);

                }

                $nominee_nid = $request->file('nominee_nid');

                if($nominee_nid)
                {
                    $imageName = rand().'.'.$nominee_nid->getClientOriginalExtension();

                    $nominee_nid->move(base_path().'/Backend/images/FixedDepositNomineeNid/',$imageName);

                    DB::table('fixed_deposit_nominees2')->where('id',$nominee_insert)->update(['nid'=>$imageName]);

                }
            }

            return redirect('fixeddeposit_registration')->with('success','ফিক্সড ডিপোজিট রেজিষ্ট্রেশন সম্পন্ন করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট রেজিষ্ট্রেশন সম্পন্ন করা হয়নি');
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
        $schema = fixed_deposit_schema::get();
        $data = fixed_deposit_registration::find($id);
        $area = area_info::where('branch_id',$data->branch_id)->get();
        $member = member::where('branch_id',$data->branch_id)->where('area_id',$data->area_id)->get();
        // $nominee = fixed_deposit_nominee::where('fixed_deposit_regid',$id)->first();
        $nominee = DB::table('fixed_deposit_nominees2')->where('fixed_deposit_regid',$id)->first();
        return view('Backend.User.FixedDepositRegistraiton.edit',compact('branch','schema','data','area','member','nominee'));
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
            'registration_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            'schema_id'=>'required',
            // 'approval'=>'required',
            'deposit_ammount'=>'required',
            'service_charge'=>'required',
            'deposit_opening_date'=>'required',
            // 'deposit_exp_date'=>'required',
            'nominee_name'=>'required',
            // 'nid_no'=>'required',
        ],
        [
            'registration_date.required'=>'রেজিষ্ট্রেশন তারিখ প্রদান করুন',
            'registration_id.unique'=>'এই আইডি দ্বারা রেজিষ্ট্রেশন সম্পন্ন করা হয়েছে',
            'branch_id.required'=>'ব্রাঞ্চ নির্বাচন করুন',
            'area_id.required'=>'কেন্দ্র নির্বাচন করুন',
            'member_id.required'=>'গ্রাহক নির্বাচন করুন',
            'schema_id.required'=>'স্কিমা নির্বাচন করুন',
            // 'approval.required'=>'অ্যাপরুভাল নির্বাচন করুন',
            'deposit_ammount.required'=>'ডিপোজিট পরিমাণ প্রদান করুন',
            'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
            'deposit_opening_date.required'=>'ডিপোজিট খোলার তারিখ প্রদান করুন',
            // 'deposit_exp_date.required'=>'ডিপোজিট মেয়াদ উত্তীর্ণের তারিখ প্রদান করুন',
            'nominee_name.required'=>'নমীনি নাম প্রদান করুন',
            // 'nid_no.required'=>'জাতীয় পরিচয় পত্র নাম্বার প্রদান করুন',
        ]);


        $explode = explode('/',$request->registration_date);

        $application_date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $explode1 = explode('/',$request->deposit_opening_date);

        $deposit_opening_date = $explode1[2].'-'.$explode1[1].'-'.$explode1[0];


        if($request->deposit_exp_date)
        {
            
            $exp_date = explode('/',$request->deposit_exp_date);
            $deposit_exp_date = $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
        }
        else
        {
            $deposit_exp_date = NULL;
        }

        $update = fixed_deposit_registration::where('id',$id)->update([
            'application_date'=>$application_date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'phone'=>$request->phone,
            'schema_id'=>$request->schema_id,
            'approval'=>'0',
            'deposit_ammount'=>$request->deposit_ammount,
            'service_charge'=>$request->service_charge,
            'deposit_opening_date'=>$deposit_opening_date,
            'deposit_exp_date'=>$deposit_exp_date,
            'risk_ammount'=>$request->risk_ammount,
            'comment'=>$request->comment,
            'status'=>$request->status,
        ]);


        $nominee_insert = DB::table('fixed_deposit_nominees2')->where('fixed_deposit_regid',$id)->update([
            'nominee_name'=>$request->nominee_name,
            'email'=>$request->email,
            'present_address'=>$request->present_address,
            'permenant_address'=>$request->permanent_address,
            'nid_no'=>$request->nid_no,
            'relation'=>$request->relation,
        ]);


        $nominee_image = $request->file('nominee_image');

        if($nominee_image)
        {
            $pathImage = fixed_deposit_nominee::where('fixed_deposit_regid',$id)->first();

            $path = base_path().'/Backend/images/FixedDepositNominee/'.$pathImage->nominee_image;

            if(file_exists($path))
            {
                unlink($path);
            }
        }

        if($nominee_image)
        {
            $imageName = rand().'.'.$nominee_image->getClientOriginalExtension();

            $nominee_image->move(base_path().'/Backend/images/FixedDepositNominee/',$imageName);

            fixed_deposit_nominee::where('fixed_deposit_regid',$id)->update(['nominee_image'=>$imageName]);

        }

        $nominee_signature = $request->file('nominee_signature');

        if($nominee_signature)
        {
            $pathImage = fixed_deposit_nominee::where('fixed_deposit_regid',$id)->first();

            $path = base_path().'/Backend/images/FixedDepositNomineeSign/'.$pathImage->nominee_signature;

            if(file_exists($path))
            {
                unlink($path);
            }
        }

        if($nominee_signature)
        {
            $imageName = rand().'.'.$nominee_signature->getClientOriginalExtension();

            $nominee_signature->move(base_path().'/Backend/images/FixedDepositNomineeSign/',$imageName);

            fixed_deposit_nominee::where('fixed_deposit_regid',$id)->update(['nominee_signature'=>$imageName]);

        }


        $nominee_nid = $request->file('nominee_nid');

        if($nominee_nid)
        {
            $pathImage = fixed_deposit_nominee::where('fixed_deposit_regid',$id)->first();

            $path = base_path().'/Backend/images/FixedDepositNomineeNid/'.$pathImage->nominee_nid;

            if(file_exists($path))
            {
                unlink($path);
            }
        }

        if($nominee_nid)
        {
            $imageName = rand().'.'.$nominee_nid->getClientOriginalExtension();

            $nominee_nid->move(base_path().'/Backend/images/FixedDepositNomineeNid/',$imageName);

            fixed_deposit_nominee::where('fixed_deposit_regid',$id)->update(['nid'=>$imageName]);

        }

        if($update)
        {
            return redirect('fixeddeposit_registration')->with('success','ফিক্সড ডিপোজিট রেজিষ্ট্রেশন তথ্য আপডেট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট রেজিষ্ট্রেশন তথ্য আপডেট করা হয়নি');
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
        $applicantSign = fixed_deposit_registration::find($id);

        $path = base_path().'/Backend/images/FixedDepositRegSign/'.$applicantSign->applicants_signature;

        if(file_exists($path))
        {
            unlink($path);
        }


        $path2 = base_path().'/Backend/images/FixedDepositRegNid/'.$applicantSign->nid;

        if(file_exists($path2))
        {
            unlink($path2);
        }

        $nomineeImage = fixed_deposit_nominee::where('fixed_deposit_regid',$id)->first();

        $path = base_path().'/Backend/images/FixedDepositNominee/'.$nomineeImage->nominee_image;

        if(file_exists($path))
        {
            unlink($path);
        }

        $nomineeSign = fixed_deposit_nominee::where('fixed_deposit_regid',$id)->first();

        $path = base_path().'/Backend/images/FixedDepositNomineeSign/'.$nomineeSign->nominee_signature;

        if(file_exists($path))
        {
            unlink($path);
        }

        $path3 = base_path().'/Backend/images/FixedDepositNomineeNid/'.$nomineeSign->nid;

        if(file_exists($path3))
        {
            unlink($path3);
        }

        fixed_deposit_nominee::where('fixed_deposit_regid',$id)->delete();

        $delete = fixed_deposit_registration::find($id)->delete();
        if($delete)
        {
            return redirect()->back()->with('success','ফিক্সড ডিপোজিট রেজিষ্ট্রেশন তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','ফিক্সড ডিপোজিট রেজিষ্ট্রেশন তথ্য ডিলিট করা হয়নি');
        }

    }

    public function fixedDepositStatsChange($id)
    {
        $check = DB::table('fixed_deposit_registrations')->where('registration_id',$id)->first();

        if($check->status == 0)
        {
            DB::table('fixed_deposit_registrations')->where('registration_id',$id)->update(['status'=>1]);
        }
        else
        {
            DB::table('fixed_deposit_registrations')->where('registration_id',$id)->update(['status'=>0]);
        }

        return redirect()->back();
    }
}
