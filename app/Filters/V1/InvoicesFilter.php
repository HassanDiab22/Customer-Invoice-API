<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter{
    //safe parms for filtering
 protected $safeParms=[
    'customerId'=>['eq'],
    'amount'=>['eq','gt','lt','lte','gte'],
    'status'=>['eq','ne'],
    'address'=>['eq'],
    'billedDate'=>['eq','gt','lt','lte','gte'],
    'paidDate'=>['eq','gt','lt','lte','gte'],
 ];

 // te fix transform the names to the db columns name and the operator 
 protected $columnMap = [
    'billedDate'=>'billed_date',
    'paidDate'=>'paid_date',
    'customerId'=>'customer_id',
 ];

 protected $operatorMap=[
    'eq'=>'=',
    'lt'=>'<',
    'lte'=>'<=',
    'gt'=>'>',
    'gte'=>'>=',
    'ne'=>'!=',
 ];


}