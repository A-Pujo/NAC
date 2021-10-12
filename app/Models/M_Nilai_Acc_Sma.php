<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai_Acc_Sma extends Model
{
    protected $table      = 'nilai_acc_sma';

    protected $returnType     = 'object';

    public function getAll(){
        return $this
        ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_acc_sma.partisipan_id')
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
        ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_acc_sma.partisipan_id')
        ->orderBy('prelim', 'DESC')
        ->orderBy('nilai_total', 'DESC')
        ->orderBy('prelim_jawab_salah', 'DESC')
        ->get()->getResult();
    }

}