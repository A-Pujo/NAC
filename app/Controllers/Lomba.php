<?php

namespace App\Controllers;

use function PHPUnit\Framework\isNull;

class Lomba extends BaseController
{
	protected $PARTISIPAN, $PARTISIPAN_LOMBA, $SOAL, $JAWABAN, $JAWABAN_PARTISIPAN, $NILAI;
	// Data Soal
	protected $soal, $jawaban;

	function __construct(){
		$this->PARTISIPAN = new \App\Models\M_Partisipan();
		$this->PARTISIPAN_LOMBA = new \App\Models\M_Partisipan_Lomba();
		$this->SOAL =  new \App\Models\M_Soal();
		$this->JAWABAN = new \App\Models\M_Jawaban();
		$this->JAWABAN_PARTISIPAN = new \App\Models\M_Jawaban_Partisipan();
		$this->NILAI = new \App\Models\M_Nilai();
	}

	// Form input voucher prelim
	public function index()
	{
		return view('statis/pages/prelim-input-voucher');
	}

	// dashboard perlombaan
	public function dashboard(){
		if(!isLoggedIn() or !isInRole('peserta lomba')){
			return redirect()->to(base_url('dashboard'));
		}

		$data=[
			'judul' => 'Perlombaan NAC 2021',
            'halaman' => 'lomba',
		];
		$lomba = userinfo()->partisipan_jenis;
		if($lomba == 'AccSMA'){
			return view('dashboard/pages/lomba/lomba-index-sma', $data);
		} elseif($lomba == 'AccUniv') {
			return view('dashboard/pages/lomba/lomba-index-univ', $data);
		} else {
			return view('dashboard/pages/lomba/lomba-index-cfp', $data);
		}
	}

	public function pengajuan_lomba(){
		if(!isLoggedIn() or userinfo()->pembayaran_aktif == 0){
			return redirect()->to(getGoogleClient()->createAuthUrl());
		}
		$data = [
			'data_partisipan' => $this->PARTISIPAN_LOMBA->where(['partisipan_id' => userinfo()->partisipan_id])->findAll(),
			'daftar_lomba' => [
				'AuditUniv' => 'Lomba Audit Universitas',
				'AccUniv' => 'Lomba Akuntansi Universitas',
				'AccSMA' => 'Lomba Akuntansi Tingkat SMA',
			],
		];
		return view('/test/ajukan-lomba.php', $data);
	}

	// Generate kode voucher masing-masing tim
	public function generate_voucher(){
		if(!isInRole('peserta lomba')){
			return redirect()->to(base_url('/dashboard'));
		}
		foreach(explode('|', userinfo()->partisipan_jenis) as $kode_lomba){
			if($kode_lomba == ''){
				continue;
			}
			$this->PARTISIPAN_LOMBA->setPartisipanLomba(userinfo()->partisipan_id, $kode_lomba);
			if(! $this->PARTISIPAN_LOMBA->isExist(userinfo()->partisipan_id, $kode_lomba)){
				$this->NILAI->insert(['kode_voucher' => hash('crc32b', userinfo()->partisipan_id . '--' . $kode_lomba . '--' . date('d/m/Y'))]);
			}
		}
		return redirect()->to(base_url('/lomba/dashboard'));
	}

