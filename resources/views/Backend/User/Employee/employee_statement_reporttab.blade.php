
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
    <title>কর্মকর্তা / কর্মচারী স্টেটমেন্ট</title>
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
                        <td colspan="8"><h4>কর্মকর্তা / কর্মচারীদের তথ্য</h4></td>
                    </tr>




                    <tr>
                        <th>তারিখ:</th>
                        <td>{{ date('d M Y') }}</td>

                        <th>ব্রাঞ্চ নাম:</th>
                        <td>{{ $branch->branch_name }}</td>
                        {{--
                        <th>অ্যাসেট টাইটেল:</th>
                        <td>{{ $asset_title->asset_title }}</td> --}}

                        <th>রিপোর্ট টাইপ:</th>
                        <td>@if($report_type == 1) কর্মকর্তা @elseif($report_type == 'all') সবগুলো  @else কর্মচারী  @endif</td>

                    </tr>
                </table>


                <table class="table-bordered w-100 mt-3" style="text-align: left;">

                    <thead>
                        <tr>
                            <th>সিরিয়াল</th>
                            <th style="width: 10%;">নাম</th>
                            <th style="width: 10%;">ফোন</th>
                            <th style="width: 10%;">ফোন ২</th>
                            {{-- <th style="width: 10%;">ই-মেইল</th> --}}
                            <th style="width: 10%;">পিতার নাম</th>
                            <th style="width: 10%;">মাতার নাম</th>
                            {{-- <th>জন্ম তারিখ</th> --}}
                            <th style="width: 10%;">লিঙ্গ</th>
                            {{-- <th>ধর্ম</th> --}}
                            <th style="width: 10%;">বর্তমান ঠিকানা</th>
                            {{-- <th>স্থায়ী ঠিকানা</th> --}}
                            <th style="width: 10%;">জাতীয় পরিচয় পত্র নাম্বার</th>
                            <th style="width: 10%;">যোগদানের তারিখ</th>
                            <th style="width: 10%;">ছবি</th>

                        </tr>
                    </thead>

                  <tbody>
                    @if($data)
                    @foreach ($data as $d)
                        <tr>
                          <td>{{ $d->sl }}</td>
                          <td><b>{{ $d->name }}</b></td>
                          <td>{{ $d->phone }}</td>
                          <td>{{ $d->phone2 }}</td>
                          {{-- <td>{{ $d->email }}</td> --}}
                          <td>{{ $d->fathers_name }}</td>
                          <td>{{ $d->mothers_name }}</td>
                          {{-- <td>{{ $d->date_of_birth }}</td> --}}
                          <td>{{ $d->gender }}</td>
                          {{-- <td>{{ $d->religion }}</td> --}}
                          <td>{!! $d->present_address !!}</td>
                          {{-- <td>{!! $d->permenant_address !!}</td> --}}
                          <td>{{ $d->nid_no }}</td>
                          <td>{{ $d->join_date }}</td>
                          <td>
                            @php
                            $path = base_path().'/Backend/images/EmployeeImage/'.$d->image;
                            @endphp
                            @if(file_exists($path))
                            <img src="{{asset('Backend/images/EmployeeImage')}}/{{$d->image}}" class="" style="height: 50px;width:50px;border-radius:100%;">
                            @endif
                          </td>
                      </tr>

                      @endforeach
                      @endif

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

    table, tr, td{
        padding-left: 5px;
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



