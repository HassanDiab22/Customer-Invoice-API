<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\BulkStoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use App\Filters\V1\InvoicesFilter;
use Illuminate\Support\Arr;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request); // [['column','operator','value']]
        
        if(count($queryItems)==0){
            $result = new InvoiceCollection(Invoice::paginate());
            return $result;
        }else{
            $invoices =Invoice::where($queryItems)->paginate();
            //to keep the filter on the next pages  we get it from teh request and add it
            $result = new InvoiceCollection($invoices->appends($request->query()));
            return $result;
        }

        //
        // $result = new CustomerCollection(Customer::all());

    }
    /**
     * Show the form for creating a new resource.
     */
    public function bulkStore(BulkStoreInvoiceRequest $request){
        $bulk= collect($request->all())->map(function($arr,$key){
            return Arr::except($arr,['customerId','billedDate','paidDate']);
        });

        Invoice::insert($bulk->toArray());
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
