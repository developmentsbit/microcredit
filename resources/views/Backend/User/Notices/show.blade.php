@extends('Backend.Layouts.master')
@section('body')


@php
Use App\Models\admin_branch_info;

$today_date = date('d/m/Y');
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
                            <h5 class="m-b-10">নোটিশ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('ho_collection.index')}}"></a></li>
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
                        <h5>নোটিশ</h5>
                    </div>
                    <div class="card-body">
                        <h4>{{$data['notice']->title}}</h4>
                        <b>প্রকাশ করেছেন : </b> <span>{{$data['publisher']->name}}</span><br>
                        <b>প্রকাশ তারিখ : </b> <span>{{$data['notice']->published_date}}</span>
                        <hr>
                        {!! $data['notice']->description  !!}
                        <hr>

                        @php
                        $path = base_path().'/Backend/Notices/'.$data['notice']->file;
                        @endphp

                        @if(file_exists($path))

                        @php
                        $explodeFile = explode('.',$data['notice']->file);
                        $extension = $explodeFile[1];
                        @endphp

                        @if($extension == 'pdf')
                        <div class='embed-responsive' style='padding-bottom:150%'>
                        <object data="{{ asset('/Backend/Notices/'.$data['notice']->file) }}" type='application/pdf' width='100%' height='100%'></object>
                        </div>
                        @else

                        <img src="{{asset('/Backend/Notices')}}/{{$data['notice']->file}}" alt="" height="120px;">
                        @endif


                        @endif
                    </div>
            </div>
        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
    <script>
        $('.date').datepicker({
        'format': 'dd/mm/yyyy',
        'autoclose': true
    });
    </script>
    @endsection
