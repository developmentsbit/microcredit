@extends('Backend.Layouts.master')
@section('body')


@php
Use App\Models\admin_branch_info;
Use App\Models\branch_info;
@endphp





<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">ঝুঁকি উত্তোলন</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{url('riskamount_withdraw')}}">ঝুঁকি উত্তোলন</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- table card-1 start -->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>ঝুঁকি উত্তোলন করুন</h5>
          </div>
          <div class="card-body">
            <form action="{{ url('investment_riskamountstore')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
               
                <div class="col-sm-6 mb-3">
                  <label>ব্রাঞ্চ নাম <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" id="branch_id" onchange="loadArea()">
                      <option value="">নির্বাচন করুন</option>
                      @php
                      if(Auth::user()->user_role == 1)
                      {
                        $admin_branch = branch_info::where('status',1)->get();
                      }
                      else {

                        $admin_branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                        ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                        ->select('branch_infos.*')
                        ->get();
                      }

                      @endphp

                      @if($admin_branch)
                      @foreach($admin_branch as $showbranch)

                      <option value="{{ $showbranch->id }}">{{ $showbranch->branch_name }}</option>

                      @endforeach
                      @endif

                    </select>
                  </div>
                  @error('branch_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>


                <div class="col-sm-6 mb-3">
                  <label>কেন্দ্র নাম <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <select class="js-example-basic-single form-control @error('area_id') is-invalid @enderror" name="area_id" required="" id="area_id" onchange="loadMember()">
                      <option value="">নির্বাচন করুন</option>

                    </select>
                  </div>
                  @error('area_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <input type="hidden" name="entry_date" value="{{ date('Y-m-d') }}">


                <div class="col-sm-8 mb-3">
                  <label>মেম্বার নাম <span class="text-danger">*</span></label>
                  <div class="input-group">



                    <select class="js-example-basic-single form-control @error('member_id') is-invalid @enderror" name="member_id" id="member_id" required="" onchange="getinvestmentamount();">
                      <option value="">নির্বাচন করুন</option>

                    </select>
                  </div>
                  @error('member_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>



                <div class="col-sm-4 mb-3">
                  <label>ঝুঁকি উত্তোলন<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="text" class="onlyEng form-control form-control-sm @error('withdraw') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="withdraw" value="{{old('withdraw')}}" required="" id="withdraw">
                  </div>
                  @error('withdraw')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>


{{--
                                <div class="col-sm-3 mb-3">
                                    <label>সার্ভিস চার্জ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm @error('service_charge') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="service_charge" value="{{old('service_charge')}}" required="">
                                    </div>
                                    @error('service_charge')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                --}}



                                <div class="col-sm-6 mb-3">
                                  <label>মন্তব্য</label>
                                  <input type="text" class="form-control form-control-sm @error('comment') is-invalid @enderror" aria-describedby="inputGroupPrepend" name="comment" value="{{old('comment')}}">
                                </div>
                                @error('comment')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                              </div>
                            </div>
                            {{-- hidden input --}}
                            <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                            <div class="submit-btn">
                              <input type="submit" class="btn btn-success" value="সেভ করুন">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Latest Customers end -->
                  </div>
                  <!-- [ Main Content ] end -->







                  <!-- [ Main Content ] end -->
                  <script type="text/javascript">
                    function loadArea()
                    {
                      var branch_id = $('#branch_id').val();

                // var default = "<option value=''>নির্বাচন করুন</option>";

                // alert(branch_id);
                if(branch_id == "")
                {
                  $('#area_id').html("");
                }
                else
                {
                  $.ajax({
                    headers : {
                      'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('loadArea') }}',

                    type : 'POST',

                    data : {branch_id},

                    success : function(data)
                    {
                      $('#area_id').html(data);
                            // alert(data);
                          }
                        });
                }
              }
            </script>


            <script>
              function loadMember()
              {
                var area_id = $('#area_id').val();
                // alert(area_id);
                var branch_id = $('#branch_id').val();
                // alert(branch_id);
                if(area_id == "")
                {

                }
                else
                {
                  $.ajax({

                    headers : {
                      'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },

                    url : '{{ url('loadMember4') }}',

                    type : 'POST',

                    data : {area_id,branch_id},

                    success : function(data)
                    {
                      $('#member_id').html(data);
                            // alert(data);
                          }

                        });
                }
              }
            </script>




            <script>
              function getinvestmentamount()
              {

                var member_id = $("#member_id").val();

                $.ajax({

                  headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                  },

                  url : '{{ url('getinvestmentamount') }}/'+member_id,

                  type : 'GET',

                  success : function(response)
                  {
                    $('#investment_amount').val(response);
                  }

                });

              }
            </script>






            <script>
              $('.date').datepicker({
                'format': 'd/m/yyyy',
                'autoclose': true
              });
            </script>





            @endsection
