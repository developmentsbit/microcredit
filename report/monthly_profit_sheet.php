<?php

    include('db_connect.php');
    $db= new database();
    date_default_timezone_set("Asia/Dhaka");


    $branch_id=$_GET["branch_id"];
    $area_id=$_GET["area_id"];
    $schema_id=$_GET["schema_id"];
    $m1=$_GET["month1"];
    $m2=$_GET["month2"];
    $year=$_GET["year"];


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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>মাসিক মুনাফা প্রদান শীট</title>
    
</head>
<style>
    body{
        font-family: 'Noto Serif Bengali', serif;
        font-size: 12px;
        padding:20px;
    }
    tr td{
        padding : 5.5px 2px;
        font-size : 10.5px;
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
            <td style="width:10%" align="right"></td>
            <td align="center">
                <label style="widtd:150px;">
                    <img src="logo.png"  style="max-height: 120px;max-widtd: 120px; float: left; clear: right;"></label>
                <label> 
                    <span style="font-size:30px; "> শ্যামল ছায়া সমাজকল্যাণ সংস্থা</span><br>
                    <span style="font-size:16px; ">আতা, মাদ্রা, নেছারাবাদ, পিরোজপুর ।<br>
                        scsks2016@gmail.com, Phone-01721653785, 01880668788</span><br>

                        <b style="font-size:18px; margin-bottom: 5px; ">মাসিক মুনাফা প্রদান শীট</b><br>
                </label>

            </td>
            <td style="width:20%"></td>
        </tr>
    </table>

   <table  cellpadding="0" cellspacing="0"  style="width:100%;">
            <tr>
                <td  style="text-align: left; background: #f4f4f4; padding: 5px; ">ব্রাঞ্চ নাম: <b><?php print $branch_id?> <?php print $fetchBranchName['branch_name']?></b></td>
                <td  style="text-align: left;background: #f4f4f4;">কেন্দ্রের নাম: <b><?php print $fetchKandroName['area_name']?></b></td>
                <td  style="text-align: left;background: #f4f4f4;">স্কিমা নাম:<b> <?php print $fetchSchemaName['id']?> <?php print $fetchSchemaName['fixed_deposit_name']?></b></td>
                <td  style="text-align: right;background: #f4f4f4;">প্রিন্ট সময় ও তারিখ :<b><?php print date('d-M-Y h:i:sa'); ?>  </b></td>
            </tr>
</table>


<table cellpadding="0" cellspacing="0"   style="width:100%;margin-right:30px">
            <tr>
                <td rowspan="2" width="30" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;">হিসাব নং</td> 
                 <td rowspan="2" width="70" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">রেজিস্ট্রেশন আইডি</td>
                <td rowspan="2"align="center" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid; width: 70px;text-align: center;">হিসাব খোলার <br>তারিখ</td>
                <td rowspan="2"style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;width:12%;">সদস্যের নাম</td>
                <td rowspan="2"  style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">পিতা / স্বামীর নাম</td>
                  <!-- <td rowspan="2"  style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;min-width: 80px;text-align: center;">মোবাইল নাম্বার</td> -->
                <td rowspan="2" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;width:4%;">ঠিকানা</td>
             

                <td rowspan="2" align="center" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">জমাকৃত <br>টাকার পরিমাণ</td>

                    <td rowspan="2" align="center" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">পূর্বের মুনাফা <br>প্রদানের তারিখ </td> 

                    <td rowspan="2" align="center" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">মুনাফা<br>(<?php print $fetchSchemaName['percantage']?>%)</td>




                <td rowspan="2" style="border-left: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;border-right: 1px #000 solid;">  পরিশোধযোগ্য <br>মুনাফার পরিমাণ </td>


                <?php 
                $c=0;
                $c=$m1;
                while($c<=$m2)
                {
                ?>
                <td colspan="4" valign="center" align="center" style="border-right: 1px #000 solid;border-top: 1px #000 solid;border-bottom: 1px #000 solid;"><?php print $db->month_name($c);?></td>
                <?php
                    $c++;
                }
                ?>

            </tr>

            <tr>

<!-- return_profit
return_deposit -->
                <?php 
                $c=0;
                $c=$m1;
                while($c<=$m2)
                {
                ?>
                   
                <td   style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;" valign="top" align="center">সার্ভিস চার্জ <br>প্রদান</td>
                <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;" valign="top" align="center">মাসে জমা</td>
                <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;" valign="top" align="center">উত্তোলন </td>
                <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;" valign="top" align="center">সদস্য <br>স্বাক্ষর</td>  


                <?php
                    $c++;
                }
                ?>

              

    
            </tr>
            <?PHP
            $i=1;
            $toalAmount=0;
            $oldProfit=0;
            $totalProfit=0;
            $totalNetProft=0;

                $selectMember=$db->link->query("SELECT `fixed_deposit_collections`.`collection_date`,sum(`fixed_deposit_collections`.`deposit_ammount`) as 'deposit_ammount',sum(`fixed_deposit_collections`.`return_deposit`) as 'return_deposit',`fixed_deposit_registrations`.`registration_id`,`members`.`aplicant_name`,`members`.`father_name`,`members`.`phone`,`members`.`present_address`,`members`.`member_id` FROM `fixed_deposit_collections` INNER JOIN `fixed_deposit_registrations` ON `fixed_deposit_collections`.`member_id` =`fixed_deposit_registrations`.`registration_id` LEFT JOIN `members` ON `fixed_deposit_registrations`.`member_id`=`members`.`member_id` WHERE `fixed_deposit_collections`.`branch_id`='$branch_id' AND `fixed_deposit_registrations`.`schema_id`='$schema_id' AND `fixed_deposit_collections`.`area_id`='$area_id'  AND `fixed_deposit_registrations`.`status`='1' GROUP BY `fixed_deposit_collections`.`member_id` ORDER BY `fixed_deposit_registrations`.`registration_id` ASC");

              if($selectMember){
                 while($fetch_info=$selectMember->fetch_array())
                {
                    
                    if($fetch_info['deposit_ammount'] > 0)
                    {

                $toalAmount=$toalAmount+($fetch_info['deposit_ammount']-$fetch_info['return_deposit']);
            ?>

    <tr>
                
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;  text-align: center;"><?php print $i++; ?></td>
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<a href="fixed_deposit_statement.php?regID=<?php print $fetch_info['registration_id'] ?>" target="_blank" style="text-decoration: none;" ><?php print $fetch_info['registration_id'] ?></a></td>   
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;"><?php print $db->custome_date($fetch_info['collection_date']) ?></td>
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<?php print $fetch_info['aplicant_name'] ?>(<?php print $fetch_info['member_id'] ?>)</td>
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<?php print $fetch_info['father_name'] ?></td>
    <!-- <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; ">&nbsp;<?php print $fetch_info['phone'] ?></td> -->
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;">&nbsp;<?php print $fetch_info['present_address'] ?></td>
    

    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;"><?php $amount=intval($fetch_info['deposit_ammount']-$fetch_info['return_deposit']); print @$db->my_money_format($amount); ?>&nbsp;</td>



    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right; text-align: center; ">
        <?php 

        $paidProfit=$db->link->query("SELECT `collection_date`,`return_profit` FROM `fixed_deposit_collections` WHERE `member_id`='$fetch_info[registration_id]' and `return_profit`>0 order by `collection_date` desc limit 0,1");
        if($paidProfit->num_rows>0)
        {
            $fetch_Profit=$paidProfit->fetch_array();
           $oldProfit=$oldProfit+$fetch_Profit['return_profit'];
            print $db->custome_date($fetch_Profit['collection_date']).'('.intval($fetch_Profit['return_profit']).'/-)'; 
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

  <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;border-right: 1px #000 solid;"> 
        <?php 
    $netprofit=0;
        $selectprofit=$db->link->query("SELECT SUM(`profit`),SUM(`return_profit`) FROM `fixed_deposit_collections` WHERE `member_id`='$fetch_info[registration_id]'");
        if($selectprofit->num_rows>0)
        {
            $fetch_Profit=$selectprofit->fetch_array();
            $netprofit=round($fetch_Profit[0]-$fetch_Profit[1],2)+$profit;
            $totalNetProft=$totalNetProft+$netprofit;
            print $netprofit;
        }
  

?>&nbsp;</td>



                <?php 
                $c=0;
                $c=intval($m1);
                while($c<=intval($m2))
                {
                    if($c<10)
                    {
                        $date=$year.'-'.'0'.$c;
                    }
                    else
                    {
                        $date=$year.'-'.$c;
                    }


                    $selectcollection=$db->link->query("SELECT sum(`return_profit`) as 'return_profit', sum(`deposit_ammount`) as 'deposit_ammount', sum(`return_deposit`) as 'return_deposit' FROM `fixed_deposit_collections` WHERE `member_id`='$fetch_info[registration_id]' and `collection_date` like '%$date%'");


                    if($fetch_collection=$selectcollection->fetch_array())
                    {


                ?>
                   <td valign="center" style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;">
                    <?php $profit=intval($fetch_collection['return_profit']); if($profit>0) echo $profit; ?>
                        &nbsp;
                    </td>
                    <td valign="center"style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">
                        <?php $deposit=intval($fetch_collection['deposit_ammount']); if($deposit>0)echo $deposit;?>
                          &nbsp;  
                        </td>
                    <td valign="center" style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;">
                        <?php $returnDeposit=intval($fetch_collection['return_deposit']); if($returnDeposit>0)echo $returnDeposit; ?>
                           &nbsp; 
                        </td>
                    <td valign="center"style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: right;"></td>
                  

                <?php
                    }
                    $c++;
                }
                ?>




</tr>





<?php
     }
}
}

?>
<tr>
                
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;  text-align: center;" colspan="4">মোট সদস্য : <?php echo $i-1; ?></td>

   
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;" colspan="2">মোট সঞ্চিত অর্থ পরিমাণ : </td>
    <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;" align="right"><?php  print @$db->my_money_format($toalAmount); ?>/-&nbsp;</td>   

     <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;" align="right"><?php  print @$db->my_money_format($oldProfit); ?>/-&nbsp;</td>   


     <td style="border-left: 1px #000 solid;border-bottom: 1px #000 solid;" align="right"><?php  print @$db->my_money_format($totalProfit); ?>/-&nbsp </td>


    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;"><?php  print @$db->my_money_format($totalNetProft); ?>/-&nbsp;</td>


                <?php 
                $c=0;
                $c=intval($m1);
                while($c<=intval($m2))
                {
                      if($c<10)
                    {
                        $date=$year.'-'.'0'.$c;
                    }
                    else
                    {
                        $date=$year.'-'.$c;
                    }


                    $selectcollectionFixed=$db->link->query("SELECT sum(`fixed_deposit_collections`.`return_profit`) as 'return_profit', sum(`fixed_deposit_collections`.`deposit_ammount`) as 'deposit_ammount', sum(`fixed_deposit_collections`.`return_deposit`) as 'return_deposit' FROM `fixed_deposit_collections` INNER JOIN `fixed_deposit_registrations` ON `fixed_deposit_collections`.`member_id` =`fixed_deposit_registrations`.`registration_id` WHERE `fixed_deposit_collections`.`branch_id`='$branch_id' AND `fixed_deposit_registrations`.`schema_id`='$schema_id' AND `fixed_deposit_collections`.`area_id`='$area_id'  AND `fixed_deposit_registrations`.`status`='1' AND `fixed_deposit_collections`.`collection_date` like '%$date%'");


                    if($fetch_collectionFixed=$selectcollectionFixed->fetch_array())
                    {
                ?>
                    <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;"><?php $rp= intval($fetch_collectionFixed['return_profit']); if($rp>0) echo $rp;?>&nbsp;</td>
                    <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;"><?php $da= intval($fetch_collectionFixed['deposit_ammount']); if($da>0) echo $da; ?>&nbsp;</td>
                    <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;"><?php $rd= intval($fetch_collectionFixed['return_deposit']); if($rd>0) echo $rd;?>&nbsp;</td>
                    <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: right;"></td>
                <?php
                    }
                    $c++;
                }
                ?>


  
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