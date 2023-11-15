<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\investor_registration;
use App\Models\area_info;
use App\Models\investmentschema;
use App\Models\member;
use DB;
use Auth;
use App\Models\branch_info;
use App\Models\admin_branch_info;
use App\Models\investment_collection;
use Yajra\DataTables\Facades\DataTables;
use DateTime;
use DateInterval;



class InvestmentRegistration extends Controller
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
            $data = DB::table("investor_registrations")
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.member_id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status',function($v){
                    if($v->status == 1)
                    {
                        return '<a href='.url("/investmentStatusChange/".$v->registration_id).' class="btn btn-sm btn-success confirm">Active</a>';
                    }
                    else
                    {
                        return '<a href='.url("/investmentStatusChange/".$v->registration_id).' class="btn btn-sm btn-danger confirm">Inactive</a>';
                    }
                })
                ->addColumn('action',function($v){
                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                    {
                        $btn = '<a id="" style="float: left;margin-right:10px;" href="'.route('investment_registration.edit',$v->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                        <form action="'.route('investment_registration.destroy',$v->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';
                    }
                    else
                    {
                        $btn = '';
                    }

                    $view = '<a href="'.url("viewinvestment/".$v->id).'" class="btn-sm btn btn-dark"><i class="feather icon-eye"></i></a>';

                    return $btn." ".$view;
                })
                ->rawColumns(['status','action'])
                ->make(true);
            }

        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('investor_registrations','investor_registrations.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.member_id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status',function($v){
                    if($v->status == 1)
                    {
                        return '<a href='.url("/investmentStatusChange/".$v->registration_id).' class="btn btn-sm btn-success confirm">Active</a>';
                    }
                    else
                    {
                        return '<a href='.url("/investmentStatusChange/".$v->registration_id).' class="btn btn-sm btn-danger confirm">Inactive</a>';
                    }
                })
                ->addColumn('action',function($v){
                    if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                    {
                        $btn = '<a id="" style="float: left;margin-right:10px;" href="'.route('investment_registration.edit',$v->id).'" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                        <form action="'.route('investment_registration.destroy',$v->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="" id="" type="submit" class="confirm btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                        </form>';
                    }
                    else
                    {
                        $btn = '';
                    }

                    $view = '<a href="'.url("viewinvestment/".$v->id).'" class="btn-sm btn btn-dark"><i class="feather icon-eye"></i></a>';

                    return $btn." ".$view;
                })
                ->rawColumns(['status','action'])
                ->make(true);
            }
        }

        return view('Backend.User.InvestmentRegistration.index',compact('data'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.User.InvestmentRegistration.create');
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

       $explode = explode('/',$request->date);
       $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

       $opening_date = explode('/',$request->investment_start_date);
       $investment_start_date = $opening_date[2].'-'.$opening_date[1].'-'.$opening_date[0];

        $d='P'.$request->duration.'D';
        $lastdate = new DateTime($date);
        $lastdate->add(new DateInterval($d));
        $investment_end_date = $lastdate->format('Y-m-d');

       $registration_id = $this->AutoCode('investor_registrations', 'registration_id', 'I-', '8');

       $data = array(
        'date'=> $date,
        'registration_id'=>$registration_id,
        'branch_id'=>$request->branch_id,
        'area_id'=>$request->area_id,
        'member_id'=>$request->member_id,
        'phone'=>$request->phone,
        'schema_id'=>$request->schema_id,
        'schema_per' => $request->schema_per,
        'approval'=>$request->approval,
        'amount'=>$request->amount,
        'totalamount'=>$request->totalamount,
        'service_charge'=>$request->service_charge,
        'installment'=>$request->installment,
        'installment_amount'=>$request->installment_amount,
        'investment_start_date'=>$investment_start_date,
        'investment_end_date'=>$investment_end_date,
        'deposite'=>$request->deposite,
        'comment'=>$request->comment,
        'risk_amount'     => $request->risk_amount,
        'signature'     =>'0',
        'nid'     =>'0',

        'status'=>$request->status,
        'nominee_name'=>$request->nominee_name,
        'nominee_email'=>$request->nominee_email,
        'nominee_present_address'=>$request->nominee_present_address,
        'nominee_permanent_address'=>$request->nominee_permanent_address,
        'nominee_nid_no'=>$request->nominee_nid_no,
        'relation_for_applicant'=>$request->relation_for_applicant,
        'nominee_image'=>'0',
        'nid'=>'0',
        'nominee_nid'=>'0',
        'nominee_signature'=>'0',

        'go_name'=>$request->go_name,
        'go_phone'=>$request->go_phone,
        'go_address'=>$request->go_address,
        'go_nid'=>'0',
        'go_signature'=>'0',

        'gt_name'=>$request->gt_name,
        'gt_phone'=>$request->gt_phone,
        'gt_address'=>$request->gt_address,
        'gt_nid'=>'0',
        'gt_signature'=>'0',


    );


       $insert = investor_registration::create($data);


       if($insert)
       {

        DB::table('saving_registrations')->where('registration_id',$request->deposite)->update([
            'investment_id'=>$registration_id,
        ]);

        $id = $insert->id;

        // $file  = $request->file('applicant_signature');
        $file2 = $request->file('nominee_image');
        $file3 = $request->file('nominee_signature');
        $file4 = $request->file('go_signature');
        $file5 = $request->file('gt_signature');
        // $file6 = $request->file('nid');
        $file7 = $request->file('go_nid');
        $file8 = $request->file('gt_nid');
        $file9 = $request->file('nominee_nid');



        if($file2)
        {
            $imageName = rand().'.'.$file2->getClientOriginalExtension();

            $file2->move(base_path().'/Backend/images/InvestorImage',$imageName);

            investor_registration::where('id',$id)->update(['nominee_image'=>$imageName]);
        }


        if($file3)
        {
            $imageName = rand().'.'.$file3->getClientOriginalExtension();

            $file3->move(base_path().'/Backend/images/InvestorImage',$imageName);

            investor_registration::where('id',$id)->update(['nominee_signature'=>$imageName]);
        }

        if($file4)
        {
            $imageName = rand().'.'.$file4->getClientOriginalExtension();

            $file4->move(base_path().'/Backend/images/InvestorImage',$imageName);

            investor_registration::where('id',$id)->update(['go_signature'=>$imageName]);
        }

        if($file5)
        {
            $imageName = rand().'.'.$file5->getClientOriginalExtension();

            $file5->move(base_path().'/Backend/images/InvestorImage',$imageName);

            investor_registration::where('id',$id)->update(['gt_signature'=>$imageName]);
        }


        if($file7)
        {
            $imageName = rand().'.'.$file7->getClientOriginalExtension();

            $file7->move(base_path().'/Backend/images/goNid',$imageName);

            investor_registration::where('id',$id)->update(['go_nid'=>$imageName]);
        }


        if($file8)
        {
            $imageName = rand().'.'.$file8->getClientOriginalExtension();

            $file8->move(base_path().'/Backend/images/gtNid',$imageName);

            investor_registration::where('id',$id)->update(['gt_nid'=>$imageName]);
        }

        if($file9)
        {
            $imageName = rand().'.'.$file9->getClientOriginalExtension();

            $file9->move(base_path().'/Backend/images/InvestorNomNid',$imageName);

            investor_registration::where('id',$id)->update(['nominee_nid'=>$imageName]);
        }



        return redirect('viewinvestment/'.$id)->with('success','বিনিয়োগ রেজিষ্ট্রেশন সম্পন্ন হয়েছে');

    }
    else
    {
        return redirect()->back()->with('error','বিনিয়োগ রেজিষ্ট্রেশন সম্পন্ন হয়নি');
    }


        // return redirect('investment_registration')->with('success','Data Insert Successfully');



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
        $data = investor_registration::find($id);
        $area = area_info::where('branch_id',$data->branch_id)->get();
        $member = member::where('branch_id',$data->branch_id)->where('area_id',$data->area_id)->get();
        return view('Backend.User.InvestmentRegistration.edit',compact('data','area','member'));
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

        $explode = explode('/',$request->date);
        $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

        $opening_date = explode('/',$request->investment_start_date);
        $investment_start_date = $opening_date[2].'-'.$opening_date[1].'-'.$opening_date[0];

        $exp_date = explode('/',$request->investment_end_date);
        $investment_end_date = $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];

        $data = array(
            'date'=> $date,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'member_id'=>$request->member_id,
            'phone'=>$request->phone,
            'schema_id'=>$request->schema_id,
            'schema_per' => $request->schema_per,
            'approval'=>$request->approval,
            'amount'=>$request->amount,
            'totalamount'=>$request->totalamount,
            'service_charge'=>$request->service_charge,
            'installment'=>$request->installment,
            'installment_amount'=>$request->installment_amount,
            'investment_start_date'=>$investment_start_date,
            'investment_end_date'=>$investment_end_date,
            'deposite'=>$request->deposite,
            'risk_amount'=>$request->risk_amount,
            'comment'=>$request->comment,

            'status'=>$request->status,
            'nominee_name'=>$request->nominee_name,
            'nominee_email'=>$request->nominee_email,
            'nominee_present_address'=>$request->nominee_present_address,
            'nominee_permanent_address'=>$request->nominee_permanent_address,
            'nominee_nid_no'=>$request->nominee_nid_no,
            'relation_for_applicant'=>$request->relation_for_applicant,
            'nominee_image'=>$request->nominee_image,

            'go_name'=>$request->go_name,
            'go_phone'=>$request->go_phone,
            'go_address'=>$request->go_address,

            'gt_name'=>$request->gt_name,
            'gt_phone'=>$request->gt_phone,
            'gt_address'=>$request->gt_address,



        );

        $update = investor_registration::find($id)->update($data);

        if($update)
        {


            // $file  = $request->file('applicant_signature');
            $file2 = $request->file('nominee_image');
            $file3 = $request->file('nominee_signature');
            $file4 = $request->file('go_signature');
            $file5 = $request->file('gt_signature');
            // $file6 = $request->file('nid');
            $file7 = $request->file('go_nid');
            $file8 = $request->file('gt_nid');
            $file9 = $request->file('nominee_nid');




            if($file2)
            {
                $imageName = rand().'.'.$file2->getClientOriginalExtension();

                $file2->move(public_path().'/Backend/images/InvestorImage',$imageName);

                investor_registration::where('id',$id)->update(['nominee_image'=>$imageName]);
            }


            if($file3)
            {
                $imageName = rand().'.'.$file3->getClientOriginalExtension();

                $file3->move(public_path().'/Backend/images/InvestorImage',$imageName);

                investor_registration::where('id',$id)->update(['nominee_signature'=>$imageName]);
            }

            if($file4)
            {
                $imageName = rand().'.'.$file4->getClientOriginalExtension();

                $file4->move(public_path().'/Backend/images/InvestorImage',$imageName);

                investor_registration::where('id',$id)->update(['go_signature'=>$imageName]);
            }

            if($file5)
            {
                $imageName = rand().'.'.$file5->getClientOriginalExtension();

                $file5->move(public_path().'/Backend/images/InvestorImage',$imageName);

                investor_registration::where('id',$id)->update(['gt_signature'=>$imageName]);
            }



            if($file7)
            {
                $imageName = rand().'.'.$file7->getClientOriginalExtension();

                $file7->move(public_path().'/Backend/images/goNid',$imageName);

                investor_registration::where('id',$id)->update(['go_nid'=>$imageName]);
            }


            if($file8)
            {
                $imageName = rand().'.'.$file8->getClientOriginalExtension();

                $file8->move(public_path().'/Backend/images/gtNid',$imageName);

                investor_registration::where('id',$id)->update(['gt_nid'=>$imageName]);
            }


            if($file9)
            {
                $imageName = rand().'.'.$file9->getClientOriginalExtension();

                $file9->move(public_path().'/Backend/images/InvestorNomNid',$imageName);

                investor_registration::where('id',$id)->update(['nominee_nid'=>$imageName]);
            }



            return redirect('investment_registration')->with('success','বিনিয়োগ আপডেট সম্পন্ন হয়েছে');

        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ আপডেট সম্পন্ন হয়নি');
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
        $pathImage = investor_registration::find($id);

        DB::table('saving_registrations')->where('registration_id',$pathImage->deposite)->update([
            'investment_id'=>'0',
        ]);

        $path = base_path().'/Backend/images/InvestorImage/'.$pathImage->signature;
        $path2 = base_path().'/Backend/images/InvestorImage/'.$pathImage->nominee_signature;
        $path3 = base_path().'/Backend/images/InvestorImage/'.$pathImage->nominee_image;
        $path4 = base_path().'/Backend/images/InvestorImage/'.$pathImage->go_signature;
        $path5 = base_path().'/Backend/images/InvestorImage/'.$pathImage->gt_signature;
        $path6 = base_path().'/Backend/images/InvestorNid/'.$pathImage->nid;
        $path7 = base_path().'/Backend/images/goNid/'.$pathImage->go_nid;
        $path8 = base_path().'/Backend/images/gtNid/'.$pathImage->gt_nid;
        $path9 = base_path().'/Backend/images/InvestorNomNid/'.$pathImage->nominee_nid;


        if(file_exists($path))
        {
            unlink($path);
        }

        if(file_exists($path2))
        {
            unlink($path2);
        }

        if(file_exists($path3))
        {
            unlink($path3);
        }

        if(file_exists($path4))
        {
            unlink($path4);
        }

        if(file_exists($path5))
        {
            unlink($path5);
        }

        if(file_exists($path6))
        {
            unlink($path6);
        }

        if(file_exists($path7))
        {
            unlink($path7);
        }

        if(file_exists($path8))
        {
            unlink($path8);
        }
        if(file_exists($path9))
        {
            unlink($path9);
        }

        $delete = investor_registration::find($id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success','বিনিয়োগ রেজিষ্ট্রেশন ডিলিট করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ রেজিষ্ট্রেশন ডিলিট করা হয়নি');
        }
    }

    public function viewinvestment($id){

        $data = investor_registration::find($id);
        $area = area_info::where('branch_id',$data->branch_id)->get();
        $member = member::where('branch_id',$data->branch_id)->where('area_id',$data->area_id)->get();

        $member_name = DB::table("members")->where('id',$data->member_id)->first();

        $schema = DB::table("investmentschemas")->where('id',$data->schema_id)->first();

        $branch = DB::table("branch_infos")->where('id',$data->branch_id)->first();
        $area   = DB::table("area_infos")->where('id',$data->area_id)->first();


        return view('Backend.User.InvestmentRegistration.viewinvestment',compact('data','area','member','member_name','schema','branch','area'));
    }


    public function investor_reg()
    {

        if(Auth::user()->user_role == 1)
        {
            $data = DB::table("investor_registrations")
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.member_id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->where("investor_registrations.approval",0)
            ->get();
        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('investor_registrations','investor_registrations.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.member_id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->where("investor_registrations.approval",0)
            ->get();
        }


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



        $sl = 1;
        return view('Backend.User.InvestmentRegistration.investor_reg_approval',compact('data','sl','branch'));
    }



    public function investor_approve($id)
    {
        $approve = investor_registration::where('id',$id)->update([
            'approval'=>1,
            'approve_by'=>Auth::user()->id,
        ]);

        if($approve)
        {
            return redirect()->back()->with('success','বিনিয়োগ অ্যাপ্রুভ হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','বিনিয়োগ অ্যাপ্রুভ হয়নি');
        }
    }


    public function approve_all_investor(Request $request)
    {

        for ($i=0; $i < count($request->saving_id) ; $i++)
        {
            $approve = investor_registration::where('id',$request->saving_id[$i])->update([
                'approval'=>1,
                'approve_by'=>Auth::user()->id,
            ]);
        }

        return 1;
    }


    public function getinvestSchemaPer(Request $request)
    {
        // return $request->schema_id;
        $data = investmentschema::find($request->schema_id);

        return $data->percentage;
    }

    public function getinvestmentSchemaPer(Request $request)
    {
        // return $request->schema_id;

        $schema = DB::table('investor_registrations')->where('registration_id',$request->member_id)->first();

        $data = investmentschema::find($schema->schema_id);

        return $data->percentage;
    }



    public function loadinvestCollBranch(Request $request)
    {

        if(Auth::user()->user_role == 1)
        {
            $data = DB::table("investor_registrations")
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->where("investor_registrations.branch_id",$request->branch_id)
            ->where("investor_registrations.approval",0)
            ->get();
        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('investor_registrations','investor_registrations.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->where("investor_registrations.branch_id",$request->branch_id)
            ->where("investor_registrations.approval",0)
            ->get();
        }

        return view('Backend.User.InvestmentRegistration.loadinvestCollBranch',compact('data'));
    }




    public function loadAreainvestColl(Request $request)
    {

        if(Auth::user()->user_role == 1)
        {
            $data = DB::table("investor_registrations")
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->where("investor_registrations.area_id",$request->area_id)
            ->where("investor_registrations.approval",0)
            ->get();
        }
        else
        {
            $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('investor_registrations','investor_registrations.branch_id','=','admin_branch_infos.branch_id')
            ->leftjoin('branch_infos','branch_infos.id','investor_registrations.branch_id')
            ->leftjoin('area_infos','area_infos.id','investor_registrations.area_id')
            ->leftjoin('members','members.id','investor_registrations.member_id')
            ->leftjoin('investmentschemas','investmentschemas.id','investor_registrations.schema_id')
            ->select("investor_registrations.*",'branch_infos.branch_name','area_infos.area_name','investmentschemas.investment_name','members.aplicant_name')
            ->where("investor_registrations.area_id",$request->area_id)
            ->where("investor_registrations.approval",0)
            ->get();
        }

        return view('Backend.User.InvestmentRegistration.loadAreainvestColl',compact('data'));
    }



    public function riskamount_withdraw(){


     if(Auth::user()->user_role == 1)
     {
        $data = DB::table("investor_riskamount")
        ->leftjoin("branch_infos",'branch_infos.id','investor_riskamount.branch_id')
        ->leftjoin("area_infos",'area_infos.id','investor_riskamount.area_id')
        ->leftjoin("members",'members.id','investor_riskamount.member_id')
        ->select("investor_riskamount.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
        ->get();
    }
    else
    {
        $data = DB::table("admin_branch_infos")->where('admin_branch_infos.admin_id',Auth::user()->id)
        ->join('investor_riskamount','investor_riskamount.branch_id','=','admin_branch_infos.branch_id')
        ->leftjoin("branch_infos",'branch_infos.id','investor_riskamount.branch_id')
        ->leftjoin("area_infos",'area_infos.id','investor_riskamount.area_id')
        ->leftjoin("members",'members.id','investor_riskamount.member_id')
        ->select("investor_riskamount.*",'branch_infos.branch_name','area_infos.area_name','members.aplicant_name')
        ->get();
    }



    return view('Backend.User.investmentrisk.index',compact('data'));

}



public function create_investorriskamount(){
  return view('Backend.User.investmentrisk.create');
}


public function investment_riskamountstore(Request $r){

    $data = DB::table('investor_riskamount')->insert([

        'date'            => date('Y-m-d'),
        'registration_id' => $r->member_id,
        'withdraw'        => $r->withdraw,
        'branch_id'       => $r->branch_id,
        'area_id'         => $r->area_id,
        'comment'         => $r->comment
    ]);


    if($data)
    {
        return redirect()->back()->with('success','ঝুঁকি উত্তোলন হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','ঝুঁকি উত্তোলন হয়নি');
    }

}


public function deleteinvestor_riskamount($id){

    $data = DB::table("investor_riskamount")->where("id",$id)->delete();
    if($data)
    {
        return redirect()->back()->with('success','ঝুঁকি উত্তোলন ডিলিট হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','ঝুঁকি উত্তোলন ডিলিট হয়নি');
    }
}

public function investmentStatusChange($id)
{
    $check = DB::table('investor_registrations')->where('registration_id',$id)->first();

    if($check->status == 0)
    {
        DB::table('investor_registrations')->where('registration_id',$id)->update(['status'=>1]);
    }
    else
    {
        DB::table('investor_registrations')->where('registration_id',$id)->update(['status'=>0]);
    }

    return redirect()->back();
}

public function add_invest_risk_amount()
{
    return view('Backend.User.InvestmentRegistration.add_risk_amount');
}

public function addRiskAmount(Request $request)
{
    $explode = explode('/',$request->date);
    $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

    $member_id = DB::table('investor_registrations')->where('registration_id',$request->registration_id)->first();

    $insert = DB::table('investor_riskamount')->insert([
        'date'=>$date,
        'member_id'=>$member_id->member_id,
        'registration_id'=>$request->registration_id,
        'risk_amount'=>$request->risk_amount,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success','বিনিয়োগ ঝুঁকি যোগ করা হয়েছে');

}


}
