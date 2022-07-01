<?php

namespace App\Repositery;

interface TeacherRepositeryInterface{

    //getAllTeacher
    public function getAllTeacher();

    //gender
    public function gender();

    //spacialization
    public function spacialization();

    //store teachers
    public function StoreTeacher($request);


    //delete teacher
    public function EditTeacher($id);

    public function updateTeacher($id);
//
    //delete teacher
    public function DeleteTeacher($id);


}
