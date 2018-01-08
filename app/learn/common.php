
@include('partials.table_script')

<th>@lang('Action')</th>

                               <td>
                                <a  href="{{ route('depots.edit', $value->id) }}" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span></a>
                                <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#{{$value->id}}"><span class="glyphicon glyphicon-search"></span></button>
                            </td>