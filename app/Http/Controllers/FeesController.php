<?php

namespace App\Http\Controllers;

use App\Repositery\StudentFeesRepositery;
use App\Repositery\StudentFeesRepositeryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{

    protected $fee;

    public function __construct(StudentFeesRepositery $fee)
    {
        $this->fee=$fee;
    }

    public function index()
    {
        return $this->fee->index();
    }

    public function create()
    {
        return $this->fee->create();
    }

    public function store(Request $request)
    {
        return $this->fee->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->fee->edit($id);
    }


    public function update(Request $request,$id)
    {
        return $this->fee->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->fee->delete_fee($id);
    }
}
