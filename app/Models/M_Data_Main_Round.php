<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Data_Main_Round extends Model
{
    protected $table = 'data_main_round';
    protected $returnType = 'object';

    public function insertData($data){
        db()->table($this->table)->insert($data);
    }
}

?>