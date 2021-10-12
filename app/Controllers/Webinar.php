<?php

namespace App\Controllers;
use App\Models\M_Webinar;

use function PHPUnit\Framework\isNull;

class Webinar extends BaseController
{

    public function __construct()
    {
        $model = new M_Webinar();
        $sudah_daftar = $model->getDataPeserta(userinfo()->id);
        if($sudah_daftar){
            return redirect()->to(base_url('/webinar'));
        }   
    }

    public function index(){
        return view('statis/pages/webinar');
    }
    public function dashboard(){
        $peserta = new M_Webinar();
        $data =[
            'judul' => 'Selamat Datang Peserta Webinar',
            'halaman' => 'webinar',
            'peserta' => $peserta->getDataPeserta(userinfo()->id),
        ];
        return view('dashboard/pages/webinar/index', $data);
    }
    public function pendaftaran(){
        // dd(base_url('webinar/pilih/'.session('webinar_id')));

        if(!is_null($this->request->getVar('submit'))){
            $validasi = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang('Validasi.required'),
                    ],
                ],
                'wa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang('Validasi.required'),
                    ],
                ],
            ];
            if(! $this->validate($validasi)){ // cek nama dan wa
                return redirect()->to('/webinar/pendaftaran')->withInput();
            } else {
                $validasi['is_stan'] = 
                    [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Pilih asal instansi Anda terlebih dahulu',
                        ],
                    ];
                if(!$this->validate($validasi)){
                    return redirect()->to('/webinar/pendaftaran')->withInput();
                } else {
                    if($this->request->getVar('is_stan') == 'non'){
                        $validasi['instansi'] = 
                        [
                            'rules' => 'required',
                            'errors' => [
                                'required' => lang('Validasi.required'),
                            ],
                        ]; 
                        if(!$this->validate($validasi)){
                            return redirect()->to('/webinar/pendaftaran')->withInput();
                        } else {
                            // Siap insert untuk non stan
                            $data = [
                                'user_id' => userinfo()->id,
                                'nama' => $this->request->getVar('nama'),
                                'npm' => '',
                                'prodi' => '',
                                'wa' => $this->request->getVar('wa'),
                                'instansi' => $this->request->getVar('instansi'),
                            ];
                            $model = new M_Webinar();
                            $model->insert($data);
                            return redirect()->to(base_url('webinar/pilih/'.session('webinar_id')));
                        }
                    } else {
                        $validasi['npm'] = 
                        [
                            'rules' => 'required',
                            'errors' => [
                                'required' => lang('Validasi.required'),
                            ],
                        ]; 
                        $validasi['prodi'] = 
                        [
                            'rules' => 'required',
                            'errors' => [
                                'required' => lang('Validasi.required'),
                            ],
                        ]; 
                        if(!$this->validate($validasi)){
                            return redirect()->to('/webinar/pendaftaran')->withInput();
                        } else {
                            // Siap insert untuk stan
                            $data = [
                                'user_id' => userinfo()->id,
                                'nama' => $this->request->getVar('nama'),
                                'npm' => $this->request->getVar('npm'),
                                'prodi' => $this->request->getVar('prodi'),
                                'wa' =>$this->request->getVar('wa'),
                                'instansi' => 'PKN STAN',
                            ];
                            $model = new M_Webinar();
                            $model->insert($data);
                            return redirect()->to(base_url('webinar/pilih/'.session('webinar_id')));
                        }
                    }
                }
            }
        }

        $data =[
            'judul' => 'Formulir pendaftaran Webinar',
            'halaman' => 'beranda',
        ];
        return view('dashboard/pages/webinar/pendaftaran', $data);
    }
    public function pilih($webinar_id){
        $model = new M_Webinar();
        $sudah_daftar = $model->getDataPeserta(userinfo()->id);
        if(is_null($sudah_daftar)){
            session()->set(['webinar_id' => $webinar_id]);
            return redirect()->to(base_url('webinar/pendaftaran'));
        }
    }

}