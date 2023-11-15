<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee_info;
use App\Models\branch_info;
use App\Models\User;
use App\Models\admin_main_menu;
use App\Models\admin_sub_menu;
use App\Models\admin_branch_info;
use App\Models\main_menu_priority;
use App\Models\sub_menu_priority;
use Auth;
use DB;

class EmployeeController extends Controller
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
    public function index()
    {
        if(Auth::user()->user_role == 1)
        {
            $data = employee_info::join('branch_infos','branch_infos.id','=','employee_infos.branch_id')
            ->select('employee_infos.*','branch_infos.branch_name')
            ->orderBy('sl','ASC')
            ->get();
        }
        else
        {
            $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
            ->join('employee_infos','employee_infos.branch_id','=','admin_branch_infos.branch_id')
            ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
            ->select('employee_infos.*','branch_infos.branch_name')
            ->get();
        }

        return view('Backend.User.Employee.index',compact('data'));
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
        return view('Backend.User.Employee.create',compact('branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->date_of_birth;
        // $explde_date = explode('/',$request->date_of_birth);
        // return $explde_date;
        // // $date_of_birth = $

        $validated = $request->validate([
            'sl'=>'required',
            'branch_id'=>'required',
            'type'=>'required',
            'name'=>'required',
            'gender'=>'required',
            'religion'=>'required',
            'status'=>'required',
        ],[
            'sl.required'=>'সিরিয়াল নং দিন',
            'branch_id.required'=>'একটি ব্রাঞ্চ নির্বাচন করুন',
            'type.required'=>'ধরণ নির্বাচন করুন',
            'name.required'=>'একটি নাম দিন',
            'gender.required'=>'লিঙ্গ নির্বাচন করুন',
            'religion.required'=>'ধর্ম নির্বাচন করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $emp_id = $this->AutoCode('employee_infos', 'emp_id', 'E-', '8');


        $data = array(
            'emp_id' => $emp_id,
            'sl'=> $request->sl,
            'branch_id'=>$request->branch_id,
            'type'=>$request->type,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'phone_2'=>$request->phone_2,
            'email'=>$request->email,
            'fathers_name'=>$request->fathers_name,
            'mothers_name'=>$request->mothers_name,
            'date_of_birth'=>$request->date_of_birth,
            'date_of_birth'=>$request->date_of_birth,
            'gender'=>$request->gender,
            'religion'=>$request->religion,
            'present_address'=>$request->present_address,
            'permenant_address'=>$request->permenant_address,
            'nid_no'=>$request->nid_no,
            'join_date'=>$request->join_date,
            'status'=>$request->status,
            'image'=>'0',
            'designation'=>$request->designation,
            'nid_image'=>'0',
        );

        $insert = employee_info::create($data);

        if($insert)
        {
            $id = $insert->id;
            // return $id;
            $file = $request->file('image');
            if($file)
            {
                $imageName = rand().'.'.$file->getClientOriginalExtension();

                $file->move(base_path().'/Backend/images/EmployeeImage',$imageName);

                employee_info::where('id',$id)->update(['image'=>$imageName]);
            }

            $nid_image = $request->file('nid_image');

            if($nid_image)
            {
                $imageName = rand().'.'.$nid_image->getClientOriginalExtension();

                $nid_image->move(base_path().'/Backend/images/EmployeeNid',$imageName);

                employee_info::where('id',$id)->update(['nid_image'=>$imageName]);
            }

            return redirect('add_employee')->with('success','কর্মকর্তা/কর্মচারী যোগ করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','কর্মকর্তা/কর্মচারী যোগ করা হয়েনি');
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
        $data = employee_info::find($id);
        return view('Backend.User.Employee.edit',compact('branch','data'));
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
            'branch_id'=>'required',
            'type'=>'required',
            'name'=>'required',
            'gender'=>'required',
            'religion'=>'required',
            'status'=>'required',
        ],[
            'sl.required'=>'সিরিয়াল নং দিন',
            'branch_id.required'=>'একটি ব্রাঞ্চ নির্বাচন করুন',
            'type.required'=>'ধরণ নির্বাচন করুন',
            'name.required'=>'একটি নাম দিন',
            'gender.required'=>'লিঙ্গ নির্বাচন করুন',
            'religion.required'=>'ধর্ম নির্বাচন করুন',
            'status.required'=>'স্ট্যাটাস নির্বাচন করুন',
        ]);

        $emp_id = employee_info::where('id',$id)->first();

        $data = array(
            'emp_id' => $emp_id->emp_id,
            'sl'=> $request->sl,
            'branch_id'=>$request->branch_id,
            'type'=>$request->type,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'phone_2'=>$request->phone_2,
            'email'=>$request->email,
            'fathers_name'=>$request->fathers_name,
            'mothers_name'=>$request->mothers_name,
            'date_of_birth'=>$request->date_of_birth,
            'date_of_birth'=>$request->date_of_birth,
            'gender'=>$request->gender,
            'religion'=>$request->religion,
            'present_address'=>$request->present_address,
            'permenant_address'=>$request->permenant_address,
            'nid_no'=>$request->nid_no,
            'join_date'=>$request->join_date,
            'status'=>$request->status,
            'designation'=>$request->designation,
        );

        $update = employee_info::where('id',$id)->update($data);
        $file = $request->file('image');
        if($file)
        {
            $pathImage = employee_info::find($id);

            $path = base_path().'/Backend/images/EmployeeImage/'.$pathImage->image;

            if(file_exists($path))
            {
                unlink($path);
            }
        }

        if($file)
        {
            $imageName = rand().'.'.$file->getClientOriginalExtension();

            $file->move(base_path().'/Backend/images/EmployeeImage',$imageName);

            employee_info::where('id',$id)->update(['image'=>$imageName]);
            User::where('employee_id',$id)->update(['image'=>$imageName]);
        }

        $nid_image = $request->file('nid_image');

        if($nid_image)
        {
            $pathImage = employee_info::find($id);

            $path = base_path().'/Backend/images/EmployeeNid/'.$pathImage->nid_image;

            if(file_exists($path))
            {
                unlink($path);
            }
        }

        if($nid_image)
        {
            $imageName = rand().'.'.$nid_image->getClientOriginalExtension();

            $nid_image->move(base_path().'/Backend/images/EmployeeNid',$imageName);

            employee_info::where('id',$id)->update(['nid_image'=>$imageName]);
        }

        if($update)
        {
            return redirect('add_employee')->with('success','কর্মকর্তা/কর্মচারীর তথ্য আপডেট সম্পন্ন করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('error','কর্মকর্তা/কর্মচারীর তথ্য আপডেট হয়নি');
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
        $pathImage = employee_info::find($id);

        $path = base_path().'/Backend/images/EmployeeImage/'.$pathImage->image;

        if(file_exists($path))
        {
            unlink($path);
        }

        $path2 = base_path().'/Backend/images/EmployeeNid/'.$pathImage->nid_image;

        if(file_exists($path2))
        {
            unlink($path2);
        }

        $admin_id = User::where('employee_id',$id)->first();


        if($admin_id)
        {

            admin_branch_info::where('admin_id',$admin_id->id)->delete();
            main_menu_priority::where('admin_id',$admin_id->id)->delete();
            sub_menu_priority::where('admin_id',$admin_id->id)->delete();
            User::where('employee_id',$id)->delete();
        }



        $delete = employee_info::find($id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success','কর্মকর্তা/কর্মচারীর তথ্য ডিলিট করা হলো');
        }
        else
        {
            return redirect()->back()->with('error','কর্মকর্তা/কর্মচারীর তথ্য ডিলিট করা হয়নি');
        }
    }

    public function employeeStatementReport()
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
        return view('Backend.User.Employee.employee_statement_report',compact('branch'));
    }

    public function employeeStatementReportShow(Request $request)
    {

        if($request->type == 'all')
        {
            $data = employee_info::join('branch_infos','branch_infos.id','=','employee_infos.branch_id')
            ->where('employee_infos.branch_id',$request->branch_id)
            ->select('employee_infos.*','branch_infos.branch_name')
            ->orderBy('employee_infos.sl','ASC')
            ->get();
        }
        else
        {
            $data = employee_info::join('branch_infos','branch_infos.id','=','employee_infos.branch_id')
            ->where('employee_infos.branch_id',$request->branch_id)
            ->where('employee_infos.type',$request->type)
            ->select('employee_infos.*','branch_infos.branch_name')
            ->orderBy('employee_infos.sl','ASC')
            ->get();

        }


        $branch = branch_info::where('id',$request->branch_id)->first();

        $report_type = $request->type;

        return view('Backend.User.Employee.employee_statement_reporttab',compact('data','branch','report_type'));


    }





    public function employee_salary_intialize(){


      if(Auth::user()->user_role == 1)
      {
        $data = employee_info::join('branch_infos','branch_infos.id','=','employee_infos.branch_id')
        ->select('employee_infos.*','branch_infos.branch_name')
        ->orderBy('sl','ASC')
        ->get();
    }
    else
    {
        $data = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
        ->join('employee_infos','employee_infos.branch_id','=','admin_branch_infos.branch_id')
        ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
        ->select('employee_infos.*','branch_infos.branch_name')
        ->get();
    }


    if(Auth::user()->user_role == 1)
    {
        $showdata = DB::table('employeesalarysetups')
        ->join('branch_infos','branch_infos.id','=','employeesalarysetups.branch_id')
        ->join('employee_infos','employee_infos.id','employeesalarysetups.employee_id')
        ->select('employeesalarysetups.*','branch_infos.branch_name','employee_infos.name')
        ->get();
    }
    else
    {


        $showdata = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
        ->join('employeesalarysetups','employeesalarysetups.branch_id','=','admin_branch_infos.branch_id')
        ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
        ->join('employee_infos','employee_infos.id','employeesalarysetups.employee_id')
        ->select('employeesalarysetups.*','branch_infos.branch_name','employee_infos.name')
        ->get();
    }



    return view("Backend.User.Employee.employee_salary_intialize",compact('data','showdata'));
}


public function getloadMember(Request $request)
{
    $employee = employee_info::where('branch_id',$request->branch_id)
    ->where('status',1)
    ->get();

    if($employee)
    {
        echo "<option value=''>নির্বাচন করুন</option>";
        foreach ($employee as $v)
        {
            echo "<option value='".$v->id."'>".$v->name."</option>";
        }
    }
}



public function employee_salary_setup(){
    
    
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



    return view("Backend.User.Employee.employee_salary_setup",compact('branch'));
}

public function searchemployee_salary(Request $r){
    
    
    $data = DB::table("employee_infos")
    ->join('employeesalarysetups','employeesalarysetups.employee_id','employee_infos.id')
    ->where('employee_infos.branch_id',$r->branch_id)
    ->select('employee_infos.*','employeesalarysetups.salary_scale','employeesalarysetups.home_rent','employeesalarysetups.travel_bill','employeesalarysetups.mobile_bill','employeesalarysetups.treatment_bill','employeesalarysetups.others','employeesalarysetups.gpper','employeesalarysetups.employee_id')
    ->get();
    
    
    $month = $r->month;
    
    $year = $r->year;
    
    // return $month;

    
    return view("Backend.User.Employee.searchemployee_salary",compact('data','month','year'));
    
    
}


public function insertemployeesalary(Request $r){

    $validatedData = $r->validate([
        'employee_id' => 'required|unique:employeesalarysetups|max:255',
    ]);
    
    $explode = explode('/',$r->date);
    
    $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

    $insert = DB::table("employeesalarysetups")->insert([

        'date' => $date,
        'entry_date' => $r->entry_date,
        'branch_id' => $r->branch_id,
        'employee_id' => $r->employee_id,
        'gpper' => $r->gpper,
        'salary_scale' => $r->salary_scale,
        'home_rent' => $r->home_rent,
        'travel_bill' => $r->travel_bill,
        'mobile_bill' => $r->mobile_bill,
        'treatment_bill' => $r->treatment_bill,
        'others' => $r->others,

    ]);
    
    if($r->previous_gp > 0)
    {
        DB::table('acceptemployeesalarysetups')->insert([
            'date'=>$date,
            'employee_id'=>$r->employee_id,
            'gp'=>$r->previous_gp,
            ]);
    }


    if($insert)
    {
        return redirect()->back()->with('success','কর্মকর্তা/কর্মচারীর বেতন অ্যাড করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','কর্মকর্তা/কর্মচারীর বেতন অ্যাড করা হয়নি');
    }

}

public function employeesalarydelete($id){

    $delete = DB::table("employeesalarysetups")->where("id",$id)->delete();

    if($delete)
    {
        return redirect()->back()->with('success','কর্মকর্তা/কর্মচারীর ডিলিট করা হয়েছে');
    }
    else
    {
        return redirect()->back()->with('error','কর্মকর্তা/কর্মচারীর ডিলিট করা হয়নি');
    }

}




public function depositeemployeesalary(Request $r){

    $check = DB::table("draftemployeesalarysetups")->where("month",$r->month)->where("year",$r->year)->first();

    if (isset($check)) {
        
    }
    else{


        for ($i=0; $i < count($r->employee) ; $i++) {

         DB::table("draftemployeesalarysetups")->insert([
           'date'         => date('Y-m-d'),
           'branch_id'  => $r->branch_id,
           'employee_id'  => $r->employee[$i],
           'gpper'         => $r->gpper[$i],
           'salary_scale' => $r->salary_scale[$i],
           'increment'      => $r->increment[$i],
           'total_salary'   => $r->total_salary[$i],
           'home_rent'      => $r->home_rent[$i],
           'travel_bill'    => $r->travel_bill[$i],
           'mobile_bill'    => $r->mobile_bill[$i],
           'treatment_bill' => $r->treatment_bill[$i],
           'others'       => $r->others[$i],
           'gp'           => $r->gp[$i],
           'totalgp'      => $r->totalgp[$i],
           'monthkorton'  => $r->monthkorton[$i],
           'revinew'      => $r->revinew[$i],
           'totalsalaryforothers' => $r->totalsalaryforothers[$i],
           'totalkorton'      => $r->totalkorton[$i],
           'totalkorton'      => $r->totalkorton[$i],
           'netsalary'        => $r->netsalary[$i],

           'month' => $r->month,
           'year'  => $r->year,

       ]);

     }

 }


 return redirect()->back()->with('success','কর্মকর্তা / কর্মচারী বেতন অ্যাড করা হয়েছে');



}


public function employee_salary_provide(){
    $datas = DB::table("employee_salary_payments")
    ->join('employee_infos','employee_infos.id','employee_salary_payments.employee_id')
    ->select("employee_salary_payments.*",'employee_infos.name')
    ->where("employee_salary_payments.salary_withdraw",'>','0')
    ->get();

    $data = DB::table("employee_infos")->get();
    return view("Backend.User.Employee.employee_salary_provide",compact('data','datas'));
}



public function getdepositenumbers($employee_id){

    $deposite = DB::table("employee_salary_payments")->where('employee_id',$employee_id)->sum('salary_deposit');
    $withdraw = DB::table("employee_salary_payments")->where('employee_id',$employee_id)->sum('salary_withdraw');

    $total = $deposite-$withdraw;

    return response()->json($total);

}


public function employee_salary_payment(Request $r){

    DB::table("employee_salary_payments")->insert([
        'employee_id' => $r->employee_id,
        'date'  => date('Y-m-d'),
        'salary_withdraw' => $r->salary_withdraw,
        'note' => $r->note,

    ]);

     return redirect()->back()->with('success','কর্মকর্তা / কর্মচারী বেতন প্রদান করা হয়েছে');

}


public function employee_salary_delete($id){

    DB::table("employee_salary_payments")->where("id",$id)->delete();
     return redirect()->back()->with('success','কর্মকর্তা / কর্মচারী বেতন ডিলিট করা হয়েছে');

}

public function salary_report()
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
    return view('Backend.User.Employee.salary_report',compact('branch'));
}

public function salary_report_show(Request $r)
{
    $data = DB::table("draftemployeesalarysetups")
	->join('employee_infos','employee_infos.id','draftemployeesalarysetups.employee_id')
	->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->select("draftemployeesalarysetups.*",'employee_infos.name','employee_infos.join_date','employee_infos.id as emp_id')
	->get();
	
	
	$total_salary_scale = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.salary_scale');
	
	$total_increment = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.increment');
	
	
	$grandtotal_salary = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.total_salary');
	
	$total_home_rent = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.home_rent');
	
	$total_travell_bill = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.travel_bill');
	
	
	$total_mobile_bill = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.mobile_bill');
	
	$total_treatment_bill = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.treatment_bill');
	
	$total_others = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.others');
	
	$total_totalsalaryforothers = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.totalsalaryforothers');
	
	$total_gp = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.gp');
	
	
	$total_totalgp = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.totalgp');
	
	$total_monthkorton = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.monthkorton');
	
	$total_revinew = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.revinew');
	
	
	$total_totalkorton = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.totalkorton');
	
	$total_netsalary = DB::table("draftemployeesalarysetups")->where('draftemployeesalarysetups.month',$r->month)
	->where('draftemployeesalarysetups.year',$r->year)
	->where('draftemployeesalarysetups.branch_id',$r->branch_id)
	->sum('draftemployeesalarysetups.netsalary');
	

    
    
    $month = $r->month;
    
    $year = $r->year;
    return view('Backend.User.Employee.salary_report_show',compact('data','month','year','total_salary_scale','total_increment','grandtotal_salary','total_home_rent','total_travell_bill','total_mobile_bill','total_treatment_bill','total_others','total_totalsalaryforothers','total_gp','total_totalgp','total_monthkorton','total_revinew','total_totalkorton','total_netsalary'));
}

public function employee_salray_update()
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
    return view('Backend.User.Employee.employee_salray_update',compact('branch'));
}

public function employee_salary_check(Request $r){
    

    $data = DB::table("draftemployeesalarysetups")
    ->join('employee_infos','employee_infos.id','draftemployeesalarysetups.employee_id')
    ->where('draftemployeesalarysetups.branch_id',$r->branch_id)
    ->select("draftemployeesalarysetups.*",'employee_infos.name','employee_infos.join_date','employee_infos.id as emp_id')
    ->orderby('draftemployeesalarysetups.id','ASC')
    ->skip($r->skip)
    ->take($r->limit)
    ->get();

    return view("Backend.User.Employee.employee_salary_check",compact('data'));
}

public function employee_salray_confirm_update(Request $r)
{
    for ($i=0; $i < count($r->employee) ; $i++) {

        DB::table("draftemployeesalarysetups")->where('id',$r->id[$i])->update([
            'date'         => date('Y-m-d'),
            'employee_id'  => $r->employee[$i],
            'salary_scale' => $r->salary_scale[$i],
            'increment'      => $r->increment[$i],
            'total_salary'   => $r->total_salary[$i],
            'home_rent'      => $r->home_rent[$i],
            'travel_bill'    => $r->travel_bill[$i],
            'mobile_bill'    => $r->mobile_bill[$i],
            'treatment_bill' => $r->treatment_bill[$i],
            'others'       => $r->others[$i],
            'totalsalaryforothers'       => $r->totalsalaryforothers[$i],
            'gpper'           => $r->gpper[$i],
            'gp'           => $r->gp[$i],
            'totalgp'      => $r->totalgp[$i],
            'monthkorton'  => $r->monthkorton[$i],
            'revinew'      => $r->revinew[$i],
            'totalkorton'      => $r->totalkorton[$i],
            'netsalary'        => $r->netsalary[$i],

            'month' => $r->month,
            'year'  => $r->year,

        ]);

    }

    return redirect()->back();
}

}
