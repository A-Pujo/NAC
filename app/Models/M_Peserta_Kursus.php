<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Peserta_Kursus extends Model{

    protected $table      = 'peserta_kursus';

    protected $returnType     = 'object';

    protected $allowedFields = ['id_user', 'wa', 'nama_peserta', 'nama_sekolah', 'kartu_pelajar', 'twibbon_kursus', 'verifikasi_peserta', 'peserta_ditolak', 'alasan_ditolak', 'nilai_video_1', 'nilai_video_2', 'nilai_video_3', 'nilai_video_4', 'nilai_video_5', 'nilai_video_6', 'nilai_video_7', 'video_kursus_1', 'video_kursus_2', 'video_kursus_3', 'video_kursus_4', 'video_kursus_5', 'video_kursus_6', 'video_kursus_7'];

    protected $useTimestamps = true;
    protected $createdField  = 'data_pk_dibuat';
    protected $updatedField  = 'data_pk_diperbarui';

    function getFullUserInfo(){
        return $this->where(['id_user' => userinfo()->id])->first();
    }

}

?>