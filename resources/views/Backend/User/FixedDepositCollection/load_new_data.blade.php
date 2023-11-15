@if($data)
@foreach ($data as $v)
<tr>
    <td>
        <input onclick="chkAll()" id="chkFixedDepoColl" type="checkbox" name="saving_coll[]" value="{{$v->id}}">
    </td>
    <td>{{$sl++}}</td>
    <td>{{$v->collection_date}}</td>
    <td>{{$v->branch_name}}</td>
    <td>{{$v->area_name}}</td>
    <td>{{$v->aplicant_name}} - {{$v->registration_id}}</td>
    <td>{{$v->deposit_ammount}}</td>
    <td>{{$v->service_charge}}</td>
    <td>{{$v->total}}</td>
    <td>{{$v->comment}}</td>
    <td>@if($v->status == 1) <div class="badge badge-success">Active</div>@else <div class="badge badge-danger">Inactive</div> @endif</td>
    <td>
        {{-- <a style="float: left;margin-right:10px;" href="{{route('fixeddeposit_collection.edit',$v->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a> --}}
        <form action="{{ route('fixeddeposit_collection.destroy',$v->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
        </form>
    </td>
    <td>
        <a href="{{url('/approved_fixed_depositcoll')}}/{{$v->id}}" class="btn btn-sm btn-dark">Approved</a>
    </td>
</tr>
@endforeach
@endif
