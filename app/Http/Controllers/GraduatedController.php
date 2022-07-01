<?php

namespace App\Http\Controllers;

use App\Repositery\StudentGraduatedRepositery;
use App\Repositery\StudentGraduatedRepositeryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $graduated;

    public function __construct(StudentGraduatedRepositery $graduated)
    {
        $this->graduated=$graduated;
    }

    public function index()
    {
        return $this->graduated->index();
    }


    public function create()
    {
        return $this->graduated->create();
    }


    public function store(Request $request)
    {
        return $this->graduated->softdelete($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        return $this->graduated->return_student($request);
    }


    public function destroy(Request $request)
    {
        return $this->graduated->delete_student($request);
    }
}
