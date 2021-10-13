<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai_Acc_Univ extends Model
{
    protected $table      = 'nilai_acc_univ';

    protected $returnType     = 'object';

    public function isLulusPrelim($partisipan_id){
        return $this
        ->where('partisipan_id', $partisipan_id)
        ->get()->getRow()->prelim;
    }

    public function getAll(){
        return $this
        ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_acc_univ.partisipan_id')
        ->orderBy('nama_tim')
        ->get()->getResult();
    }

    public function getPrelim(){
        return $this
        ->select(
            '(segmen_1 + segmen_2 + segmen_3) as nilai_total,
            nama_tim,
            pt,
            prelim,
            prelim_jawab_benar,
            prelim_jawab_salah
            ')
        ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_acc_univ.partisipan_id')
        ->orderBy('prelim', 'DESC')
        ->orderBy('nilai_total', 'DESC')
        ->orderBy('prelim_jawab_salah', 'ASC')
        ->get()->getResult();
    }

}