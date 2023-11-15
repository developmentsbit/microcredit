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
                            <h5 class="m-b-10">H / O প্রদান</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{route('ho_handover.index')}}">H / O প্রদান</a></li> --}}
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
                                <h5>H / O প্রদান</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                {{-- <a href="{{route('ho_handover.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> নতুন H/O প্রদান করুন</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="chkAll" onclick="chkAll()">
                                    </th>
                                    <th>সিরিয়াল নং</th>
                                    <th>তারিখ</th>
                                    <th>প্রদানকৃত ব্রাঞ্চ</th>
                                    <th>গ্রহীত ব্রাঞ্চ</th>
                                    <th>টাকার পরিমাণ</th>
                                    <th>বিস্তারিত</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>অ্যাকশান</th>
                                    <th>অ্যপ্রুভাল</th>
                                </tr>
                            </thead>
                            <tbody>

                              @php
                              $i = 1;
                              @endphp

                              @if(isset($data))
                              @foreach($data as $d)

                              <tr>
                                <td>
                                    <input onclick="chkAll()" id="chkNewHOhandover" type="checkbox" name="new_income[]" value="{{$d->id}}">
                                </td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $d->date }}</td>
                                <td>{{ $d->branch_name }}</td>
                                <td>{{ $d->branch_name2 }}</td>
                                <td>{{ $d->amount }}</td>
                                <td>{{ $d->details }}</td>
                                <td>
                                   @if($d->status == 1)
                                   <span class="btn btn-success btn-sm">Active</span>
                                   @else
                                   <span class="btn btn-danger btn-sm">Inactive</span>
                                   @endif
                               </td>

                               <td>

                                <a style="float: left;margin-right:10px;" href="{{route('ho_handover.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                <form action="{{ route('ho_handover.destroy',$d->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                </form>
                            </td>
                            <td>
                                <a href="{{url('/approved_newho_handover')}}/{{$d->id}}" class="btn btn-sm btn-dark">Approved</a>
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
            $('input#chkNewHOhandover').prop('checked',true);
        }
        else
        {
            // $('input#chkSavingReg').prop('checked',false);
        }


        if($('input#chkNewHOhandover').is(':checked'))
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

        $('#chkNewHOhandover:checked').each(function(key){

            id[key] = $(this).val();

            // alert(id);

            $.ajax({

                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('approveAllhoHandover') }}',

                type : 'POST',

                data : {new_ho_handover : id},

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
@endsection