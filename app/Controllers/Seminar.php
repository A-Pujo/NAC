<?php

namespace App\Controllers;

class Seminar extends BaseController
{

    public function index(){
        return view('statis/pages/seminar');
    }
    public function dashboard(){
        $data =[
            'judul' => 'Selamat Datang',
            'halaman' => 'beranda',
        ];
        return view('dashboard/pages/seminar/index', $data);
    }
    public function pendaftaran(){

        $data =[
            'judul' => 'Selamat Datang',
            'halaman' => 'beranda',
        ];
        return view('dashboard/pages/seminar/pendaftaran', $data);
    }

}