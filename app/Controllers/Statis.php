<?php

namespace App\Controllers;

class Statis extends BaseController
{
    public function index(){
        return view('statis/pages/home');
    }
}