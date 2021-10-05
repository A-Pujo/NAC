<?php

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
        'finish-pre' => '2021-10-05 22:00', // start pengerjaan soal

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