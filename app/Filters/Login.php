<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Login implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('akun');
        if(!isLoggedIn()){
            return redirect()->to(getGoogleClient()->createAuthUrl());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

?>