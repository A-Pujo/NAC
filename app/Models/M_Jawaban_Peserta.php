<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Jawaban_Peserta extends Model{

    protected $table      = 'jawaban_peserta_kursus';

    protected $returnType     = 'object';

    protected $allowedFields = ['peserta_kursus_id', 'soal_id', 'jawaban_id'];
    
}

?>