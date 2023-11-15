
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <title>আয়</title>
</head>
<body style="font-family: 'Montserrat','Tiro Bangla', serif; font-size: 14px;">

    @php
    $company_info = DB::table("company_informations")->first();
    @endphp


    <div class="container-fluid mt-4">


        <div class="card">
            <div class="card-header">
                <center>
                    <img src="{{ asset("Backend/images/".$company_info->logo) }}" class="img-fluid" style="height: 40px;">

                    <div class="mt-2">
                        <h5><strong>{{ $company_info->company_name }}</strong></h5>
                        <span>
                            {{ $company_info->address }}<br>
                            {{ $company_info->email }}<br>
                            Phone-{{ $company_info->phone }}, {{ $company_info->phone_2 }}<br>

                        </span>
                    </div>
                </center>
            </div>

            <div class="card-body">


                <table class="table-bordered w-100 text-center">

                    <tr>
                        <td colspan="8">আয় রিপোর্ট</td>
                    </tr>




                    <tr>
                        <th>তারিখ:</th>
                        <td>{{ date('d M Y') }}</td>

                        {{-- <th>ব্রাঞ্চ নাম:</th>
                        <td>{{ $branch->branch_name }}</td>

                        <th>অ্যাসেট টাইটেল:</th>
                        <td>{{ $asset_title->asset_title }}</td> --}}

                        <th>রিপোর্ট টাইপ:</th>
                        <td>@if($report_type == 1) সবগুলো @else {{$from_date}} - {{$to_date}}  @endif</td>

                    </tr>
                </table>


                <table class="table-bordered w-100 mt-3">

                    <thead>
                        <tr>
                            <th>সিরিয়াল</th>
                            <th>তারিখ</th>
                            <th>ব্রাঞ্চ নাম</th>
                            <th>আয় খাত</th>
                            <th>বিস্তারিত</th>
                            <th>অ্যাডমিন</th>
                            <th>টাকার পরিমাণ</th>

                        </tr>
                    </thead>

                  <tbody>
                    @if($data)
                    @foreach ($data as $d)
                        <tr>
                          <td>{{ $sl++ }}</td>
                          <td>{{ $d->date }}</td>
                          <td>{{ $d->branch_name }}</td>
                          <td>{{ $d->title }}</td>
                          <td>{{ $d->comment }}</td>
                          <td>{{ $d->name }} {{$d->last_name}}</td>
                          <td>{{ $d->amount }}</td>
                      </tr>

                      @endforeach
                      @endif

                      <tr>
                        <td colspan="6" style="text-align: right">মোট</td>
                        <td colspan="" style="font-weight: bold;">{{$total}}</td>
                      </tr>

                  </tbody>

              </table>

          </div>

      </div>



  </div>
  <br>
  <center><a href="#" class="btn btn-danger btn-sm print w-40" onclick="window.print();">Print Now</a></center><br>
</div>


</div>



<style type="text/css">
table{
    text-align: left;
}
table, tr, td,th{
    padding-left: 10px;
}
  @media  print
  {


    @page  {
        /*size: 7in 15.00in;*/
        margin: 1mm 1mm 1mm 1mm;
        padding: 10px;
    }

    .print{
        display: none;
    }

    .invoice span{
        font-size: 22px;
    }
    /*@page  { size: 10cm 20cm landscape; }*/

}

</style>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



