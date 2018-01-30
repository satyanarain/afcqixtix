<?php
function getDomesticCities()
{
$result = \App\Package::where('type', '=', 'domestic')
    ->groupBy('from_city')
    ->get(['from_city']);

return $result;
}