<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Jawaban extends Model
{
    protected $table      = 'pilihan_jawaban';

    protected $returnType     = 'object';

    protected $allowedFields = ['soal_id', 'jawaban_kode', 'jawaban_teks', 'jawaban_kode_benar'];

    function ifJawabanIsFile($soal_id, $nama_file){
        $this->insert([
            'soal_id' => $soal_id,
            'jawaban_kode' => '',
            'jawaban_teks' => $nama_file,
            'jawaban_kode_benar' => 'esai',
        ]);

        return $this->where(['jawaban_teks' => $nama_file])->first();
    }
}

?>