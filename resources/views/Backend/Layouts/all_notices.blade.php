@extends('Backend.Layouts.master')
@section('body')
<style>
    a.box-link {
    background: white;
    padding: 11px 12px;
    border-radius: 8px;
    box-shadow: 0px 3px 2px 1px;
    transition: .3s;
    margin-right: 15px;
    margin-top: 15px;
}

a.box-link:hover {
    background: #e3e0e0;
}
</style>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">সকল নোটিশ সমূহ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{url('/')}}">সকল নোটিশ সমূহ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->


        <div class="row mt-4 card-body bg-white">

            <div class="col-12">
                <table class="table table-bordered">
                    <tr>
                        <th>তারিখ</th>
                        <th>টাইটেল</th>
                        <th>অ্যাকশান</th>
                    </tr>
                    @if($data)
                    @foreach ($data as $v)

                    <tr>
                        <td>{{$v->published_date}}</td>
                        <td>{{$v->title}}</td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="{{route('notices.show',$v->id)}}">নোটিশ দেখুন</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>

        </div>
            <!-- Widget primary-success card start -->
            <!-- Widget primary-success card end -->

@endsection
