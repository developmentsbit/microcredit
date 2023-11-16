<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\admin_branch_info;
use App\Models\fixed_deposit_registration;
use App\Models\fixed_deposit_collection;
use App\Traits\Date;
use Auth;

class DepositTransactionReport extends Controller
{
    protected $path;
    public $branch;
    use Date;
    public function __construct()
    {
        $this->middleware('auth');

        $this->path = 'Backend.User.DepositTrans';
    }
    public function index()
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
        return view($this->path.'.index',compact('branch'));
    }

    public function getFixedDepositMemebers(Request $request)
    {
        $members = fixed_deposit_registration::where('fixed_deposit_registrations.branch_id',$request->branch_id)->where('fixed_deposit_registrations.area_id',$request->area_id)
        ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
        ->select('fixed_deposit_registrations.*','members.aplicant_name')
        ->get();
        $output = '<option value="">--- Chose One ----</option>';
        if($members)
        {
            foreach($members as $v)
            {
                $output .= '<option value="'.$v->registration_id.'">'.$v->registration_id.' - '.$v->aplicant_name.'</option>';
            }
        }

        return $output;
    }

    public function depositTransactionReport(Request $request)
    {
        $from_date = Date::OriginalToDb('-',$request->from_date);
        $to_date = Date::OriginalToDb('-',$request->to_date);
        $data = [];
        $data['from_date'] = $request->from_date;
        $data['to_date'] = $request->to_date;

        $data['deposit_id'] = $request->fixed_deposit_id;

        $data['total_collection'] = fixed_deposit_collection::where('member_id',$request->fixed_deposit_id)->where('approval',1)->whereBetween('collection_date',[$from_date,$to_date])->get();

        $data['members'] = fixed_deposit_registration::where('fixed_deposit_registrations.registration_id',$request->fixed_deposit_id)
        ->join('members','members.member_id','=','fixed_deposit_registrations.member_id')
        ->select('members.aplicant_name')
        ->first();

       $data['total_deposit'] = fixed_deposit_collection::where('member_id',$request->fixed_deposit_id)->where('approval',1)->whereBetween('collection_date',[$from_date,$to_date])->sum('deposit_ammount');

       $data['total_return']= fixed_deposit_collection::where('member_id',$request->fixed_deposit_id)->where('approval',1)->whereBetween('collection_date',[$from_date,$to_date])->sum('return_deposit');
        $data['total_profit'] = fixed_deposit_collection::where('member_id',$request->fixed_deposit_id)->where('approval',1)->whereBetween('collection_date',[$from_date,$to_date])->sum('return_profit');

        // $data['total_return_profit'] = $total_return + $total_profit;


        return view($this->path.'.report',compact('data'));
    }
}
