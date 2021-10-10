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
        if(empty(user_kursus()) or !user_kursus()->verifikasi_peserta ?? false ){
            return redirect()->to('kursus/registrasi');
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
            $pendaftar = kuota('course') - db()->table('peserta_kursus')->countAllResults();
            if ($pendaftar <= 0){
                return redirect()->to('dashboard/pendaftaran-index');
            }
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
                'wa' => $this->request->getVar('wa'),
                'old_kartu_pelajar' => $this->request->getVar('old_kartu_pelajar'),
                'old_twibbon_kursus' => $this->request->getVar('old_twibbon_kursus'),
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
                'wa' => [
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

            if($data['old_twibbon_kursus'] == null){
                $validasi['twibbon_kursus'] = [
                    'rules' => 'uploaded[twibbon_kursus]|max_size[twibbon_kursus,600]|ext_in[twibbon_kursus,jpg,png,jpeg]',
                    'errors' => [
                        'uploaded' => lang('Validasi.required'),
                        'max_size' => lang('Validasi.max_size', ['Kartu Pelajar', '500 KB']),
                        'ext_in' => lang('Validasi.ext_in', ['Kartu Pelajar', 'jpg, jpeg, atau png']),
                    ],
                ];
            } else {
                $validasi['twibbon_kursus'] = [
                    'rules' => 'max_size[twibbon_kursus,600]|ext_in[twibbon_kursus,jpg,png,jpeg]',
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

                if($kp = $this->request->getFile('twibbon_kursus')){
                    if($kp->isValid() && ! $kp->hasMoved()){
                        $data['twibbon_kursus'] = $kp->getRandomName();
                        $kp->move(APPPATH . '../public/uploads/kursus/twibbon/', $data['twibbon_kursus']);

                        if($data['old_twibbon_kursus'] != null and $data['twibbon_kursus'] != $data['old_twibbon_kursus']){
                            unlink(APPPATH.'../public/uploads/kursus/twibbon/' . $data['old_twibbon_kursus']);
                        }
                    }
                }

                unset($data['old_kartu_pelajar']);
                unset($data['old_twibbon_kursus']);

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
        if(! isInRole('tim registrasi')){
            return redirect()->to(base_url('/dashboard'));
        }
        $builder = db()->table('peserta_kursus');
        $builder->select('*');
        $builder->join('users', 'users.id = peserta_kursus.id_user');
        $daftar_peserta = $builder->get()->getResult();
        if($user_id == null){
            $data = [
                'daftar_peserta' => $daftar_peserta,
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
        if(! isInRole('tim registrasi')){
            return redirect()->to(base_url('/dashboard'));
        }
        if($id_user==null or empty($this->PESERTA_K->where(['id_user' => $id_user])->first())){
            return redirect()->to(base_url('kursus/verifikasi'));
        }

        $this->PESERTA_K->where(['id_user' => $id_user])->update(null, ['verifikasi_peserta' => $value]);

        return redirect()->to(base_url('kursus/verifikasi'));
    }

    public function tolak_peserta($id_user = null, $value = 0){
        if(! isInRole('tim registrasi')){
            return redirect()->to(base_url('/dashboard'));
        }
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
            'wa' => '',
            'verifikasi_peserta' => 0,
            'alasan_ditolak' => $alasan,
            'peserta_ditolak' => $value,
        ]);

        return redirect()->to(base_url('kursus/verifikasi'));
    }

    // public function video(){

    //     return view('kursus/video');
    // }

    public function video_attempt($index_video = null){
        if(sekarang() < tanggal('start_course') || sekarang() > tanggal('finish_course')){
            session()->setFlashdata('pesan-error', 'Course hanya bisa dikerjakan pada tanggal 1-8 Oktober 2021');
            return redirect()->to('kursus');
        }
        $video = [
            'video_kursus_1' => 'https://www.youtube.com/embed/iShJI5MXqAo',
            'video_kursus_2' => 'https://www.youtube.com/embed/jcRe4x7StvA',
            'video_kursus_3' => 'https://www.youtube.com/embed/EiClmfPBf9Q',
            'video_kursus_4' => 'https://www.youtube.com/embed/d8-GHGd-CN0',
            'video_kursus_5' => 'https://www.youtube.com/embed/xLzEP3acMe0',
            'video_kursus_6' => 'https://www.youtube.com/embed/xCcs_cX7Duo',
            'video_kursus_7' => 'https://www.youtube.com/embed/6gqvqzPUnXs',
        ];

        if(! array_key_exists($index_video, $video)){
            return redirect()->to(base_url('dashboard/pages/kursus'));
        }

        $data = [
            'video' => $video[$index_video],
            'index' => explode('_',$index_video)[2],
            'judul' => 'Course NAC 2021',
            'halaman' => 'kursus',
        ];

        $this->PESERTA_K->where(['id_user' => userinfo()->id])->update(null, [$index_video => 1]);

        return view('dashboard/pages/kursus/video-show', $data);
    }

    public function kuis($index = null){
        if(sekarang() < tanggal('start_course') || sekarang() > tanggal('finish_course')){
            session()->setFlashdata('pesan-error', 'Course hanya bisa dikerjakan pada tanggal 1-8 Oktober 2021');
            return redirect()->to('kursus');
        }
        $kuis = ['video-1', 'video-2', 'video-3', 'video-4', 'video-5', 'video-6', 'video-7'];

        if(! in_array($index, $kuis)){
            return redirect()->to(base_url('kursus'));
        }
        // jika sebelumnya peserta udah ngerjakan kuis
        $kolom = 'nilai_video_' . explode('-', $index)[1];
        $pesertaArray = db()->table('peserta_kursus')
                ->where('id_user', userinfo()->id)
                ->get()->getResultArray()[0];
        if($pesertaArray[$kolom] == 1){
            return redirect()->to(base_url('kursus'));
        }
        
        
        $data['index'] = explode('-', $index)[1];
        $data['kuis'] = $index;
        $data['soal'] = $this->SOAL->where(['kode_lomba' => $index])->orderBy('RAND()')->findAll();
        $data['pilihan'] =  $this->PILIHAN->findAll();
        $data['judul'] = 'Course NAC 2021';
        $data['halaman'] = 'kursus';

        return view('dashboard/pages/kursus/kuis-show', $data);
    }

    public function submit_jawaban($index){
        if(sekarang() < tanggal('start_course') || sekarang() > tanggal('finish_course')){
            session()->setFlashdata('pesan-error', 'Course hanya bisa dikerjakan pada tanggal 1-8 Oktober 2021');
            return redirect()->to('kursus');
        }
        if($this->request->getPost()){
            $soal = $this->request->getVar('soal');
            $pilihan = $this->request->getVar('jawaban');
            $peserta = $this->PESERTA_K->where(['id_user' => userinfo()->id])->first();


            // jika sebelumnya peserta udah ngerjakan kuis
            $kolom = 'nilai_video_' . explode('-', $index)[1];
            $pesertaArray = db()->table('peserta_kursus')
                ->where('id_user', userinfo()->id)
                ->get()->getResultArray()[0];
            if($pesertaArray[$kolom] == 1){
                return redirect()->to(base_url('kursus'));
            }
        
            $pilihan_peserta = $this->JPK->join('soal', 'soal.soal_id = jawaban_peserta_kursus.soal_id')
            ->where(['kode_lomba' => $index, 'peserta_kursus_id' => $peserta->id_peserta])->findAll();
            
            // if(count($pilihan_peserta) > 0){
            //     return redirect()->to(base_url('kursus'));
            // }
            
            foreach($soal as $s){
                $this->JPK->insert(['peserta_kursus_id' => $peserta->id_peserta, 'soal_id' => $s, 'jawaban_id' => $pilihan[$s]]);
            }
            
            db()->table('peserta_kursus')
                ->where('id_user', userinfo()->id)
                ->update([$kolom => 1]);
        }

        return redirect()->to(base_url('kursus'));
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
        // dd($nilai);
        // dd([$nilai, 'nilai_'.$index]);
        $this->PESERTA_K->where(['id_peserta' => $peserta])->update(null, ['nilai_'.$index => $nilai]);

        return redirect()->to(base_url('kursus'));
    }

    public function kalkulasi_semua(){
        $peserta_kursus = $this->PESERTA_K->where('verifikasi_peserta', 1)->findAll();
        $array_nilai = array();

        // id_peserta
        foreach($peserta_kursus as $p){
            $record_jawaban = $this->JPK->join('soal', 'soal.soal_id = jawaban_peserta_kursus.soal_id')->join('pilihan_jawaban', 'pilihan_jawaban.jawaban_id = jawaban_peserta_kursus.jawaban_id')->where(['peserta_kursus_id' => $p->id_peserta])->findAll();
            // $record_jawaban = db()->table('jawaban_peserta_kursus')->join('soal', 'soal.soal_id=jawaban_peserta_kursus.soal_id')
            //                 ->join('pilihan_jawaban', 'pilihan_jawaban.jawaban_id=jawaban_peserta_kursus.jawaban_id')
            //                 ->where('peserta_kursus_id', $p->id_peserta)->get()->getResult();

            # init nilai
            $nilai_video_1 = $nilai_video_2 = $nilai_video_3 = $nilai_video_4 = $nilai_video_5 = $nilai_video_6 = $nilai_video_7 = 0;

            foreach($record_jawaban as $jawaban){
                if($jawaban->jawaban_kode == ''){
                    // do nothing
                }
                else if($jawaban->jawaban_kode == $jawaban->jawaban_kode_benar){
                    switch ($jawaban->kode_lomba) {
                        case 'video-1':
                            $nilai_video_1 += 2;
                            break;

                        case 'video-2':
                            $nilai_video_2 += 2;
                            break;

                        case 'video-3':
                            $nilai_video_3 += 2;
                            break;

                        case 'video-4':
                            $nilai_video_4 += 2;
                            break;

                        case 'video-5':
                            $nilai_video_5 += 2;
                            break;

                        case 'video-6':
                            $nilai_video_6 += 2;
                            break;

                        case 'video-7':
                            $nilai_video_7 += 2;
                            break;

                        default:
                            break;
                    }
                } else{
                    // switch ($jawaban->kode_lomba) {
                    //     case 'video-1':
                    //         $nilai_video_1 += 0;
                    //         break;

                    //     case 'video-2':
                    //         $nilai_video_2 += 0;
                    //         break;

                    //     case 'video-3':
                    //         $nilai_video_3 += 0;
                    //         break;

                    //     case 'video-4':
                    //         $nilai_video_4 += 0;
                    //         break;

                    //     case 'video-5':
                    //         $nilai_video_5 += 0;
                    //         break;

                    //     case 'video-6':
                    //         $nilai_video_6 += 0;
                    //         break;

                    //     case 'video-7':
                    //         $nilai_video_7 += 0;
                    //         break;

                    //     default:
                    //         break;
                    // }
                }

                $array_nilai[$p->id_peserta] = [
                    'nilai_video_1' => $nilai_video_1,
                    'nilai_video_2' => $nilai_video_2,
                    'nilai_video_3' => $nilai_video_3,
                    'nilai_video_4' => $nilai_video_4,
                    'nilai_video_5' => $nilai_video_5,
                    'nilai_video_6' => $nilai_video_6,
                    'nilai_video_7' => $nilai_video_7,
                ];

                // update db
                db()->table('peserta_kursus')->where('id_peserta', $p->id_peserta)->update([
                    'nilai_video_1' => $nilai_video_1,
                    'nilai_video_2' => $nilai_video_2,
                    'nilai_video_3' => $nilai_video_3,
                    'nilai_video_4' => $nilai_video_4,
                    'nilai_video_5' => $nilai_video_5,
                    'nilai_video_6' => $nilai_video_6,
                    'nilai_video_7' => $nilai_video_7,
                ]);
            }
            
        }
        dd($array_nilai);
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