<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai_CFP extends Model
{

    protected $table      = 'nilai_cfp';
    protected $primaryKey = 'id';
    protected $allowedFields = ['full_paper', 'nilai_1'];

    public function getUserData(){
        return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_cfp.partisipan_id')
            ->join('users', 'data_partisipan.user_id = users.id')
            ->where('email', session('LoggedEmail'))
            ->get()->getRow();
    }
    public function getAll(){
        return $this
        ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_cfp.partisipan_id')
        ->join('data_pembayaran', 'data_partisipan.user_id = data_pembayaran.user_id')
        ->orderBy('nama_tim')
        ->get()->getResult();
    }

}