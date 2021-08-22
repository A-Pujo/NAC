<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Partisipan extends Model
{
    protected $table      = 'data_partisipan';

    protected $returnType     = 'object';

    protected $allowedFields = ['user_id', 'pt', 'nama_tim', 'nama_ketua', 'nama_1', 'nama_2', 'wa', 'ktm', 'twibbon', 'partisipan_aktif'];

    protected $useTimestamps = true;
    protected $createdField  = 'partisipan_dibuat';
    protected $updatedField  = 'partisipan_diupdate';
}

?>