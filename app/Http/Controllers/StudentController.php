<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show($id)
    {

        $data = [
            [
                'id' => 1,
                'name' => 'Trương Văn Tùng',
                'email' => 'tungtvph46392@fpt.edu.vn',
                'phone' => '0868313293'
            ],
            
        ];

        return view('student', compact('data'));
    }
}
