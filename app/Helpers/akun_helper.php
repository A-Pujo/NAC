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
    function role_user($id){
        return db()->table('role_user_groups')
            ->join('roles', 'roles.role_id = role_user_groups.role_id')
            ->where('user_id', $id)
            ->get()->getRow()->role_name;
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

    function user_main_round(){
        $data = new \App\Models\M_Data_Main_Round();
        $user = userinfo();
        $lomba = $user->partisipan_jenis;
        if($lomba == 'AccSMA'){
            return $data
            ->join('nilai_acc_sma', 'nilai_acc_sma.partisipan_id = data_main_round.partisipan_id')
            ->where('nilai_acc_sma.partisipan_id', $user->partisipan_id)->first();
        } elseif($lomba == 'AccUniv'){
            return $data
            ->join('nilai_acc_univ', 'nilai_acc_univ.partisipan_id = data_main_round.partisipan_id')
            ->where('nilai_acc_univ.partisipan_id', $user->partisipan_id)->first();
        } elseif($lomba == 'CFP'){
            return $data
            ->join('nilai_cfp', 'nilai_cfp.partisipan_id = data_main_round.partisipan_id')
            ->where('nilai_cfp.partisipan_id', $user->partisipan_id)->first();
        }  else {
            return $data;
        }
    }



?>