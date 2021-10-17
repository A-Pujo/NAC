<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Webinar extends Model
{
    protected $table      = 'peserta_webinar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nama', 'npm', 'prodi', 'wa', 'instansi', 'webinar_1', 'webinar_2', 'webinar_3', 'webinar_4', 'pertanyaan_1', 'pertanyaan_2', 'pertanyaan_3','pertanyaan_4'];

    public function getDataPeserta(){
        return $this
            ->select('*, peserta_webinar.id as peserta_id, peserta_webinar.nama as nama')
            ->join('users', 'users.id = peserta_webinar.user_id')
            ->where('email', session('loggedEmail'))
            ->get()->getRow();
    }

    public function countStan($webinar){
        return $this
            ->where('instansi', 'PKN STAN')
            ->where($webinar.' !=', '0')
            ->countAllResults();
    }
    public function countNonStan($webinar){
        return $this
            ->where('instansi !=', 'PKN STAN')
            ->where($webinar.' !=', '0')
            ->countAllResults();
    }
    public function countAbsen($webinar){
        return $this
            ->whereNotIn($webinar,['0', '1'])
            ->countAllResults();
    }
    public function countVerifAbsen($webinar){
        return $this
            ->whereNotIn($webinar,['0', '1', '2'])
            ->countAllResults();
    }
    public function getVerifAbsen($webinar){
        return $this
            ->whereNotIn($webinar,['0', '1', '2'])
            ->get()->getResult();
            
    }

    public function getPertanyaan($webinar){
        return $this
            ->where("$webinar !=", '')
            ->where("$webinar !=", '-')
            ->where("$webinar !=", 'aman')
            ->where("$webinar !=", 'Belom ada')
            ->where("$webinar !=", 'Belom ada.')
            ->where("$webinar !=", 'Belum ada')
            ->where("$webinar !=", 'Belum ada.')
            ->where("$webinar !=", 'Tidak ada')
            ->where("$webinar !=", 'Tidak ada.')
            ->where("$webinar !=", 'Tidak')
            ->get()->getResultArray();
    }
}

?>