	public function get_soal_all(){

		if(sekarang() < tanggal('start_pre') || sekarang() > tanggal('finish_pre')){
			session()->setFlashdata('pesan-error', 'Preliminary Round dapat diakses pada '.tanggal('start_pre')." hingga ".tanggal('finish_pre'));
			return redirect()->to(base_url('lomba'));
		}

		$voucher = $this->request->getVar('voucher');
		if(strlen($voucher) != 10){
			//jumlah karakter voucher salah
			session()->setFlashdata('pesan-error', 'Voucher tidak valid');
			return redirect()->to(base_url('lomba'));
		}
		// kode voucher : string
		$kode_voucher = str_split($voucher, 8)[0];
		// segmen : int
		$segmen = str_split($voucher, 8)[1];
		$kode_segmen = [
			'qw' => 1,
			'as' => 2,
			'zx' => 3,
		];
		if(!array_key_exists($segmen, $kode_segmen)){
			// kode segmen salah
			session()->setFlashdata('pesan-error', 'Voucher tidak valid');
			return redirect()->to(base_url('lomba'));
		}

		if(!isset($_COOKIE['device_token'])){
			// belum punya cokis
			$klaim_akses = db()->table('data_device_prelim')->where(['kode_voucher' => $voucher, 'segmen' => $segmen])
							->get()->getRow();
		
			if($klaim_akses){
				// udah ada yang akses : lempar ke home
				session()->setFlashdata('pesan-error', 'Soal dengan kode voucher '. $kode_voucher .' telah diakses menggunakan device dengan alamat IP: ' . $klaim_akses->alamat_ip .'.');
				return redirect()->to(base_url());
			} else {
				// belum ada yang akses : insert db + kasih COOKIES
				db()->table('data_device_prelim')->insert(['kode_voucher' => $voucher, 'segmen' => $segmen, 'alamat_ip' => $_SERVER['REMOTE_ADDR']]);
				setcookie('device_token', hash('ripemd128', 'token-for-' . $_SERVER['REMOTE_ADDR']), time() + (3600 * 3), "/");
			}
		}
		// punya cokis : next code



		$segmen = $kode_segmen[$segmen];
		// Get data partisipan
		$data_partisipan = $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher);
		if(!$data_partisipan){
			// kode_voucher tidak ada di db
			session()->setFlashdata('pesan-error', 'Voucher tidak valid');
			return redirect()->to(base_url('lomba'));
		}
		// Udah submit
		if($this->PARTISIPAN_LOMBA->isPercobaanHabis($kode_voucher, $segmen)){
			session()->setFlashdata('pesan-error', 'Jawaban Anda telah tersimpan, silahkan tunggu pengumuman nilai ya sobat.');
			return redirect()->to(base_url('lomba'));
		}

		// Data Soal dan Pilihan Jawaban
		$soal = $this->SOAL->getSoal($data_partisipan->kode_lomba, ($segmen - 1) * 50);
		$soal_id = array_map(function($e){ return $e->soal_id; }, $soal);
		$pilihan_jawaban = $this->JAWABAN->whereIn('soal_id', $soal_id)->get()->getResult();

		// Jawaban User
		$jawaban_user = $this->JAWABAN_PARTISIPAN->getJawabanUser($kode_voucher, $segmen);
		
		//=== USER PERTAMA AKSES SOAL : Isi db dengan data 'kosong' atau 'tidak menjawab' ===//
			if(!$jawaban_user) {
				// Jawaban kosong yang akan di input ke db
				$jawaban_kosong = array_filter(
					$pilihan_jawaban,
					function($e){
						return ($e->jawaban_kode == '');
					});
				$jawaban_kosong_id = array_values(array_map(function($e){ return $e->jawaban_id; }, $jawaban_kosong));
	
				// Isi database jawaban dengan jawaban 'kosong' atau 'tidak menjawab'
				for($i=0; $i<50; $i++){
					db()->table('jawaban_partisipan')->insert([
						'soal_id' => $soal_id[$i],
						'jawaban_id' => $jawaban_kosong_id[$i],
						'partisipan_kode_voucher' => $kode_voucher,
						'segmen' => $segmen,
					]);
				}
				// Ambil jawaban user yang barusan diinput
				$jawaban_user = $this->JAWABAN_PARTISIPAN->getJawabanUser($kode_voucher, $segmen);
			}
		//=== END USER PERTAMA AKSES SOAL ===//
		session()->set([
			'soal' => $soal,
			'jawaban' => $pilihan_jawaban,
			'segmen' => $segmen,
			'data_partisipan' => $data_partisipan,
			'jawaban_user' => $jawaban_user,
		]);

