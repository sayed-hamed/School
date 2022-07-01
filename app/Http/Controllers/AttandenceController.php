<?php

namespace App\Http\Controllers;

use App\Repositery\AttandenceRepositery;
use Illuminate\Http\Request;

class AttandenceController extends Controller
{
    protected $attandence;

    public function __construct(AttandenceRepositery $attandence)
    {
        return $this->attandence=$attandence;
    }

    public function index(){
        return $this->attandence->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->attandence->store($request);
    }


    public function show($id)
    {
        return $this->attandence->show($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
