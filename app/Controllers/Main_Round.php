<?php
namespace App\Controllers;

use App\Models\M_Nilai_Acc_Sma;
use App\Models\M_Nilai_Acc_Univ;

class Main_Round extends BaseController
{
    
    protected $DATA_MAIN_ROUND;

    function __construct()
    {
        $this->DATA_MAIN_ROUND = new \App\Models\M_Data_Main_Round();
    }

    public function index(){
        $data = user_main_round();
        
        dd($data);
    }

    public function lengkapi_data_diri(){
        if(user_main_round()){
            return redirect()->to(base_url('lomba/dashboard'));
        }
        $user_info = userinfo();
        // === CEK KELULUSAN TAHAP X == //
            if($user_info->partisipan_jenis == 'AccSMA'){
                $nilai = new M_Nilai_Acc_Sma();
                $lulus = $nilai->isLulusPrelim($user_info->partisipan_id);
            } elseif($user_info->partisipan_jenis == 'AccUniv') {
                $nilai = new M_Nilai_Acc_Univ();
                $lulus = $nilai->isLulusPrelim($user_info->partisipan_id);
            }
            if(!$lulus){
                return redirect()->to(base_url('lomba/dashboard'));
            }
        // === END CEK KELULUSAN TAHAP X == //

        $data = [
            'halaman' => 'lomba',
            'judul' => 'Formulir Daftar Ulang',
            'user_info' => $user_info,
        ];
        return view('dashboard/pages/main-round/formulir-data-diri', $data);
    }

    public function submit_data_diri(){
        if($records = $this->request->getPost()){
            // dd($records);

            // array validasi
            $validasi = array();
            $array_keys = array_keys($records);
            foreach($array_keys as $key){
                $validasi[$key] = [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang('Validasi.required'),
                    ],
                ];
            }

            // koreksi array validasi semester
            $validasi['kelas_semester_ketua'] = [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => lang('Validasi.required'),
                    'numeric' => lang('Validasi.numeric'),
                ]
            ];

            $validasi['kelas_semester_1'] = [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => lang('Validasi.required'),
                    'numeric' => lang('Validasi.numeric'),
                ]
            ];

            $validasi['kelas_semester_2'] = [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => lang('Validasi.required'),
                    'numeric' => lang('Validasi.numeric'),
                ]
            ];

            // validasi
            if(!$this->validate($validasi)){
                return redirect()->to(base_url('Main_Round/lengkapi-data-diri'))->withInput();
            } else {
                array_splice($records, -2, 1);
                array_splice($records, -3, 1);
                array_splice($records, -4, 1);
                array_splice($records, -5, 1);
                $this->DATA_MAIN_ROUND->insertData($records);
                session()->setFlashdata('pesan-success', 'Data formulir daftar ulang telah berhasil disimpan');
                return redirect()->to(base_url('lomba/dashboard'));
            }
        }
    }

}