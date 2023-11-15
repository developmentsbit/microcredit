@if($data)
@foreach ($data as $showdata)
<tr>
    <td>
        <input onclick="chkAll()" id="chkSavingColl" type="checkbox" name="saving_coll[]" value="{{$showdata->id}}">
    </td>
    <td>{{$sl++}}</td>
    <td>{{$showdata->date}}</td>
    <td>{{$showdata->branch_name}}</td>
    <td>{{$showdata->area_name}}</td>
    <td>{{$showdata->aplicant_name}}</td>
    <td>{{$showdata->savings_ammount}}</td>
    <td>{{$showdata->service_charge}}</td>
    <td>{{$showdata->deposit_ammount}}</td>
    <td>{{$showdata->total}}</td>
    <td>{{$showdata->comment}}</td>
    <td>
        {{-- <a style="float: left;margin-right:10px;" href="{{route('saving_collection.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a> --}}
        <form action="{{ route('saving_collection.destroy',$showdata->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
        </form>
    </td>
    <td>
        <a href="{{url('/approved_collection')}}/{{$showdata->id}}" class="btn btn-sm btn-dark">Approved</a>
    </td>
</tr>
@endforeach
@endif