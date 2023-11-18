<?php

require_once("db_connect.php");
$db = new database();
date_default_timezone_set("Asia/Dhaka");

$y=$_REQUEST['year'];
$m=$_REQUEST['month'];
$d=$_REQUEST['day'];

foreach ($db->getday($y, $m, $d) as $day) {
    $daycount=$daycount+1;
}


if (isset($_POST["investCollection"])) 
{   
    
        $lower=$_REQUEST['lower'];
        $upper=$_REQUEST['upper'];
        $branch_id=$_REQUEST["branch_id"];
        $area_id=$_REQUEST["area_id"];
        $schema_id=$_REQUEST["schema_id"];

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


    $select_schema_id=$db->link->query("SELECT * FROM `saving_schemas` WHERE `id`='$schema_id'");
    if($select_schema_id)
    {
        $fetchSchemaName=$select_schema_id->fetch_array();
    }

?>


<table  cellpadding="0" cellspacing="0"  style="width:100%;">
            <tr>
                <td  style="text-align: left; background: #f4f4f4; padding: 5px; ">ব্রাঞ্চ নাম: <b><?php print $branch_id?> <?php print $fetchBranchName['branch_name']?></b></td>
                <td  style="text-align: left;background: #f4f4f4;">কেন্দ্রের নাম: <b><?php print $fetchKandroName['area_name']?></b></td>
                <td  style="text-align: left;background: #f4f4f4;">স্কিমা নাম:<b> <?php print $fetchSchemaName['id']?> - <?php print $fetchSchemaName['deposit_name']?></b></td>
                <td  style="text-align: right;background: #f4f4f4;">তারিখ :<b><?php print date('d-m-Y h:i:sa'); ?>  </b></td>
            </tr>
</table>

    
<table cellpadding="0" cellspacing="0" style="width:100%;">
     <tr>
        <td style="border-left: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;" rowspan="3">ক্রমিক নং</td>
        <td style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" rowspan="3">সদস্যের নাম</td>        

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">  পিতা / স্বামীর নাম </td> 
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3"> ভর্তির তারিখ </td>

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3"> সঞ্চয় পরিমাণ </td>

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3"> মোট সঞ্চয় </td>
      

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" colspan="<?php print $daycount?>">সঞ্চয় আদায় &nbsp;</td>

           <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">এ মাসে মোট আদায় </td>        

           <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2"> এ মাসে সঞ্চয় উত্তোলন &nbsp;</td>

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">ঝুকি জমা &nbsp;</td>   

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">ঝুকি উত্তোলন &nbsp;</td>    

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">মোট ঝুকির পরিমাণ &nbsp;</td>    

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">ঋণ বিতরণের তারিখ</td>

         <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">ঋণ পরিমাণ &nbsp;</td>



        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">ঋণ পরিমাণ + মুনাফা &nbsp;</td>

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">আদায়যোগ্য ঋণ &nbsp;</td>       

         <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" colspan="<?php print $daycount ?>">ঋণ আদায় </td>        

<td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">এ মাসে মোট আদায় </td> 
<td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="3">প্রদেয় কিস্তি সংখ্য</td> 
         <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center; min-width: 80px;" rowspan="3">মন্তব্য</td>        
    </tr>    

    <tr>
       
        <?php 
        for($j=1;$j<=$daycount;$j++)
        {
        ?>
          <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">সাপ্তাহ - <?php echo $db->numberSystem($j); ?></td>
         <?php 
     }
     ?>
       
<!-- ////////////////////////// Invest  /////////////////////////////////////////////////////-->
        <?php 
        for($j=1;$j<=$daycount;$j++)
        {
        ?>
          <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">সাপ্তাহ - <?php echo $db->numberSystem($j); ?></td>
         <?php 
     }
     ?>
   
    </tr>       

    <tr>
       
    <?php
        $flag=0;
        foreach ($db->getday($y, $m, $d) as $day) {
            if($flag==0)
            {
                $firstDay=$day->format("d-m-Y");
            }
            $flag=1;
        ?>
    

        <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center; min-width: 70px;">
            <b><?php echo $day->format("d-m-Y");?></b>
        </td>
            <?php
        
    }

?>

 <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center; width: 80px;">
  
</td>

  <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;width: 80px;">

</td>

   <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;width: 80px;">
   
   </td>

<!-- ////////////////////////// Invest Collection Date /////////////////// -->
<?php

        foreach ($db->getday($y, $m, $d) as $day) {
            ?>
    

        <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center; min-width: 70px;">
             <b><?php echo $day->format("d-m-Y");?></b>

        </td>


            <?php
        
    }

?>
        

    </tr>    
<?php
$selectMember=$db->link->query("SELECT `saving_registrations`.`member_id`,`saving_registrations`.`application_date`,`saving_registrations`.`registration_id`,`saving_registrations`.`installment_ammount`,`saving_registrations`.`investment_id`,`members`.`aplicant_name`,`father_name`,`mother_name`,`investment_handovers`.`investment_amount`,`investment_handovers`.`date`,`investor_registrations`.`totalamount` FROM `saving_registrations` 
INNER JOIN `members` ON `members`.`member_id`=`saving_registrations`.`member_id` 
LEFT JOIN `investment_handovers` ON `investment_handovers`.`member_id`=`saving_registrations`.`investment_id` 
 LEFT JOIN `investor_registrations` ON `investor_registrations`.`registration_id`=`saving_registrations`.`investment_id` WHERE `saving_registrations`.`schema_id`='$schema_id' AND `saving_registrations`.`branch_id`='$branch_id' AND `saving_registrations`.`area_id`='$area_id'  ORDER BY `saving_registrations`.`id` ASC  LIMIT $lower,$upper");


$i=$lower+1;
if($selectMember->num_rows>0)
{
        while($fetch_info=$selectMember->fetch_array())
        {


?>
<tr>
      

        <td style="border-left:1px #000 solid;border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; "><?php print $i++;?></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: left; min-width: 100px; "> &nbsp;<?php print $fetch_info['aplicant_name'];?>
        </td> 
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: left; min-width: 100px; "> &nbsp; <?php print $fetch_info['father_name'];?>
        </td>
              
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; min-width: 60px; "> &nbsp; <?php print $db->custome_date($fetch_info['application_date']);?>
        </td>

        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; min-width: 50px; "> &nbsp; <?php print intval($fetch_info['installment_ammount']);?>
        </td>

           <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align:center "><?php 
           $totalSaving=$db->link->query("SELECT SUM(`deposit_ammount`)-SUM(`return_ammount`) FROM `saving_transactions` WHERE `member_id`='".$fetch_info['registration_id']."'");
           $fetchval=$totalSaving->fetch_array();
           print intval($fetchval[0]);

       ?> <input type="hidden" name="savingRegID[]" value="<?php print $fetch_info['registration_id'];?>">

            <input type="hidden" name="investRegID[]" value="<?php print $fetch_info['investment_id'];?>">
            <input type="hidden" name="member_id[]" value="<?php print $fetch_info['member_id'];?>">

           </td>


        <?php 
        for($j=1;$j<=$daycount;$j++)
        {
        ?>

         <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; "> 
           
         </td>

         <?php 
     }
     ?>
       
     
    
       

    

         <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; "> 

           
            
         </td>

         <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; "> 
            
         </td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; "> 
          
        </td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center;"> 
           
        </td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align:center;  "> 
            <?php 
           $totalriskAmount=$db->link->query("SELECT SUM(`risk_amount`)-SUM(`withdraw`) FROM `investor_riskamount` WHERE `member_id`='".$fetch_info['member_id']."'");
           $fetchriskAmount=$totalriskAmount->fetch_array();
           print intval($fetchriskAmount[0]);

       ?>

        </td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align:center; min-width: 60px; padding: 2px;"><?php echo $db->custome_date($fetch_info['date']);?></td>

         <td style="border-right:1px #000 solid; border-bottom:1px #000 solid;padding: 2px; text-align:center; "><?php echo $fetch_info['totalamount'];?></td>

          <td style="border-right:1px #000 solid; border-bottom:1px #000 solid;padding: 2px; text-align:center; "><?php echo $fetch_info['totalamount'];?></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid;text-align:center; ">
            <?php
            $totalInvestCollect=$db->link->query("SELECT SUM(`investment_collection`) FROM `investment_collections` WHERE `member_id`='".$fetch_info['investment_id']."'");
            if($totalInvestCollect->num_rows>0)
            {
                $fetchInvestCollect=$totalInvestCollect->fetch_array();
                echo $fetch_info['totalamount']-$fetchInvestCollect[0];
            }

            ?>
        </td>


        <?php 
        for($j=1;$j<=$daycount;$j++)
        {
        ?>

         <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center;">

           

         </td>

         <?php 
     }
     ?>

       
  
          <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center;">
        
          </td>


          <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center;">
        
          </td>

          <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center;">
        
          </td>
</tr>
<?php
        }
}
?>

           <tr class="print">
            <td colspan="21" align="center"><br>
                <input type="button" value="Print"  name="print" style="height:35px; width: 120px; background: green; color: #fff; border-radius:5px;" onclick="window.print()">
                
            </td>
        </tr>


</table>



<?php           
}

?>



