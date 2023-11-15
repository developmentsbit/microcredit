<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\branch_info;
use App\Models\admin_branch_info;

class ReportsController extends Controller
{


	public function __construct()
	{
		$this->middleware('auth');
	}

// Invest

	public function investor_register_report(){

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


		return view("Backend.User.Report.investor_register_report",compact('branch'));

	}



	public function show_investorregister_report(Request $r){

		$data = DB::table("investor_registrations")
		->where("investor_registrations.branch_id",$r->branch_id)
		->where("investor_registrations.area_id",$r->area_id)
		->where("investor_registrations.schema_id",$r->schema_id)
		->leftjoin('members','members.id','investor_registrations.member_id')
		->select("investor_registrations.*",'members.aplicant_name')
		->get();

		$branch = DB::table('branch_infos')
		->where("id",$r->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$r->area_id)
		->first();

		$schema = DB::table("investmentschemas")
		->where("id",$r->schema_id)
		->first();





		return view("Backend.User.Report.show_investorregister_report",compact('data','branch','area','schema'));
	}

// saving




	public function saving_register_report(){

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


		return view("Backend.User.Report.saving_register_report",compact('branch'));

	}



	public function show_saving_register_report(Request $r){

		$data = DB::table("saving_registrations")
		->where("saving_registrations.branch_id",$r->branch_id)
		->where("saving_registrations.area_id",$r->area_id)
		->where("saving_registrations.schema_id",$r->schema_id)
		->leftjoin('members','members.id','saving_registrations.member_id')
		->select("saving_registrations.*",'members.aplicant_name')
		->get();

		$branch = DB::table('branch_infos')
		->where("id",$r->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$r->area_id)
		->first();

		$schema = DB::table("saving_schemas")
		->where("id",$r->schema_id)
		->first();



		return view("Backend.User.Report.show_saving_register_report",compact('data','branch','area','schema'));
	}


// fixed deposite




	public function fixeddeposite_register_report(){

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


		return view("Backend.User.Report.fixeddeposite_register_report",compact('branch'));

	}



	public function show_fixeddeposite_register_report(Request $r){

		$data = DB::table("fixed_deposit_registrations")
		->where("fixed_deposit_registrations.branch_id",$r->branch_id)
		->where("fixed_deposit_registrations.area_id",$r->area_id)
		->where("fixed_deposit_registrations.schema_id",$r->schema_id)
		->leftjoin('members','members.member_id','fixed_deposit_registrations.member_id')
		->select("fixed_deposit_registrations.*",'members.aplicant_name')
		->get();

		$branch = DB::table('branch_infos')
		->where("id",$r->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$r->area_id)
		->first();

		$schema = DB::table("fixed_deposit_schemas")
		->where("id",$r->schema_id)
		->first();




		return view("Backend.User.Report.show_fixeddeposite_register_report",compact('data','branch','area','schema'));
	}




	public function investment_statement_reports(){

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


		return view("Backend.User.Report.investment_statement_reports",compact('branch'));

	}


	public function show_investment_statement_reports(Request $request){

		$members = DB::table("investor_registrations")
		->where('investor_registrations.registration_id',$request->member_id)
		->first();

		$member = DB::table("members")->where('id',$members->member_id)->first();



		$investment = DB::table("investor_registrations")
		->where("registration_id",$request->member_id)
		->first();

		$investment_collections = DB::table("investment_collections")
		->where("member_id",$request->member_id)
		->get();

		$investment_handovers = DB::table("investment_handovers")
		->where("member_id",$request->member_id)
		->get();

		$branch = DB::table('branch_infos')
		->where("id",$request->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$request->area_id)
		->first();

		return view("Backend.User.Report.show_investment_statement_reports",compact('member','investment','investment_collections','investment_handovers','branch','area','members'));

	}













	public function savings_statement_reports(){

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


		return view("Backend.User.Report.savings_statement_reports",compact('branch'));

	}


