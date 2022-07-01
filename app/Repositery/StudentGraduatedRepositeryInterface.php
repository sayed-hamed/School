<?php

namespace App\Repositery;

interface StudentGraduatedRepositeryInterface
{

    public function create();

    public function index();

    public function softdelete($request);

    public function delete_student($request);
    public function return_student($request);

}
