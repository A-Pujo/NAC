<?php

function tanggal($aksi){
    $data = [
        // pendaftaran
        'close_acc_sma' => '2021-10-07 23:59', //batas waktu pendaftaran
        'close_acc_univ' => '2021-10-07 23:59', //batas waktu pendaftaran
        'close_abstrak' => '2021-09-24 23:59', //batas waktu pengumpulan abstrak
        'close_paper' => '2021-10-16 23:59', // batas waktu full paper
        // course
        'open_course' => '2021-09-24 08:00', // buka daftar
        'close_course' => '2021-09-30 23:59', // tutup daftar
        'start_course' => '2021-01-01 08:00', // mulai masa mengerjakan
        'finish_course' => '2021-10-08 23:59', // akhir masa mengerjakan
        'pengumuman_course' => '2021-10-10 14:00', //pengumuman kelulusan course

        // pengumuman
        'acc-sma-pre-peng' => '2021-10-12 12:00', // kelulusan pre el
        'acc-univ-pre-peng' => '2021-10-12 12:00', // kelulusan pre el
        'cfp-abstrak' => '2021-09-25 12:00', // kelulusan abstrak

        // tahap prelim
        'start_pre' => '2021-10-09 09:30', // start pengerjaan soal
        'finish_pre' => '2021-10-10 11:30', // finish pengerjaan soal

        // seminar

        // pembukaan regis
        'webinar_open_regis_1' => '2021-10-14 10:10',
        'webinar_open_regis_2' => '2021-10-14 10:10',
        'webinar_open_regis_3' => '2021-10-14 10:10',
        'webinar_open_regis_4' => '2021-10-14 10:10',
        // penutupan regis
        'webinar_close_regis_1' => '2021-10-17 13:30',
        'webinar_close_regis_2' => '2021-10-20 07:30',
        'webinar_close_regis_3' => '2021-10-21 09:30',
        'webinar_close_regis_4' => '2021-10-17 11:00',
        // start join
        'webinar_start_join_zoom_1' => '2020-10-17 13:30',
        'webinar_start_join_zoom_2' => '2020-10-20 07:30',
        'webinar_start_join_zoom_3' => '2020-10-21 09:30',
        'webinar_start_join_zoom_4' => '2021-10-17 11:00',
        // finish join zoom
        'webinar_finish_join_zoom_1' => '2021-10-17 17:15',
        'webinar_finish_join_zoom_2' => '2021-10-20 11:00',
        'webinar_finish_join_zoom_3' => '2021-10-21 13:00',
        'webinar_finish_join_zoom_4' => '2021-10-17 12:00',
        // pembukaan absen
        'webinar_start_absen_1' => '2021-10-17 17:00',
        'webinar_start_absen_2' => '2021-10-20 10:45',
        'webinar_start_absen_3' => '2021-10-21 12:45',
        'webinar_start_absen_4' => '2021-10-17 11:40',
        // penutupan absen
        'webinar_finish_absen_1' => '2021-10-17 19:45',
        'webinar_finish_absen_2' => '2021-10-20 13:30',
        'webinar_finish_absen_3' => '2021-10-21 15:30',
        'webinar_finish_absen_4' => '2021-10-17 14:35',
        // Tanggal pelaksanaan webinar
        'webinar_start_1' => '2021-10-17 13:30',
        'webinar_start_2' => '2021-10-20 07:30',
        'webinar_start_3' => '2021-10-21 09:30',
        'webinar_start_4' => '2021-10-17 11:00',
        'webinar_finish_1' => '2021-10-17 17:15',
        'webinar_finish_2' => '2021-10-20 11:00',
        'webinar_finish_3' => '2021-10-21 13:00',
        'webinar_finish_4' => '2021-10-17 12:05',


        '' => '2021-01-01 00:00',
    ];
    if($aksi == 'all'){
        return $data;
    } else {
        return $data[$aksi];
    }
}

function info($info){

    $data = [
        // password webinar
        'webinar_pass_1' => 'DevelopmentGoals',
        'webinar_pass_2' => 'AuditingCapability',
        'webinar_pass_3' => 'EconomicSolution',
        'webinar_pass_4' => 'GetReadyToTransform',

        // kuota untuk mahasiswa stan
        'webinar_kuota_stan_1' => 700,
        'webinar_kuota_stan_2' => 700,
        'webinar_kuota_stan_3' => 700,
        'webinar_kuota_stan_4' => 10000,
        // kuota untuk non mahasiswa stan
        'webinar_kuota_non_stan_1' => 300,
        'webinar_kuota_non_stan_2' => 300,
        'webinar_kuota_non_stan_3' => 300,
        'webinar_kuota_non_stan_4' => 10000,
        // data zoom 1
        'webinar_zoom_id_1' => '938 2889 7613',
        'webinar_zoom_pass_1' => '900923',
        'webinar_zoom_link_1' => 'https://zoom.us/j/93828897613?pwd=M3Z2Wnp6aDdsaTlWdGZheW9iZUZqQT09',
        // data zoom 1
        'webinar_zoom_id_2' => '963 7865 0991',
        'webinar_zoom_pass_2' => '983980',
        'webinar_zoom_link_2' => 'https://zoom.us/j/96378650991?pwd=YmphNWZsaEJLUHh5T0hEeUxjREcwQT09',
        // data zoom 1
        'webinar_zoom_id_3' => '983980',
        'webinar_zoom_pass_3' => '963 7865 0991',
        'webinar_zoom_link_3' => 'https://zoom.us/j/96378650991?pwd=YmphNWZsaEJLUHh5T0hEeUxjREcwQT09',
        // data zoom 4
        'webinar_zoom_id_4' => '983980',
        'webinar_zoom_pass_4' => '963 7865 0991',
        'webinar_zoom_link_4' => 'https://zoom.us/j/96378650991?pwd=YmphNWZsaEJLUHh5T0hEeUxjREcwQT09',

    ];
    return $data[$info];
}

function tanggal_human($aksi){
    $tanggal_timestamp = date_timestamp_get(date_create(tanggal($aksi)));
    $tanggal = date('d', $tanggal_timestamp) ;
    $tahun = date('Y', $tanggal_timestamp) ;
    $jam = date('G', $tanggal_timestamp) ;
    $menit = date('i', $tanggal_timestamp) ;
    $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $kode_hari = date('N', $tanggal_timestamp  )- 1;
    $kode_bulan = date('m', $tanggal_timestamp )- 1;
    return "$hari[$kode_hari], $tanggal-$bulan[$kode_bulan]-$tahun pukul $jam:$menit ";
}

function jam_human($aksi){
    $tanggal_timestamp = date_timestamp_get(date_create(tanggal($aksi)));
    $jam = date('G', $tanggal_timestamp) ;
    $menit = date('i', $tanggal_timestamp) ;
    return "$jam:$menit"; 
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