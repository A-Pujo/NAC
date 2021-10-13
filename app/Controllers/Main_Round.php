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

        $data = [
            'halaman' => 'data-diri',
            'judul' => 'Formulir Data Diri',
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
                // dd($validasi);
                return redirect()->to(base_url('main-round/lengkapi-data-diri'))->withInput();
            } else {
                $this->DATA_MAIN_ROUND->insertData($records);
                return 'ok';
            }
        }
    }

    public function kuisioner(){
        $data = [
            'halaman' => 'kuisioner',
            'judul' => 'Kuisioner Main ROund',
        ];
        return view('dashboard/pages/main-round/formulir-kuisioner', $data);
    }

    public function submit_kuisioner(){
        if($records = $this->request->getPost()){
            db()->table('data_kuisioner')->insert($records);
            return 'ok';
        }
    }

}