@extends('Backend.Layouts.master')
@section('body')

@php
Use App\Models\admin_branch_info;
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
                            <h5 class="m-b-10">আয়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_income.index')}}">আয়</a></li>
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
                        <h5>আয় যুক্ত করুন</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('add_income.update',$data->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-sm-6 mb-3 d-none">
                                    <label for="validationCustomUsername">সিরিয়াল নং</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="{{ $data->sl }}">
                                    </div>
                                    <input type="hidden" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="1">
                                    @error('sl')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                $explode = explode('-',$data->date);

                                $date = $explode[2].'/'.$explode[1].'/'.$explode[0];
                                @endphp
                                <div class="col-sm-6 mb-3">
                                    <label for="validationCustomUsername">তারিখ</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <input type="text" class="date form-control-sm form-control @error('date') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="date" value="{{ $date }}" required="">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <label>ব্রাঞ্চ নাম</label><span class="text-danger">*</span>
                                    <div class="input-group">
                                        <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="" required="">

                                            @php


                                            if(Auth::user()->user_role == 1) {
                                                $admin_branch = DB::table("branch_infos")->get();
                                            }
                                            else{

                                                $admin_branch = admin_branch_info::where('admin_branch_infos.admin_id',Auth::user()->id)
                                                ->join('branch_infos','branch_infos.id','=','admin_branch_infos.branch_id')
                                                ->select('branch_infos.*')
                                                ->get();

                                            }
                                            @endphp

                                            @if($admin_branch)
                                            @foreach($admin_branch as $showbranch)

                                            <option value="{{ $showbranch->id }}" <?php if ($showbranch->id == $data->branch_id) {
                                               echo "selected";
                                           } ?>>{{ $showbranch->branch_name }}</option>

                                           @endforeach
                                           @endif

                                       </select>
                                   </div>
                                   @error('branch_id')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                   @enderror
                               </div>



                               <div class="col-sm-6 mb-3">
                                <label for="validationCustomUsername">আয় খাতের নাম</label><span class="text-danger">*</span>
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control @error('title_id') is-invalid @enderror" name="title_id" required="">

                                        @php
                                        $incometitle = DB::table("income_titles")->where("status",1)->get();
                                        @endphp

                                        @if(isset($incometitle))
                                        @foreach($incometitle as $i)
                                        <option value="{{ $i->id }}" <?php if ($i->id == $data->title_id) {
                                           echo "selected";
                                       } ?>>{{ $i->title }}</option>
                                       @endforeach
                                       @endif
                                   </select>
                               </div>
                               @error('title_id')
                               <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                           </div>
                           <div class="col-sm-6 mb-3">
                            <label for="validationCustomUsername">বিস্তারিত</label>
                            <div class="input-group">
                                <textarea class="form-control" name="details">{{ $data->details }}</textarea>
                            </div>
                            @error('details')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="validationCustomUsername">টাকার পরিমাণ</label><span class="text-danger">*</span>
                            <div class="input-group">
                                <input type="text" class="onlyEng form-control-sm form-control @error('amount') is-invalid @enderror" id="validationCustomUsername" placeholder="টাকার পরিমাণ" aria-describedby="inputGroupPrepend" name="amount" value="{{ $data->amount }}" required="">
                            </div>
                            @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="validationCustomUsername">নোট</label>
                            <div class="input-group">
                                <input type="text" class="form-control-sm form-control @error('comment') is-invalid @enderror" id="validationCustomUsername" placeholder="" aria-describedby="inputGroupPrepend" name="comment" value="{{ $data->comment }}">
                            </div>
                            @error('comment')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="validationCustomUsername">স্ট্যাটাস</label><span class="text-danger">*</span>
                            <div class="input-group">
                                <select class="form-control-sm form-control @error('status') is-invalid @enderror" name="status">

                                    @if($data->status == 1)
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    @else
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>

                                    @endif
                                </select>
                            </div>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- hidden input --}}
                    <input type="text" hidden name="admin_id" value="{{Auth::user()->id}}">
                    {{-- hidden input --}}
                    <div class="submit-btn">
                        <input type="submit" class="btn btn-sm btn-success" value="সেভ করুন">
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
@endsection
