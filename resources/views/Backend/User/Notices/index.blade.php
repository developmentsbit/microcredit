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
                            <h5 class="m-b-10"> নোটিশ</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('notices.index')}}"> নোটিশ যুক্ত করুন</a></li>
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
                        <div class="row">
                            <div class="col-6">
                                <h5> নোটিশ</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{route('notices.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i>  নোটিশ যু্ক্ত করুন</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>

                                    <th>সিরিয়াল নং</th>
                                    <th>প্রকাশের তারিখ</th>
                                    <th>টাইটেল</th>
                                    <th>বিস্তারিত</th>
                                    <th>ফাইল/ছবি</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($data)
                            @foreach ($data as $v)
                            <tr>

                                <td>{{$i++}}</td>
                                <td>{{$v->published_date}}</td>
                                <td>{{$v->title}}</td>
                                <td>{{$v->description}}</td>
                                <td>
                                    @php
                                    $path = base_path().'/Backend/Notices/'.$v->file;
                                    @endphp
                                    @if(file_exists($path))
                                    <a target="_blank" href="{{asset('/Backend/Notices')}}/{{$v->file}}" class="btn btn-sm btn-info">View File</a>
                                    @endif
                                </td>
                                <td>@if($v->status == 1) <div class="badge badge-success">Active</div>@else <div class="badge badge-danger">Inactive</div> @endif</td>
                                <td>
                                    @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 || $v->approval == 0)
                                    <a style="float: left;margin-right:10px;" href="{{route('notices.edit',$v->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                    <form action="{{ route('notices.destroy',$v->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="" type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                    </form>
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
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
@endsection
