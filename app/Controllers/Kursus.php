<?php

namespace App\Controllers;

class Kursus extends BaseController{
    
    protected $PESERTA_K, $JPK, $SOAL, $PILIHAN;

    function __construct()
    {
        $this->PESERTA_K = new \App\Models\M_Peserta_Kursus();
        $this->JPK = new \App\Models\M_Jawaban_Peserta();
        $this->SOAL = new \App\Models\M_Soal();
        $this->PILIHAN = new \App\Models\M_Jawaban();
    }

    public function index(){
        if(!user_kursus()->verifikasi_peserta ?? false ){
            return redirect()->to('dashboard/pendaftaran-index');
        }
        $data = [
            'judul' => 'Course NAC 2021',
            'halaman' => 'kursus',
        ];

        return view('dashboard/pages/kursus/kursus-index', $data);
    }

    public function registrasi(){
        if(user_kursus()->verifikasi_peserta ?? false){
            return redirect()->to('dashboard/pendaftaran-index');
        }
        if(! $this->request->getPost()){
            $data = [
                'peserta' => $this->PESERTA_K->where(['id_user' => userinfo()->id])->first(),
                'judul' => 'Pendaftaran Kursus',
                'halaman' => 'pendaftaran',
            ];
            return view('dashboard/pages/kursus/regis', $data);
        } else {
            $data = [
                'id_user' => userinfo()->id,
                'nama_peserta' => $this->request->getVar('nama_peserta'),
                'nama_sekolah' => $this->request->getVar('nama_sekolah'),
                'old_kartu_pelajar' => $this->request->getVar('old_kartu_pelajar'),
            ];

            $validasi = [
                'nama_peserta' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang('Validasi.required'),
                    ],
                ],
                'nama_sekolah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => lang('Validasi.required'),
                    ],
                ],
            ];

            if($data['old_kartu_pelajar'] == null){
                $validasi['kartu_pelajar'] = [
                    'rules' => 'uploaded[kartu_pelajar]|max_size[kartu_pelajar,600]|ext_in[kartu_pelajar,jpg,png,jpeg]',
                    'errors' => [
                        'uploaded' => lang('Validasi.required'),
                        'max_size' => lang('Validasi.max_size', ['Kartu Pelajar', '500 KB']),
                        'ext_in' => lang('Validasi.ext_in', ['Kartu Pelajar', 'jpg, jpeg, atau png']),
                    ],
                ];
            } else {
                $validasi['kartu_pelajar'] = [
                    'rules' => 'max_size[kartu_pelajar,600]|ext_in[kartu_pelajar,jpg,png,jpeg]',
                    'errors' => [
                        'max_size' => lang('Validasi.max_size', ['Kartu Pelajar', '500 KB']),
                        'ext_in' => lang('Validasi.ext_in', ['Kartu Pelajar', 'jpg, jpeg, atau png']),
                    ],
                ];
            }

            if($this->validate($validasi)){
                if($kp = $this->request->getFile('kartu_pelajar')){
                    if($kp->isValid() && ! $kp->hasMoved()){
                        $data['kartu_pelajar'] = $kp->getRandomName();
                        $kp->move(APPPATH . '../public/uploads/kursus/kartu-pelajar/', $data['kartu_pelajar']);

                        if($data['old_kartu_pelajar'] != null and $data['kartu_pelajar'] != $data['old_kartu_pelajar']){
                            unlink(APPPATH.'../public/uploads/kursus/kartu-pelajar/' . $data['old_kartu_pelajar']);
                        }
                    }
                }

                unset($data['old_kartu_pelajar']);

                $_exist = $this->PESERTA_K->where(['id_user' => userinfo()->id])->first();
                if(empty($_exist)){
                    $this->PESERTA_K->insert($data);
                } else {
                    unset($data['id_user']);
                    $this->PESERTA_K->where(['id_user' => userinfo()->id])->update(null, $data);
                }
            } else {
                return redirect()->to('kursus/registrasi')->withInput();
            }
            return redirect()->to('dashboard/pendaftaran-index');
        }
    }

    public function verifikasi($user_id = null){
        if($user_id == null){
            $data = [
                'daftar_peserta' => $this->PESERTA_K->findAll(),
                'judul' => 'Verifikasi Pendaftaran Kursus',
                'halaman' => 'verifikasi-kursus',
            ];

            return view('dashboard/pages/kursus/verifikasi', $data);
        } else {
            $data = [
                'peserta' => $this->PESERTA_K->where(['id_user' => $user_id])->first(),
                'judul' => 'Verifikasi Pendaftaran Kursus',
                'halaman' => 'verifikasi-kursus',
            ];

            if(empty($data['peserta'])){
                return redirect()->to(base_url('kursus/verifikasi'));
            }

            return view('dashboard/pages/kursus/verifikasi-single', $data);
        }
    }

    public function aktivasi_peserta($id_user = null, $value = 0){
        if($id_user==null or empty($this->PESERTA_K->where(['id_user' => $id_user])->first())){
            return redirect()->to(base_url('kursus/verifikasi'));
        }

        $this->PESERTA_K->where(['id_user' => $id_user])->update(null, ['verifikasi_peserta' => $value]);

        return redirect()->to(base_url('kursus/verifikasi'));
    }

    public function tolak_peserta($id_user = null, $value = 0){
        if($id_user==null or empty($this->PESERTA_K->where(['id_user' => $id_user])->first())){
            return redirect()->to(base_url('kursus/verifikasi'));
        }

        $alasan = ($this->request->getGet('alasan_ditolak')) ? $this->request->getGet('alasan_ditolak') : '';

        $peserta = $this->PESERTA_K->where(['id_user' => $id_user])->first();

        if(! empty($peserta->kartu_pelajar)){
            unlink(APPPATH.'../public/uploads/kursus/kartu-pelajar/' . $peserta->kartu_pelajar);
        }

        $this->PESERTA_K->where(['id_user' => $id_user])->update(null, [
            'nama_peserta' => '',
            'nama_sekolah' => '',
            'kartu_pelajar' => '',
            'verifikasi_peserta' => 0,
            'alasan_ditolak' => $alasan,
            'peserta_ditolak' => $value,
        ]);

        return redirect()->to(base_url('kursus/verifikasi'));
    }

    public function video(){
        return view('kursus/video');
    }

    public function video_attempt($index_video = null){
        $video = [
            'video_kursus_1' => 'https://www.youtube.com/embed/QtXby3twMmI',
            'video_kursus_2' => 'https://www.youtube.com/embed/QtXby3twMmI',
            'video_kursus_3' => 'https://www.youtube.com/embed/QtXby3twMmI',
            'video_kursus_4' => 'https://www.youtube.com/embed/QtXby3twMmI',
            'video_kursus_5' => 'https://www.youtube.com/embed/QtXby3twMmI',
            'video_kursus_6' => 'https://www.youtube.com/embed/QtXby3twMmI',
            'video_kursus_7' => 'https://www.youtube.com/embed/QtXby3twMmI',
        ];

        if(! array_key_exists($index_video, $video)){
            return redirect()->to(base_url('kursus/video'));
        }

        $data = [
            'video' => $video[$index_video],
            'index' => $index_video,
        ];

        $this->PESERTA_K->where(['id_user' => userinfo()->id])->update(null, [$index_video => 1]);

        return view('kursus/video-single', $data);
    }

    public function kuis($index = null){
        $kuis = ['video-1', 'video-2', 'video-3', 'video-4', 'video-5', 'video-6', 'video-7'];

        if(! in_array($index, $kuis)){
            return redirect()->to(base_url('kursus/video'));
        }
        
        $data['kuis'] = $index;
        $data['soal'] = $this->SOAL->where(['kode_lomba' => $index])->orderBy('RAND()')->findAll();
        $data['pilihan'] =  $this->PILIHAN->findAll();

        return view('kursus/kuis', $data);
    }

    public function submit_jawaban($index){
        if($this->request->getPost()){
            $soal = $this->request->getVar('soal');
            $pilihan = $this->request->getVar('jawaban');
            $peserta = $this->PESERTA_K->where(['id_user' => userinfo()->id])->first();
            $pilihan_peserta = $this->JPK->join('soal', 'soal.soal_id = jawaban_peserta_kursus.soal_id')->where(['kode_lomba' => $index, 'peserta_kursus_id' => $peserta])->findAll();

            if(count($pilihan_peserta) > 0){
                return redirect()->to(base_url('kursus/video'));
            }
            
            foreach($soal as $s){
                $this->JPK->insert(['peserta_kursus_id' => $peserta->id_peserta, 'soal_id' => $s, 'jawaban_id' => $pilihan[$s]]);
            }

            return redirect()->to('kursus/kalkulasi/' . $peserta->id_peserta . '/' . $index);
        }

        return redirect()->to(base_url('kursus/video'));
    }

    public function kalkulasi($peserta, $index){
        $nilai = 0;
        $pilihan_peserta = $this->JPK->join('soal', 'soal.soal_id = jawaban_peserta_kursus.soal_id')->join('pilihan_jawaban', 'pilihan_jawaban.jawaban_id = jawaban_peserta_kursus.jawaban_id')->where(['kode_lomba' => $index, 'peserta_kursus_id' => $peserta])->findAll();
        $index = str_replace('-', '_', $index);
        $jumlah_soal = 10;
        // dd($pilihan_peserta);
        
        foreach($pilihan_peserta as $ps){
            if($ps->jawaban_kode == $ps->jawaban_kode_benar){
                $nilai++;
            }
        }

        $nilai = $nilai/$jumlah_soal * 100;
        // dd([$nilai, 'nilai_'.$index]);
        $this->PESERTA_K->where(['id_peserta' => $peserta])->update(null, ['nilai_'.$index => $nilai]);
    }

    public function peserta_index(){
        if(!isInRole('tim registrasi')){
            return redirect()->to(base_url('dashboard'));
        }
        $data = [
            'daftar_peserta' => $this->PESERTA_K->join('users', 'users.id = peserta_kursus.id_user')->findAll(),
            'judul' => 'Data Peserta Course',
            'halaman' => 'data-peserta-course',
        ];
        return view('dashboard/pages/kursus/peserta-index', $data);
    }

    public function nilai_index(){
        if(!isInRole('tim lomba')){
            return redirect()->to(base_url('dashboard'));
        }
        $data = [
            'daftar_peserta' => $this->PESERTA_K->join('users', 'users.id = peserta_kursus.id_user')->findAll(),
            'judul' => 'Data Nilai Course',
            'halaman' => 'data-nilai-kursus',
        ];
        return view('dashboard/pages/kursus/nilai-index', $data);
    }
}

?>