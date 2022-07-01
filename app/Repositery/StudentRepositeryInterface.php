<?php

namespace App\Repositery;

interface StudentRepositeryInterface{


    //show students
    public function show_students();
    //create student
    public function create_student();

    // show_student
    public function show_student($id);

    //edit student
    public function edit_form($id);

    //edit student
    public function edit_student($request,$id);

    // delete_student
    public function delete_student($id);

    //list classroom
    public function Get_classrooms($id);

    //list sections
    public function Get_Sections($id);

    //store students
    public function store_students($request);

    //upload attachment
    public function upload_attach($request);

    //dawnload_attachment
    public function dawnload_attachment($stdname,$filename);

    //delete attach
    public function delete_attachment($request);


}
