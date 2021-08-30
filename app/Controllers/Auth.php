<?php 

namespace App\Controllers;

use Google_Service;

class Auth extends BaseController
{

    protected $googleClient;

    function __construct(){
        helper('akun');
        $this->googleClient = getGoogleClient();
    }

    public function index(){
        if(!session()->has('loggedUserEmail')){
            return redirect()->to(base_url() . '/auth/login');
        }

        return redirect()->to(previous_url());
    }

    public function login(){
        return view('login');
    }

    public function atempt_login(){
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if(empty($token['error'])){
            $this->googleClient->setAccessToken($token['access_token']);
            session()->set('AccessToken', $token['access_token']);

            $googleService = new \Google\Service\Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();

            $userData = array();
            
            if($this->USER->isAlreadyRegistered($data['id'])){
                $userData = [
                    'nama' => $data['name'], 
                    'email' => $data['email'], 
                    'avatar' => $data['picture'],
                ];

                $this->USER->where(['oauth_id' => $data['id']])->update(null, $userData);
            } else {
                $userData = [
                    'oauth_id' => $data['id'],
                    'nama' => $data['name'], 
                    'email' => $data['email'], 
                    'avatar' => $data['picture'],
                ];

                $this->USER->insert($userData);
                $this->USER->initUserInfo($data['id']);
            }

            session()->set('loggedEmail', $data['email']);

        } else {
            session()->setFlashdata('error', 'something went wrong');
            return redirect()->to(base_url());
        }

        return redirect()->to(base_url('/dashboard'));
    }

    public function logout(){
        session()->remove('loggedEmail');
        return redirect()->to(base_url());
    }
}

?>