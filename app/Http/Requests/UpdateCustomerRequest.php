<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method=='PUT'){
            return [
                'name'=>['required'],
                'email'=>['required','email'],
                'type'=>['required',Rule::in(['I','B','i','b'])],
                'address'=>['required'],
                'city'=>['required'],
                'state'=>['required'],
                'postalCode'=>['required'],
            ];
        }else{
            return [
                'name'=>['sometimes','required'],
                'email'=>['sometimes','required','email'],
                'type'=>['sometimes','required',Rule::in(['I','B','i','b'])],
                'address'=>['sometimes','required'],
                'city'=>['sometimes','required'],
                'state'=>['sometimes','required'],
                'postalCode'=>['sometimes','required'],
            ];
        }

    }

        // to change the camelCase to nor_mal 
    protected function prepareForValidation(){
        //if postal code exist merge this 
        if($this->postalCode){
            
            $this->merge([
                'postal_code'=>$this->postalCode
            ]);
        }

    }
}
