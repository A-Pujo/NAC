<?php

namespace App\Controllers;
use App\Models\M_Webinar;

use function PHPUnit\Framework\isNull;

class Webinar extends BaseController
{
    public function index(){
        return view('statis/pages/webinar');
    }
    public function dashboard(){
        $user_webinar = user_webinar();
        if(is_null($user_webinar)){
            return redirect()->to(base_url('webinar/pendaftaran'));
        }
        $model = new M_Webinar();
        if($user_webinar->instansi == 'PKN STAN'){
            $kuota = [
                info('webinar_kuota_stan_1') - $model->countStan('webinar_1'),
                info('webinar_kuota_stan_2') - $model->countStan('webinar_2'),
                info('webinar_kuota_stan_3') - $model->countStan('webinar_3'),
                info('webinar_kuota_stan_4') - $model->countStan('webinar_4'),
            ];
        } else {
            $kuota = [
                info('webinar_kuota_non_stan_1') - $model->countNonStan('webinar_1'),
                info('webinar_kuota_non_stan_2') - $model->countNonStan('webinar_2'),
                info('webinar_kuota_non_stan_3') - $model->countNonStan('webinar_3'),
                info('webinar_kuota_non_stan_4') - $model->countNonStan('webinar_4'),
            ];
        }
        $data =[
            'judul' => 'Selamat Datang Peserta Webinar / Open Ceremony',
            'halaman' => 'webinar',
            'peserta' => $user_webinar,
            'kuota' => $kuota,
        ];
        return view('dashboard/pages/webinar/index', $data);
    }
    public function pendaftaran(){
        if(user_webinar()){
            return redirect()->to(base_url('webinar/dashboard'));
        }

        // SUBMIT
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
                            return redirect()->to(base_url('webinar/dashboard'));
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
                            return redirect()->to(base_url('webinar/dashboard'));
                        }
                    }
                }
            }
        }

        // VIEW
        $data =[
            'judul' => 'Formulir pendaftaran Webinar',
            'halaman' => 'beranda',
        ];
        return view('dashboard/pages/webinar/pendaftaran', $data);
    }

    // === PROSES DARI HALAMAN DEPAN === //
    public function pilih($webinar_id){
        if(is_null(user_webinar())){
            // Belum isi biodata
            session()->set(['webinar_id' => $webinar_id]);
            return redirect()->to(base_url('webinar/pendaftaran'));
        } else {
            session()->set(['webinar_id' => $webinar_id]);
            return redirect()->to(base_url('webinar/dashboard'));
        }
    }
    public function pilih_opening(){
        $user_webinar = user_webinar();
        if(is_null($user_webinar)){
            // Daftar akun
            session()->set(['webinar_id' => 4]);
            return redirect()->to(base_url('webinar/pendaftaran'));
        } else {
            if($user_webinar->webinar_4 == '' || $user_webinar->webinar_4 == '0' ){
                //Klaim
                session()->set(['webinar_id' => 4]);
                return redirect()->to(base_url('webinar/dashboard'));
            } else {
                // Buka link zoom
                // session()->set(['zoom_id' => 4]);
                return redirect()->to(base_url('webinar/dashboard'));
            }
        }
    }
    public function get_zoom_id($zoom_id){
        $user_webinar = user_webinar();
        if(is_null($user_webinar)){
            // Daftar akun;
            return redirect()->to(base_url('webinar/pendaftaran'));
        } else {
            session()->set(['zoom_id' => $zoom_id]);
            return redirect()->to(base_url('webinar/dashboard'));
        }
    }
    // === END PROSES DARI HALAMAN DEPAN === //

    public function klaim(){
        $validasi = [
            'ig' => [
                'rules' => 'regex_match[/instagram.com\/p\//]',
                'errors' => [
                    'required' => 'Link share twibbon tidak valid',
                ],
            ],
        ];
        if(!$this->validate($validasi)){
            return redirect()->to('/webinar/dashboard')->withInput();
        }
        $webinar_id = $this->request->getVar('webinar_id');
        $instansi = $this->request->getVar('instansi');

        // == CEK KUOTA == //
            $kuota = new M_Webinar();
            if($instansi == 'PKN STAN'){
                $kuota = info('webinar_kuota_stan_'.$webinar_id) - $kuota->countStan('webinar_'.$webinar_id);
            } else {
                $kuota = info('webinar_kuota_stan_'.$webinar_id) - $kuota->countNonStan('webinar_'.$webinar_id);
            }
            if($kuota <= 0){
                session()->set(['webinar_id' => 0]);
                session()->setFlashdata('pesan-error', "Maaf, kuota telah habis");
                return redirect()->to(base_url('webinar/dashboard'));
            }
        // == END CEK KUOTA //

        $data = [
            'id' => $this->request->getVar('peserta_id'),
            'webinar_'.$webinar_id => 1,
            'pertanyaan_'.$webinar_id => $this->request->getVar('pertanyaan'),
        ];
        $model = new M_Webinar();
        $model->save($data);
        $judul = $this->request->getVar('judul');
        session()->setFlashdata('pesan-success', "Klaim tiket $judul berhasil");
        return redirect()->to(base_url('webinar/dashboard'));

    }
    public function absen(){
        // === VALIDASI PASSWORD === //
            $pass = $this->request->getVar('pass'); 
            $pass = preg_replace('/\s+/', '', $pass); // hapus whitespace 
            $pass = strtolower($pass); // konversi lowercase

            $absen_id = $this->request->getVar('absen_id');
            if($absen_id == 1 && $pass == strtolower(preg_replace('/\s+/', '', info('webinar_pass_1')))){
                $kode = 2;
            } elseif($absen_id == 2 && $pass == strtolower(preg_replace('/\s+/', '', info('webinar_pass_2')))){
                $kode = 2;
            } elseif($absen_id == 3 && $pass == strtolower(preg_replace('/\s+/', '', info('webinar_pass_3')))){
                $kode = 2;
            } else {
                $kode = $this->request->getVar('pass');
            }
        // === END VALIDASI PASSWORD === //

        $data = [
            'id' => $this->request->getVar('peserta_id'),
            'webinar_'.$absen_id => $kode,
        ];
        $model = new M_Webinar();
        $model->save($data);
        $judul = $this->request->getVar('judul');
        if($kode == 2){
            session()->setFlashdata('pesan-success', "Absen $judul berhasil. Silakan Anda mengunduh sertifikat pada tautan yang telah disediakan");
        } else {
            session()->setFlashdata('pesan-error', "Maaf, password yang Anda input salah. Silakan Anda menghubungi CP agar panitia dapat memvalidasi password Anda secara manual.");
        }
        return redirect()->to(base_url('webinar/dashboard'));

    }

    public function verif_absen($webinar_id){
        if( $data = $this->request->getVar('check')){
            $model = new \App\Models\M_Webinar();
            $model->update($data, ['webinar_'.$webinar_id => '2']);
            session()->setFlashdata('pesan-success', 'Update data Webinar #'.$webinar_id.' berhasil');
            return redirect()->to(base_url('dashboard/regis-webinar?page=default'));
        } else {
            session()->setFlashdata('pesan-error', 'Tidak ada data yang diupdate');
            return redirect()->to(base_url('dashboard/regis-webinar?page=default'));
        }
        
    }

}