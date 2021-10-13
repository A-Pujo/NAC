<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Webinar extends Model
{
    protected $table      = 'peserta_webinar';
    protected $allowedFields = ['user_id', 'nama', 'npm', 'prodi', 'wa', 'instansi', 'webinar_1', 'webinar_2', 'webinar_3'];

    // public function cekSudahIsiBiodata($user_id){
    //     return $this->where('user_id', $user_id)->get()->getRow();
    // }

    public function getDataPeserta(){
        return $this
            ->join('users', 'users.id = peserta_webinar.user_id')
            ->where('email', session('loggedEmail'))
            ->get()->getRow();
    }
}

?>