@component('mail::message')
Dear {{$userName}},<br>

Inventory for {{$itemName}} has gone below minimum level. Please look into and take the required action.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
