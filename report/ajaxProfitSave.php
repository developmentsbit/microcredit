<?php

require_once("db_connect.php");
$db = new database();
date_default_timezone_set("Asia/Dhaka");
	
$countreg_id=count($_POST['reg_id']);
$branch_id=$_POST['branch_id'];
$schema_id=$_POST['schema_id'];
$month1=$_POST['month1'];
$year=$_POST['year'];
$admin_id=$_POST['admin_id'];
$date=$_POST['date'];
$profit_month=$year.'-'.$month1;
$x="";
for($i=0;$i<$countreg_id;$i++)
{
		$reg_id=$_POST['reg_id'][$i];
		$areaid=$_POST['areaid'][$i];
		$profit_provide=$_POST['profit_provide'][$i];

		if(!empty($reg_id) && !empty($profit_provide))
		{

		$db->link->query("INSERT INTO `fixed_deposit_collections`(`collection_date`, `branch_id`, `area_id`, `member_id`, `deposit_ammount`, `service_charge`, `total`, `profit`, `return_profit`, `return_deposit`, `comment`, `status`, `admin_id`, `approval`, `approved_by`, `profit_provide_date_month`, `transaction_type`) VALUES ('$date','$branch_id','$areaid','$reg_id','0','0','0','$profit_provide','0','0','','1','$admin_id','0','0','$profit_month','1')");

	     }
}

print "<h1><span style='color:green'>Data Insert Successfully</span></h1>";


?>