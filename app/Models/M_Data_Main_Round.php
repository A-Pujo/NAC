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

    public function getDataSMA(){
        return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = data_main_round.partisipan_id')
            ->join('users', 'users.id = data_partisipan.user_id')
            ->where('partisipan_jenis', 'AccSMA')
            ->get()->getResult();
    }
    public function getDataUniv(){
        return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = data_main_round.partisipan_id')
            ->join('users', 'users.id = data_partisipan.user_id')
            ->where('partisipan_jenis', 'AccUniv')
            ->get()->getResult();
    }
    public function getDataCFP(){
        return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = data_main_round.partisipan_id')
            ->join('users', 'users.id = data_partisipan.user_id')
            ->where('partisipan_jenis', 'CFP')
            ->get()->getResult();
    }

    public function getDataUser($partisipan_id){
        return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = data_main_round.partisipan_id')
            ->join('users', 'users.id = data_partisipan.user_id')
            ->where('data_partisipan.partisipan_id', $partisipan_id)
            ->get()->getRow();
    }
}

?>