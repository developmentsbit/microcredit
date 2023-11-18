<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\main_menu;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AdminPriority;
use App\Http\Controllers\CompanyInformation;
use App\Http\Controllers\SchemaController;
use App\Http\Controllers\DepositSchema;
use App\Http\Controllers\FixedDepositSchema;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\InvestmentRegistration;
use App\Http\Controllers\InvestmentHandover;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\InvestmentCollection;
use App\Http\Controllers\SavingCollection;
use App\Http\Controllers\SavingReturn;
use App\Http\Controllers\FixedDepositRegistration;
use App\Http\Controllers\FixedDepositCollection;
use App\Http\Controllers\FixedDepositReturn;
use App\Http\Controllers\IncomeTitle;
use App\Http\Controllers\ExpenseTitle;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HoHandover;
use App\Http\Controllers\HoCollection;
use App\Http\Controllers\InternalLoanCustomer;
use App\Http\Controllers\InternalLoanHandover;
use App\Http\Controllers\InternalLoanCollection;
use App\Http\Controllers\AssetCategorey;
use App\Http\Controllers\AssetExpense;
use App\Http\Controllers\AssetDepreciation;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\LoanCustomer;
use App\Http\Controllers\LoanHandover;
use App\Http\Controllers\LoanCollection;
use App\Http\Controllers\CashCloseController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\DepositTransactionReport;



