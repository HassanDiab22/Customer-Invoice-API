<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
 use App\Filters\V1\CustomersFilter;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new CustomersFilter();
        $filterItems = $filter->transform($request); // [['column','operator','value']]
        
        $customers = Customer::where($filterItems);

        $includesInvoices = $request->query('includeInvoices');
        print($includesInvoices=="True" || $includesInvoices=="true" );
        if($includesInvoices){
            //has invoices
            $customers=$customers->with('invoices');
        }
        
        $result = new CustomerCollection($customers->paginate()->appends($request->query()));
        return $result;
        

        //
        // $result = new CustomerCollection(Customer::all());

    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //

        $includesInvoices = request()->query('includeInvoices');
        $result = new CustomerResource($customer);
        if($includesInvoices){
            $result = new CustomerResource($customer->LoadMissing('invoices'));
        }
        
        return $result;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
