<?php

    include('db_connect.php');
    $db= new database();
    date_default_timezone_set("Asia/Dhaka");


    $branch_id=$_GET["branch_id"];
    $area_id=$_GET["area_id"];
    $schema_id=$_GET["schema_id"];



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
    <title>মাসিক সঞ্চয় ও মাসিক ঋণ আদায় শীট</title>
    
</head>
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
<body>

    <table  cellpadding="0" cellspacing="0" style="border-bottom: 2px #000 dotted; width: 100%;" >
        <tr>    
            <td style="width:10%" align="right"></td>
            <td align="center">
                <label style="widtd:150px;">
                    <img src="logo.png"  style="max-height: 100px;max-widtd: 120px; float: left; clear: right;"></label>
                <label> 
                    <span style="font-size:30px; "> শ্যামল ছায়া সমাজকল্যাণ সংস্থা</span><br>
                    <span style="font-size:16px; ">আতা, মাদ্রা, নেছারাবাদ, পিরোজপুর ।<br>
                        scsks2016@gmail.com, Phone-01721653785, 01880668788</span><br>

                        <b style="font-size:18px; margin-bottom: 5px; ">মাসিক কালেকশান শীট</b><br>
                </label>

            </td>
            <td style="width:20%"></td>
        </tr>
    </table>
<br>


   <table  cellpadding="0" cellspacing="0"  style="width:100%;">
            <tr>
                <td  style="text-align: left; background: #f4f4f4; padding: 5px; ">ব্রাঞ্চ নাম: <b><?php print $branch_id?> <?php print $fetchBranchName['branch_name']?></b></td>
                <td  style="text-align: left;background: #f4f4f4;">কেন্দ্রের নাম: <b><?php print $fetchKandroName['area_name']?></b></td>
                <td  style="text-align: left;background: #f4f4f4;"></td>
                <td  style="text-align: right;background: #f4f4f4;">প্রিন্ট সময় ও তারিখ :<b><?php print date('d-M-Y h:i:sa'); ?>  </b></td>
            </tr>
</table>

    
<table cellpadding="0" cellspacing="0" style="width:100%;">
    <tr>
        <td style="border-left: 1px #000 solid; border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align: center;" rowspan="2">ক্রমিক নং</td>
        <td style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" rowspan="2">সদস্যের নাম</td>        
        <td style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" rowspan="2">&nbsp;সঞ্চয় আইডি</td>
        <td style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" rowspan="2">&nbsp;পিতা / স্বামীর নাম</td>
        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">ভর্তির তারিখ &nbsp;</td>

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2"> সঞ্চয় পরিমাণ &nbsp;</td> 

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">প্রারম্ভিক জের সঞ্চয়  &nbsp;</td>

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">ঝুকি তহবিল &nbsp;</td>    

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">ঋণ বিতরণের তারিখ &nbsp;</td>         

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">ঋণ বিতরণের পরিমাণ &nbsp;</td>    

        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center" rowspan="2">প্রারম্ভিক জের ঋণ &nbsp;</td> 



        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" colspan="6">জানুয়ারী - ০১ &nbsp;</td>


        <td  style="border-top: 1px #000 solid;border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;" colspan="6">ফেব্রুয়ারি - ০2 &nbsp;</td>

               

    </tr>    

    <tr>
       
        <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">তারিখ</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center"> সঞ্চয় আদায়</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center">ঋণ আদায় </td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center">সুদ আদায়</td>   
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center">বিবিধ</td> <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">ঝুকি তহ:</td>


           <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">তারিখ</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center"> সঞ্চয় আদায়</td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center">ঋণ আদায় </td>
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center">সুদ আদায়</td>   
        <td  style="border-right: 1px #000 solid;border-bottom: 1px #000 solid; text-align:center">বিবিধ</td> <td style="border-right: 1px #000 solid;border-bottom: 1px #000 solid;text-align: center;">ঝুকি তহ:</td>

   
    </tr>       


      
<?php
$selectMember=$db->link->query("SELECT `saving_registrations`.`application_date`,`registration_id`,`installment_ammount`,`investment_id`,`members`.`aplicant_name`,`father_name`,`mother_name` FROM `saving_registrations` INNER JOIN `members` ON `members`.`member_id`=`saving_registrations`.`member_id` WHERE `saving_registrations`.`schema_id`='$schema_id' AND `saving_registrations`.`branch_id`='$branch_id' AND `saving_registrations`.`area_id`='$area_id'");
$i=1;
if($selectMember->num_rows>0)
{
        while($fetch_info=$selectMember->fetch_array())
        {



?>
<tr>
      

        <td style="border-left:1px #000 solid;border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: center; "><?php print $i++;?></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: left; min-width: 100px; "> &nbsp;<?php print $fetch_info['aplicant_name'];?></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: left; width: 50px"> &nbsp;<?php print $fetch_info['registration_id'];?></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: left; "> &nbsp;<?php print $fetch_info['father_name'];?></td>        

        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: left; width: 60px; "> &nbsp;<?php print $fetch_info['application_date'];?></td>      

         <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; text-align: right; "> <?php print intval($fetch_info['installment_ammount']);?>&nbsp;</td>

       
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "> </td>
    
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
        
          <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
          <td style="border-right:1px #000 solid; border-bottom:1px #000 solid; "></td>
</tr>
<?php
        }
}
?>
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