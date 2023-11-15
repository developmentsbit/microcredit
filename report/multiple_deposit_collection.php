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
    <script type="text/javascript">

        function sl_update()
        {
            var lower = parseInt($('#lower').val());
            var upper = parseInt($('#upper').val());
            var val=lower+upper;
            $('#lower').val(val);
        }

        function investCollectIonfun()
        {
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
           let admin_id=searchParams.get('admin_id');  
           let year=searchParams.get('year');  
           let month1=searchParams.get('month1');  
           let date=searchParams.get('date');  
           // alert(admin_id);
           if(admin_id=="")
           {
              alert("Login Your Account Again");
              return 0;
           }
           var lower =parseInt($('#lower').val()); 
           var upper =parseInt($('#upper').val());  
 
           
            if(upper=="")
            {
              alert("Put Upper Limit");
              
            }
            var investCollection="investCollection";
                    $.ajax({
                      url:"ajaxFixedDepositCollection.php",
                      type:"POST",
                      data:{lower:lower,upper:upper,branch_id:branch_id,area_id:area_id,schema_id:schema_id,admin_id:admin_id,investCollection:investCollection,month1:month1,year:year,date:date},
                      cache:false,
                        success:function(result)
                        {
                          $('#sms').html(result);
                        }
                    });
        }

function profit_provide_collection()
{
        document.getElementById("save_data").disabled = true;
          $('#resultshow').html("");
          var form=$('form')[0];
          var formData=new FormData(form);

            $.ajax({
                      url:"ajaxdeposit_collection_entry.php",
                      type:"POST",
                      data:formData,
                      contentType:false,
                      processData:false,

                        success:function(result)
                        {
                           $('#resultshow').html(result);
                          
                           investCollectIonfun();
                           sl_update();
                            document.getElementById("save_data").disabled = false;
                        }
                    });
}

    </script>
</head>

  <body>

      <table class="table  " align="center" width="100%"  bgcolor="#f4f4f4">
        <tr>
          <td colspan="2"><h3>Collection Entry</h3></td>
        </tr>
            
        <tr>
            <td>Range</td>
            <td align="left">
              <label><input type="text" name="lower" class="form-control" id="lower" value="0"></label>
              <label><input type="text" name="upper" class="form-control" id="upper" value="10"></label>
              <label><input type="button" name="show" class="btn btn-success" value="Show" onclick="return investCollectIonfun(),sl_update()"></label>
            </td>
        </tr>     
        <tr><td><br></td><td><br></td></tr>  
      </table>
     <form method="post" enctype="multipart/form-data">
      <div id="sms"> </div>
    <span id="resultshow"> </span><br>
     </form>
      </body>
</html>

