<?php

namespace App\Filters;

use Illuminate\Http\Request;

class  ApiFilter{
    //safe parms for filtering
 protected $safeParms=[];

 // te fix transform the names to the db columns name and the operator 
 protected $columnMap = [];

 protected $operatorMap=[];

 public function transform(Request $request){
    $eloQuery = [];

    foreach($this->safeParms as $parm => $operators){
        //if there is parms
        $query = $request->query($parm);
        //p arm is postCode adn the query is "gt"=> "3000"
        //if no result
        if(!isset($query)){
            continue;
        }
        //like if it was postalCode to transorm it to its column name in db else keep it as its
        $column = $this->columnMap[$parm] ?? $parm;

        foreach($operators as $operator){
            
            if(isset($query[$operator])){
                //           columnname    operator                 value to filter to
                $eloQuery[]=[$column,$this->operatorMap[$operator],$query[$operator]] ;
            }

        }
    }
    return $eloQuery;
 }
}