	public function show_savings_statement_reports(Request $request){


		$saving = DB::table("saving_registrations")
		->where("saving_registrations.registration_id",$request->member_id)
		->join('members','members.id','saving_registrations.member_id')
		->select("saving_registrations.*",'members.aplicant_name')
		->first();

		$savings_collections = DB::table("saving_transactions")
		->where("member_id",$request->member_id)
		->select('date')
		->groupBy("date")
		->get();


		$member_id = $request->member_id;




		$branch = DB::table('branch_infos')
		->where("id",$request->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$request->area_id)
		->first();

		return view("Backend.User.Report.show_savings_statement_reports",compact('saving','savings_collections','branch','area','member_id'));

	}


















	public function fixeddeposite_statement_report(){

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


		return view("Backend.User.Report.fixeddeposite_statement_report",compact('branch'));

	}


	public function show_fixeddeposite_statement_report(Request $request){


		$deposite = DB::table("fixed_deposit_registrations")
		->where("registration_id",$request->member_id)
		->first();

// 		return $deposite;

		$member = DB::table("members")
		->where("member_id",$deposite->member_id)
		->first();

		$fixed_deposit_collections = DB::table("fixed_deposit_collections")
		->where("member_id",$request->member_id)
		->get();


		$total_collection = DB::table("fixed_deposit_collections")
		->where("member_id",$request->member_id)
		->sum('deposit_ammount');

// 		return $fixed_deposit_collections;

		$fixed_deposit_returns = DB::table("fixed_deposit_returns")
		->where("member_id",$request->member_id)
		->get();

		$total_return = DB::table("fixed_deposit_returns")
		->where("member_id",$request->member_id)
		->sum('deposit_return_ammount');

		$branch = DB::table('branch_infos')
		->where("id",$request->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$request->area_id)
		->first();

		return view("Backend.User.Report.show_fixeddeposite_statement_report",compact('member','deposite','fixed_deposit_collections','fixed_deposit_returns','branch','area','total_collection','total_return'));

	}



	public function member_statement_reports(){

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


		return view("Backend.User.Report.member_statement_reports",compact('branch'));

	}




	public function show_member_statement_reports(Request $request){

		$member = DB::table("members")
		->where("branch_id",$request->branch_id)
		->where("area_id",$request->area_id)
		->get();

		$branch = DB::table('branch_infos')
		->where("id",$request->branch_id)
		->first();

		$area   = DB::table("area_infos")
		->where("id",$request->area_id)
		->first();

		return view("Backend.User.Report.show_member_statement_reports",compact('member','branch','area'));

	}











	public function internalloan_reports(){

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


		return view("Backend.User.Report.internalloan_reports",compact('branch'));

	}




	public function show_internalloan_reports(Request $request){

		$data = DB::table("internalloans")
		->where("branch_id",$request->branch_id)
		->get();

		$branch = DB::table('branch_infos')
		->where("id",$request->branch_id)
		->first();



		return view("Backend.User.Report.show_internalloan_reports",compact('data','branch'));

	}







	public function loan_report(){

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


		return view("Backend.User.Report.loan_report",compact('branch'));

	}




	public function show_loan_report(Request $request){

		$data = DB::table("loans")
		->where("branch_id",$request->branch_id)
		->get();

		$branch = DB::table('branch_infos')
		->where("id",$request->branch_id)
		->first();



		return view("Backend.User.Report.show_loan_report",compact('data','branch'));

	}

