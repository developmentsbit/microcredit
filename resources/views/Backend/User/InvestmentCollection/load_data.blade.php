@php
								$i = 1;
								@endphp

								@if(isset($data))
								@foreach($data as $d)

								<tr>
									<td><input onclick="chkAll()" id="chkSavingReg" type="checkbox" name="investor_reg[]" value="{{$d->id}}"></td>
									<td>{{ $i++ }}</td>
									<td>{{ $d->date }}</td>
									<td>{{ $d->branch_name }}</td>
									<td>{{ $d->area_name }}</td>
									<td>{{ $d->member_id }}</td>
									<td>{{ $d->investment_collection }}</td>
									<td>{{ $d->comment }}</td>

									<td>

										<a style="float: left;margin-right:10px;" href="{{route('investment_collection.edit',$d->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
										<form action="{{ route('investment_collection.destroy',$d->id) }}" method="post">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
										</form>

										 <a href="{{url('investment_collections_show_approve')}}/{{$d->id}}" class="btn btn-dark btn-sm">Approve</a>

									</td>
								</tr>

								@endforeach
								@endif
