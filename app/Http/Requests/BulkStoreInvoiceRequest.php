<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // * SO WEHN WE HAVE AN ARRAY IT VALIDATES EVERY SINGLE ONE
        return [
            '*.customerId'=>['required','integer'],
            '*.amount'=>['required','numeric'],
            '*.status'=>['required',Rule::in(['B','V','P'])],
            '*.billedDate'=>['required','date_format:Y-m-d H:i:s','nullable'],
            '*.paidDate'=>['date_format:Y-m-d H:i:s','nullable'],
        ];
    }

    // to change the camelCase to nor_mal 
    protected function prepareForValidation(){
        //we have to iierate over each one so we create new data and append modified ones
        $data=[];
        foreach($this->toArray() as $obj){
            $obj['customer_id']= $obj['customerId']?? null;
            $obj['billed_date']= $obj['billedDate']?? null;
            $obj['paid_date']= $obj['paidDate']?? null;

            $data[]=$obj;
        }
        $this->merge($data);
    }
}
