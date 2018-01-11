{{ createButton('create','Add') }}
{{  actionHeading('Action', $newaction='') }}
{{ actionEdit('edit',$value->id)}}

@include('partials.depotsheader')
@include('partials.table_script')
@stop