<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pembayaran extends Model
{
    protected $table      = 'data_pembayaran';

    protected $returnType     = 'object';

    protected $allowedFields = ['user_id', 'nama_bank', 'nama_nasabah', 'nomor_rekening', 'jumlah_transfer', 'bukti_transfer', 'pembayaran_aktif'];

    protected $useTimestamps = true;
    protected $createdField  = 'pembayaran_dibuat';
    protected $updatedField  = 'pembayaran_diupdate';

    function setActive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['pembayaran_aktif' => 1]);
    }

    function setDeactive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['pembayaran_aktif' => 0]);
    }
}

?>