@component('mail::message')
Dear {{$userName}},<br>

Inventory for {{$itemName}} ({{$remainingStock}}) has gone below minimum stock ({{$minStock}}). Please look into and take the required action.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
