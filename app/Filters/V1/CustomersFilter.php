<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter{
    //safe parms for filtering
 protected $safeParms=[
    'name'=>['eq'],
    'type'=>['eq'],
    'email'=>['eq'],
    'address'=>['eq'],
    'state'=>['eq'],
    'city'=>['eq'],
    'postalCode' => ['eq','gt','lt'],
 ];

 // te fix transform the names to the db columns name and the operator 
 protected $columnMap = [
    'postalCode'=>'postal_code'
 ];

 protected $operatorMap=[
    'eq'=>'=',
    'lt'=>'<',
    'lte'=>'<=',
    'gt'=>'>',
    'gte'=>'>=',
 ];


}