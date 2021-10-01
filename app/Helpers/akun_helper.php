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


    function tanggal($aksi){
        $data = [
            // pendaftaran
            'close_abstrak' => '2021-09-24 23:59', //batas waktu pengumpulan abstrak
            // course
            'open_course' => '2021-09-24 08:00', // buka daftar
            'close_course' => '2021-09-30 23:59', // tutup daftar
            'start_course' => '2021-01-01 08:00', // mulai masa mengerjakan
            'finish_course' => '2021-10-08 23:59', // akhir masa mengerjakan
            'pengumuman_course' => '2021-10-09 08:00', //pengumuman kelulusan course

            // pengumuman
            'acc-sma-pre' => '2021-10-10 12:00', // kelulusan pre el
            'acc-univ-pre' => '2021-10-10 12:00', // kelulusan pre el
            'cfp-abstrak' => '2021-09-25 12:00', // kelulusan abstrak

            // tahap prelim
            'start-pre' => '2021-09-10 09:00', // start pengerjaan soal
            'finish-pre' => '2021-10-10 10:00', // start pengerjaan soal

            '' => '2021-01-01 00:00',
        ];
        if($aksi == 'all'){
            return $data;
        } else {
            return $data[$aksi];
        }
    }

    function sekarang(){
        return date('Y-m-d H:i:s');
    }


    function db(){
        return \Config\Database::connect();
    }

    function kuota($aksi){
        $data = [
            // pendaftaran
            'course' => 150, // kuota 
        ];
        return $data[$aksi];
    }

?>