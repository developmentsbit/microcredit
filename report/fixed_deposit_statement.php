
<?php

    include('db_connect.php');
    $db= new database();
    date_default_timezone_set("Asia/Dhaka");

    $regID=$_GET['regID'];

   $selectFixedDepositReg=$db->link->query("SELECT * FROM `fixed_deposit_registrations` WHERE `registration_id`='$regID'");
    if($selectFixedDepositReg)
    {
        $fetch_fixed_deposit_info=$selectFixedDepositReg->fetch_array();
    }



    $branch_id=$fetch_fixed_deposit_info['branch_id'];
    $area_id=$fetch_fixed_deposit_info['area_id'];
    $schema_id=$fetch_fixed_deposit_info['schema_id'];

    $select_branch=$db->link->query("SELECT * FROM `branch_infos` WHERE `id`=' $branch_id'");
    if($select_branch)
    {
        $fetchBranchName=$select_branch->fetch_array();
    }


     $select_kandro=$db->link->query("SELECT * FROM `area_infos` WHERE `branch_id`='$branch_id' and `id`='$area_id'");
    if($select_kandro)
    {
        $fetchKandroName=$select_kandro->fetch_array();
    }


    $select_schema_id=$db->link->query("SELECT * FROM `fixed_deposit_schemas` WHERE `id`='$schema_id'");
    if($select_schema_id)
    {
        $fetchSchemaName=$select_schema_id->fetch_array();
    }

      $fixed_deposit_info=$db->link->query("SELECT `fixed_deposit_registrations`.*,`members`.* FROM `fixed_deposit_registrations` 
INNER JOIN `members` ON `members`.`member_id`=`fixed_deposit_registrations`.`member_id`
WHERE `fixed_deposit_registrations`.`registration_id`='$regID'");
    if($fixed_deposit_info)
    {
        $fetch_member_info=$fixed_deposit_info->fetch_array();
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Deposit Statement </title>
<style>
    body{
        font-family: 'Noto Serif Bengali', serif;
        font-size: 12px;
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
</head>

<body>
     <table  cellpadding="0" cellspacing="0" style="border-bottom: 2px #000 dotted; width: 100%;" >
        <tr>    
            <td style="width:10%" align="right"></td>
            <td align="center">
                <label style="widtd:150px;">
                    <img src="logo.png"  style="max-height: 120px;max-widtd: 120px; float: left; clear: right;"></label>
                <label> 
                    <span style="font-size:30px; "> শ্যামল ছায়া সমাজকল্যাণ সংস্থা</span><br>
                    <span style="font-size:16px; ">আতা, মাদ্রা, নেছারাবাদ, পিরোজপুর ।<br>
                        scsks2016@gmail.com, Phone-01721653785, 01880668788</span><br>

                        <b style="font-size:18px; margin-bottom: 5px; ">মাসিক সঞ্চয় ও মুনাফা প্রদানের বিবরণ</b><br><br>

                </label>

            </td>
            <td style="width:20%"></td>
        </tr>
    </table>

       <table  cellpadding="0" cellspacing="0"  style="width:100%;">
        <tr>
<td  style="text-align: left; background: #f4f4f4; padding: 5px; ">সদস্যের নাম: <b> <?php print $fetch_member_info['member_id'].'-'.$fetch_member_info['aplicant_name']?></b></td>     

                <td  style="text-align: left; background: #f4f4f4; padding: 5px; ">মোবাইল-ঠিকানা :  <b> <?php print $fetch_member_info['phone'].'-'.$fetch_member_info['permenant_address']?></b></td>      

                <td  style="text-align: left; background: #f4f4f4; padding: 5px; "><b>  এককালীন সঞ্চয় রেজিস্ট্রেশন আইডি: <?php print $regID;?></b></td>   

                <td   style="text-align: right;background: #f4f4f4; padding-right: 10px;"><b> হিসাব খোলার তারিখ : <?php print $fetch_member_info['application_date'];?></b></td> 
        </tr>
            <tr>
                 


                   <td  style="text-align: left; background: #f4f4f4; padding: 5px; ">ব্রাঞ্চ নাম: <b><?php print $branch_id?> <?php print $fetchBranchName['branch_name']?></b></td>


                <td  style="text-align: left;background: #f4f4f4;">কেন্দ্রের নাম: <b><?php print $fetchKandroName['area_name']?></b></td>
                <td  style="text-align: left;background: #f4f4f4;">স্কিমা নাম:<b> <?php print $fetchSchemaName['id']?> <?php print $fetchSchemaName['fixed_deposit_name']?></b></td>
                <td  style="text-align: right;background: #f4f4f4; padding-right: 10px;">প্রিন্ট সময় ও তারিখ :<b><?php print date('d-M-Y h:i:sa'); ?>  </b></td>
            </tr>
</table>
<table cellpadding="0" cellspacing="0" style="width:100%;">
    <tr>
        <td style="border-left: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;">সিরিয়াল নং</td>
        <td style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">তারিখ</td>
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">সঞ্চয় &nbsp;</td>
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">লভ্যাংশ জমা&nbsp;</td>
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">সঞ্চয় উত্তোলন&nbsp;</td>   

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">লভ্যাংশ উত্তোলন&nbsp;</td>
        
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">মোট লভ্যাংশের পরিমাণ&nbsp;</td> 
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">মোট সঞ্চয় পরিমাণ&nbsp;</td>
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">মন্তব্য</td>
    </tr>  

<?php
$currentdeposit=0;
$currentProfit=0;

$i=1;
$select_transaction=$db->link->query("SELECT `collection_date`,`deposit_ammount`,`profit`,`return_deposit`,`return_profit`,`comment` FROM `fixed_deposit_collections` WHERE `member_id`='$regID'");
if($select_transaction)
{
    while($fetch_transaction=$select_transaction->fetch_array())
    {

$currentdeposit=$currentdeposit+$fetch_transaction['deposit_ammount'];
$currentdeposit=$currentdeposit-$fetch_transaction['return_deposit'];
$currentProfit=$currentProfit+$fetch_transaction['profit'];
$currentProfit=$currentProfit-$fetch_transaction['return_profit'];

?>

    <tr>
        <td style="border-left: 1px #000 solid; border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;"><?php print $i++;?></td>
        <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;"><?php print $fetch_transaction['collection_date'];?></td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_transaction['deposit_ammount'];?> &nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_transaction['profit'];?>&nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_transaction['return_deposit'];?>&nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_transaction['return_profit'];?>&nbsp;</td>  
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $currentProfit;?>&nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $currentdeposit;?>&nbsp;</td> 
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;"><?php print $fetch_transaction['comment'];?>&nbsp;</td>
    </tr>
<?php
    }
}

$fetch_sum[0]=0;
$fetch_sum[1]=0;
$fetch_sum[2]=0;
$fetch_sum[3]=0;

$select_transaction_sum=$db->link->query("SELECT SUM(`deposit_ammount`),SUM(`profit`),SUM(`return_deposit`),SUM(`return_profit`) FROM `fixed_deposit_collections` WHERE `member_id`='$regID'");
if($select_transaction_sum)
{
  $fetch_sum=$select_transaction_sum->fetch_array();
}

  


?>

    <tr>
        <td style="border-left: 1px #000 solid; border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;" colspan="2">মোট&nbsp; : &nbsp;</td>
     
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_sum[0];?>&nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_sum[1];?>&nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_sum[2];?>&nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $fetch_sum[3];?>&nbsp;</td>  <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $currentProfit;?>&nbsp;</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"><?php print $currentdeposit;?>&nbsp;</td> 
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">&nbsp;</td>
    </tr>      

</table>

<br>

    <table style="width:100%;">
        <tr>
            <td style="width:30%;text-align: center;">
                ---------------------------------- <br>
                <span>যোনাল ম্যানেজারের স্বাক্ষর</span>
            </td>
            <td style="width:40%;text-align: center;">
              
            </td>
            <td style="width:30%; text-align: center;">
                ---------------------------------- <br>
                <span>
শাখা ব্যবস্থাপকের স্বাক্ষর</span>
            </td>
        </tr>
        <tr class="print">
            <td colspan="3" align="center"><input type="button" value="Print" name="print" onclick="window.print()" style="height:35px; width: 120px; background: #ff0000; color: #fff; border-radius:5px;"></td>
        </tr>
    </table>

</body>
</html>