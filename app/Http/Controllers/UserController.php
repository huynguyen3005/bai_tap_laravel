<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'home';
    }

    public function show($id)
    {
        return 'user infomation';
    }

    public function destroy($id)
    {
        return 'deleted';
    }
}
