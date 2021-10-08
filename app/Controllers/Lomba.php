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
		if(!isLoggedIn()){
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

		// Cek apakah soal telah diakses oleh device tertentu
		if(!isset($_COOKIE['device_token'])){
			$klaim_akses = db()->table('data_device_prelim')->where(['kode_voucher' => $voucher, 'segmen' => $segmen])
							->get()->getResult();
			if(empty($klaim_akses)){
				db()->table('data_device_prelim')->insert(['kode_voucher' => $voucher, 'segmen' => $segmen, 'alamat_ip' => $_SERVER['REMOTE_ADDR']]);
				setcookie('device_token', hash('ripemd128', 'token-for-' . $_SERVER['REMOTE_ADDR']), time() + (3600 * 3), "/");
			} else {
				if($_SERVER['REMOTE_ADDR'] != $klaim_akses[0]->alamat_ip){
					session()->setFlashdata('sudah_akses', 'Soal sedang diakses lewat device dengan alamat IP: ' . $_COOKIE['user_ip'] .'.');
					return redirect()->to(base_url());
				} else {
					setcookie('device_token', hash('ripemd128', 'token-for-' . $_SERVER['REMOTE_ADDR']), time() + (3600 * 3), "/");
				}
			}
		}



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
		// $jawaban_user = db()->table('jawaban_partisipan')->where('partisipan_kode_voucher', $kode_voucher)->where('segmen', $segmen)->get()->getResult();
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
				// var_dump($pilihan_jawaban); die();
	
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
				$jawaban_user = db()->table('jawaban_partisipan')->where('partisipan_kode_voucher', $kode_voucher)->where('segmen', $segmen)->get()->getResult();
			}
		//=== END USER PERTAMA AKSES SOAL ===//
			// dd($jawaban_user);
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
		if(sekarang() < tanggal('start_pre') || sekarang() > tanggal('finish_pre')){
			return redirect()->to(base_url('lomba'));
		}
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
			} elseif($nav == 'submit') {
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
			$nilai = 0;
			// Get id jawaban per user
			$jawaban_peserta_id = db()->table('jawaban_partisipan')->select('jawaban_id')->where('partisipan_kode_voucher', $voucher->partisipan_kode_voucher)->get()->getResult();
			$jawaban_peserta_id = array_map(function($e){ return $e->jawaban_id; }, $jawaban_peserta_id);
			// Get Jawaban per user
			$jawaban_peserta = db()->table('pilihan_jawaban')->whereIn('jawaban_id', $jawaban_peserta_id)->get()->getResult();
			// Cek jawaban
			foreach($jawaban_peserta as $jawaban){
				if($jawaban->jawaban_kode == $jawaban->jawaban_kode_benar){
					$nilai = $nilai + 2;
				} elseif($jawaban->jawaban_kode == ''){
					$nilai = $nilai + 0;
				} else{
					$nilai = $nilai -1;
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
					'prelim' => $nilai,
				]);
			} else if($kode_lomba == 'AccUniv') {
				db()->table('nilai_acc_univ')->insert([
					'partisipan_id' => $partisipan_id,
					'prelim' => $nilai,
				]);
			}
		}
	}

	public function reviu_lju($kode_voucher = null){
		if($kode_voucher == null or !$this->PARTISIPAN_LOMBA->isValid($kode_voucher)){
			return redirect()->to('lomba');
		}

		$record_nilai = null;
		// cek jenis lomba sudah ada
		if(userinfo()->partisipan_jenis == 'AccUniv'){
			$record_nilai = db()->table('nilai_acc_univ')->where('partisipan_id', userinfo()->partisipan_id)->get()->getResult();
		} else if(userinfo()->partisipan_jenis == 'AccSMA') {
			$record_nilai = db()->table('nilai_acc_sma')->where('partisipan_id', userinfo()->partisipan_id)->get()->getResult();
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
			if(userinfo()->partisipan_jenis == 'AccUniv'){
				db()->table('nilai_acc_univ')->insert(['partisipan_id' => userinfo()->partisipan_id, 'segmen_1' => $_nilai_1, 'segmen_2' => $_nilai_2, 'segmen_3' => $_nilai_3]);
			} else if(userinfo()->partisipan_jenis == 'AccSMA') {
				db()->table('nilai_acc_sma')->insert(['partisipan_id' => userinfo()->partisipan_id, 'segmen_1' => $_nilai_1, 'segmen_2' => $_nilai_2, 'segmen_3' => $_nilai_3]);
			}
			return redirect()->to(base_url('lomba/reviu-lju/' . $kode_voucher));
		}
		
		$data['nilai'] = $record_nilai[0];
		$data['voucher'] = $kode_voucher;
		$data['record_jawaban'] = $this->JAWABAN_PARTISIPAN->getSingleJawabanPartisipan($kode_voucher);
		$data['halaman'] = 'lomba';
		$data['judul'] = 'Hasil pengerjaan';

		return view('dashboard/pages/lomba/reviu-lju', $data);
		// return view('test/riviu-lju', $data);
	}
}
