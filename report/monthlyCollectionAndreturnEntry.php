<?php
	require_once("db_connect.php");
	$db = new database();
	date_default_timezone_set("Asia/Dhaka");

	$branch_id=$_POST['branch_id'];
	$area_id=$_POST['area_id'];
	$schema_id=$_POST['schema_id'];
	$admin_id=$_POST['admin_id'];
	


	$savingsCollection=count($_POST['deposit_collection_date']);
	// echo 'Count :'.$savingsCollection.'<br>';
	// for($i=0;$i<$savingsCollection;$i++)
	// {
	// 	echo $_POST['deposit_collection_date'][$i].'<br>';
	// }

	$investCollection=count($_POST['invest_collection_date']);
	// echo 'Count :'.$investCollection.'<br>';
	// for($i=0;$i<$investCollection;$i++)
	// {
	// 	echo $_POST['invest_collection_date'][$i].'<br>';
	// }


	$countsavingRegID=count($_POST['savingRegID']);
	// echo 'countsavingRegID :'.$countsavingRegID.'<br>';
	for($i=0;$i<$countsavingRegID;$i++)
	{

		$member_id=$_POST['member_id'][$i];
		$savingRegID=$_POST['savingRegID'][$i];
		$investRegID=$_POST['investRegID'][$i];

		$savings='sc-'.$_POST['savingRegID'][$i];
		$invest='ic-'.$_POST['savingRegID'][$i];

		$sw='sw-'.$_POST['savingRegID'][$i];
		$rs='rs-'.$_POST['savingRegID'][$i];
		$rw='rw-'.$_POST['savingRegID'][$i];

		$investSchema=$db->link->query("SELECT `schema_id` FROM `investor_registrations` WHERE `registration_id`='$investRegID'");
		if($investSchema->num_rows>0)
		{
			$fetch_invest_schema=$investSchema->fetch_array();
		}



		for($j=0;$j<$savingsCollection;$j++)
		{
			$savingscoll=$_POST[$savings][$j];
			$investcoll=$_POST[$invest][$j];
			$savingcoldate=$db->custome_date($_POST['deposit_collection_date'][$j]);
			$investcoldate=$db->custome_date($_POST['deposit_collection_date'][$j]);

			if(!empty($savingRegID) && !empty($savingscoll))
				{

			$db->link->query("INSERT INTO `saving_transactions`(`date`,`transaction_type`,`branch_id`,`area_id`,`schema_id`,`member_id`,`deposit_ammount`,`return_ammount`,`profit_ammount`,`total`,`admin_id`,`approval`,`entry_date`,`approved_by`,`created_at`) VALUES('$savingcoldate','1','$branch_id','$area_id','$schema_id','$savingRegID','$savingscoll','0','0','0','$admin_id','1','".date('Y-m-d')."','1','".date('Y-m-d h:i:s')."')");
				}


				if(!empty($investRegID) && !empty($investcoll))
				{
					$db->link->query("INSERT INTO `investment_collections`(`date`,`branch_id`,`area_id`,`schema_id`,`member_id`,`investment_collection`,`admin_id`,`approval`,`approved_by`,`entry_date`,`created_at`) VALUES('$investcoldate','$branch_id','$area_id','$fetch_invest_schema[0]','$investRegID','$investcoll','$member_id','1','1','".date('Y-m-d')."','".date('Y-m-d h:i:s')."')");

				}
				

		}

			$swdate=$db->custome_date($_POST['sw_date']);
			$rsdate=$db->custome_date($_POST['rs_date']);
			$rwdate=$db->custome_date($_POST['rw_date']);
			$savingswithdraw=$_POST[$sw];
			$riskamountdeposit=$_POST[$rs];
			$riskamountwithdraw=$_POST[$rw];

			if(!empty($savingswithdraw))
			{
			$db->link->query("INSERT INTO `saving_transactions`(`date`,`transaction_type`,`branch_id`,`area_id`,`schema_id`,`member_id`,`deposit_ammount`,`return_ammount`,`profit_ammount`,`total`,`admin_id`,`approval`,`entry_date`,`approved_by`,`created_at`) VALUES('".$swdate."','1','$branch_id','$area_id','$schema_id','$savingRegID','0','$savingswithdraw','0','0','$admin_id','1','".date('Y-m-d')."','1','".date('Y-m-d h:i:s')."')");
			}

			if(!empty($riskamountdeposit))
			{
				$db->link->query("INSERT INTO `investor_riskamount`(`date`,`member_id`,`registration_id`,`risk_amount`,`branch_id`,`area_id`,`withdraw`,`created_at`) VALUES('$rsdate','$member_id','$investRegID','$riskamountdeposit','$branch_id','$area_id','0','".date('Y-m-d h:i:s')."')");
			}
			
			if(!empty($riskamountwithdraw))
			{
			$db->link->query("INSERT INTO `investor_riskamount`(`date`,`member_id`,`registration_id`,`risk_amount`,`branch_id`,`area_id`,`withdraw`,`created_at`) VALUES('$rwdate','$member_id','$investRegID','0','$branch_id','$area_id','$riskamountwithdraw','".date('Y-m-d h:i:s')."')");
			}
				
	}

	print "<h1 style='text-align:center; color:green'>Insert Successfull</h1>";




?>