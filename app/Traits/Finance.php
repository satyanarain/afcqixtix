<?php 
namespace App\Traits;

use App\Models\Client;
use App\Models\ClientFixedFee;
use App\Models\CostCenterTrademark;
use App\Models\CostCenter\CostCenterGI;
use App\Models\PreferredVendorClassification;
use App\Models\CostCenter\CostCenterCopyright;
use App\Models\CostCenter\CostCenterDomainName;
use App\Models\FinanceAndAccounting\ClientInvoice;
use App\Models\CostCenter\CostCenterCustomRecordal;
use App\Models\CostCenter\CostCenterIndustrialDesign;
use App\Models\FinanceAndAccounting\ClientRemittance;

trait Finance
{
	public function checkFinancialStatusOfClient($clientId=null, $countryId=null, $serviceId=null, $subserviceId=null, $associateId=null)
	{
		$client = Client::where('id', $clientId)->first();
        $clientFeeType = $client->client_billing;
        $clientCreditLimit = $client->credit_limit; 
        $serviceCost = 0;

        if($associateId != null)
        {
            $preferedAssocate = $associateId;
        }
        else 
        {
            $preferedAssocate = PreferredVendorClassification::where([['service_id', $serviceId], ['country_id', $countryId]])->first()->associate_id;
        }
        

        //calculate current sub service charge
        if($clientFeeType == 'Pre Approved Cost')
        {
            $cost = ClientFixedFee::where([['client_id', $clientId], ['service_id', $serviceId], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
            $serviceCost = $cost->total_fee;
        }
        else if($clientFeeType == 'Schedule of Charges')
        {
            switch ($serviceId) {
                case 1:
                    $cost = CostCenterTrademark::where([['associate_id', $preferedAssocate], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
                    break;
                case 2:
                    $cost = ClientFixedFee::where([['associate_id', $preferedAssocate], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
                    break;
                case 3:
                    $cost = CostCenterGI::where([['associate_id', $preferedAssocate], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
                    break;
                case 4:
                    $cost = CostCenterDomainName::where([['associate_id', $preferedAssocate], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
                    break;
                case 5:
                    $cost = CostCenterCustomRecordal::where([['associate_id', $preferedAssocate], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
                    break;

                case 6:
                    $cost = CostCenterCopyright::where([['associate_id', $preferedAssocate], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
                    break;
                case 7:
                    $cost = CostCenterIndustrialDesign::where([['associate_id', $preferedAssocate], ['sub_service_id', $subserviceId], ['country_id', $countryId]])->first();
                    break;
                
                default:
                    $serviceCost = 0;
                    break;
            }
        }

        //calculate client balance

        $clientInvoices = ClientInvoice::where('client_id', $clientId)->get()->sum('invoice_amount');
        $clientInvoiceIds = ClientInvoice::where('client_id', $clientId)->get()->pluck('id')->toArray();

        //return response()->json($clientInvoiceIds);exit();

        $clientRemittance = ClientRemittance::whereIn('invoice_id', $clientInvoiceIds)->get()->sum('payment_amount');

        $clientBalance = $clientInvoices - $clientRemittance;

        $clientBalanceIncludingCurrentSubService = $clientBalance + $serviceCost;

        $data = array();
        if($clientBalanceIncludingCurrentSubService <= $clientCreditLimit*80/100)
        {
            $data['status'] = 'true';
            $data['message'] = 'Client charges is less than credit limit.';
            return $data;
        }
        else 
        {
            $data['status'] = 'false';
            $data['message'] = 'Client charges is greater than credit limit.';
            return $data;
        }
	}
}