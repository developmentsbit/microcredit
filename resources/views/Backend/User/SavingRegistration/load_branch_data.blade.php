@if ($data)
                                @foreach ($data as $showdata)
                                    <tr>
                                        <td><input onclick="chkAll()" id="chkSavingReg" type="checkbox" name="saving_reg[]" value="{{$showdata->id}}"></td>
                                        <td>{{$sl++}}</td>
                                        <td>{{$showdata->application_date}}</td>
                                        <td>{{$showdata->registration_id}}</td>
                                        <td>{{$showdata->branch_name}}</td>
                                        <td>{{$showdata->area_name}}</td>
                                        <td>{{$showdata->aplicant_name}}</td>
                                        <td>{{$showdata->phone}}</td>
                                        <td>
                                            <!-- This is a button toggling the modal -->
                                            <a href="{{route('saving_registration.show',$showdata->id)}}" class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>
    
                                            <!-- This is the modal -->
                                            <div id="modal-example-{{$showdata->id}}" uk-modal>
                                                <div class="uk-modal-dialog uk-modal-body">
                                                    
                                                    <p class="uk-text-right">
                                                        <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
                                                        {{-- <button class="uk-button uk-button-primary" type="button">Save</button> --}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>@if($showdata->status == 1) <div class="badge badge-success">Active</div> @else <div class="badge badge-danger">Inactive</div> @endif</td>
                                        <td>
                                            <a style="float: left;margin-right:10px;" href="{{route('saving_registration.edit',$showdata->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i></a>
                                        <form action="{{ route('saving_registration.destroy',$showdata->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn btn-danger"><i class="feather icon-trash"></i></button>
                                        </form>
                                        </td>
                                        <td>
                                            <a href="{{url('saving_approve')}}/{{$showdata->id}}" class="btn btn-dark btn-sm">Approve</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif