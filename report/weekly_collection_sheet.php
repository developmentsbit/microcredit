<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="icon" href="logo.png" type="image/x-icon">
   <script type="text/javascript" src="jquery-1.11.3.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Collection Entry</title>
    <style>
        *{
            padding: 0px; margin:0px;
        }
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

    <script type="text/javascript">

      investCollectIonfun();

        function sl_update()
        {
            var lower = parseInt($('#lower').val());
            if(lower==1)
              lower=0;
            var upper = parseInt($('#upper').val());
            var val=lower+upper;
            $('#lower').val(val);
        }

        function investCollectIonfun()
        {
           var checking_html = '<img src="loading.gif" /> <br> Loading...';
           $('#sms').html(checking_html);

           $('#sms').val("");  
           let url = new URL(window.location.href);
           let searchParams = new URLSearchParams(url.search);
           let branch_id=searchParams.get('branch_id');  

           if(branch_id=="")
           {
              alert("Select Branch Name");
              return 0;
           }
           let area_id=searchParams.get('area_id');  
           if(area_id=="")
           {
              alert("Select Kandro Name");
              return 0;
           }
           let schema_id=searchParams.get('schema_id');  
           if(schema_id=="")
           {
              alert("Select Schema Name");
              return 0;
           }

           let day=searchParams.get('day');  
           if(day=="")
           {
              alert("Select Day");
              return 0;
           }

           let month=searchParams.get('month');  
           if(month=="")
           {
              alert("Select month");
              return 0;
           }

            let year=searchParams.get('year');  
           if(year=="")
           {
              alert("Select Year");
              return 0;
           }



           let admin_id=searchParams.get('admin_id');  
           // alert(admin_id);
           if(admin_id=="")
           {
              alert("Login Your Account Again");
              return 0;
           }
           var lower =parseInt($('#lower').val()); 
           if(lower==1)
            lower=0;
           var upper =parseInt($('#upper').val());  
 
           
            if(upper=="")
            {
              alert("Put Upper Limit");
              
            }
            var investCollection="investCollection";
                    $.ajax({
                      url:"savings_invest_collection.php",
                      type:"POST",
                      data:{lower:lower,upper:upper,branch_id:branch_id,area_id:area_id,schema_id:schema_id,admin_id:admin_id,year:year,month:month,day:day,investCollection:investCollection},
                      cache:false,
                        success:function(result)
                        {
                          $('#sms').html(result);
                        }
                    });
        }


function calculateinvest(id,sl)
{
      var investcoll=0;
      for(j=1; j<=sl; j++)
      {
          var invest = document.getElementById(id+'-'+j).value;
          if(invest!="")
          {
             investcoll=parseInt(investcoll)+parseInt(invest);
          }
         

      }
          document.getElementById('totalinvest-'+id).value=investcoll;
     // alert(investcoll);
     // alert(id);
     // alert(sl);
       
}
    </script>
</head>

 <body>

    <table  cellpadding="0" cellspacing="0" style="border-bottom: 2px #000 dotted; width: 100%;" >
        <tr>    
            <td style="width:10%" align="right"></td>
            <td align="center">
                <label style="widtd:150px;">
                    <img src="logo.png"  style="max-height: 60px;max-widtd: 60px; float: left; clear: right;"></label>
                <label> 
                    <span style="font-size:20px; "> শ্যামল ছায়া সমাজকল্যাণ সংস্থা</span><br>
                    <span style="font-size:14px; ">আতা, মাদ্রা, নেছারাবাদ, পিরোজপুর ।<br>
                        scsks2016@gmail.com, Phone-01721653785, 01880668788</span><br>

                        <b style="font-size:14px; margin-bottom: 5px; ">সাপ্তাহিক সঞ্চয় ও ঋণ আদায় </b><br>
                </label>

            </td>
            <td style="width:20%"></td>
        </tr>
</table>

<form method="post" id="form" name="form" enctype="multipart/form-data">

   <table  cellpadding="0" cellspacing="0" style=" width: 100%; margin-top:2px;" >
          <tr>
              <td></td>
              <td align="center"> <label><input type="text" name="lower" class="form-control" id="lower" value="0" style="width: 100px;"></label>
              <label><input type="text" name="upper" class="form-control" id="upper" value="10" style="width: 100px;"></label>
              <label><input type="button" name="show" class="btn btn-success" value="Show" onclick="return investCollectIonfun(),sl_update()"></label></td>
              <td></td>
          </tr>

            <tr>
                <td colspan="3" id="sms"></td>
            </tr>

            <tr>
                <td colspan="3" id="result" ></td>
            </tr>
    </table>
  </form>


      </body>
</html>

