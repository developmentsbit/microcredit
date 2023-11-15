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
                            <h5 class="m-b-10"> কর্মকর্তা ও কর্মচারী বেতন প্রদান</h5>
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
                        <h5>    কর্মকর্তা ও কর্মচারী বেতন প্রদান</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('employee_salary_payment')}}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-sm-3 mb-3">
                                    <label for="validationCustomUsername">তারিখ</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control-sm form-control @error('date') is-invalid @enderror" id="validationCustomUsername" placeholder="" aria-describedby="inputGroupPrepend" name="date" value="{{ date('Y-m-d') }}">
                                    </div>
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-9 mb-3">
                                    <label for="validationCustomUsername">কর্মকর্তা ও কর্মচারী</label>
                                    <div class="input-group">

                                     <select class="form-control form-control-sm js-example-basic-single" name="employee_id" id="employee_id" onchange="gettotaldeposite()">
                                         <option value="">নির্বাচন করুন</option>

                                         @if(isset($data))
                                         @foreach($data as $d)

                                         <option value="{{ $d->id }}">{{ $d->name }}</option>

                                         @endforeach
                                         @endif
                                     </select>

                                 </div>
                                 @error('date')
                                 <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                             </div>


                             <div class="col-sm-3 mb-3">
                                <label for="validationCustomUsername">ডিপোজিট</label>
                                <div class="input-group">
                                    <input type="text" class="form-control-sm form-control" readonly="" id="deposite">
                                </div>
                            </div>

                            <div class="col-sm-4 mb-3">
                                <label for="validationCustomUsername">প্রদান</label>
                                <div class="input-group">
                                    <input type="text" class="form-control-sm form-control" name="salary_withdraw" id="salary_withdraw">
                                </div>
                            </div>

                            <div class="col-sm-5 mb-3">
                                <label for="validationCustomUsername">নোট</label>
                                <div class="input-group">
                                    <input type="text" class="form-control-sm form-control" name="note" id="note">
                                </div>
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





            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5>কর্মকর্তা ও কর্মচারী বেতন প্রদান তথ্য</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>নাম</th>
                                    <th>প্রদান</th>
                                    <th>মন্তব্য</th>
                                    <th>অ্যাকশান</th>
                                </tr>
                            </thead>
                            <tbody>


                                @php
                                $i = 1;
                                @endphp

                                @if(isset($datas))
                                @foreach($datas as $d)

                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $d->date }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->salary_withdraw }}</td>
                                    <td>{{ $d->note }}</td>
                                    <td>
                                        <a href="{{ url("employee_salary_delete/".$d->id) }}" class="btn btn-danger">Delete</a>

                                    </td>
                                </tr>

                                @endforeach
                                @endif                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>





        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
    
    <script>

        function gettotaldeposite()
        {


            var employee_id = $('#employee_id').val();

            $.ajax({

                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('getdepositenumbers') }}/'+employee_id,

                type : 'GET',

                success : function(response)
                {
                    $('#deposite').val(response);
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