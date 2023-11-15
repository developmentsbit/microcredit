@php
                                $i = 1;
                                @endphp

                                @if(isset($data))
                                @foreach($data as $d)

                                <tr>
                                    <td>
                                        <input onclick="chkAll()" id="chkNewExpense" type="checkbox" name="new_income[]" value="{{$d->id}}">
                                    </td>
                                   <td>{{ $i++ }}</td>
                                   <td>{{ $d->date }}</td>
                                   <td>{{ $d->branch_name }}</td>
                                   <td>{{ $d->title }}</td>
                                   <td>{{ $d->amount }}</td>
                                   <td>{{ $d->details }}</td>
                                   <td>{{ $d->comment }}</td>

                                   <td>
                                     @if($d->status == 1)
                                     <span class="btn btn-success btn-sm">Active</span>
                                     @else
                                     <span class="btn btn-danger btn-sm">Inactive</span>
                                     @endif
                                 </td>


                                   <td>

                                    <a style="float: left;margin-right:10px;" href="{{route('add_expense.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                    <form action="{{ route('add_expense.destroy',$d->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{url('/approved_expense')}}/{{$d->id}}" class="btn btn-sm btn-dark">Approved</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif