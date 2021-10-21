<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Nilai_Acc_Sma extends Model
{
    protected $table      = 'nilai_acc_sma';

    protected $returnType     = 'object';

    protected $allowedFields = [
        'absen_1',
        'absen_2',
        'absen_3',
        'absen_4',
        'absen_5',
        'absen_6',
        'absen_7',
        'absen_8',
        'absen_9',
        'absen_10',
        'absen_11',
        'semifinal',
        'final',
        'nilai_1',
        'nilai_2',
        'nilai_3',
        'nilai_4',
    ];
    

    public function isLulusPrelim($partisipan_id){
        return $this
        ->where('partisipan_id', $partisipan_id)
        ->get()->getRow()->prelim;
    }

    public function getAll($kolom = false, $kondisi = false, $order = 'nama_tim', $orderResult= 'ASC'){
        if($kolom){
            return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_acc_sma.partisipan_id')
            ->where($kolom, $kondisi)
            ->orderBy($order, $orderResult)
            ->get()->getResultArray();
        } else {
            return $this
            ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_acc_sma.partisipan_id')
            ->orderBy($order)
            ->get()->getResult();
        }
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
        ->orderBy('prelim_jawab_salah', 'ASC')
        ->get()->getResult();
    }

}