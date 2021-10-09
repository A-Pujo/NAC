<?php

function tanggal($aksi){
    $data = [
        // pendaftaran
        'close_acc_sma' => '2021-10-07 23:59', //batas waktu pendaftaran
        'close_acc_univ' => '2021-10-07 23:59', //batas waktu pendaftaran
        'close_abstrak' => '2021-09-24 23:59', //batas waktu pengumpulan abstrak
        // course
        'open_course' => '2021-09-24 08:00', // buka daftar
        'close_course' => '2021-09-30 23:59', // tutup daftar
        'start_course' => '2021-01-01 08:00', // mulai masa mengerjakan
        'finish_course' => '2021-10-08 23:59', // akhir masa mengerjakan
        'pengumuman_course' => '2021-10-09 08:00', //pengumuman kelulusan course

        // pengumuman
        'acc-sma-pre' => '2021-10-12 10:00', // kelulusan pre el
        'acc-univ-pre' => '2021-10-12 10:00', // kelulusan pre el
        'cfp-abstrak' => '2021-09-25 12:00', // kelulusan abstrak

        // tahap prelim
        'start_pre' => '2021-10-10 09:30', // start pengerjaan soal
        'finish_pre' => '2021-10-10 10:30', // finish pengerjaan soal

        // seminar
        'seminar_pass_1' => 'DevelopmentGoals',
        'seminar_pass_2' => 'AuditingCapability',
        'seminar_pass_3' => 'EconomicSolution',



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