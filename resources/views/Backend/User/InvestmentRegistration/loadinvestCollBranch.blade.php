 @php
 $i = 1;
 @endphp


 @if(isset($data))
 @foreach($data as $d)
 <tr>
     <td><input onclick="chkAll()" id="chkSavingReg" type="checkbox" name="investor_reg[]" value="{{$d->id}}"></td>
     <td>{{ $i++ }}</td>
     <td>{{ $d->date }}</td>
     <td>{{ $d->registration_id }}</td>
     <td>{{ $d->branch_name }}</td>
     <td>{{ $d->area_name }}</td>
     <td>{{ $d->aplicant_name }}</td>
     <td>{{ $d->phone }}</td>
     <td>{{ $d->investment_name }}</td>


     <td>

        <a style="float: left;margin-right:10px;" href="{{route('investment_registration.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
        <form action="{{ route('investment_registration.destroy',$d->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
        </form>

    </td>

    <td>
        <a href="{{url('investor_approve')}}/{{$d->id}}" class="btn btn-dark btn-sm">Approve</a>
        <a href="{{url('viewinvestment')}}/{{$d->id}}" target="blank" class="btn btn-dark btn-sm">View</a>
    </td>

</tr>

@endforeach
@endif