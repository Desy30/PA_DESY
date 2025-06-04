<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiModel::with('transaksi')->latest()->get();
        return view('admin.pengiriman.index', compact('transaksis'));
    }

    
}
