<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	protected $PARTISIPAN, $PEMBAYARAN;

	function __construct(){
		$this->PARTISIPAN = new \App\Models\M_Partisipan();
        $this->PEMBAYARAN = new \App\Models\M_Pembayaran();
	}


	public function index()
	{
        return view('dashboard/pages/home');
	}

    public function pendaftaran()
	{
        if(! isInRole('tim registrasi')){
            return redirect()->to(base_url('/dashboard'));
        }
        return view('dashboard/pages/pendaftaran');
	}

    public function pembayaran()
	{
        if(! isInRole('tim pembayaran')){
            return redirect()->to(base_url('/dashboard'));
        }
        return view('dashboard/pages/pembayaran');
	}

    public function admin(){
        
        $data = [
            'data_partisipan' => $this->PARTISIPAN->getAll(),
        ];

        return view('dashboard/pages/admin', $data);
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
            'partisipan_jenis' => [
                'rules' => 'in_list[tim,individu]',
                'errors' => [
                    'in_list' => lang('Validasi.in_list', ['tim, atau individu']),
                ],
            ],
            'wa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ],
        ];

        if($this->request->getVar('partisipan_jenis') == 'tim'){
            $validasi['nama_1'] = [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ];
            $validasi['nama_2'] = [
                'rules' => 'required',
                'errors' => [
                    'required' => lang('Validasi.required'),
                ],
            ];
        }

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

        if(! $this->validate($validasi)){
            return redirect()->to('/dashboard')->withInput();
        } else {
            $ktm = array();
            $twibbon = array();
            if($uploadedFiles = $this->request->getFiles()){
                foreach($uploadedFiles['ktm'] as $img){
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $newName = $img->getRandomName();
                        $img->move(APPPATH . '../public/uploads/partisipan/ktm', $newName);
                        array_push($ktm, $newName);
                    }
                }
                if($this->request->getVar('old_ktm') != $ktm and $this->request->getVar('old_ktm') != null){
                    foreach(explode('|', $this->request->getVar('old_ktm')) as $ktmFile){
                        unlink(APPPATH.'../public/uploads/partisipan/ktm/' . $ktmFile);
                    }
                }
                foreach($uploadedFiles['twibbon'] as $img){
                    if ($img->isValid() && ! $img->hasMoved())
                    {
                        $newName = $img->getRandomName();
                        $img->move(APPPATH . '../public/uploads/partisipan/twibbon', $newName);
                        array_push($twibbon, $newName);
                    }
                }
                if($this->request->getVar('old_twibbon') != $twibbon and $this->request->getVar('old_twibbon') != null){
                    foreach(explode('|', $this->request->getVar('old_twibbon')) as $twibbonFile){
                        unlink(APPPATH.'../public/uploads/partisipan/twibbon/' . $twibbonFile);
                    }
                }
            }

            $record = [
                'pt' => $this->request->getVar('pt'),
                'nama_tim' => $this->request->getVar('nama_tim'),
                'nama_ketua' => $this->request->getVar('nama_ketua'),
                'nama_1' => $this->request->getVar('nama_1'),
                'nama_2' => $this->request->getVar('nama_2'),
                'partisipan_jenis' => $this->request->getVar('partisipan_jenis'),
                'wa' => $this->request->getVar('wa'),
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
                    'max_size' => lang('Validasi.max_size', ['bukti bukti_transfer', '2MB']),
                    'ext_in' => lang('Validasi.ext_in', ['bukti bukti_transfer', 'jpg, jpeg, atau png']),
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
            return redirect()->to('/dashboard')->withInput();
        } else {
            $file = $this->request->getFile('bukti_transfer');
            if ($file->isValid() && ! $file->hasMoved()){
                $bukti_transfer = $file->getRandomName();
                $file->move(APPPATH . '../public/uploads/pembayaran/bukti', $bukti_transfer);
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
        if($user_id == null or !isInRole('admin')){
            return redirect()->to(base_url());
        }
        $this->PARTISIPAN->setActive($user_id);
        return redirect()->to(base_url('/dashboard/admin'));
    }

    public function deaktivasi_partisipan($user_id){
        if($user_id == null or !isInRole('admin')){
            return redirect()->to(base_url());
        }
        $this->PARTISIPAN->setDeactive($user_id);
        return redirect()->to(base_url('/dashboard/admin'));
    }
    
    public function aktivasi_pembayaran($user_id){
        if($user_id == null or !isInRole('admin')){
            return redirect()->to(base_url());
        }
        $this->PEMBAYARAN->setActive($user_id);
        return redirect()->to(base_url('/dashboard/admin'));
    }

    public function deaktivasi_pembayaran($user_id){
        if($user_id == null or !isInRole('admin')){
            return redirect()->to(base_url());
        }
        $this->PEMBAYARAN->setDeactive($user_id);
        return redirect()->to(base_url('/dashboard/admin'));
    }
}
?>