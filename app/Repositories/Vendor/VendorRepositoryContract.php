<?php
namespace App\Repositories\Vendor;

interface VendorRepositoryContract
{
    public function find($id);
    
    public function getAllVendorsCount();

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);

    public function status($id);

    public function listallcountries();

    public function allvendors();

}
