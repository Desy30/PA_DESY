<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class PetaniController extends Controller
{
    public function index()
    {
        return view('admin.petani.index');
    }

    public function create()
    {
        return view('admin.petani.create');
    }

    public function edit($id)
    {
        return view('admin.petani.edit');
    }
}

