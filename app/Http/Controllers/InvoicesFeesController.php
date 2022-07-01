<?php

namespace App\Http\Controllers;

use App\Repositery\FeesInvoicesRepositery;
use Illuminate\Http\Request;

class InvoicesFeesController extends Controller
{

    protected $invoice_fee;

    public function __construct(FeesInvoicesRepositery $invoice_fee)
    {
        $this->invoice_fee=$invoice_fee;
    }

    public function index()
    {
        return $this->invoice_fee->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->invoice_fee->add($request);
    }


    public function show($id)
    {
        return $this->invoice_fee->show($id);
    }


    public function edit($id)
    {
        return $this->invoice_fee->edit($id);
    }


    public function update(Request $request)
    {
        return $this->invoice_fee->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->invoice_fee->delete($request);
    }
}
