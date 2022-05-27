<?php

namespace App\Interfaces;

use GuzzleHttp\Psr7\Request;

interface CrudRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);
}