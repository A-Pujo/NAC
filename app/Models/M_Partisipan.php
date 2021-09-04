<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Partisipan extends Model
{
    protected $table      = 'data_partisipan';

    protected $returnType     = 'object';

    protected $allowedFields = ['user_id', 'pt', 'nama_tim', 'nama_ketua', 'nama_1', 'nama_2', 'partisipan_jenis', 'wa', 'provinsi', 'file_abstrak', 'file_paper', 'surat_pernyataan', 'ktm', 'twibbon', 'partisipan_aktif', 'partisipan_ditolak', 'id_tim_regis', 'pertama_input'];

    protected $useTimestamps = true;
    protected $createdField  = 'partisipan_dibuat';
    protected $updatedField  = 'partisipan_diupdate';

    function getAll(){
        return $this->join('users', 'users.id = data_partisipan.user_id')->join('data_pembayaran', 'data_pembayaran.user_id = data_partisipan.user_id')
        ->join('role_user_groups', 'role_user_groups.user_id = users.id')->findAll();
    }

    function getAllWithVerificator(){
        $datas = $this->join('users', 'users.id = data_partisipan.user_id')
        ->join('data_pembayaran', 'data_pembayaran.user_id = data_partisipan.user_id')
        ->join('role_user_groups', 'role_user_groups.user_id = users.id')->findAll();

        $i = 0;
        for ($i=0; $i < count($datas) ; $i++) { 
            $datas[$i]->nama_verifikator = $datas[$i]->partisipan_aktif == 0 ? 'Tidak ada' : $this->db->table('users')->select()->where(['id' => $datas[$i]->id_tim_regis])->get()->getRow()->nama;
            $datas[$i]->nama_bendahara = $datas[$i]->pembayaran_aktif == 0 ? 'Tidak ada' : $this->db->table('users')->select()->where(['id' => $datas[$i]->id_tim_bendahara])->get()->getRow()->nama;
        }

        return $datas;
    }

    function getSingle($user_id){
        return $this->join('users', 'users.id = data_partisipan.user_id')->join('data_pembayaran', 'data_pembayaran.user_id = data_partisipan.user_id')->where(['id' => $user_id])->first();
    }

    function setActive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['partisipan_aktif' => 1, 'id_tim_regis' => userinfo()->id,]);
    }

    function setDeactive($user_id){
        return $this->where(['user_id' => $user_id])->update(null, ['partisipan_aktif' => 0, 'id_tim_regis' => userinfo()->id]);
    }

    function setReject($user_id){
        $data = $this->where(['user_id' => $user_id])->first();
        // delete sp
        unlink(APPPATH.'../public/uploads/partisipan/surat-pernyataan/' . $data->surat_pernyataan);

        // delete ktm
        foreach(explode('|', $data->ktm) as $ktmFile){
            unlink(APPPATH.'../public/uploads/partisipan/ktm/' . $ktmFile);
        }

        // delete twibbon
        foreach(explode('|', $data->twibbon) as $twibbonFile){
            unlink(APPPATH.'../public/uploads/partisipan/twibbon/' . $twibbonFile);
        }

        return $this->where(['user_id' => $user_id])->update(null, [
            'pt' => '',
            'nama_tim' => '',
            'nama_ketua' => '',
            'nama_1' => '',
            'nama_2' => '',
            'partisipan_jenis' => '',
            'wa' => '',
            'provinsi' => '',
            'surat_pernyataan' => '',
            'ktm' => '',
            'twibbon' => '',
            'partisipan_aktif' => 0, 
            'partisipan_ditolak' => 1,
            'id_tim_regis' => userinfo()->id,
        ]);
    }
}

?>