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
              <h5 class="m-b-10"> লোন গ্রাহক</h5>
            </div>

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
            <h5> লোন গ্রাহক যুক্ত করুন</h5>
          </div>
          <div class="card-body">
            <form action="{{route('loan_customer.update',$data->id)}}" method="POST">
              @csrf
              @method("put")
              <div class="row">
                <div class="col-sm-6 mb-3 d-none">
                  <label for="validationCustomUsername">সিরিয়াল নং</label>
                  <div class="input-group">
                    <input type="text" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="{{ $data->sl  }}">
                  </div>
                  @error('sl')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <input type="hidden" class="form-control-sm form-control @error('sl') is-invalid @enderror" id="validationCustomUsername" placeholder="Seral No" aria-describedby="inputGroupPrepend" name="sl" value="1">

                <div class="col-sm-6 mb-3">
                  <label> ব্রাঞ্চ নাম</label>
                  <div class="input-group">
                    <select class="js-example-basic-single form-control @error('branch_id') is-invalid @enderror" name="branch_id" required="">

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
                  <label for="validationCustomUsername">নাম</label>
                  <div class="input-group">
                    <input type="text" class="form-control-sm form-control @error('name') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="name" value="{{$data->name}}" required="">
                  </div>
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-6 mb-3">
                  <label for="validationCustomUsername">ফোন</label>
                  <div class="input-group">
                    <input type="text" class="form-control-sm form-control @error('phone') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="phone" value="{{$data->phone}}">
                  </div>
                  @error('phone')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-6 mb-3">
                  <label for="validationCustomUsername">ই-মেইল</label>
                  <div class="input-group">
                    <input type="text" class="form-control-sm form-control @error('email') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="email" value="{{$data->email}}">
                  </div>
                  @error('main_menu')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-6 mb-3">
                  <label for="validationCustomUsername">ঠিকানা</label>
                  <div class="input-group">
                    <textarea class="form-control" name="address">{{ $data->address }}</textarea>
                  </div>
                  @error('main_menu')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-6 mb-3">
                  <label for="validationCustomUsername">স্ট্যাটাস</label>
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
    @endsection