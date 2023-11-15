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
                            <h5 class="m-b-10">অ্যাডমিন লিংক এবং ব্রাঞ্চ প্রায়োরিটি</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{route('area_info.index')}}">কেন্দ্র</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        @php 
        use App\Models\main_menu_priority;
        @endphp
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>অ্যাডমিন লিংক এবং ব্রাঞ্চ প্রায়োরিটি</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin_priority.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <label>অ্যাডিমন নির্বাচন করুন</label>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control form-control-sm @error('admin_id') is-invalid @enderror" name="admin_id" onchange="loadBranchMenu()" id="admin_id"> 
                                            <option value="">নির্বাচন করুন</option>
                                            @if($admin)
                                            @foreach ($admin as $showadmin)
                                            <option value="{{$showadmin->id}}">{{$showadmin->name}} {{$showadmin->last_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('admin_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="data-ajax">

                            </div>
                            {{-- hidden input --}}
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
        <script>
            function loadBranchMenu()
            {
                var admin_id = $('#admin_id').val();

                if(admin_id == "")
                {
                    $('#data-ajax').html('');
                }
                else
                {
                    $.ajax({

                        headers : 
                        {
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },

                        url : '{{ url('loadBrnahcMenu') }}',

                        type : 'POST',

                        data : {admin_id},

                        success : function(data)
                        {
                            $('#data-ajax').html(data);
                        }

                    });
                }
            }
        </script>
@endsection