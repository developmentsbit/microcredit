<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface NoticeInterface {

    public function index();

    public function create();

    public function store(Request $request);

    public function show($id);

    public function edit($id);

    public function update(array $request, $id);

    public function delete($id);

}
