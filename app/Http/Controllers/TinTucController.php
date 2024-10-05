<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function index()
    {
       return view('index');
    }

    public function lienHe() {
       return view('lien-he');
    }

    public function show($id) {
        $data = [
            'id' => $id
        ];

        return view('chi-tiet',$data);
    }
}
