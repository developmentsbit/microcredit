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
$areaid=$_POST['areaid'];
$profit_month=$year.'-'.$month1;
$x="";
for($i=0;$i<$countreg_id;$i++)
{
		$reg_id=$_POST['reg_id'][$i];
		$return_profit=$_POST['return_profit'][$i];
		$deposit_ammount=$_POST['deposit_ammount'][$i];
		$return_deposit=$_POST['return_deposit'][$i];
		if($return_profit=="")
		{
		    $return_profit=0;
		}
		
		if($deposit_ammount=="")
		{
		    $deposit_ammount=0;
		}
		
		if($return_deposit=="")
		{
		    $return_deposit=0;
		}
	
		if($return_profit!='0' or $deposit_ammount!='0' or $return_deposit!='0')
		{

		       $db->link->query("INSERT INTO `fixed_deposit_collections`(`collection_date`, `branch_id`, `area_id`, `member_id`, `deposit_ammount`, `service_charge`, `return_profit`, `return_deposit`, `comment`, `status`, `admin_id`, `approval`, `approved_by`, `profit_provide_date_month`, `transaction_type`) VALUES ('$date','$branch_id','$areaid','$reg_id','$deposit_ammount','0','$return_profit','$return_deposit','','1','$admin_id','0','0','','2')");
	     }
}

print "<h1><span style='color:green'>Data Insert Successfully</span></h1>";


?>