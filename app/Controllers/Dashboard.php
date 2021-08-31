<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	protected $PARTISIPAN, $PEMBAYARAN, $RUG;

	function __construct(){
		$this->PARTISIPAN = new \App\Models\M_Partisipan();
        $this->PEMBAYARAN = new \App\Models\M_Pembayaran();
        $this->RUG =  new \App\Models\M_RUG();
	}


	public function index()
	{
        $data =[
            'judul' => 'Selamat Datang',
            'halaman' => 'beranda',
        ];
        echo view('dashboard/pages/home', $data);
	}

    public function pendaftaran()
	{
        if(!isInRole('umum')){
            return redirect()->to(base_url('/dashboard'));
        }
        $data =[
            'judul' => 'Pendaftaran Lomba',
            'halaman' => 'pendaftaran',
        ];
        return view('dashboard/pages/pendaftaran', $data);
	}

    public function pembayaran()
	{
        if(!isInRole('umum')){
            return redirect()->to(base_url('/dashboard'));
        } elseif(userinfo()->partisipan_aktif == 0){
            return redirect()->to(base_url('/dashboard'));
        }
        
        $data =[
            'judul' => 'Pembayaran Lomba',
            'halaman' => 'pembayaran',
        ];
        return view('dashboard/pages/pembayaran', $data);
	}

    public function admin($page = null){
        if(!isInRole('admin')){
            return redirect()->to(base_url('/dashboard'));
        }
        $data = [
            'data_partisipan' => $this->RUG->getAllUserRole(),
            'judul' => 'Kelola Role',
            'halaman' => 'admin',
        ];
        
        if($page == 'tim-regis'){
            $data['judul'] = 'Kelola Tim Registrasi';
            return view('dashboard/pages/admin-kelola-tim-regis', $data);
        } else if($page == 'tim-bendahara'){
            $data['judul'] = 'Kelola Tim Bendahara';
            return view('dashboard/pages/admin-kelola-tim-bendahara', $data);
        }
        return view('dashboard/pages/admin', $data);
    }

    public function tambah_anggota($page = null){
        $data = [
            'data_partisipan' => $this->RUG->getAllUserRole(),
            'halaman' => 'admin',
        ];
        
        if($page == 'tim-regis'){
            $data['judul'] = 'Tambah Tim Registrasi';
            return view('dashboard/pages/admin-tambah-tim-regis', $data);
        } else if($page == 'tim-bendahara'){
            $data['judul'] = 'Tambah Tim Bendahara';
            return view('dashboard/pages/admin-tambah-tim-bendahara', $data);
        }
        return view('dashboard/pages/admin', $data);
    }

    public function tambah_registrasi($user_id = null){
        if($user_id != null){
            $this->RUG->setUserRole($user_id, 91);
        }
        return redirect()->to(base_url('/dashboard/admin'));
    }

    public function tambah_bendahara($user_id = null){
        if($user_id != null){
            $this->RUG->setUserRole($user_id, 92);
        }
        return redirect()->to(base_url('/dashboard/admin'));
    }

    public function hapus_role($user_id = null){
        if($user_id != null){
            $this->RUG->setUserRole($user_id, 0);
        }
        return redirect()->to(base_url('/dashboard/admin'));
    }

    public function verifikasi_pendaftaran($id = null){
        if(! isInRole('tim registrasi')){
            return redirect()->to(base_url('/dashboard'));
        }

        if($id == null){
            $data = [
                'judul' => 'Data Peserta',
                'halaman' => 'kelola-pendaftaran',
                'data_partisipan' => $this->PARTISIPAN->getAll(),
            ];
    
            return view('dashboard/pages/verifikasi-pendaftaran', $data);
        } else {
            $data = [
                'judul' => 'Verifikasi Peserta',
                'halaman' => 'kelola-pendaftaran',
                'partisipan' => $this->PARTISIPAN->getSingle($id),
            ];
    
            return view('dashboard/pages/verifikasi-pendaftaran-single', $data);
        }

    }

    public function verifikasi_pembayaran($id = null){
        if(! isInRole('tim bendahara')){
            return redirect()->to(base_url('/dashboard'));
        }
        if($id == null){
            $data = [
                'judul' => 'Data Peserta',
                'halaman' => 'kelola-pembayaran',
                'data_partisipan' => $this->PARTISIPAN->getAll(),
            ];
    
            return view('dashboard/pages/verifikasi-pembayaran', $data);
        } else {
            $data = [
                'judul' => 'Data Peserta',
                'halaman' => 'kelola-pembayaran',
                'partisipan' => $this->PARTISIPAN->getSingle($id),
            ];
    
            return view('dashboard/pages/verifikasi-pembayaran-single', $data);
        }

    }

    public function update_pendaftaran(){
        $validasi = [
            'pt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
            'nama_ketua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
            'nama_1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
            'nama_2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
            'partisipan_jenis' => [
                'rules' => 'in_list[AuditUniv,AccUniv,AccSMA]',
                'errors' => [
                    'in_list' => lang('Validasi.in_list', ['2 pilihan dari Audit Universitas, Akuntansi Universita, atau Akuntansi SMA']),
                ],
            ],
            'wa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
        ];

        if($this->request->getVar('nama_tim_lama') == $this->request->getVar('nama_tim')){
            $validasi['nama_tim'] = [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ];
        } else {
            $validasi['nama_tim'] = [
                'rules' => 'required|is_unique[data_partisipan.nama_tim]',
                'errors' => [
                    'required' => lang('Validasi.required'),
                    'is_unique' => lang('Validasi.is_unique'),
                ],
            ];
        }

        if(empty(userinfo()->ktm)){
            $validasi['ktm'] = [
                'rules' => 'uploaded[ktm]|max_size[ktm,2048]|ext_in[ktm,jpg,png,jpeg]',
                'errors' => [
                    'uploaded' => lang('Validasi.required'),
                    'max_size' => lang('Validasi.max_size', ['bukti KTM', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti KTM', 'jpg, jpeg, atau png']),
                ],
            ];
        } else {
            $validasi['ktm'] = [
                'rules' => 'max_size[ktm,2048]|ext_in[ktm,jpg,png,jpeg]',
                'errors' => [
                    'max_size' => lang('Validasi.max_size', ['bukti KTM', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti KTM', 'jpg, jpeg, atau png']),
                ],
            ];
        }

        if(empty(userinfo()->twibbon)){
            $validasi['twibbon'] = [
                'rules' => 'uploaded[twibbon]|max_size[twibbon,2048]|ext_in[twibbon,jpg,png,jpeg]',
                'errors' => [
                    'uploaded' => lang('Validasi.required'),
                    'max_size' => lang('Validasi.max_size', ['bukti twibbon', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti twibbon', 'jpg, jpeg, atau png']),
                ],
            ];
        } else {
            $validasi['twibbon'] = [
                'rules' => 'max_size[twibbon,2048]|ext_in[twibbon,jpg,png,jpeg]',
                'errors' => [
                    'max_size' => lang('Validasi.max_size', ['bukti twibbon', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti twibbon', 'jpg, jpeg, atau png']),
                ],
            ];
        }

        if(empty(userinfo()->surat_pernyataan)){
            $validasi['surat_pernyataan'] = [
                'rules' => 'uploaded[surat_pernyataan]|max_size[surat_pernyataan,2048]|ext_in[surat_pernyataan,pdf,doc,docx]',
                'errors' => [
                    'uploaded' => lang('Validasi.required'),
                    'max_size' => lang('Validasi.max_size', ['bukti surat pernyataan', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti surat pernyataan', 'pdf, doc, atau docx']),
                ],
            ];
        } else {
            $validasi['surat_pernyataan'] = [
                'rules' => 'max_size[surat_pernyataan,2048]|ext_in[surat_pernyataan,pdf,doc,docx]',
                'errors' => [
                    'max_size' => lang('Validasi.max_size', ['bukti surat pernyataan', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti surat pernyataan', 'pdf, doc, atau docx']),
                ],
            ];
        }

        if(! $this->validate($validasi)){
            return redirect()->to('/dashboard/pendaftaran')->withInput();
        } else {
            $ktm = array();
            $twibbon = array();
            $surat_pernyataan = '';

            if($uploadedFiles = $this->request->getFiles()){
                if(count($uploadedFiles['ktm']) > 3 or count($uploadedFiles['twibbon']) > 3){
                    return redirect()->to(base_url('/dashboard'));
                } //cek jika upload lebih dari 3 file

                foreach($uploadedFiles['ktm'] as $img){ //upload ktm
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $newName = $img->getRandomName();
                        $img->move(APPPATH . '../public/uploads/partisipan/ktm', $newName);
                        array_push($ktm, $newName);
                    } else {
                        array_push($ktm, $this->request->getVar('old_ktm'));
                        array_unique($ktm);
                    }
                }
                if($this->request->getVar('old_ktm') != implode('|', $ktm) and $this->request->getVar('old_ktm') != null){
                    foreach(explode('|', $this->request->getVar('old_ktm')) as $ktmFile){
                        unlink(APPPATH.'../public/uploads/partisipan/ktm/' . $ktmFile);
                    }
                }

                foreach($uploadedFiles['twibbon'] as $img){ //upload twibbon
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $newName = $img->getRandomName();
                        $img->move(APPPATH . '../public/uploads/partisipan/twibbon', $newName);
                        array_push($twibbon, $newName);
                    } else {
                        array_push($twibbon, $this->request->getVar('old_twibbon'));
                        array_unique($twibbon);
                    }
                }
                if($this->request->getVar('old_twibbon') != implode('|', $twibbon) and $this->request->getVar('old_twibbon') != null){
                    foreach(explode('|', $this->request->getVar('old_twibbon')) as $twibbonFile){
                        unlink(APPPATH.'../public/uploads/partisipan/twibbon/' . $twibbonFile);
                    }
                }

                if($this->request->getFile('surat_pernyataan')->isValid() and ! $this->request->getFile('surat_pernyataan')->hasMoved()){
                    $surat_pernyataan = $this->request->getFile('surat_pernyataan')->getRandomName();
                    $this->request->getFile('surat_pernyataan')->move(APPPATH . '../public/uploads/partisipan/surat-pernyataan/', $surat_pernyataan);
                } else {
                    $surat_pernyataan = $this->request->getVar('old_surat_pernyataan');
                }
                
                if($this->request->getVar('old_surat_pernyataan') != $surat_pernyataan and $this->request->getVar('old_surat_pernyataan') != null){
                    unlink(APPPATH.'../public/uploads/partisipan/surat-pernyataan/' . $this->request->getVar('old_surat_pernyataan'));
                }
            }

            $partisipan_jenis = implode('|', $this->request->getVar('partisipan_jenis'));

            $record = [
                'pt' => $this->request->getVar('pt'),
                'nama_tim' => $this->request->getVar('nama_tim'),
                'nama_ketua' => $this->request->getVar('nama_ketua'),
                'nama_1' => $this->request->getVar('nama_1'),
                'nama_2' => $this->request->getVar('nama_2'),
                'partisipan_jenis' => $partisipan_jenis,
                'wa' => $this->request->getVar('wa'),
                'surat_pernyataan' => $surat_pernyataan,
                'ktm' => implode('|', $ktm),
                'twibbon' => implode('|', $twibbon),
            ];

            $this->PARTISIPAN->where(['user_id' => userinfo()->id])->update(null, $record);
            return redirect()->to(base_url('/dashboard'));
        }
    }

    public function update_pembayaran(){
        $validasi = [
            'nama_bank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
            'nama_nasabah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
            'nomor_rekening' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
            'jumlah_transfer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
        ];

        if(empty(userinfo()->bukti_transfer)){
            $validasi['bukti_transfer'] = [
                'rules' => 'uploaded[bukti_transfer]|max_size[bukti_transfer,2048]|ext_in[bukti_transfer,jpg,png,jpeg]',
                'errors' => [
                    'uploaded' => lang('Validasi.required'),
                    'max_size' => lang('Validasi.max_size', ['bukti transfer', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti transfer', 'jpg, jpeg, atau png']),
                ],
            ];
        } else {
            $validasi['bukti_transfer'] = [
                'rules' => 'max_size[bukti_transfer,2048]|ext_in[bukti_transfer,jpg,png,jpeg]',
                'errors' => [
                    'max_size' => lang('Validasi.max_size', ['bukti bukti_transfer', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti bukti_transfer', 'jpg, jpeg, atau png']),
                ],
            ];
        }

        if(! $this->validate($validasi)){
            return redirect()->to('/dashboard/pembayaran')->withInput();
        } else {
            $file = $this->request->getFile('bukti_transfer');
            if ($file->isValid() && ! $file->hasMoved()){
                $bukti_transfer = $file->getRandomName();
                $file->move(APPPATH . '../public/uploads/pembayaran/bukti', $bukti_transfer);
            } else {
                $bukti_transfer = $this->request->getVar('old_bukti_transfer');
            }
            if($this->request->getVar('old_bukti_transfer') != $bukti_transfer and $this->request->getVar('old_bukti_transfer') != null){
                unlink(APPPATH.'../public/uploads/pembayaran/bukti/' . $this->request->getVar('old_bukti_transfer'));
            }

            $record = [
                'nama_bank' => $this->request->getVar('nama_bank'),
                'nama_nasabah' => $this->request->getVar('nama_nasabah'),
                'nomor_rekening' => $this->request->getVar('nomor_rekening'),
                'jumlah_transfer' => $this->request->getVar('jumlah_transfer'),
                'bukti_transfer' => $bukti_transfer,
            ];

            $this->PEMBAYARAN->where(['user_id' => userinfo()->id])->update(null, $record);
            return redirect()->to(base_url('/dashboard'));
        }
    }

    public function aktivasi_partisipan($user_id){
        if($user_id == null or !isInRole('tim registrasi')){
            return redirect()->to(base_url('/dashboard'));
        }
        $this->PARTISIPAN->setActive($user_id);
        return redirect()->to(base_url('/dashboard/verifikasi-pendaftaran'));
    }

    public function deaktivasi_partisipan($user_id){
        if($user_id == null or !isInRole('tim registrasi')){
            return redirect()->to(base_url('/dashboard'));
        }
        $this->PARTISIPAN->setDeactive($user_id);
        return redirect()->to(base_url('/dashboard/verifikasi-pendaftaran'));
    }
    
    public function aktivasi_pembayaran($user_id){
        if($user_id == null or !isInRole('tim bendahara')){
            return redirect()->to(base_url('/dashboard'));
        }
        $this->PEMBAYARAN->setActive($user_id);
        $this->RUG->setUserRole($user_id, 2);
        return redirect()->to(base_url('/dashboard/verifikasi-pembayaran'));
    }

    public function deaktivasi_pembayaran($user_id){
        if($user_id == null or !isInRole('tim bendahara')){
            return redirect()->to(base_url('/dashboard'));
        }
        $this->PEMBAYARAN->setDeactive($user_id);
        $this->RUG->setUserRole($user_id, 0);
        return redirect()->to(base_url('/dashboard/verifikasi-pembayaran'));
    }
}
?>