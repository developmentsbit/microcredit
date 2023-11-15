<?php

require_once("db_connect.php");
$db = new database();

require_once(__DIR__."/lib/AdnSmsNotification.php");
use AdnSms\AdnSmsNotification;

if (isset($_POST["send_sms"])) 
{
		
		$lower=$_REQUEST['lower'];
		$upper=$_REQUEST['upper'];
		$msg=$_REQUEST['message'];

		$sql=$db->link->query("SELECT `registration_id`,`phone` FROM `ex_students` LIMIT $lower,$upper");
		if($sql->num_rows>0)
		{
			while($fetch=$sql->fetch_array())
			{
					$recipient  = '88'.$fetch['phone'];     
					$requestType = 'SINGLE_SMS';    
					$messageType = 'TEXT';       
					
					//$sms = new AdnSmsNotification();
					//$sms->sendSms($requestType, $msg, $recipient, $messageType);
					print  $fetch[0] .'->'. $fetch[1].'<br>';

			}
		}
		


			
}

?>