<?php

use App\Models\M_User;

function getGoogleClient(){
        include_once APPPATH . '../vendor/autoload.php';
        $googleClient = new \Google_Client();
        $googleClient->setClientId(getenv('OAuth.id'));
        $googleClient->setClientSecret(getenv('OAuth.secret'));
        $googleClient->setRedirectUri(base_url('/auth/atempt-login'));
        $googleClient->addScope('email');
        $googleClient->addScope('profile');

        return $googleClient;
    }

    function isLoggedIn(){
        return session()->has('loggedEmail') ? true : false ;
    }

    function isInRole($role_name){
        $db = \Config\Database::connect();

        $role = $db->table('roles')->where(['role_name' => $role_name])->get()->getRowObject();
        $userRole = $db->table('role_user_groups')->where(['user_id' => userinfo()->id])->get()->getRowObject();

        return ($role->role_id == $userRole->role_id) ? true : false;
    }

    function userinfo(){
        if(! isLoggedIn()){
            return redirect()->to(base_url() . '/auth/login');
        }

        $USER = new \App\Models\M_User();
        return $USER->getFullUserInfo();
    }

?>