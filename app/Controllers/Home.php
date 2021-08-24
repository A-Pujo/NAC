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
		if(isLoggedIn()){
			echo print_r(userinfo());
			if(isInRole('umum')){
				echo '<br>umum nih bos <br>';
			}
			echo 'Data partisipan:<br>';
			foreach ($this->PARTISIPAN->getAll() as $partisipan) {
				echo print_r($partisipan) . '<br>';
			}
		} else{
			return 'belum login <br> <a href="' . base_url('/auth/login') . '">login sini</a>';
		}
	}

	public function tes(){
		return view('dashboard/pages/home');
	}
}
