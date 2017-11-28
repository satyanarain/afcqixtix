<?php
namespace App\Http\Traits;

use App\Brand;

trait PtestsTrait {
    public function patentsAll() {
        // Get all the brands from the Brands Table.
        $brands = Patent::all();

        return $brands;
    }
function DateFormat($date='')
{
$newDate = date("d-m-Y", strtotime($date));
return $newDate;
}



}

