<?php
namespace App\Repositories\PayoutReason;
interface PayoutReasonRepositoryContract
{
    public function find($id);
    public function getAllPayoutReasons();
    public function create($requestData);
    public function update($id, $requestData);

}
