@if ($data)
@foreach ($data as $v)
    <tr>
        <td>
            <input onclick="chkAll()" id="chkNewInternallonColl" type="checkbox" name="new_income[]" value="{{$v->id}}">
        </td>
        <td>{{$v->serial_no}}</td>
        <td>{{$v->date}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->branch_name}}</td>
        <td>{{$v->ammount}}</td>
        <td>{{$v->description}}</td>
        <td>{{$v->first_name}} {{$v->last_name}}</td>
        <td>@if($v->status == 1) <div class="badge badge-success">Active</div>@else <div class="badge badge-danger">Inactive</div> @endif</td>
        <td>
            <a style="float: left;margin-right:10px;" href="{{route('internal_loan_collection.edit',$v->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
            <form action="{{ route('internal_loan_collection.destroy',$v->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
            </form>
        </td>
        <td>
            <a href="{{url('/approved_internalloan_collection')}}/{{$v->id}}" class="btn btn-sm btn-dark">Approved</a>
        </td>
    </tr>
@endforeach
@endif