<?php

use App\Models\M_User;
use App\Models\M_Peserta_Kursus;

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
            return redirect()->to(getGoogleClient()->createAuthUrl());
        }

        $USER = new \App\Models\M_User();
        return $USER->getFullUserInfo();
    }

    function user_kursus(){
        if(! isLoggedIn()){
            return redirect()->to(getGoogleClient()->createAuthUrl());
        }

        $user_kursus = new \App\Models\M_Peserta_Kursus();
        return $user_kursus->getFullUserInfo();
    }

    function user_webinar(){
        if(! isLoggedIn()){
            return redirect()->to(getGoogleClient()->createAuthUrl());
        }

        $peserta = new \App\Models\M_Webinar();
        return $peserta->getDataPeserta();
    }

    function countPartisipan($kolom = null, $value = null){
        $PARTISIPAN = new \App\Models\M_Partisipan();
        $PARTISIPAN->join('users', 'users.id = data_partisipan.user_id')
        ->join('data_pembayaran', 'data_pembayaran.user_id = data_partisipan.user_id')
        ->join('role_user_groups', 'role_user_groups.user_id = users.id');

        if($kolom == null){
            $partisipan = $PARTISIPAN->findAll();
        } else{
            $partisipan = $PARTISIPAN->where($kolom, $value)->findAll();
        }

        return empty($partisipan) ? 0 : count($partisipan);
    }



?>