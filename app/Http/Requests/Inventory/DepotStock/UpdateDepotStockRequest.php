<?php

namespace App\Http\Requests\Inventory\DepotStock;

use App\Http\Requests\Request;

class UpdateDepotStockRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        return [
            'depot_id' => 'required',
            'items_id' => 'required',
            'quantity' => 'required_if:items_id,2|numeric|min:1',
            'denom_id' => 'required_if:items_id,1',
            'series' => 'required_if:items_id,1',
            'start_sequence' => 'required_if:items_id,1',
            'end_sequence' => 'required_if:items_id,1',
            'remark' => 'required',
        ];        
    }

    public function messages()
    {
        return [
            'depot_id.required'=>'Depo is required.',
            'items_id.required'=>'Item is required.',
            'quantity.required_if:items_id,2'=>'Quantity is required.',
            'denom_id.required_if:items_id,1'=>'Denominion is required.',
            'series.required_if:items_id,1'=>'Series is required.',
            'start_sequence.required_if:items_id,1'=>'Start sequence is required.',
            'end_sequence.required_if:items_id,1'=>'End sequence is required.',
            'remark.required'=>'Remark is required.',
        ];
    }

}
