<?php

namespace App\Http\Requests\ConcessionFareSlab;

use App\Http\Requests\Request;

class StoreConcessionFareSlabRequest extends Request
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
    // `route`, `path`, `direction`, `default_path`, `stop_id`, `stage_number`, `distance`, `hot_key`, `is_this_by`,
    public function rules()
    {
        
     //  print_r($_POST);
       
       
//
//$rules = [
//    'initial_page' => 'required_with:end_page|integer|min:1|digits_between: 1,5',
//    'end_page' => 'required_with:initial_page|integer|min:'. ($init_page+1) .'|digits_between:1,5'
//] 
//        
   
          $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
           return [
                    'service_id' => 'required',
                   'percentage' => 'required|integer',
                   'stage_from' => 'required|integer',
                   'stage_to' => 'required|integer',
                   'fare' =>  array('required','regex:'.$regex) 
             ];
        
    }
}
