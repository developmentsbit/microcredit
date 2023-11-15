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
                            <h5 class="m-b-10">অ্যাসেট সংক্রান্ত ব্যায়</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('add_asset_expense.index')}}">অ্যাসেট সংক্রান্ত ব্যায়</a></li>
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
                                <h5>অ্যাসেট সংক্রান্ত ব্যায়</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                {{-- <a href="{{route('add_asset_expense.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> অ্যাসেট সংক্রান্ত ব্যায় যু্ক্ত করুন</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row mb-4">
                            <div class="input-single-box col-4">
                                <label for="">ব্রাঞ্চ নির্বাচন করুন</label>
                                <select name="branch_id" id="branch_id" class="form-control js-example-basic-single" onchange="loadDataBranch()">
                                    <option value="">নির্বাচন করুন</option>
                                    @if($branch)
                                    @foreach ($branch as $v)
                                        <option value="{{$v->id}}">{{$v->branch_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="chkAll" onclick="chkAll()">
                                    </th>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>ব্রাঞ্চ নাম</th>
                                    <th>অ্যাসেট টাইটেল</th>
                                    <th>টাকার পরিমাণ</th>
                                    <th>বিস্তারিত</th>
                                    <th>অ্যাডমিন</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                    <th>অ্যাপ্রুভ</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                                @if ($data)
                                    @foreach ($data as $v)
                                        <tr>
                                            <td>
                                                <input onclick="chkAll()" id="chkNewAssetExpense" type="checkbox" name="new_income[]" value="{{$v->id}}">
                                            </td>
                                            <td>{{$v->serial_no}}</td>
                                            <td>{{$v->date}}</td>
                                            <td>{{$v->branch_name}}</td>
                                            <td>{{$v->asset_title}}</td>
                                            <td>{{$v->taka_ammount}}</td>
                                            <td>{{$v->description}}</td>
                                            <td>{{$v->name}} {{$v->last_name}}</td>
                                            <td>
                                                @if($v->status == 1)
                                                <div class="badge badge-success">Active</div>
                                                @else
                                                <div class="badge badge-danger">Inactive</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a style="float: left;margin-right:10px;" href="{{route('add_asset_expense.edit',$v->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                                <form action="{{ route('add_asset_expense.destroy',$v->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{url('/approved_assetexpense')}}/{{$v->id}}" class="btn btn-sm btn-dark">Approved</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <input type="button" class="btn btn-success btn-sm" value="Approve All" disabled id="approveAll" onclick="approveAllData()">
                    </div>
                </div>
            </div>
            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
        <script>
            function chkAll()
            {
                if($('#chkAll').is(':checked'))
                {
                    $('input#chkNewAssetExpense').prop('checked',true);
                }
                else
                {
                    // $('input#chkSavingReg').prop('checked',false);
                }
        
        
                if($('input#chkNewAssetExpense').is(':checked'))
                {
                    $('#approveAll').prop('disabled',false);
                }
                else
                {
                    $('#approveAll').prop('disabled',true);
        
                }
            }
        </script>
        <script>
            function approveAllData()
            {
        
                var id = [];
        
                $('#chkNewAssetExpense:checked').each(function(key){
        
                    id[key] = $(this).val();
        
                    // alert(id);
        
                    $.ajax({
        
                        headers:{
                            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                        },
        
                        url : '{{ url('approveNewAssetExpense') }}',
        
                        type : 'POST',
        
                        data : {new_asset_expense : id},
        
                        success : function(data)
                        {
                            // console.log(data);
                            if(data == 1)
                            {
                                location.reload(true)
                            }
                        }
                        
                    });
        
                });
                
            }
        </script>

<script>
    function loadDataBranch()
    {
        var branch_id = $('#branch_id').val();

        if(branch_id == "")
        {
            location.reload(true)
        }
        else
        {
            $.ajax({

                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('loadBranchAssetExpense') }}',

                type : 'POST',

                data : {branch_id},

                success : function(data)
                {
                    // alert(data);
                    $('#table_data').html(data);
                }

            });
        }
    }
</script>
@endsection