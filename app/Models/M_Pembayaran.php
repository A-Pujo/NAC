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
}

?>