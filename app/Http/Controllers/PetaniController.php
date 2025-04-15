<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
            return view('petani.index');
        }

        public function create()
        {
            return view('petani.create');
        }
    }