	public function draftsalarycheck()
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
	    return view('Backend.User.Employee.draftsalarycheck',compact('branch'));
	}




	public function draftemployeesalarycheck(Request $r){

		$data = DB::table("draftemployeesalarysetups")
		->join('employee_infos','employee_infos.id','draftemployeesalarysetups.employee_id')
		->where('draftemployeesalarysetups.branch_id',$r->branch_id)
		->select("draftemployeesalarysetups.*",'employee_infos.name','employee_infos.join_date','employee_infos.id as emp_id')
		->get();

		return view("Backend.User.Report.draftemployeesalarycheck",compact('data'));
	}



	public function acceptdepositeemployeesalary(Request $r){



		for ($i=0; $i < count($r->employee) ; $i++) {

			DB::table("acceptemployeesalarysetups")->insert([
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


		for ($i=0; $i < count($r->employee) ; $i++) {

			DB::table("employee_salary_payments")->insert([

				'date'           => date('Y-m-d'),
				'employee_id'    => $r->employee[$i],
				'salary_deposit' => $r->netsalary[$i],
				'month' => $r->month,
				'year'  => $r->year,
			]);

		}


		for ($i=0; $i < count($r->employee) ; $i++) {

			DB::table("employeesalarysetups")->where('employee_id',$r->employee[$i])->update([

				'salary_scale'    => $r->total_salary[$i],
			]);

		}




		DB::table("draftemployeesalarysetups")->delete();


		return redirect('/');




	}

	public function branch_area_reports(){

		$branch = DB::table("branch_infos")->get();
		return view("Backend.User.Report.branch_area_reports",compact('branch'));

	}




	public function admin_reports(){

		$admin = DB::table("users")->get();
		return view("Backend.User.Report.admin_reports",compact('admin'));

	}

	public function weeklysaving_reports(){

		return view("Backend.User.Report.weeklysaving_reports");
	}


	public function demoreport(){

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

		return view("Backend.User.Report.demoreport",compact('branch'));
	}

    public function weeklysavingloancollsheet()
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

        $schemas = DB::table('saving_schemas')->where('type','weekly')->get();
        $invest_schema = DB::table('investmentschemas')->where('type','weekly')->get();
        return view('Backend.User.Report.weekly_saving_loan_coll',compact('branch','schemas','invest_schema'));
    }

    public function monthlycollsheet()
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

        $saving_schema = DB::table('saving_schemas')->get();
        return view('Backend.User.Report.monthlycollsheet',compact('branch','saving_schema'));
    }

    public function monthlyprofitsheet()
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

        $investmentschema = DB::table('fixed_deposit_schemas')->get();

        return view('Backend.User.Report.monthlyprofitsheet',compact('branch','investmentschema'));
    }

    public function investment_collection_report()
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

        $investmentschema = DB::table('investmentschemas')->get();
    	return view('Backend.User.Report.investment_collection_report',compact('branch','investmentschema'));

	}
    public function saving_collection_report()
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

        $saving_schema = DB::table('saving_schemas')->get();
    	return view('Backend.User.Report.saving_collecton_report',compact('branch','saving_schema'));
    }

    public function daily_auto_voucher()
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
        return view('Backend.User.Report.daily_auto_voucher',compact('branch'));
    }

	public function dateformate($r,$x)
    {
        $d=explode($r, $x);
        return $d[2].'-'.$d[1].'-'.$d[0];
    }

    public function showDailyAutoVoucher(Request $request)
    {
        $branch = branch_info::find($request->branch_id)->first();
		$cash_date = $request->last_cashclose_date;
		$cash_info = DB::table('cash_close_infos')->where('cash_close_date',$cash_date)->where('branch_id',$request->branch_id)->first();

		// return $cash_info;

		$cash_in_hand = $cash_info->debit - $cash_info->credit;


		$cash_incomes = DB::table('cash_close_incomes')->where('cash_close_date',$cash_date)->where('branch_id',$request->branch_id)->first();
		$cash_expenses = DB::table('cash_close_expenses')->where('cash_close_date',$cash_date)->where('branch_id',$request->branch_id)->first();
        return view('Backend.User.Report.show_daliyauto_voucher',compact('branch','cash_info','cash_incomes','cash_expenses','cash_in_hand'));
    }


    public function monthly_profit_sheet()
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
        $investmentschema = DB::table('fixed_deposit_schemas')->get();
        return view('Backend.User.Report.monthly_profit_sheet',compact('branch','investmentschema'));
    }

    public function multiple_monthly_collection_sheet()
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
        $investmentschema = DB::table('investmentschemas')->get();
        return view('Backend.User.Report.multiple_monthly_collection_sheet',compact('branch','investmentschema'));
    }

    public function weekly_saving_report()
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

        $schemas = DB::table('saving_schemas')->where('type','weekly')->get();
        $invest_schema = DB::table('investmentschemas')->where('type','weekly')->get();

        return view('Backend.User.Report.weekly_saving_report',compact('branch','schemas','invest_schema'));
    }



}
