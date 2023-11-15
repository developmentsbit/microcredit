<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branch_info;
use App\Models\admin_branch_info;
use Auth;

class DepositTransactionReport extends Controller
{
    protected $path;
    public $branch;
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
}