		return redirect()->to(base_url('/lomba/prelim?step=1'));
	}

	public function prelim(){
		if(sekarang() < tanggal('start_pre') || sekarang() > tanggal('finish_pre')){
			session()->setFlashdata('pesan-error', 'Waktu pengerjaan Preliminary Round telah habis');
			return redirect()->to(base_url('lomba'));
		}
		$step = $_GET['step']; // paginasi
		$data = [
			'partisipan_info' => session()->get('data_partisipan'), // data tim user
			// 'daftar_soal' => $soal_show,
			'daftar_soal' => session()->get('soal'),
			'daftar_pilihan' => session()->get('jawaban'), // data seluruh jawaban
			'segmen' => session()->get('segmen'), // segmen
			'daftar_lomba' => 	[ 	// konversi nama lomba
									'AccSMA' => 'Accounting for High School',
									'AccUniv' => 'Accounting for University',
			],
			'jawaban_user' => session()->get('jawaban_user'),
		];
		return view('/statis/pages/prelim', $data);
	}

	// Jawaban prelim
	public function submit_jawaban($kode_voucher, $segmen){
		// if(sekarang() < tanggal('start_pre') || sekarang() + 5000 > tanggal('finish_pre')){
		// 	return redirect()->to(base_url('lomba'));
		// }
		if(!$this->PARTISIPAN_LOMBA->isValid($kode_voucher)){
			return redirect()->to(base_url('/lomba/pengajuan-lomba'));
		}

		//=== UPDATE DATA JAWABAN ===//
			$jawaban = $this->request->getVar('jawaban');
			$jawaban_user_id = $this->request->getVar('jawaban_user_id');
			foreach($jawaban_user_id as $id){
				$this->JAWABAN_PARTISIPAN->update($id,['jawaban_id' => $jawaban[$id]]);
			}
		//=== END UPDATE DATA JAWABAN ===//

		//=== RESET JAWABAN USER ===//
			$jawaban_user = $this->JAWABAN_PARTISIPAN->getJawabanUser($kode_voucher, $segmen);
			session()->set(['jawaban_user' => $jawaban_user]);
		//=== END RESET JAWABAN USER ===/

		//=== NAVIGASI ===//
			$nav = $this->request->getVar('nav');
			$step = $this->request->getVar('step');
			if($nav == 'next'){
				return redirect()->to(base_url('/lomba/prelim?step='.$step + 1));
			} elseif($nav == 'prev') {
				return redirect()->to(base_url('/lomba/prelim?step='.$step - 1));
			} elseif($nav == 'submit' || $nav == null) {
				$this->PARTISIPAN_LOMBA->where(['kode_voucher' => $kode_voucher])->update(null, ['kuota_' . $segmen => 0]);
				session()->setFlashdata('pesan-success', 'Selamat, Anda telah menyelesaikan tahap Preliminary Round.');
				return redirect()->to(base_url());
			} else {
				return redirect()->to(base_url('/lomba/prelim?step='.ceil($nav/5)));
			}
		//=== END NAVIGASI ===//
	}

	public function kalkulasi(){
		// Get Data User 
		db()->table('nilai_acc_sma')->truncate();
		db()->table('nilai_acc_univ')->truncate();
		$voucher_peserta = db()->query('SELECT DISTINCT partisipan_kode_voucher FROM jawaban_partisipan')->getResult();
		foreach($voucher_peserta as $voucher){
			// Init Nilai per user
			$_nilai_1 = $_nilai_2 = $_nilai_3 = 0;
			$_prelim_jawab_benar = 0;
			$_prelim_jawab_salah = 0;
			// Get id jawaban per user
			// $jawaban_peserta_id = db()->table('jawaban_partisipan')->select('jawaban_id')->where('partisipan_kode_voucher', $voucher->partisipan_kode_voucher)->get()->getResult();
			// $jawaban_peserta_id = array_map(function($e){ return $e->jawaban_id; }, $jawaban_peserta_id);
			// Get Jawaban per user
			// $jawaban_peserta = db()->table('pilihan_jawaban')->whereIn('jawaban_id', $jawaban_peserta_id)->get()->getResult();

			// get jawaban
			$jawaban_peserta = $this->JAWABAN_PARTISIPAN->getSingleJawabanPartisipan($voucher->partisipan_kode_voucher);

			// Cek jawaban
			foreach($jawaban_peserta as $jawaban){
				if($jawaban->jawaban_kode == $jawaban->jawaban_kode_benar){
					if($jawaban->segmen == 1){
						$_nilai_1 = $_nilai_1 + 2;
						$_prelim_jawab_benar = $_prelim_jawab_benar + 1;
					}

					if($jawaban->segmen == 2){
						$_nilai_2 = $_nilai_2 + 2;
						$_prelim_jawab_benar = $_prelim_jawab_benar + 1;
					}

					if($jawaban->segmen == 3){
						$_nilai_3 = $_nilai_3 + 2;
						$_prelim_jawab_benar = $_prelim_jawab_benar + 1;
					}

				} elseif($jawaban->jawaban_kode == ''){
					if($jawaban->segmen == 1){
						$_nilai_1 = $_nilai_1 + 0;
					}

					if($jawaban->segmen == 2){
						$_nilai_2 = $_nilai_2 + 0;
					}

					if($jawaban->segmen == 3){
						$_nilai_3 = $_nilai_3 + 0;
					}

				} else{
					if($jawaban->segmen == 1){
						$_nilai_1 = $_nilai_1 -1;
						$_prelim_jawab_salah = $_prelim_jawab_salah + 1;
					}

					if($jawaban->segmen == 2){
						$_nilai_2 = $_nilai_2 - 1;
						$_prelim_jawab_salah = $_prelim_jawab_salah + 1;
					}

					if($jawaban->segmen == 3){
						$_nilai_3 = $_nilai_3 - 1;
						$_prelim_jawab_salah = $_prelim_jawab_salah + 1;
					}
				}
			}
			// Insert jawaban
			$partisipan = db()->table('partisipan_lomba')->where('kode_voucher', $voucher->partisipan_kode_voucher)->get()->getResult()[0];
			$partisipan_id = $partisipan->partisipan_id;
			$kode_lomba = $partisipan->kode_lomba;
			// dd($partisipan_id);
			if($kode_lomba == 'AccSMA') {
				db()->table('nilai_acc_sma')->insert([
					'partisipan_id' => $partisipan_id,
					'segmen_1' => $_nilai_1,
					'segmen_2' => $_nilai_2,
					'segmen_3' => $_nilai_3,
					'prelim_jawab_benar' => $_prelim_jawab_benar,
					'prelim_jawab_salah' => $_prelim_jawab_salah,
				]);
			} else if($kode_lomba == 'AccUniv') {
				db()->table('nilai_acc_univ')->insert([
					'partisipan_id' => $partisipan_id,
					'segmen_1' => $_nilai_1,
					'segmen_2' => $_nilai_2,
					'segmen_3' => $_nilai_3,
					'prelim_jawab_benar' => $_prelim_jawab_benar,
					'prelim_jawab_salah' => $_prelim_jawab_salah,
				]);
			}
		}
		return 'OK';
	}

	public function reviu_lju($kode_voucher = null){
		if($kode_voucher == null or !$this->PARTISIPAN_LOMBA->isValid($kode_voucher)){
			return redirect()->to('lomba');
		}

		$data_partisipan = db()->table('partisipan_lomba')->join('data_partisipan', 'data_partisipan.partisipan_id=partisipan_lomba.partisipan_id')
							->where('kode_voucher', $kode_voucher)->get()->getRow();

		$record_nilai = null;
		// cek jenis lomba sudah ada
		if($data_partisipan->partisipan_jenis == 'AccUniv'){
			$record_nilai = db()->table('nilai_acc_univ')->where('partisipan_id', $data_partisipan->partisipan_id)->get()->getResult();
		} else if($data_partisipan->partisipan_jenis == 'AccSMA') {
			$record_nilai = db()->table('nilai_acc_sma')->where('partisipan_id', $data_partisipan->partisipan_id)->get()->getResult();
		}

		// cek apa record nilai kosong dan generate
		if(empty($record_nilai)){
			$_jawaban = $this->JAWABAN_PARTISIPAN->getSingleJawabanPartisipan($kode_voucher);
			$_nilai_1 = $_nilai_2 = $_nilai_3 = 0;
			foreach($_jawaban as $jawaban){
				if($jawaban->jawaban_kode == $jawaban->jawaban_kode_benar){
					if($jawaban->segmen == 1){
						$_nilai_1 = $_nilai_1 + 2;
					}

					if($jawaban->segmen == 2){
						$_nilai_2 = $_nilai_2 + 2;
					}

					if($jawaban->segmen == 3){
						$_nilai_3 = $_nilai_3 + 2;
					}

				} elseif($jawaban->jawaban_kode == ''){
					if($jawaban->segmen == 1){
						$_nilai_1 = $_nilai_1 + 0;
					}

					if($jawaban->segmen == 2){
						$_nilai_2 = $_nilai_2 + 0;
					}

					if($jawaban->segmen == 3){
						$_nilai_3 = $_nilai_3 + 0;
					}

				} else{
					if($jawaban->segmen == 1){
						$_nilai_1 = $_nilai_1 -1;
					}

					if($jawaban->segmen == 2){
						$_nilai_2 = $_nilai_2 - 1;
					}

					if($jawaban->segmen == 3){
						$_nilai_3 = $_nilai_3 - 1;
					}
				}
			}

			// insert ke db
			if($data_partisipan->partisipan_jenis == 'AccUniv'){
				db()->table('nilai_acc_univ')->insert(['partisipan_id' => $data_partisipan->partisipan_id, 'segmen_1' => $_nilai_1, 'segmen_2' => $_nilai_2, 'segmen_3' => $_nilai_3]);
			} else if($data_partisipan->partisipan_jenis == 'AccSMA') {
				db()->table('nilai_acc_sma')->insert(['partisipan_id' => $data_partisipan->partisipan_id, 'segmen_1' => $_nilai_1, 'segmen_2' => $_nilai_2, 'segmen_3' => $_nilai_3]);
			}
			return redirect()->to(base_url('lomba/reviu-lju/' . $kode_voucher));
		}
		
		$data['nilai'] = $record_nilai[0];
		$data['voucher'] = $kode_voucher;
		$data['record_jawaban'] = $this->JAWABAN_PARTISIPAN->getSingleJawabanPartisipan($kode_voucher);
		$data['halaman'] = 'lomba';
		$data['judul'] = 'Hasil pengerjaan';
		$data['partisipan'] = $data_partisipan;

		return view('dashboard/pages/lomba/reviu-lju', $data);
		// return view('test/riviu-lju', $data);
	}
	public function lulus_prelim(){
		$peserta_lolos = db()->table('nilai_acc_sma')
		->select('id, (segmen_1 + segmen_2 + segmen_3) as nilai_total, prelim_jawab_salah, prelim_jawab_benar')
		// ->select('(segmen_1 + segmen_2 + segmen_3) as nilai_total, prelim_jawab_salah, prelim_jawab_benar, data_partisipan.partisipan_id, nama_tim, kode_voucher')
		// ->join('data_partisipan', 'data_partisipan.partisipan_id = nilai_acc_sma.partisipan_id')
		// ->join('partisipan_lomba', 'partisipan_lomba.partisipan_id = nilai_acc_sma.partisipan_id')
		->orderBy('nilai_total', 'DESC')
		->orderBy('prelim_jawab_salah', 'ASC')
		->orderBy('prelim_jawab_benar', 'DESC')
		->limit(20)
		->get()->getResult();
		foreach($peserta_lolos as $peserta){
			db()->table('nilai_acc_sma')->where('id', $peserta->id)->update(['prelim' => 1]);
		}
		$peserta_lolos = db()->table('nilai_acc_univ')
		->select('id, (segmen_1 + segmen_2 + segmen_3) as nilai_total, prelim_jawab_salah, prelim_jawab_benar')
		->orderBy('nilai_total', 'DESC')
		->orderBy('prelim_jawab_salah', 'ASC')
		->orderBy('prelim_jawab_benar', 'DESC')
		->limit(20)
		->get()->getResult();
		foreach($peserta_lolos as $peserta){
			db()->table('nilai_acc_univ')->where('id', $peserta->id)->update(['prelim' => 1]);
		}
	}

	public function upload_absen_sma(){
		if($records = $this->request->getPost()){
			if(!$this->validate([
				'bukti' => [
					'rules' => 'uploaded[bukti]|max_size[bukti,600]|ext_in[bukti,jpg,png,jpeg]',
					'errors' => [
						'uploaded' => lang('Validasi.required'),
						'max_size' => lang('Validasi.max_size', ['bukti', '500 KB']),
						'ext_in' => lang('Validasi.ext_in', ['bukti', 'jpg, jpeg, atau png']),
					],
				]
			])){
				session()->setFlashdata('pesan-error', 'Absen tidak terekam');
				return redirect()->to('lomba/dashboard')->withInput();
			} else {
				// file bukti
				$strBukti = [];
				if($files = $this->request->getFiles()){
					foreach($files['bukti'] as $file){
						if ($file->isValid() && ! $file->hasMoved()) {
							$newName = $file->getRandomName();
							$file->move(APPPATH . '../public/uploads/partisipan/lomba/absen', $newName);
							array_push($strBukti, $newName);
						}
					}

					// update db
					$strBukti = implode('|', $strBukti);
					db()->table('nilai_acc_sma')->where('id', $records['id'])->update(['absen_' . $records['absen_id'] => $strBukti]);
					session()->setFlashdata('pesan-success', 'Absen berhasil terekam');
					return redirect()->to('lomba/dashboard')->withInput();
				}
			}
		}
	}
	public function upload_absen_univ(){
		if($records = $this->request->getPost()){
			if(!$this->validate([
				'bukti' => [
					'rules' => 'uploaded[bukti]|max_size[bukti,600]|ext_in[bukti,jpg,png,jpeg]',
					'errors' => [
						'uploaded' => lang('Validasi.required'),
						'max_size' => lang('Validasi.max_size', ['bukti', '500 KB']),
						'ext_in' => lang('Validasi.ext_in', ['bukti', 'jpg, jpeg, atau png']),
					],
				]
			])){
				session()->setFlashdata('pesan-error', 'Absen tidak terekam');
				return redirect()->to('lomba/dashboard')->withInput();
			} else {
				// file bukti
				$strBukti = [];
				if($files = $this->request->getFiles()){
					foreach($files['bukti'] as $file){
						if ($file->isValid() && ! $file->hasMoved()) {
							$newName = $file->getRandomName();
							$file->move(APPPATH . '../public/uploads/partisipan/lomba/absen', $newName);
							array_push($strBukti, $newName);
						}
					}

					// update db
					$strBukti = implode('|', $strBukti);
					db()->table('nilai_acc_univ')->where('id', $records['id'])->update(['absen_' . $records['absen_id'] => $strBukti]);
					session()->setFlashdata('pesan-success', 'Absen berhasil terekam');
					return redirect()->to('lomba/dashboard')->withInput();
				}
			}
		}
	}

	public function verif_absen_sma(){
		if($records = $this->request->getPost()){
			// dd(array_keys($records));
			foreach (array_keys($records) as $id) {
				foreach(explode('|', $records['absen_'.$id]) as $file){
					unlink(APPPATH.'../public/uploads/partisipan/lomba/absen' . $file);
				}
				db()->table('nilai_acc_sma')->where('id', $records['id'])->update(['absen_1' => $records[$id]]);
			}
			return 'ok';
		} else {
			// return 'tidak kesubmit';
			return view('dashboard/pages/regis/sma/verif-absen-1');
		}
	}

	public function initial_cfp(){
		db()->table('nilai_cfp')->truncate();
		$partisipan = $this->PARTISIPAN->where('lolos_abstrak', 1)->findAll();
		foreach($partisipan as $p){
			db()->table('nilai_cfp')->insert(['partisipan_id' => $p->partisipan_id]);
		}
	}

	public function verif_paper($id){
		db()->table('nilai_cfp')->where('id', $id)->update(['full_paper' => 1]);
	}

	public function unverif_paper($id){
		db()->table('nilai_cfp')->where('id', $id)->update(['full_paper' => 0]);
	}

}
