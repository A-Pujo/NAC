<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Jawaban_Partisipan extends Model
{
    protected $table      = 'jawaban_partisipan';

    protected $returnType     = 'object';

    protected $allowedFields = ['soal_id', 'jawaban_id', 'partisipan_kode_voucher'];

    function getFullJawabanPartisipan(){
        return $this->join('soal', 'soal.soal_id = jawaban_partisipan.soal_id')->join('pilihan_jawaban', 'pilihan_jawaban.jawaban_id = jawaban_partisipan.jawaban_id')->findAll();
    }

    function getSingleJawabanPartisipan($kode_voucher){
        return $this->join('soal', 'soal.soal_id = jawaban_partisipan.soal_id')->join('pilihan_jawaban', 'pilihan_jawaban.jawaban_id = jawaban_partisipan.jawaban_id')->where(['partisipan_kode_voucher' => $kode_voucher])->findAll();
    }
}

?>