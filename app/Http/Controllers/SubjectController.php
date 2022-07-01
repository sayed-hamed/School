<?php

namespace App\Http\Controllers;

use App\Repositery\SubjectRepositery;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct(SubjectRepositery $subject)
    {
        $this->subject=$subject;
    }

    public function index()
    {
        return $this->subject->index();
    }


    public function create()
    {
        return $this->subject->create();
    }


    public function store(Request $request)
    {
        return $this->subject->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->subject->edit($id);
    }


    public function update(Request $request,$id)
    {
        return $this->subject->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->subject->delete($id);
    }
}
