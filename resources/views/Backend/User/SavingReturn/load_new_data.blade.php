@if($data)
@foreach ($data as $v)
<tr>
    <td>
        <input onclick="chkAll()" id="chkSavingReturns" type="checkbox" name="saving_coll[]" value="{{$v->id}}">
    </td>
    <td>{{$sl++}}</td>
    <td>{{$v->date}}</td>
    <td>{{$v->branch_name}}</td>
    <td>{{$v->area_name}}</td>
    <td>{{$v->aplicant_name}}</td>
    <td>{{$v->return_ammount}}</td>
    <td>{{$v->profit_ammount}}</td>
    {{-- <td>{{$v->total}}</td> --}}
    <td>{{$v->comment}}</td>
    <td>
        {{-- <a style="float: left;margin-right:10px;" href="{{route('saving_return.edit',$v->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a> --}}
        <form action="{{ route('saving_return.destroy',$v->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
        </form>
    </td>
    <td>
        <a href="{{url('/approved_returns')}}/{{$v->id}}" class="btn btn-sm btn-dark">Approved</a>
    </td>
</tr>
@endforeach
@endif
