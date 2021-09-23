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
	public function pengumuman()
	{
		return view('statis/pages/pengumuman');
	}

	public function fr_pre_el(){
		return view('test/fr-pre-el');
	}
	public function fr_course(){
		$data['halaman'] = 'kursus';
		$data['judul'] = 'Course NAC STAN 2021';
		return view('test/fr-kursus-index', $data);
	}
}
