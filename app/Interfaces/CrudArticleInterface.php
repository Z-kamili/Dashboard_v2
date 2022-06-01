<?php

namespace App\Interfaces;

use App\Http\Requests\ArticlesRequest;
use GuzzleHttp\Psr7\Request;

interface CrudArticleInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);
}