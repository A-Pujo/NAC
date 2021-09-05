<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pembayaran extends Model
{
    protected $table      = 'data_pembayaran';

    protected $returnType     = 'object';

    protected $allowedFields = ['user_id', 'nama_bank', 'nama_nasabah', 'nomor_rekening', 'jumlah_transfer', 'bukti_transfer', 'pembayaran_aktif', 'id_tim_bendahara'];

    protected $useTimestamps = true;
    protected $createdField  = 'pembayaran_dibuat';
    protected $updatedField  = 'pembayaran_diupdate';

    function setActive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['pembayaran_aktif' => 1, 'id_tim_bendahara' => userinfo()->id]);
    }

    function setDeactive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['pembayaran_aktif' => 0, 'id_tim_bendahara' => userinfo()->id]);
    }

    function setReject($user_id){
        $data = $this->where(['user_id' => $user_id])->first();

        // delete bukti pembayaran
        if(! empty($data->bukti_transfer)){
            unlink(APPPATH.'../public/uploads/pembayaran/bukti/' . $data->bukti_transfer);
        }

        $this->where(['user_id' => $user_id])->update(null, [
            'nama_bank' => '',
            'nama_nasabah' => '',
            'nomor_rekening' => '',
            'jumlah_transfer' => 0,
            'bukti_transfer' => '',
            'pembayaran_aktif' => 0,
            'id_tim_bendahara' => 0,
        ]);
    }
}

?>