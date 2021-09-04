<?php

namespace App\Controllers;

class Home extends BaseController
{
	protected $PARTISIPAN;

	function __construct(){
		$this->PARTISIPAN = new \App\Models\M_Partisipan();
	}


	public function index()
	{
		return view('statis/pages/home');
	}
	public function guide()
	{
		return view('statis/pages/guide');
	}

	public function tes(){
		return view('dashboard/pages/home');
	}
}
