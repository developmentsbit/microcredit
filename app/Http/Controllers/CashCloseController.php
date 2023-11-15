<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\branch_info;
use App\Models\admin_branch_info;
use DateTime;
use DateInterval;

class CashCloseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dateformate($x)
    {
        $d=explode('-', $x);
        return $d[2].'-'.$d[1].'-'.$d[0];
    }
    public function create_cash_close()
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
        return view('Backend.User.CashClose.create_cash_close',compact('branch'));
    }

    public function getLastCashClose(Request $request)
    {
        $data = DB::table('cash_close_infos')->where('branch_id',$request->branch_id)->orderby('cash_close_date','DESC')->get();

        if($data)
        {
            echo "<option>--নির্বাচন করুন--</option>";
            foreach($data as $v)
            {
                $explode = explode('-',$v->cash_close_date);

                $date = $explode[2].'-'.$explode[1].'-'.$explode[0];

                echo "<option value='".$v->cash_close_date."'>".$date."</option>";
            }
        }
    }

    public function show_dailyauto_voucher(Request $request)
    {
        $lastCdate = $request->last_cashclose_date;
        $lastdate = new DateTime($lastCdate);
        $lastdate->add(new DateInterval('P1D'));
        $from_date=$lastdate->format('Y-m-d');
        
        $branch_id = $request->branch_id;

        $cash_date = $this->dateformate($request->to_date);


        $last_cash = DB::table('cash_close_infos')->where('cash_close_date',$request->last_cashclose_date)->where('branch_id',$request->branch_id)->first();


        $cash_in_hand = $last_cash->debit - $last_cash->credit;

        $total_service_charge = DB::table('investment_collections')->whereBetween('date',[$from_date,$request->to_date])->where('branch_id',$request->branch_id)->sum('profit');

        $admission_fee = DB::table('incomes')->where('title_id',100)->whereBetween('date',[$from_date,$request->to_date])->where('branch_id',$request->branch_id)->sum('amount');

        $ho_income = DB::table('ho_collections')->where('collection_branch_id',$request->branch_id)->whereBetween('date',[$from_date,$request->to_date])->sum('amount');

        $savings_collection = DB::table('saving_transactions')->where('transaction_type',1)->where('branch_id',$request->branch_id)->whereBetween('date',[$from_date,$request->to_date])->sum('deposit_ammount');

        $monthly_saving_collection = DB::table('fixed_deposit_collections')->where('branch_id',$request->branch_id)->whereBetween('collection_date',[$from_date,$request->to_date])->sum('deposit_ammount');

        

       return view('Backend.User.CashClose.show_daily_cash_close',compact('last_cash','total_service_charge','admission_fee','ho_income','savings_collection','monthly_saving_collection','branch_id','cash_date','cash_in_hand'));
    }

    public function submitCashCloseReport(Request $request)
    {
        // dd($request->all());

        $cash_date = $request->cash_close_date;

        // return $cash_date;

        $total_incomes = ( $request->collection_service_charge + $request->one_time_service_charge + $request->admission_fee + $request->ho_income + $request->third_party + $request->saving_collection + $request->monthly_saving_collection + $request->onetime_saving + $request->saving_accumulation + $request->loan_accumulation + $request->loan_collection + $request->vehicle_income + $request->stationary_income + $request->venture_funds + $request->future_funds + $request->house_rent_advance + $request->sundry_income + $request->employee_income + $request->office_collection + $request->others );

        $total_expense = ( $request->salary_expense + $request->office_rent + $request->transport + $request->general_expense + $request->electricity_bill + $request->saving_accumulation_expense + $request->loan_accumulation_expense + $request->hospitality + $request->bonus + $request->saving_return + $request->monthly_saving_return + $request->onetime_saving_return + $request->ho_expense + $request->third_pary_expense + $request->saving_accumulation_return + $request->loan_accumulation_return + $request->loan_distribution + $request->loan_service_charge + $request->vehicle_expense + $request->advance_house_rent + $request->future_fund_return + $request->sundry_expense + $request->risk_fund_withdraw + $request->case_expense + $request->security_expense );

        

        // return $total_expense;

        $cash_incoems = array(
            "branch_id" => $request->branch_id,
            "cash_close_date" => $cash_date,
            "collection_service_charge" => $request->collection_service_charge,
            "one_time_service_charge" => $request->one_time_service_charge,
            "admission_fee" =>$request->admission_fee,
            "ho_income" =>$request->ho_income,
            "third_party" => $request->third_party,
            "savings_collection" => $request->savings_collection,
            "monthly_saving_collection" => $request->monthly_saving_collection,
            "onetime_saving" => $request->onetime_saving,
            "saving_accumulation" => $request->saving_accumulation,
            "loan_accumulation" => $request->loan_accumulation,
            "loan_collection" => $request->loan_collection,
            "vehicle_income" => $request->vehicle_income,
            "stationary_income" => $request->stationary_income,
            "venture_funds" => $request->venture_funds,
            "future_funds" => $request->future_funds,
            "house_rent_advance" => $request->house_rent_advance,
            "sundry_income" => $request->sundry_income,
            "employee_income" => $request->employee_income,
            "office_collection" => $request->office_collection,
            "others" => $request->others,
        );

        $cash_expense = array(
            "branch_id" => $request->branch_id,
            "cash_close_date" => $cash_date,
            "salary_expense" => $request->salary_expense,
            "office_rent" => $request->office_rent,
            "transport" => $request->transport,
            "general_expense" => $request->general_expense,
            "electricity_bill" => $request->electricity_bill,
            "saving_accumulation_expense" => $request->saving_accumulation_expense,
            "loan_accumulation_expense" => $request->loan_accumulation_expense,
            "hospitality" => $request->hospitality,
            "bonus" => $request->bonus,
            "saving_return" => $request->saving_return,
            "monthly_saving_return" => $request->monthly_saving_return,
            "onetime_saving_return" => $request->onetime_saving_return,
            "ho_expense" => $request->ho_expense,
            "third_pary_expense" => $request->third_pary_expense,
            "saving_accumulation_return" => $request->saving_accumulation_return,
            "loan_accumulation_return" => $request->loan_accumulation_return,
            "loan_distribution" => $request->loan_distribution,
            "loan_service_charge" => $request->loan_service_charge,
            "vehicle_expense" => $request->vehicle_expense,
            "advance_house_rent" => $request->advance_house_rent,
            "future_fund_return" => $request->future_fund_return,
            "sundry_expense" => $request->sundry_expense,
            "risk_fund_withdraw" => $request->risk_fund_withdraw,
            "case_expense" => $request->case_expense,
            "security_expense" => $request->security_expense,
        );

        $insert_cash_close = DB::table('cash_close_infos')->insert([
            "branch_id" => $request->branch_id,
            "cash_close_date" => $cash_date,
            "create_by"=>Auth::user()->id,
            'debit'=>$total_incomes,
            'credit'=>$total_expense,
        ]);

        $insert_cash_incomes = DB::table('cash_close_incomes')->insert($cash_incoems);
        $insert_cash_expense = DB::table('cash_close_expenses')->insert($cash_expense);

        return redirect()->back();
    }
}
