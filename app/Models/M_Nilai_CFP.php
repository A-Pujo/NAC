<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai_CFP extends Model
{

    protected $table      = 'nilai_cfp';
    protected $primaryKey = 'id';
    protected $allowedFields = ['full_paper', 'final', 'absen_1','nilai_1', 'nilai_2', 'nilai_3'];

    public function getUserData(){
        return $this
            ->select('*, nilai_cfp.id as id')
            ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_cfp.partisipan_id')
            ->join('users', 'data_partisipan.user_id = users.id')
            ->where('email', session('loggedEmail'))
            ->get()->getRow();
    }
    public function getLulusPendaftaran(){
        return $this
        ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_cfp.partisipan_id')
        ->join('data_pembayaran', 'data_partisipan.user_id = data_pembayaran.user_id')
        ->orderBy('nama_tim')
        ->get()->getResult();
    }

    public function getAll($kolom = false, $kondisi = false, $order = 'nama_tim', $orderResult= 'ASC'){
        if($kolom){
            return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_cfp.partisipan_id')
            ->where($kolom, $kondisi)
            ->orderBy($order, $orderResult)
            ->get()->getResultArray();
        } else {
            return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_cfp.partisipan_id')
            ->orderBy($order)
            ->get()->getResult();
        }

    }
    public function isLulusFullPaper($partisipan_id){
        return $this
        ->where('partisipan_id', $partisipan_id)
        ->get()->getRow()->full_paper;
    }

}