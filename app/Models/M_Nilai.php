<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai extends Model
{
    protected $table      = 'data_nilai';

    protected $returnType     = 'object';

    protected $allowedFields = ['kode_voucher',  'kuantitas_nilai'];

}

?>