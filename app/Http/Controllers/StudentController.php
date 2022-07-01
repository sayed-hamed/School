<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Repositery\StudentRepositery;
use App\Repositery\StudentRepositeryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentRepositery $student)
    {
        $this->student=$student;
    }

    public function index()
    {
        return $this->student->show_students();
    }


    public function create()
    {
        return $this->student->create_student();
    }


    public function store(StoreStudentRequest $request)
    {
        return $this->student->store_students($request);
    }


    public function show($id)
    {
        return $this->student->show_student($id);
    }


    public function edit($id)
    {
        return $this->student->edit_form($id);
    }


    public function update(StoreStudentRequest $request,$id)
    {
        return $this->student->edit_student($request,$id);
    }


    public function destroy($id)
    {
        return $this->student->delete_student($id);
    }

    public function Get_classrooms($id){
        return $this->student->Get_classrooms($id);
    }

    public function Get_Sections($id){
        return $this->student->Get_Sections($id);
    }

    public function upload_attach(Request $request)
    {
        return $this->student->upload_attach($request);
    }

    public function dawnload_attachment($stdname,$filename){

        return $this->student->dawnload_attachment($stdname,$filename);
    }

    public function delete_attach(Request $request){
        return $this->student->delete_attachment($request);
    }
}
