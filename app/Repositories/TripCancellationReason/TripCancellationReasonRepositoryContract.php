<?php
namespace App\Repositories\TripCancellationReason;
interface TripCancellationReasonRepositoryContract
{
    public function find($id);
    public function getAllTripCancellationReasons();
    public function create($requestData);
    public function update($id, $requestData);

}
