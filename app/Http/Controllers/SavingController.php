<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\area_info;
use App\Models\member;
use App\Models\saving_schema;
use App\Models\saving_registration;
use App\Models\savings_registration_nominee;
use App\Models\admin_branch_info;
use App\Models\User;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use DateTime;
use DateInterval;

class SavingController extends Controller
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
        // dd($data);

        if(Auth::user()->user_role == 1)
        {
            $data = saving_registration::join('branch_infos','branch_infos.id','=','saving_registrations.branch_id')
                ->join('area_infos','area_infos.id','=','saving_registrations.area_id')
                ->leftjoin('members','members.member_id','saving_registrations.member_id')
                ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
                ->join('users','users.id','=','saving_registrations.admin_id')
                ->select('saving_registrations.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_schemas.deposit_name','users.name')
                ->get();

                if ($request->ajax()) {
                    return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('show',function($row){
                                return '<a href="'.route('saving_registration.show',$row->id).'" class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>';
                            })
                            ->addColumn('status',function($row){
                                if($row->status == 1)
                                {
                                    return '<a href='.url("/savingRegStatusChange/".$row->registration_id).' class="btn btn-sm btn-success confirm">Active</a>';
                                }
                                else
                                {
                                    return '<a href='.url("/savingRegStatusChange/".$row->registration_id).' class="btn btn-sm btn-danger confirm">Inactive</a>';
                                }
                            })
                            ->addColumn('schema',function($row){
                                $schema_name = DB::table('saving_schemas')->where('id',$row->schema_id)->first();

                                return $schema_name->deposit_name;
                            })
                            ->addColumn('action',function($row){
                                $edit = '<a id="" style="float: left;margin-right:10px;" href="'.route('saving_registration.edit',$row->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>';

                                if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $row->approval == 0)
                                {
                                    $delete = '<form action="'.route('saving_registration.destroy',$row->id).'" method="post">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                    <button onclick="return confirm("Are Your Sure?")" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                </form>';
                                }
                                else
                                {
                                    $delete = '';
                                }

                                return $edit."".$delete;
                            })
                            ->rawColumns(['show','status','action','schema'])
                            ->make(true);
                }
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('saving_registrations','saving_registrations.branch_id','=','admin_branch_infos.branch_id')
                    ->join('area_infos','area_infos.id','=','saving_registrations.area_id')
                    ->join('members','members.member_id','=','saving_registrations.member_id')
                    ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
                    ->join('users','users.id','=','saving_registrations.admin_id')
                    ->join('branch_infos','branch_infos.id','=','saving_registrations.branch_id')
                    ->select('saving_registrations.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_schemas.deposit_name','users.name')
                    ->get();
                    if ($request->ajax()) {
                        return Datatables::of($data)
                                ->addIndexColumn()
                                ->addColumn('show',function($row){
                                    return '<a href="'.route('saving_registration.show',$row->id).'" class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>';
                                })
                                ->addColumn('status',function($row){
                                    if($row->status == 1)
                                    {
                                        return '<a href='.url("/savingRegStatusChange/".$row->registration_id).' class="btn btn-sm btn-success confirm">Active</a>';
                                    }
                                    else
                                    {
                                        return '<a href='.url("/savingRegStatusChange/".$row->registration_id).' class="btn btn-sm btn-danger confirm">Inactive</a>';
                                    }
                                })
                                ->addColumn('schema',function($row){
                                    $schema_name = DB::table('saving_schemas')->where('id',$row->schema_id)->first();
    
                                    return $schema_name->deposit_name;
                                })
                                ->addColumn('action',function($row){
                                    $edit = '<a id="" style="float: left;margin-right:10px;" href="'.route('saving_registration.edit',$row->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>';

                                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $row->approval == 0)
                                    {
                                        $delete = '<form action="'.route('saving_registration.destroy',$row->id).'" method="post">
                                        '.csrf_field().'
                                        '.method_field("DELETE").'
                                        <button onclick="return confirm("Are Your Sure?")" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                    </form>';
                                    }
                                    else
                                    {
                                        $delete = '';
                                    }

                                    return $edit."".$delete;
                                })
                                ->rawColumns(['show','status','action','schema'])
                                ->make(true);
                    }
        }

        $sl = 1;

        return  view('Backend.User.SavingRegistration.index',compact('data','sl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $branch = branch_info::where('status',1)->get();
        if(Auth::user()->user_role ==1)
        {
            $branch = branch_info::where('status',1)->get();
        }
        else
        {
            $branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                ->select('branch_infos.*')
                ->get();
        }

        $area = area_info::where('status',1)->get();
        $member = member::where('status',1)->get();
        $schema = saving_schema::all();
        // return $schema;
        return view('Backend.User.SavingRegistration.create',compact('branch','area','member','schema'));
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
        // return $request->registration_date;
         $reg_date = explode('/',$request->registration_date);

         $registration_date = $reg_date[2].'-'.$reg_date[1].'-'.$reg_date[0];


        $validated = $request->validate([
            'registration_date'=>'required',
            'branch_id'=>'required',
            'area_id'=>'required',
            'member_id'=>'required',
            'schema_id'=>'required',
            'savings_ammount'=>'required',
            'total'=>'required',
            'service_charge'=>'required',
            'installment_no'=>'required',
            'installment_ammount'=>'required',
            // 'deposit_ammount'=>'required',
            // 'risk_ammount'=>'required',
            'status'=>'required',
            'nominee_name'=>'required',
            'nid_no'=>'required',
            'relation'=>'required',
        ],
    [
        'registration_date.required'=>'রেজিষ্ট্রেশন তারিখ প্রদান করুন',
        'branch_id.required'=>'একটি ব্রাঞ্চ সিলেক্ট করুন',
        'area_id.required'=>'একটি কেন্দ্র নির্বাচন করুন',
        'member_id.required'=>'একজন গ্রাহক নির্বাচন করুন',
        'schema_id.required'=>'একটি স্কিমা নির্বাচন করুন',
        'savings_ammount.required'=>'সঞ্চয় পরিমাণ প্রদান করুন',
        'total.required'=>'মোট টাকা প্রদান করুন',
        'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
        'installment_no.required'=>'কিস্তির নাম্বার প্রদান করুন',
       
        // 'deposit_ammount.required'=>'সঞ্চয় পরিমাণ প্রদান করুন',
        // 'risk_ammount.required'=>'ঝুকির পরিমাণ প্রদান করুন',
        'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        'nominee_name.required'=>'নমীনি নাম প্রদান করুন',
        'nid_no.required'=>'জাতীয় পরিচয় পত্র প্রদান করুন',
        'relation.required'=>'সম্পর্ক নির্বাচন করুন',
    ]);

    $reg_date = explode('/',$request->registration_date);

    $registration_date = $reg_date[2].'-'.$reg_date[1].'-'.$reg_date[0];

        $d='P'.$request->duration.'D';
        $lastdate = new DateTime($registration_date);
        $lastdate->add(new DateInterval($d));
        $savings_exp_date = $lastdate->format('Y-m-d');
       


    $registration_id = $this->AutoCode('saving_registrations', 'registration_id', 'S-', '8');

    $saving_info = array(
        'application_date'=>$registration_date,
        'registration_id'=>$registration_id,
        'branch_id'=>$request->branch_id,
        'area_id'=>$request->area_id,
        'member_id'=>$request->member_id,
        'phone'=>$request->phone,
        'schema_id'=>$request->schema_id,
        'approval'=>'0',
        'savings_ammount'=>$request->savings_ammount,
        'profit_ammount'=>$request->profit_ammount,
        'total'=>$request->total,
        'service_charge'=>$request->service_charge,
        'installment_no'=>$request->installment_no,
        'installment_ammount'=>$request->installment_ammount,
        // 'savings_handover_date'=>$savings_handover_date,
        'savings_exp_date'=>$savings_exp_date,
        // 'deposit_ammount'=>$request->deposit_ammount,
        // 'risk_ammount'=>$request->risk_ammount,
        'comment'=>$request->comment,
        'status'=>$request->status,
        'applicants_signature'=>'0',
        'admin_id'=>$request->admin_id,
        'nid'=>'0',
        'profit_percantage'=>$request->profit_percantage,
    );

    $insert = saving_registration::insertGetId($saving_info);

    if($insert)
    {

        $nominee = array(
            'savings_reg_id'=>$insert,
            'nominee_name'=>$request->nominee_name,
            'email'=>$request->email,
            'present_address'=>$request->present_address,
            'permenant_address'=>$request->permenant_address,
            'nid_no'=>$request->nid_no,
            'relation'=>$request->relation,
            'nominee_image'=>'0',
            'nominee_signature'=>'0',
            'nid'=>'0',
            'savings_member_regid'=>$request->registration_id,
        );

        $insert_nominee = savings_registration_nominee::insert($nominee);

        if($insert_nominee)
        {
            $nominee_image = $request->file('nominee_image');

            if($nominee_image)
            {
                $imageName = rand().'.'.$nominee_image->getClientOriginalExtension();

                $nominee_image->move(base_path().'/Backend/images/NomineeImage/',$imageName);

                savings_registration_nominee::where('savings_reg_id',$insert)->update(['nominee_image'=>$imageName]);
            }

            $nominee_signature = $request->file('nominee_singature');
            if($nominee_signature)
            {
                $imageName = rand().'.'.$nominee_signature->getClientOriginalExtension();

                $nominee_signature->move(base_path().'/Backend/images/NomineeSignature/',$imageName);

                savings_registration_nominee::where('savings_reg_id',$insert)->update(['nominee_signature'=>$imageName]);
            }

            $nominee_nid = $request->file('nominee_nid');

            if($nominee_nid)
            {
                $imageName = rand().'.'.$nominee_nid->getClientOriginalExtension();

                $nominee_nid->move(base_path().'/Backend/images/NomineeNid/',$imageName);

                savings_registration_nominee::where('savings_reg_id',$insert)->update(['nid'=>$imageName]);
            }
        }


        return redirect('/saving_registration')->with('success','সঞ্চয় রেজিষ্ট্রেশন সম্পন্ন করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','সঞ্চয় রেজিষ্ট্রেশন সম্পন্ন করা হয়নি');
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
        $data = saving_registration::join('branch_infos','branch_infos.id','=','saving_registrations.branch_id')
                ->join('area_infos','area_infos.id','=','saving_registrations.area_id')
                ->join('members','members.member_id','=','saving_registrations.member_id')
                ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
                ->join('users','users.id','=','saving_registrations.admin_id')
                ->where('saving_registrations.id',$id)
                ->select('saving_registrations.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_schemas.deposit_name','users.name')
                ->first();

        $member = DB::table('members')->where('member_id',$data->member_id)->first();


        return view('Backend.User.SavingRegistration.show',compact('data','member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



        if(Auth::user()->user_role ==1)
        {
            $branch = branch_info::where('status',1)->get();
        }
        else
        {
            $branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                ->select('branch_infos.*')
                ->get();
        }
        $schema = saving_schema::all();

        $data = saving_registration::find($id);

        $schema_per = DB::table('saving_schemas')->find($data->schema_id);

        // return $schema_per->percantage;

        $area = area_info::where('status',1)->where('branch_id',$data->branch_id)->get();

        $member = member::where('status',1)->where('branch_id',$data->branch_id)->where('area_id',$data->area_id)->get();

        $nominee = savings_registration_nominee::where('savings_reg_id',$data->id)->first();



        return view('Backend.User.SavingRegistration.edit',compact('branch','area','member','schema','data','nominee','schema_per'));
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
            'savings_ammount'=>'required',
            'profit_ammount'=>'required',
            'total'=>'required',
            'service_charge'=>'required',
            'installment_no'=>'required',
            'installment_ammount'=>'required',
            'savings_exp_date'=>'required',
            // 'deposit_ammount'=>'required',
            // 'risk_ammount'=>'required',
            // 'status'=>'required',
            'nominee_name'=>'required',
            'nid_no'=>'required',
            'relation'=>'required',
        ],
    [
        'registration_date.required'=>'রেজিষ্ট্রেশন তারিখ প্রদান করুন',
        'branch_id.required'=>'একটি ব্রাঞ্চ সিলেক্ট করুন',
        'area_id.required'=>'একটি কেন্দ্র নির্বাচন করুন',
        'member_id.required'=>'একজন গ্রাহক নির্বাচন করুন',
        'schema_id.required'=>'একটি স্কিমা নির্বাচন করুন',
        'savings_ammount.required'=>'সঞ্চয় পরিমাণ প্রদান করুন',
        'profit_ammount.required'=>'লাভের পরিমাণ প্রদান করুন',
        'total.required'=>'মোট টাকা প্রদান করুন',
        'service_charge.required'=>'সার্ভিস চার্জ প্রদান করুন',
        'installment_no.required'=>'কিস্তির নাম্বার প্রদান করুন',
        'savings_exp_date.required'=>'কিস্তির মেয়াদ তারিখ প্রদান করুন',
        // 'deposit_ammount.required'=>'সঞ্চয় পরিমাণ প্রদান করুন',
        // 'risk_ammount.required'=>'ঝুকির পরিমাণ প্রদান করুন',
        // 'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        'nominee_name.required'=>'নমীনি নাম প্রদান করুন',
        'nid_no.required'=>'জাতীয় পরিচয় পত্র প্রদান করুন',
        'relation.required'=>'সম্পর্ক নির্বাচন করুন',
    ]);

    $reg_date = explode('/',$request->registration_date);

    $registration_date = $reg_date[2].'-'.$reg_date[1].'-'.$reg_date[0];

    // $explode1 = explode('/',$request->savings_handover_date);

    // $savings_handover_date = $explode1[2].'-'.$explode1[1].'-'.$explode1[0];


    $explode2 = explode('/',$request->savings_exp_date);

    $savings_exp_date = $explode2[2].'-'.$explode2[1].'-'.$explode2[0];

    $saving_info = array(
        'application_date'=>$registration_date,
        'branch_id'=>$request->branch_id,
        'area_id'=>$request->area_id,
        'member_id'=>$request->member_id,
        'phone'=>$request->phone,
        'schema_id'=>$request->schema_id,
        'savings_ammount'=>$request->savings_ammount,
        'profit_ammount'=>$request->profit_ammount,
        'total'=>$request->total,
        'service_charge'=>$request->service_charge,
        'installment_no'=>$request->installment_no,
        'installment_ammount'=>$request->installment_ammount,
        // 'savings_handover_date'=>$savings_handover_date,
        'savings_exp_date'=>$savings_exp_date,
        // 'deposit_ammount'=>$request->deposit_ammount,
        // 'risk_ammount'=>$request->risk_ammount,
        'comment'=>$request->comment,
        'status'=>$request->status,
        'profit_percantage'=>$request->profit_percantage,
    );

    $update = saving_registration::find($id)->update($saving_info);


    $nominee = array(
        'nominee_name'=>$request->nominee_name,
        'email'=>$request->email,
        'present_address'=>$request->present_address,
        'permenant_address'=>$request->permenant_address,
        'nid_no'=>$request->nid_no,
        'relation'=>$request->relation,
    );

    $nominee_update = savings_registration_nominee::where('savings_reg_id',$id)->update($nominee);

    $nominee_image = $request->file('nominee_image');

    if($nominee_image)
    {
        $pathImage = savings_registration_nominee::where('savings_reg_id',$id)->first();

        $path = base_path().'/Backend/images/NomineeImage/'.$pathImage->nominee_image;

        if(file_exists($path))
        {
            unlink($path);
        }
    }

    if($nominee_image)
    {
        $imageName = rand().'.'.$nominee_image->getClientOriginalExtension();

        $nominee_image->move(base_path().'/Backend/images/NomineeImage/',$imageName);

        savings_registration_nominee::where('savings_reg_id',$id)->update(['nominee_image'=>$imageName]);
    }


    $nominee_signature = $request->file('nominee_singature');

    if($nominee_signature)
    {
        $pathImage = savings_registration_nominee::where('savings_reg_id',$id)->first();

        $path = base_path().'/Backend/images/SavingsRegistrationSignature/'.$pathImage->nominee_signature;

        if(file_exists($path))
        {
            unlink($path);
        }
    }

    if($nominee_signature)
    {
        $imageName = rand().'.'.$nominee_signature->getClientOriginalExtension();

        $nominee_signature->move(base_path().'/Backend/images/NomineeSignature/',$imageName);

        savings_registration_nominee::where('savings_reg_id',$id)->update(['nominee_signature'=>$imageName]);
    }

    $nominee_nid = $request->file('nominee_nid');

    if($nominee_nid)
    {
        $pathImage = savings_registration_nominee::where('savings_reg_id',$id)->first();

        $path = base_path().'/Backend/images/SavingRegistrationNid/'.$pathImage->nid;

        if(file_exists($path))
        {
            unlink($path);
        }
    }

    if($nominee_nid)
    {
        $imageName = rand().'.'.$nominee_nid->getClientOriginalExtension();

        $nominee_nid->move(base_path().'/Backend/images/SavingRegistrationNid/',$imageName);

        savings_registration_nominee::where('savings_reg_id',$id)->update(['nid'=>$imageName]);
    }

    if($update)
    {
        return redirect('saving_registration')->with('success','সঞ্চয় রেজিষ্ট্রেশন তথ্য আপডেট করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','সঞ্চয় রেজিষ্ট্রেশন তথ্য আপডেট করা হয়নি');
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
        $applicant_signature = saving_registration::find($id);

        $path = base_path().'/Backend/images/SavingsRegistrationSignature/'.$applicant_signature->applicants_signature;

        if(file_exists($path))
        {
            unlink($path);
        }

        $path2 = base_path().'/Backend/images/SavingsRegistrationNid/'.$applicant_signature->nid;

        if(file_exists($path2))
        {
            unlink($path2);
        }

        $nominee_image = savings_registration_nominee::where('savings_reg_id',$id)->first();

        $path = base_path().'/Backend/images/NomineeImage/'.$nominee_image->nominee_image;

        if(file_exists($path))
        {
            unlink($path);
        }

        $nominee_signature = savings_registration_nominee::where('savings_reg_id',$id)->first();

        $path = base_path().'/Backend/images/SavingsRegistrationSignature/'.$nominee_signature->nominee_signature;

        if(file_exists($path))
        {
            unlink($path);
        }

        $path3 = base_path().'/Backend/images/SavingsRegistrationNid/'.$nominee_signature->nid;

        if(file_exists($path3))
        {
            unlink($path3);
        }

        $delete_nominee = savings_registration_nominee::where('savings_reg_id',$id)->delete();

        $delete = saving_registration::find($id)->delete();

        if($delete)
        {
            return redirect('/saving_registration')->with('success','সঞ্চয় রেজিষ্ট্রেশন তথ্য ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় রেজিষ্ট্রেশন তথ্য ডিলিট করা হয়নি');
        }


    }


    public function saving_new_data()
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
        if(Auth::user()->user_role == 1)
        {
            $data = saving_registration::join('branch_infos','branch_infos.id','=','saving_registrations.branch_id')
                ->join('area_infos','area_infos.id','=','saving_registrations.area_id')
                ->join('members','members.member_id','=','saving_registrations.member_id')
                ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
                ->join('users','users.id','=','saving_registrations.admin_id')
                ->where('saving_registrations.approval',0)
                ->select('saving_registrations.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_schemas.deposit_name','users.name')
                ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                    ->join('saving_registrations','saving_registrations.branch_id','=','admin_branch_infos.branch_id')
                    ->join('area_infos','area_infos.id','=','saving_registrations.area_id')
                    ->join('members','members.member_id','=','saving_registrations.member_id')
                    ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
                    ->join('users','users.id','=','saving_registrations.admin_id')
                    ->where('saving_registrations.approval',0)
                    ->join('branch_infos','branch_infos.id','=','saving_registrations.branch_id')
                    ->select('saving_registrations.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_schemas.deposit_name','users.name')
                    ->get();
        }
        $sl = 1;
        return view('Backend.User.SavingRegistration.new_data',compact('data','sl','branch'));
    }

    public function saving_approve($id)
    {
        $approve = saving_registration::where('id',$id)->update([
            'approval'=>1,
            'approved_by'=>Auth::user()->id,
            'status'=>1,
        ]);

        $saving_info = saving_registration::find($id);

        if($saving_info->service_charge > 0)
        {
            DB::table('incomes')->insert([
                'sl'=>1000,
                'branch_id'=>$saving_info->branch_id,
                'title_id'=>1000,
                'date'=>$saving_info->application_date,
                'amount'=>$saving_info->service_charge,
                'details'=>'সঞ্চয় রেজিষ্ট্রেশন সার্ভিস চার্জ',
                'status'=>1,
                'admin_id'=>Auth::user()->id,
            ]);
        }



        if($approve)
        {
            return redirect()->back()->with('success','সঞ্চয় অ্যাপ্রুভ হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','সঞ্চয় অ্যাপ্রুভ হয়নি');
        }
    }

    public function approve_all(Request $request)
    {


        for ($i=0; $i < count($request->saving_id) ; $i++)
        {
            $approve = saving_registration::where('id',$request->saving_id[$i])->update([
                'approval'=>1,
                'approved_by'=>Auth::user()->id,
                'status'=>1,
            ]);

            $saving_info = saving_registration::find($request->saving_id[$i]);

            if($saving_info->service_charge > 0)
            {
                DB::table('incomes')->insert([
                    'sl'=>1000,
                    'branch_id'=>$saving_info->branch_id,
                    'title_id'=>1000,
                    'date'=>$saving_info->application_date,
                    'amount'=>$saving_info->service_charge,
                    'details'=>'সঞ্চয় রেজিষ্ট্রেশন সার্ভিস চার্জ',
                    'status'=>1,
                    'admin_id'=>Auth::user()->id,
                ]);
            }

        }

        return 1;
    }

    public function loadBranchSavingNew(Request $request)
    {

        // return $request->branch_id;

        $data = saving_registration::where('saving_registrations.branch_id',$request->branch_id)
                ->join('branch_infos','branch_infos.id','=','saving_registrations.branch_id')
                ->join('area_infos','area_infos.id','=','saving_registrations.area_id')
                ->join('members','members.id','=','saving_registrations.member_id')
                ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
                ->join('users','users.id','=','saving_registrations.admin_id')
                ->where('saving_registrations.approval',0)
                ->select('saving_registrations.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_schemas.deposit_name','users.name')
                ->get();
        $sl = 1;

        return view('Backend.User.SavingRegistration.load_branch_data',compact('data','sl'));

    }
    public function loadAreaSaving(Request $request)
    {

        // return $request->branch_id;

        $data = saving_registration::where('saving_registrations.area_id',$request->area_id)
                ->join('branch_infos','branch_infos.id','=','saving_registrations.branch_id')
                ->join('area_infos','area_infos.id','=','saving_registrations.area_id')
                ->join('members','members.id','=','saving_registrations.member_id')
                ->join('saving_schemas','saving_schemas.id','=','saving_registrations.schema_id')
                ->join('users','users.id','=','saving_registrations.admin_id')
                ->where('saving_registrations.approval',0)
                ->select('saving_registrations.*','branch_infos.branch_name','area_infos.area_name','members.aplicant_name','saving_schemas.deposit_name','users.name')
                ->get();
        $sl = 1;

        return view('Backend.User.SavingRegistration.load_branch_data',compact('data','sl'));

    }

    public function savingRegStatusChange($id)
    {

        $check = DB::table('saving_registrations')->where('registration_id',$id)->first();

        if($check->status == 0)
        {
            DB::table('saving_registrations')->where('registration_id',$id)->update(['status'=>1]);
        }
        else
        {
            DB::table('saving_registrations')->where('registration_id',$id)->update(['status'=>0]);
        }

        return redirect()->back();

    }


}