/*loan_customer
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/fix_saving_schema',[BackendController::class,'fix_saving_schema']);
Route::get('/fix_deposit_schema',[BackendController::class,'fix_deposit_schema']);
Route::get('/fix_invest_schema',[BackendController::class,'fix_invest_schema']);

Route::get('/',[BackendController::class,'index']);

Auth::routes();

Route::get('/register', function() {
    return redirect('/login');
});

// Route::get('/select-branch', [App\Http\Controllers\BackendController::class, 'select_branch']);

Route::get('/dashboard', [App\Http\Controllers\BackendController::class, 'dashboard']);
Route::get('/home_dashboard', [App\Http\Controllers\BackendController::class, 'home_dashboard']);

Route::get('/fixed_deposit_reg_form',[BackendController::class,'fixed_deposit_reg_form']);
Route::get('/investment_registration_form',[BackendController::class,'investment_registration_form']);
Route::get('/check_letter',[BackendController::class,'check_letter']);
Route::get('/gurantee_letter',[BackendController::class,'gurantee_letter']);
Route::get('/check_lost_letter',[BackendController::class,'check_lost_letter']);
Route::get('/check_lost_letter',[BackendController::class,'check_lost_letter']);
Route::get('/member_reg_form',[BackendController::class,'member_reg_form']);
Route::get('/saving_reg_form',[BackendController::class,'saving_reg_form']);

// Route::get('/dashboard/{branch_name}/{id}', [App\Http\Controllers\BackendController::class, 'branch_dashboard']);
Route::post('/loadEmployee',[BackendController::class,'loadEmployee']);
Route::post('/loadBrnahcMenu',[BackendController::class,'loadBrnahcMenu']);
Route::post('/check_pass',[BackendController::class,'check_pass']);
Route::post('/change_password',[BackendController::class,'change_password']);
Route::post('/loadArea',[BackendController::class,'loadArea']);
Route::post('/loadMember',[BackendController::class,'loadMember']);
Route::post('/loadInvestorMembers',[BackendController::class,'loadInvestorMembers']);
Route::post('/loadInvestorMembers2',[BackendController::class,'loadInvestorMembers2']);
Route::post('/loadMember4',[BackendController::class,'loadMember4']);
Route::post('/loadInvestmentReportMember',[BackendController::class,'loadInvestmentReportMember']);
Route::post('/loadMember2',[BackendController::class,'loadMember2']);
Route::post('/loadMember3',[BackendController::class,'loadMember3']);
Route::post('/loadDistrict',[BackendController::class,'loadDistrict']);
Route::post('/loadUpazila',[BackendController::class,'loadUpazila']);


Route::post('getMemberData',[BackendController::class,'getMemberData']);



Route::post('/loaddeposite',[BackendController::class,'loaddeposite']);
Route::post('/loadBranchMember',[BackendController::class,'loadBranchMember']);
Route::post('/loadBranchMember2',[BackendController::class,'loadBranchMember2']);


Route::post('/getSchemaPer',[BackendController::class,'getSchemaPer']);
Route::get('/incoming_data',[BackendController::class,'incoming_data']);
Route::post('/loadMobileNumber',[BackendController::class,'loadMobileNumber']);
Route::get('/viewinvestment/{id}',[InvestmentRegistration::class,'viewinvestment']);
Route::get('/getinvestmentamount/{member_id}',[BackendController::class,'getinvestmentamount']);
Route::post('/getSavingSchemaInstallment',[BackendController::class,'getSavingSchemaInstallment']);


Route::get('/getmemberphone/{member_id}',[BackendController::class,'getmemberphone']);
Route::post('/getInvestmentSchemaInstallment',[BackendController::class,'getInvestmentSchemaInstallment']);


Route::get('/saving_new_data',[SavingController::class,'saving_new_data']);
Route::get('/saving_approve/{id}',[SavingController::class,'saving_approve']);
Route::post('/approve_all',[SavingController::class,'approve_all']);
Route::post('/loadBranchSavingNew',[SavingController::class,'loadBranchSavingNew']);
Route::post('/loadAreaSaving',[SavingController::class,'loadAreaSaving']);
Route::get('/savingRegStatusChange/{id}',[SavingController::class,'savingRegStatusChange']);



Route::get('/investor_reg',[InvestmentRegistration::class,'investor_reg']);
Route::get('/investor_approve/{id}',[InvestmentRegistration::class,'investor_approve']);
Route::post('/approve_all_investor',[InvestmentRegistration::class,'approve_all_investor']);
Route::post('/getinvestSchemaPer',[InvestmentRegistration::class,'getinvestSchemaPer']);
Route::post('/getinvestmentSchemaPer',[InvestmentRegistration::class,'getinvestmentSchemaPer']);
Route::post('/loadinvestCollBranch',[InvestmentRegistration::class,'loadinvestCollBranch']);
Route::post('/loadAreainvestColl',[InvestmentRegistration::class,'loadAreainvestColl']);

Route::get('/riskamount_withdraw',[InvestmentRegistration::class,'riskamount_withdraw']);
Route::get('/create_investorriskamount',[InvestmentRegistration::class,'create_investorriskamount']);
Route::post('/investment_riskamountstore',[InvestmentRegistration::class,'investment_riskamountstore']);
Route::get('/deleteinvestor_riskamount/{id}',[InvestmentRegistration::class,'deleteinvestor_riskamount']);




Route::get('/investment_collections_show',[InvestmentCollection::class,'investment_collections_show']);
Route::get('/investment_collections_show_approve/{id}',[InvestmentCollection::class,'investment_collections_show_approve']);
Route::post('/approve_all_investor_collection',[InvestmentCollection::class,'approve_all_investor_collection']);
Route::post('/showInvestmentCollReport',[InvestmentCollection::class,'showInvestmentCollReport']);



Route::get('/investment_handovers_show',[InvestmentHandover::class,'investment_handovers_show']);
Route::get('/investment_handovers_show_approve/{id}',[InvestmentHandover::class,'investment_handovers_show_approve']);
Route::post('/approve_all_investor_handovers',[InvestmentHandover::class,'approve_all_investor_handovers']);
Route::post('/showInvestmentHandoverReport',[InvestmentHandover::class,'showInvestmentHandoverReport']);
Route::post('/loadInvestmentHnadoverBranch',[InvestmentHandover::class,'loadInvestmentHnadoverBranch']);
Route::post('/loadAreaInvestmentHandover',[InvestmentHandover::class,'loadAreaInvestmentHandover']);

Route::post('/getRiskAmount',[InvestmentHandover::class,'getRiskAmount']);




Route::get('/saving_coll_new',[SavingCollection::class,'saving_coll_new']);
Route::get('/approved_collection/{id}',[SavingCollection::class,'approved_collection']);
Route::post('/approveAllSavingColl',[SavingCollection::class,'approveAllSavingColl']);
Route::post('/loadSavingMember',[SavingCollection::class,'loadSavingMember']);
Route::post('/loadTotalSaving',[SavingCollection::class,'loadTotalSaving']);
Route::post('/loadSavingCollBranch',[SavingCollection::class,'loadSavingCollBranch']);
Route::post('/loadAreaSavingColl',[SavingCollection::class,'loadAreaSavingColl']);
Route::post('/loadInstalmentAmount',[SavingCollection::class,'loadInstalmentAmount']);
Route::post('/showNewDataReport',[SavingCollection::class,'showNewDataReport']);


Route::post('/calCulateProfit',[SavingReturn::class,'calCulateProfit']);
Route::get('/saving_return_new',[SavingReturn::class,'saving_return_new']);
Route::get('/approved_returns/{id}',[SavingReturn::class,'approved_returns']);
Route::post('/approveAllSavingReturns',[SavingReturn::class,'approveAllSavingReturns']);
Route::post('/savingsMemberStatementShow',[SavingReturn::class,'savingsMemberStatementShow']);
Route::post('/showNewSavingReturnReport',[SavingReturn::class,'showNewSavingReturnReport']);
Route::post('/loadSavingReturnMember',[SavingReturn::class,'loadSavingReturnMember']);
Route::post('/loadSavingSchemaPercant',[SavingCollection::class,'loadSavingSchemaPercant']);


Route::get('/new_income',[IncomeController::class,'new_income']);
Route::get('/approved_income/{id}',[IncomeController::class,'approved_income']);
Route::post('/approveAllNewIcome',[IncomeController::class,'approveAllNewIcome']);
Route::post('/loadBranchIncomeNew',[IncomeController::class,'loadBranchIncomeNew']);
Route::post('/showNewIncomeReport',[IncomeController::class,'showNewIncomeReport']);

Route::get('/new_expense',[ExpenseController::class,'new_expense']);
Route::get('/approved_expense/{id}',[ExpenseController::class,'approved_expense']);
Route::post('/approveAllExpense',[ExpenseController::class,'approveAllExpense']);
Route::post('/loadBranchExpenseNew',[ExpenseController::class,'loadBranchExpenseNew']);
Route::post('/showNewExpenseReport',[ExpenseController::class,'showNewExpenseReport']);

Route::get('/new_ho_handover',[HoHandover::class,'new_ho_handover']);
Route::get('/approved_newho_handover/{id}',[HoHandover::class,'approved_newho_handover']);
Route::post('/approveAllhoHandover',[HoHandover::class,'approveAllhoHandover']);


Route::get('/new_ho_collection',[HoCollection::class,'new_ho_collection']);
Route::get('/approved_newho_collection/{id}',[HoCollection::class,'approved_newho_collection']);
Route::post('/approveAllhoCollection',[HoCollection::class,'approveAllhoCollection']);


Route::get('/new_internalloan_handover',[InternalLoanHandover::class,'new_internalloan_handover']);
Route::get('/approved_internalloan_handover/{id}',[InternalLoanHandover::class,'approved_internalloan_handover']);
Route::post('/approveAllinterLoanHandover',[InternalLoanHandover::class,'approveAllinterLoanHandover']);
Route::post('/loadBranchIntLoanHandNew',[InternalLoanHandover::class,'loadBranchIntLoanHandNew']);
Route::get('/gettotalloan/{member_id}',[InternalLoanHandover::class,'gettotalloan']);
Route::post('/showNewInternalLoanHandoverReport',[InternalLoanHandover::class,'showNewInternalLoanHandoverReport']);






Route::get('/new_internalloan_collection',[InternalLoanCollection::class,'new_internalloan_collection']);
Route::get('/approved_internalloan_collection/{id}',[InternalLoanCollection::class,'approved_internalloan_collection']);
Route::post('/approveAllinterLoanColl',[InternalLoanCollection::class,'approveAllinterLoanColl']);
Route::post('/loadInternalLoanColl',[InternalLoanCollection::class,'loadInternalLoanColl']);
Route::post('/showNewInternalLoanCollectionReport',[InternalLoanCollection::class,'showNewInternalLoanCollectionReport']);


Route::get('/new_asset_expense',[AssetExpense::class,'new_asset_expense']);
Route::get('/approved_assetexpense/{id}',[AssetExpense::class,'approved_assetexpense']);
Route::post('/approveNewAssetExpense',[AssetExpense::class,'approveNewAssetExpense']);
Route::post('/loadBranchAssetExpense',[AssetExpense::class,'loadBranchAssetExpense']);

Route::get('/assetExpenseReport',[AssetExpense::class,'assetExpenseReport']);
Route::post('/assetExpenseReportShow',[AssetExpense::class,'assetExpenseReportShow']);



Route::get('company_structure',[BackendController::class,'company_structure']);

Route::resource('notices',NoticesController::class);
Route::get('viewAllNotice',[BackendController::class,'viewAllNotice']);

// Reports


Route::get('/investor_register_report',[ReportsController::class,'investor_register_report']);
Route::get('/show_investorregister_report',[ReportsController::class,'show_investorregister_report']);

Route::get('/saving_register_report',[ReportsController::class,'saving_register_report']);
Route::get('/show_saving_register_report',[ReportsController::class,'show_saving_register_report']);


Route::get('/fixeddeposite_register_report',[ReportsController::class,'fixeddeposite_register_report']);
Route::get('/show_fixeddeposite_register_report',[ReportsController::class,'show_fixeddeposite_register_report']);

// Statement

Route::get('/investment_statement_reports',[ReportsController::class,'investment_statement_reports']);
Route::get('/show_investment_statement_reports',[ReportsController::class,'show_investment_statement_reports']);


Route::get('/savings_statement_reports',[ReportsController::class,'savings_statement_reports']);
Route::get('/show_savings_statement_reports',[ReportsController::class,'show_savings_statement_reports']);

Route::get('/fixeddeposite_statement_report',[ReportsController::class,'fixeddeposite_statement_report']);
Route::get('/show_fixeddeposite_statement_report',[ReportsController::class,'show_fixeddeposite_statement_report']);
Route::get('/show_fixed_deposit_register_report',[ReportsController::class,'show_fixeddeposite_register_report']);

Route::get('/member_statement_reports',[ReportsController::class,'member_statement_reports']);
Route::get('/show_member_statement_reports',[ReportsController::class,'show_member_statement_reports']);


Route::get('/internalloan_reports',[ReportsController::class,'internalloan_reports']);
Route::get('/show_internalloan_reports',[ReportsController::class,'show_internalloan_reports']);


Route::get('/loan_report',[ReportsController::class,'loan_report']);
Route::get('/show_loan_report',[ReportsController::class,'show_loan_report']);


Route::get('/draftsalarycheck',[ReportsController::class,'draftsalarycheck']);

Route::get('/draftemployeesalarycheck',[ReportsController::class,'draftemployeesalarycheck']);
Route::post('/acceptdepositeemployeesalary',[ReportsController::class,'acceptdepositeemployeesalary']);

Route::get('/branch_area_reports',[ReportsController::class,'branch_area_reports']);
Route::get('/admin_reports',[ReportsController::class,'admin_reports']);

Route::get('/weeklysaving_reports',[ReportsController::class,'weeklysaving_reports']);
Route::get('/demoreport',[ReportsController::class,'demoreport']);

Route::get('/weeklysavingloancollsheet',[ReportsController::class,'weeklysavingloancollsheet']);
Route::get('/monthlycollsheet',[ReportsController::class,'monthlycollsheet']);
Route::get('/monthlyprofitsheet',[ReportsController::class,'monthlyprofitsheet']);


Route::get('/investment_collection_report',[ReportsController::class,'investment_collection_report']);
Route::get('/saving_collection_report',[ReportsController::class,'saving_collection_report']);

//daily auto voucher
Route::get('/daily_auto_voucher',[ReportsController::class,'daily_auto_voucher']);
Route::get('/showDailyAutoVoucher',[ReportsController::class,'showDailyAutoVoucher']);


Route::get('/monthly_profit_sheet',[ReportsController::class,'monthly_profit_sheet']);


Route::get('/multiple_monthly_collection_sheet',[ReportsController::class,'multiple_monthly_collection_sheet']);


Route::get('/weekly_saving_report',[ReportsController::class,'weekly_saving_report']);





Route::get('/incomeReport',[IncomeController::class,'incomeReport']);
Route::post('/incomeReportShow',[IncomeController::class,'incomeReportShow']);

Route::get('/expense_statement_reports',[ExpenseController::class,'expense_statement_reports']);
Route::post('/expense_statement_reportsShow',[ExpenseController::class,'expense_statement_reportsShow']);


Route::get('/hoprodan_reports',[HoHandover::class,'hoprodan_reports']);
Route::post('/hoprodan_reportsShow',[HoHandover::class,'hoprodan_reportsShow']);

Route::get('/hoaday_reports',[HoCollection::class,'hoaday_reports']);
Route::post('/hoaday_reportsShow',[HoCollection::class,'hoaday_reportsShow']);


Route::get('/employeeStatementReport',[EmployeeController::class,'employeeStatementReport']);
Route::post('/employeeStatementReportShow',[EmployeeController::class,'employeeStatementReportShow']);
Route::get('/employee_salray_update',[EmployeeController::class,'employee_salray_update']);
Route::get('/employee_salary_check',[EmployeeController::class,'employee_salary_check']);
Route::post('/employee_salray_confirm_update',[EmployeeController::class,'employee_salray_confirm_update']);


Route::get('/assetDepreciationReport',[AssetDepreciation::class,'assetDepreciationReport']);
Route::post('/assetDepreciationReportShow',[AssetDepreciation::class,'assetDepreciationReportShow']);




Route::post('/loadFixedDepositMember',[FixedDepositCollection::class,'loadFixedDepositMember']);
Route::post('/loadFixedDepositMember1',[FixedDepositCollection::class,'loadFixedDepositMember1']);
Route::post('/loadTotalFixedDeposit',[FixedDepositCollection::class,'loadTotalFixedDeposit']);
Route::get('/new_fixed_deposit_coll',[FixedDepositCollection::class,'new_fixed_deposit_coll']);
Route::get('/approved_fixed_depositcoll/{id}',[FixedDepositCollection::class,'approved_fixed_depositcoll']);
Route::post('/approveAllFixedDepoColl',[FixedDepositCollection::class,'approveAllFixedDepoColl']);
Route::post('/showNewDepositCollReport',[FixedDepositCollection::class,'showNewDepositCollReport']);
Route::post('/loadDepositCollBranch',[FixedDepositCollection::class,'loadDepositCollBranch']);
Route::post('/loadAreaFixedColl',[FixedDepositCollection::class,'loadAreaFixedColl']);
Route::get('/profit_generate',[FixedDepositCollection::class,'profit_generate']);

Route::post('/calculateFixedDepositProfit',[FixedDepositReturn::class,'calculateFixedDepositProfit']);
Route::get('/new_fixed_deposit_return',[FixedDepositReturn::class,'new_fixed_deposit_return']);
Route::get('/approved_fixed_depositret/{id}',[FixedDepositReturn::class,'approved_fixed_depositret']);
Route::post('/approveAllFixedDepoReturn',[FixedDepositReturn::class,'approveAllFixedDepoReturn']);
Route::post('/showNewDepositReturnReport',[FixedDepositReturn::class,'showNewDepositReturnReport']);
Route::post('/loadDepositReturnBranch',[FixedDepositReturn::class,'loadDepositReturnBranch']);
Route::post('/loadAreaDepositReturn',[FixedDepositReturn::class,'loadAreaDepositReturn']);
Route::get('/fixed_deposit_coll_return',[FixedDepositReturn::class,'fixed_deposit_coll_return']);
Route::post('/profitCalculate',[FixedDepositReturn::class,'profitCalculate']);



Route::get('/employee_salary_intialize',[EmployeeController::class,'employee_salary_intialize']);
Route::post('/getloadMember',[EmployeeController::class,'getloadMember']);
Route::post('/insertemployeesalary',[EmployeeController::class,'insertemployeesalary']);
Route::post('/employeesalarydelete/{id}',[EmployeeController::class,'employeesalarydelete']);
Route::post('/depositeemployeesalary',[EmployeeController::class,'depositeemployeesalary']);


Route::get('/employee_salary_setup',[EmployeeController::class,'employee_salary_setup']);
Route::get('/searchemployee_salary',[EmployeeController::class,'searchemployee_salary']);
Route::get('/salary_report',[EmployeeController::class,'salary_report']);
Route::get('/salary_report_show',[EmployeeController::class,'salary_report_show']);



Route::get('/employee_salary_provide',[EmployeeController::class,'employee_salary_provide']);
Route::get('/getdepositenumbers/{employee_id}',[EmployeeController::class,'getdepositenumbers']);

Route::post('/employee_salary_payment',[EmployeeController::class,'employee_salary_payment']);
Route::get('/employee_salary_delete/{id}',[EmployeeController::class,'employee_salary_delete']);



// Bank

Route::get('/bankinformation', [BankController::class,'bankinformation']);
Route::post('/bankinformationinsert', [BankController::class,'bankinformationinsert']);
Route::get('/getbankinformation', [BankController::class,'getbankinformation']);
Route::get('/deletebankinformation/{id}', [BankController::class,'deletebankinformation']);
Route::get('/editbankinformation/{id}', [BankController::class,'editbankinformation']);
Route::post('/updatebankinformation/{id}', [BankController::class,'updatebankinformation']);



// Bank Transaction


Route::get('/banktransaction', [BankController::class,'banktransaction']);
Route::post('/banktransactioninsert', [BankController::class,'banktransactioninsert']);
Route::get('/managebanktransaction', [BankController::class,'managebanktransaction']);
Route::get('/deletebanktransaction/{id}', [BankController::class,'deletebanktransaction']);
Route::get('/editbanktransaction/{id}', [BankController::class,'editbanktransaction']);
Route::post('/updatebanktransaction/{id}', [BankController::class,'updatebanktransaction']);
Route::get('/gettotalamount/{id}', [BankController::class,'gettotalamount']);
Route::get('/banktransactionreports', [BankController::class,'banktransactionreports']);
Route::get('/bankvoucher/{id}', [BankController::class,'bankvoucher']);
Route::get('/bankstatement', [BankController::class,'bankstatement']);
Route::get('/bankstatementreports', [BankController::class,'bankstatementreports']);


Route::post('viewmember',[MemberController::class,'index']);

Route::post('viewSavingRegistrations',[SavingController::class,'index']);

Route::post('viewSavingCollection',[SavingCollection::class,'index']);


Route::post('viewSavingReturn',[SavingReturn::class,'index']);

Route::post('viewFixedDepositRegistration',[FixedDepositRegistration::class,'index']);
Route::get('fixedDepositStatsChange/{id}',[FixedDepositRegistration::class,'fixedDepositStatsChange']);


Route::post('viewFixedDepositCollection',[FixedDepositCollection::class,'index']);

Route::post('viewFixedDepositReturn',[FixedDepositReturn::class,'index']);

Route::post('viewInvestmentRegistration',[InvestmentRegistration::class,'index']);
Route::get('investmentStatusChange/{id}',[InvestmentRegistration::class,'investmentStatusChange']);


Route::post('viewInvestmentHandover',[InvestmentHandover::class,'index']);


Route::post('viewInvestmentCollections',[InvestmentCollection::class,'index']);

Route::post('viewIncomes',[IncomeController::class,'index']);

Route::post('viewExpenses',[ExpenseController::class,'index']);


Route::post('viewHoHandover',[HoHandover::class,'index']);


Route::post('viewHoCollections',[HoCollection::class,'index']);


Route::get('multiple_deposit_collection',[FixedDepositCollection::class,'multiple_deposit_collection']);

Route::get('multiple_saving_collection',[SavingCollection::class,'multiple_saving_collection']);


Route::get('multiple_investment_collection',[InvestmentCollection::class,'multiple_investment_collection']);



// Route::get('add_invest_risk_amount',function(){
//     return 1;
// });

Route::resources([
    'main_menu'=>main_menu::class,
    'sub_menu'=>SubMenuController::class,
    'create_admin'=>adminController::class,
    'company_information'=>CompanyInformation::class,
    'branch_info'=>BranchController::class,
    'area_info'=>AreaController::class,
    'admin_priority'=>AdminPriority::class,
    'add_schema'=>SchemaController::class,
    'add_saving_schema'=>DepositSchema::class,
    'fixed_deposit_schema'=>FixedDepositSchema::class,
    'add_employee'=>EmployeeController::class,
    'add_member'=>MemberController::class,
    'investment_registration'=>InvestmentRegistration::class,
    'investment_handover'=>InvestmentHandover::class,
    'saving_registration'=>SavingController::class,
    'investment_collection'=>InvestmentCollection::class,
    'saving_collection'=>SavingCollection::class,
    'saving_return'=>SavingReturn::class,
    'fixeddeposit_registration'=>FixedDepositRegistration::class,
    'fixeddeposit_collection'=>FixedDepositCollection::class,
    'fixeddeposit_return'=>FixedDepositReturn::class,
    'add_income_title'=>IncomeTitle::class,
    'add_expense_title'=>ExpenseTitle::class,
    'add_income'=>IncomeController::class,
    'add_expense'=>ExpenseController::class,
    'ho_handover'=>HoHandover::class,
    'ho_collection'=>HoCollection::class,
    'internal_loan_customer'=>InternalLoanCustomer::class,
    'internal_loan_handover'=>InternalLoanHandover::class,
    'internal_loan_collection'=>InternalLoanCollection::class,

    'loan_customer'=>LoanCustomer::class,
    'loan_handover'=>LoanHandover::class,
    'loan_collection'=>LoanCollection::class,

    'add_asset_categorey'=>AssetCategorey::class,
    'add_asset_expense'=>AssetExpense::class,
    'add_asset_depreciation'=>AssetDepreciation::class,





]);

Route::get('deposit_transaction',[DepositTransactionReport::class,'index']);
Route::post('getFixedDepositMemebers',[DepositTransactionReport::class,'getFixedDepositMemebers']);
Route::get('depositTransactionReport
',[DepositTransactionReport::class,'depositTransactionReport']);

Route::get('create_cash_close',[CashCloseController::class,'create_cash_close']);
Route::post('getLastCashClose',[CashCloseController::class,'getLastCashClose']);
Route::get('show_dailyauto_voucher',[CashCloseController::class,'show_dailyauto_voucher']);
Route::post('submitCashCloseReport',[CashCloseController::class,'submitCashCloseReport']);


Route::get('add_invest_risk_amount',[InvestmentRegistration::class,'add_invest_risk_amount']);
Route::post('addRiskAmount',[InvestmentRegistration::class,'addRiskAmount']);
