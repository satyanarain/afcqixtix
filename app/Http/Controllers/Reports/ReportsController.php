<?php

namespace App\Http\Controllers\Reports;

use DB;
use App\Models\Crew;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function getConductorsByDepotId($depotId)
    {
    	$conductors = Crew::where('depot_id', $depotId)->get(['id', 'crew_id', 'crew_name']);

    	if(!$conductors)
    	{
    		return response()->json(['status'=>0, 'data'=>['error'=>'Invalid depot ID.']]);
    	}

    	return response()->json(['status'=>1, 'data'=>$conductors]);
    }

    public function getDenominationsByTicketType($ticketTypeId)
    {
    	$denominations = DB::table('denominations')
    						 ->where('denomination_master_id', $ticketTypeId)
    						 ->get(['id', 'description']);

    	return response()->json($denominations, 200);
    }

    public function getVehiclesByDepotId($depotId)
    {
        $vehicles = Vehicle::where('depot_id', $depotId)->get(['id', 'vehicle_registration_number']);

        return response()->json($vehicles, 200);
    }
}
