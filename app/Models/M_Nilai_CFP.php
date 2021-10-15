<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai_CFP extends Model
{

    protected $table      = 'nilai_cfp';
    protected $primaryKey = 'id';

    public function getUserData(){
        return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_cfp.partisipan_id')
            ->join('users', 'data_partisipan.user_id = users.id')
            ->where('email', session('LoggedEmail'))
            ->get()->getRow();
    }

}