<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Partisipan_Lomba extends Model
{
    protected $table      = 'partisipan_lomba';

    protected $returnType     = 'object';

    protected $allowedFields = ['partisipan_id', 'kode_lomba', 'partisipan_lomba', 'kode_voucher', 'percobaan'];
    
    function setPartisipanLomba($partisipan_id, $kode_lomba){
        if(!$this->isSelectedFully($partisipan_id)){
            if(!$this->isExist($partisipan_id, $kode_lomba)){
                $this->insert([
                    'partisipan_id' => $partisipan_id,
                    'kode_lomba' => $kode_lomba,
                    'kode_voucher' => hash('crc32b', $partisipan_id . '--' . $kode_lomba . '--' . date('d/m/Y')),
                    'percobaan' => $kode_lomba == 'AuditUniv' ? 1 : 3,
                ]);
            }
        }
    }

    function isExist($partisipan_id, $kode_lomba){
        $query = $this->where(['partisipan_id' => $partisipan_id, 'kode_lomba' => $kode_lomba])->findAll();
        return count($query) > 0 ? true : false;
    }

    function isValid($kode_voucher){
        $query = $this->where(['kode_voucher' => $kode_voucher])->findAll();
        return count($query) == 1 ? true : false;
    }

    function isSelectedFully($partisipan_id){
        $query = $this->where(['partisipan_id' => $partisipan_id])->findAll();
        return count($query) >= 2 ? true : false;
    }

    function getPartisipanInfo($kode_voucher){
        return $this->join('data_partisipan', 'data_partisipan.partisipan_id = partisipan_lomba.partisipan_id')->where(['kode_voucher' => $kode_voucher])->first();
    }

    function getAllPartisipan(){
        return $this->join('data_partisipan', 'data_partisipan.partisipan_id = partisipan_lomba.partisipan_id')->join('data_nilai', 'data_nilai.kode_voucher = partisipan_lomba.kode_voucher')
            ->findAll();
    }

    function isPercobaanHabis($kode_voucher){
        $query = $this->where(['kode_voucher' => $kode_voucher])->first();
        return $query->percobaan <= 0 ? true : false;
    }
}

?>