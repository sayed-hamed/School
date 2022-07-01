<?php

namespace App\Repositery;

interface FeesInvoicesRepositeryInterface
{

    public function index();

    public function show($id);

    public function add($request);
    public function update($request);
    public function edit($id);
    public function delete($request);

}
