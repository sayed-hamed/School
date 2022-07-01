<?php

namespace App\Repositery;

interface AttandenceRepositeryInterface
{

    public function index();

    public function show($id);

    public function store($request);

}
