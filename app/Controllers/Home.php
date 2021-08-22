<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if(isLoggedIn()){
			echo print_r(userinfo());
			if(isInRole('umum')){
				echo '<br>umum nih bos';
			}
		} else{
			return 'belum login <br> <a href="' . base_url('/auth/login') . '">login sini</a>';
		}
	}
}
