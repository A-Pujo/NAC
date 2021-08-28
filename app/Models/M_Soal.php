<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Soal extends Model
{
    protected $table      = 'soal';

    protected $returnType     = 'object';

    protected $allowedFields = ['soal_teks', 'kode_lomba'];

    function getSoal($kode_lomba, $offset = 0){
        return $this->where(['kode_lomba' => $kode_lomba])->findAll(2, $offset);
    }
}

?>