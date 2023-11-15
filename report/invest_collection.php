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
                      url:"invest_collection_form.php",
                      type:"POST",
                      data:{lower:lower,upper:upper,branch_id:branch_id,area_id:area_id,schema_id:schema_id,admin_id:admin_id,investCollection:investCollection},
                      cache:false,
                        success:function(result)
                        {
                          $('#sms').html(result);
                        }
                    });
        }

    </script>
</head>

  <body>
      <table class="table table-bordered table-secondary ">
        <tr>
          <td bgcolor="#f4f4f4" colspan="2"><h3>Collection Entry</h3></td>
        </tr>
            
        <tr>
          <td>Range</td>
            <td align="left">
              <label><input type="text" name="lower" class="form-control" id="lower" value="0"></label>
              <label><input type="text" name="upper" class="form-control" id="upper" value="10"></label>
              <label><input type="button" name="show" class="btn btn-success" value="Show" onclick="return investCollectIonfun(),sl_update()"></label>
            </td>
        </tr>       

    
        <tr>
        
            <td colspan="2" id="sms">
                  
            </td>
        </tr>   
      </table>
      </body>
</html>

