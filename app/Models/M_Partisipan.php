<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Partisipan extends Model
{
    protected $table      = 'data_partisipan';

    protected $returnType     = 'object';

    protected $allowedFields = ['user_id', 'pt', 'nama_tim', 'nama_ketua', 'nama_1', 'nama_2','partisipan_jenis', 'wa', 'ktm', 'twibbon', 'partisipan_aktif'];

    protected $useTimestamps = true;
    protected $createdField  = 'partisipan_dibuat';
    protected $updatedField  = 'partisipan_diupdate';

    function getAll(){
        return $this->join('users', 'users.id = data_partisipan.user_id')->join('data_pembayaran', 'data_pembayaran.user_id = data_partisipan.user_id')->findAll();
    }

    function getSingle($user_id){
        return $this->join('users', 'users.id = data_partisipan.user_id')->join('data_pembayaran', 'data_pembayaran.user_id = data_partisipan.user_id')->where(['id' => $user_id])->first();
    }

    function setActive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['partisipan_aktif' => 1]);
    }

    function setDeactive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['partisipan_aktif' => 0]);
    }
}

?>