<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        return view('pages.fakultas.profil.index', [
            'title' => 'Profil Fakultas',
        ]);
    }
}
