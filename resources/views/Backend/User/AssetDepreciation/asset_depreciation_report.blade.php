@extends('Backend.Layouts.master')
@section('body')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">অ্যাসেট ডিপ্রেসিয়েশন রিপোর্ট</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{route('add_asset_expense.index')}}">অ্যাসেট সংক্রান্ত ব্যায়</a></li> --}}
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
                        <h5>অ্যাসেট ডিপ্রেসিয়েশন রিপোর্ট</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/assetDepreciationReportShow')}}" method="POST" form-target="_blank">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <label>অ্যাসেট ক্যাটাগরি</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('asset_title_id') is-invalid @enderror" name="asset_title_id">
                                            <option value="all">সবগুলো</option>
                                            @if ($asset_title)

                                            @foreach ($asset_title as $v)
                                            <option value="{{$v->id}}">{{$v->asset_title}}</option>
                                            @endforeach

                                            @endif
                                        </select>
                                    </div>
                                    @error('asset_title_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- hidden input --}}
                            <input type="text" hidden name="admin_id" value="{{Auth::user()->id}}">
                            {{-- hidden input --}}
                            <div class="submit-btn">
                                <input type="submit" class="btn btn-sm btn-success" value="রিপোর্ট দেখুন" formtarget="_blannk">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
        <script>
            $('.date').datepicker({
            'format': 'd/m/yyyy',
            'autoclose': true
        });
        </script>

        <script>
            $('#from_date').hide();
            $('#to_date').hide();
            function showdate()
            {

                var report_type = $('#report_type').val();

                if(report_type == "date_to_date")
                {
                    $('#from_date').show();
                    $('#to_date').show();


                }
                else
                {
                    $('#from_date').hide();
                    $('#to_date').hide();


                }
            }

        </script>

@endsection
