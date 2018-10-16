<?php

namespace App\Http\Requests\Inventory\DepotStock;

use App\Http\Requests\Request;

class StoreDepotStockRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return auth()->user()->can('user-create');
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
            'quantity.required_if'=>'Quantity is required.',
            'denom_id.required_if'=>'Denominion is required.',
            'series.required_if'=>'Series is required.',
            'start_sequence.required_if'=>'Start sequence is required.',
            'end_sequence.required_if'=>'End sequence is required.',
            'end_sequence.min'=>'End sequence must be greater than start sequence.',
            'remark.required'=>'Remark is required.',
        ];
    }
}
