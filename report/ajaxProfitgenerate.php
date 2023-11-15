<?php

require_once("db_connect.php");
$db = new database();
date_default_timezone_set("Asia/Dhaka");
if (isset($_POST["investCollection"])) 
{	
	$lower=$_REQUEST['lower'];
	$upper=$_REQUEST['upper'];

    $branch_id=$_REQUEST["branch_id"];
    $schema_id=$_REQUEST["schema_id"];
    $month1=$_REQUEST["month1"];
    $year=$_REQUEST["year"];
    $date=$_REQUEST["date"];
    $admin_id=$_REQUEST["admin_id"];

    $profitdate=$year.'-'.$month1;

    $select_branch=$db->link->query("SELECT * FROM `branch_infos` WHERE `id`=' $branch_id'");
    if($select_branch)
    {
        $fetchBranchName=$select_branch->fetch_array();
    }

    $select_schema_id=$db->link->query("SELECT * FROM `fixed_deposit_schemas` WHERE `id`='$schema_id'");
    if($select_schema_id)
    {
        $fetchSchemaName=$select_schema_id->fetch_array();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>মাসিক মুনাফা প্রদান </title>
    
</head>
<style>
    body{
        font-family: 'Noto Serif Bengali', serif;
        font-size: 14px;
        padding:20px;
    }
    @media print{
        .print{
            display:none;
        }
        @page{
        size:landscape;
         margin-top: 0px;
         margin-bottom: 0px;
         margin-left: 0;
         margin-right: 0;
    }
    }
</style>
<body>

    <table  cellpadding="0" cellspacing="0" style="border-bottom: 2px #000 dotted; width: 100%;" >
        <tr>    
         
            <td align="center">
               
                <label> 
                    <span style="font-size:30px; "> শ্যামল ছায়া সমাজকল্যাণ সংস্থা</span><br>
                    <span style="font-size:16px; ">আতা, মাদ্রা, নেছারাবাদ, পিরোজপুর ।<br>
                        scsks2016@gmail.com, Phone-01721653785, 01880668788</span><br>

                        <b style="font-size:18px; margin-bottom: 5px; ">মাসিক মুনাফা প্রদান </b><br>
                        <b style="font-size:18px; margin-bottom: 5px; ">Date:<?php echo $date;?>
                            Month : <?php echo $db->month_name($month1);?>
                         </b>
                </label>

            </td>
       
        </tr>
    </table>

   <table  cellpadding="0" cellspacing="0"  style="width:100%;">
            <tr>
                <td  style="text-align: left; background: #f4f4f4; padding: 5px; ">ব্রাঞ্চ নাম: <b><?php print $branch_id?> <?php print $fetchBranchName['branch_name']?></b></td>
               
                <td  style="text-align: left;background: #f4f4f4;">স্কিমা নাম:<b> <?php print $fetchSchemaName['id']?> <?php print $fetchSchemaName['fixed_deposit_name']?></b></td>
                <td  style="text-align: right;background: #f4f4f4;">প্রিন্ট সময় ও তারিখ :<b><?php print date('d-M-Y h:i:sa'); ?>  </b></td>
            </tr>
</table>


<table cellpadding="0" cellspacing="0"   style="width:100%;margin-right:30px; background: #f4f4f4">
            <tr>
                <td rowspan="2" width="30" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;">হিসাব নং</td> 
                 <td rowspan="2" width="70" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">রেজিস্ট্রেশন আইডি</td>
              
                <td rowspan="2"style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">সদস্যের নাম</td>
                <td rowspan="2"  style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">পিতা / স্বামীর নাম</td>
                  <!-- <td rowspan="2"  style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;min-width: 80px;text-align: center;">মোবাইল নাম্বার</td> -->
                <td rowspan="2" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;">ঠিকানা</td>
             

                <td rowspan="2" align="center" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">জমাকৃত <br>টাকার পরিমাণ</td>

                    <td rowspan="2" align="center" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">পূর্বের মুনাফা <br>প্রদানের তারিখ </td> 

                    <td rowspan="2" align="center" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">মুনাফা<br>(<?php print $fetchSchemaName['percantage']?>%)</td>


                    <td rowspan="2"align="center" style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;border-bottom: 1px #000 solid; width: 70px;text-align: center;">হিসাব খোলার <br>তারিখ</td>


                
                <td colspan="4" valign="center" align="center" style="border-right: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;"><?php print $db->month_name($month1);?></td>
              

            </tr>

            <tr>

                   
                <td   style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;" valign="top" align="center">মুনাফা প্রদান</td>
            


              

    
            </tr>
            <?PHP
            $i=1;
            $toalAmount=0;
            $oldProfit=0;
            $totalProfit=0;
            $totalNetProft=0;

                $selectMember=$db->link->query("SELECT `fixed_deposit_collections`.`collection_date`,sum(`fixed_deposit_collections`.`deposit_ammount`) as 'deposit_ammount',sum(`fixed_deposit_collections`.`return_deposit`) as 'return_deposit',`fixed_deposit_registrations`.`registration_id`,`fixed_deposit_registrations`.`area_id`,`members`.`aplicant_name`,`members`.`father_name`,`members`.`phone`,`members`.`present_address`,`members`.`member_id` FROM `fixed_deposit_collections` INNER JOIN `fixed_deposit_registrations` ON `fixed_deposit_collections`.`member_id` =`fixed_deposit_registrations`.`registration_id` INNER JOIN `members` ON `fixed_deposit_registrations`.`member_id`=`members`.`member_id` WHERE `fixed_deposit_collections`.`branch_id`='$branch_id' AND `fixed_deposit_registrations`.`schema_id`='$schema_id'  AND `fixed_deposit_registrations`.`status`='1'  GROUP BY `fixed_deposit_collections`.`member_id` ORDER BY `fixed_deposit_registrations`.`registration_id` ASC limit $lower,$upper");


              if($selectMember){
                 while($fetch_info=$selectMember->fetch_array())
                {

                $toalAmount=$toalAmount+($fetch_info['deposit_ammount']-$fetch_info['return_deposit']);
            ?>

           <tr>
                
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;  text-align: center;"><?php print $i++; ?></td>
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<a href="fixed_deposit_statement.php?regID=<?php print $fetch_info['registration_id'] ?>" target="_blank" style="text-decoration: none;" ><?php print $fetch_info['registration_id'] ?></a></td>   

    

    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<?php print $fetch_info['aplicant_name'] ?>(<?php print $fetch_info['member_id'] ?>)</td>
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<?php print $fetch_info['father_name'] ?></td>

    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<?php print $fetch_info['present_address'] ?></td>
    

    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;"><?php $amount=intval($fetch_info['deposit_ammount']-$fetch_info['return_deposit']); print @$db->my_money_format($amount); ?>&nbsp;</td>



    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right; text-align: center; ">
        <?php 

        $paidProfit=$db->link->query("SELECT `collection_date`,`profit` FROM `fixed_deposit_collections` WHERE `member_id`='$fetch_info[registration_id]' AND `transaction_type`='1' order by `collection_date` desc limit 0,1");
        if($paidProfit->num_rows>0)
        {
            $fetch_Profit=$paidProfit->fetch_array();
          
            print $db->custome_date($fetch_Profit['collection_date']).'('.intval($fetch_Profit['profit']).'/-)'; 
        }
    

?>&nbsp;</td>   


  
         <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right; text-align: center; ">

        <?php 
            $profit=($fetchSchemaName['percantage']*$amount)/100;
            print $profit;
            $totalProfit=$totalProfit+$profit;

        ?>
    &nbsp;
</td>

<td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;text-align: center;"><?php print $db->custome_date($fetch_info['collection_date']) ?></td>

             
                   <td valign="center" style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;padding: 2px;">
                   	<input type="text" name="profit_provide[]" id="profit_provide[]" value="<?php echo $profit; ?>" style="width:100px; height:25px; " autocomplete="off">

                    <input type="hidden" name="areaid[]" id="areaid[]" value="<?php echo $fetch_info['area_id']; ?>" style="width:100px; height:25px; " autocomplete="off">          

                    <input type="hidden" name="reg_id[]" id="reg_id[]" value="<?php echo $fetch_info['registration_id']; ?>" style="width:100px; height:25px; " autocomplete="off">

                    <input type="hidden" name="branch_id" value="<?php print $branch_id;?>">
                    <input type="hidden" name="schema_id" value="<?php print $schema_id;?>">
                    <input type="hidden" name="month1" value="<?php print $month1;?>">
                    <input type="hidden" name="year" value="<?php print $year;?>">
                    <input type="hidden" name="admin_id" value="<?php print $admin_id;?>">
                    <input type="hidden" name="date" value="<?php print $date;?>">

                    </td>
</tr>
<?php
     }
}

?>
    </table>
<br>

    <table style="width:100%;">
    
        <tr >
            <td colspan="3" align="center"><input type="button" value="Save" name="Save" onclick="return profit_provide()" id="save_data" style="height:35px; width: 160px; background: green; color: #fff; border-radius:5px;" ></td>
        </tr>
    </table>


</body>
</html>
		
<?php			
}

?>