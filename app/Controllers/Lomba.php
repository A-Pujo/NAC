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
		$data=[
			'judul' => 'Perlombaan NAC 2021',
            'halaman' => 'lomba',
		];
		return view('dashboard/pages/lomba/index', $data);
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

	// Cek kode voucher
	// public function starting_page($kode_voucher = null){

	// 	$kode_voucher = $this->request->getGet('kode_voucher') ? $this->request->getGet('kode_voucher') : $kode_voucher;

	// 	if(!$this->PARTISIPAN_LOMBA->isValid($kode_voucher) or $kode_voucher == null){
	// 		return redirect()->to(base_url('/lomba'));
	// 	}
	// 	$data = [
	// 		'partisipan_info' => $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher),
	// 		'kode_voucher' => $kode_voucher,
	// 		'daftar_lomba' => [
	// 			'AuditUniv' => 'Lomba Audit Universitas',
	// 			'AccUniv' => 'Lomba Akuntansi Universitas',
	// 			'AccSMA' => 'Lomba Akuntansi Tingkat SMA',
	// 		],
	// 	];
	// 	return view('/test/lomba-partisipan-info', $data);
	// }

	// Prelim
	// public function percobaan_lomba($kode_voucher, $segmen = 1){
	// 	if(! in_array($segmen, [1,2,3])){
	// 		return redirect()->to(base_url('lomba'));
	// 	}
		
	// 	if(!$this->PARTISIPAN_LOMBA->isValid($kode_voucher) or $this->PARTISIPAN_LOMBA->isPercobaanHabis($kode_voucher, $segmen)){
	// 		return redirect()->to(base_url('dashboard'));
	// 	}
		
	// 	$data['partisipan_info'] = $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher);
	// 	$data['daftar_lomba'] =  [
	// 		'AuditUniv' => 'Lomba Audit Universitas',
	// 		'AccUniv' => 'Lomba Akuntansi Universitas',
	// 		'AccSMA' => 'Lomba Akuntansi Tingkat SMA',
	// 	];
	// 	$data['daftar_soal' ] = $this->SOAL->getSoal($data['partisipan_info']->kode_lomba, ($segmen - 1) * 50);
	// 	$data['daftar_pilihan'] = $this->JAWABAN->findAll();
	// 	$data['segmen'] = $segmen;
		
	// 	return view('statis/pages/prelim', $data);
	// }

	public function get_soal_all(){
		$voucher = $this->request->getVar('voucher');
		if(strlen($voucher) != 10){
			//jumlah karakter voucher salah
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
			return redirect()->to(base_url('lomba'));
		}
		
		if($this->PARTISIPAN_LOMBA->isPercobaanHabis($kode_voucher, $kode_segmen[$segmen])){
			session()->setFlashdata('error', 'Jawabanmu untuk segmen tersebut sudah terekam, silahkan tunggu kalkulasi nilai ya sobat.');
			return redirect()->to(base_url('lomba'));
		}

		$segmen = $kode_segmen[$segmen];

		// Get data partisipan
		$data_partisipan = $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher);
		if(!$data_partisipan){
			// kode_voucher tidak ada di db
			return redirect()->to(base_url('lomba'));
		}

		// Data Soal dan Pilihan Jawaban
		$soal = $this->SOAL->getSoal($data_partisipan->kode_lomba, ($segmen - 1) * 50);
		$soal_id = array_map(function($e){ return $e->soal_id; }, $soal);
		$pilihan_jawaban = $this->JAWABAN->whereIn('soal_id', $soal_id)->get()->getResult();

		// Jawaban User
		$jawaban_user = db()->table('jawaban_partisipan')->where('partisipan_kode_voucher', $kode_voucher)->where('segmen', $segmen)->get()->getResult();
		
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

		// === OLD === //
			// $data['daftar_soal' ] = $this->SOAL->getSoal($data['partisipan_info']->kode_lomba, ($segmen - 1) * 50);
			// $data['daftar_pilihan'] = $this->JAWABAN->findAll();
			// $data['segmen'] = $segmen;
			// return view('statis/pages/prelim', $data);
		// === OLD === //

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
		$step = $_GET['step']; // paginasi
		// $soal_all = session()->get('soal'); // data seluruh soal sesuai segmen
		// $soal_show = array_chunk($soal_all, 5)[$step - 1]; // soal per page
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
		// var_dump($data['partisipan_info']); die();
		// var_dump($data['daftar_soal']); die();
		return view('/statis/pages/prelim', $data);
	}

	// Jawaban prelim
	public function submit_jawaban($kode_voucher, $segmen){
		if(!$this->PARTISIPAN_LOMBA->isValid($kode_voucher)){
			return redirect()->to(base_url('/lomba/pengajuan-lomba'));
		}
		

		// dd($this->request->getPost());
		// $data['partisipan_info'] = $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher);
		// if($data['partisipan_info']->kode_lomba == 'AuditUniv'){
		// 	if(! $this->validate([
		// 		'jawaban_1' => [
		// 			'rules' => 'uploaded[jawaban_1]|max_size[jawaban_1,10000]|ext_in[jawaban_1,pdf]',
		// 			'errors' => [
		// 				'uploaded' => lang('Validasi.required'),
		// 				'max_size' => lang('Validasi.max_size', ['file jawaban', '10MB']),
		// 				'ext_in' => lang('Validasi.ext_in', ['file jawaban', 'berupa pdf']),
		// 			]
		// 		],
		// 		'jawaban_2' => [
		// 			'rules' => 'max_size[jawaban_2,10000]|ext_in[jawaban_2,pdf]',
		// 			'errors' => [
		// 				'max_size' => lang('Validasi.max_size', ['file jawaban 1', '10MB']),
		// 				'ext_in' => lang('Validasi.ext_in', ['file jawaban 2', 'berupa pdf']),
		// 			]
		// 		]
		// 	])){
		// 		return redirect()->to(base_url('/lomba/percobaan-lomba/'.$kode_voucher))->withInput();	
		// 	} else {
		// 		$img = $this->request->getFile('jawaban_1');
		// 		if($img->isValid() and ! $img->hasMoved()){
		// 			$jawabanFile = $img->getRandomName();
		// 			$img->move(APPPATH . '../public/uploads/partisipan/lomba/audit/', $jawabanFile);
	
		// 			$daftar_soal = $this->request->getVar('soal');
	
		// 			foreach ($daftar_soal as $soal) {
		// 				$jawaban = $this->JAWABAN->ifJawabanIsFile($soal, $jawabanFile);
	
		// 				$this->JAWABAN_PARTISIPAN->insert([
		// 					'soal_id' => $soal,
		// 					'jawaban_id' => $jawaban->jawaban_id,
		// 					'partisipan_kode_voucher' => $kode_voucher,
		// 				]);
		// 			}
		// 		}
	
		// 		$img = $this->request->getFile('jawaban_2');
		// 		if($img->isValid() and ! $img->hasMoved()){
		// 			$jawabanFile = $img->getRandomName();
		// 			$img->move(APPPATH . '../public/uploads/partisipan/lomba/audit/', $jawabanFile);
	
		// 			$daftar_soal = $this->request->getVar('soal');
	
		// 			foreach ($daftar_soal as $soal) {
		// 				$jawaban = $this->JAWABAN->ifJawabanIsFile($soal, $jawabanFile);
	
		// 				$this->JAWABAN_PARTISIPAN->insert([
		// 					'soal_id' => $soal,
		// 					'jawaban_id' => $jawaban->jawaban_id,
		// 					'partisipan_kode_voucher' => $kode_voucher,
		// 				]);
		// 			}
		// 		}
		// 	}
		// } elseif($data['partisipan_info']->kode_lomba == 'AccUniv' or $data['partisipan_info']->kode_lomba == 'AccSMA'){
			// $daftar_soal = $this->request->getVar('soal'); 
			// $jawaban = $this->request->getVar('jawaban');

			// foreach($daftar_soal as $soal){
			// 	$this->JAWABAN_PARTISIPAN->insert([
			// 		'soal_id' => $soal,
			// 		'jawaban_id' => $jawaban[$soal],
			// 		'partisipan_kode_voucher' => $kode_voucher,
			// 	]);
			// }
		// } else {
		// 	return 'asu';
		// }

		//=== UPDATE DATA JAWABAN ===//
			$jawaban = $this->request->getVar('jawaban');
			$jawaban_user_id = $this->request->getVar('jawaban_user_id');
			foreach($jawaban_user_id as $id){
				$this->JAWABAN_PARTISIPAN->update($id,['jawaban_id' => $jawaban[$id]]);
			}
		//=== END UPDATE DATA JAWABAN ===//

		//=== RESET JAWABAN USER ===//
			$jawaban_user = db()->table('jawaban_partisipan')->where('partisipan_kode_voucher', $kode_voucher)->where('segmen', $segmen)->get()->getResult();
			session()->set(['jawaban_user' => $jawaban_user]);
		//=== END RESET JAWABAN USER ===/

		//=== NAVIGASI ===//
			$nav = $this->request->getVar('nav');
			$step = $this->request->getVar('step');
			if($nav == 'next'){
				return redirect()->to(base_url('/lomba/prelim?step='.$step + 1));
			} elseif($nav == 'prev') {
				return redirect()->to(base_url('/lomba/prelim?step='.$step - 1));
			} else {
				$this->PARTISIPAN_LOMBA->where(['kode_voucher' => $kode_voucher])->update(null, ['kuota_' . $segmen => 0]);
				return redirect()->to(base_url());
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
		
		$data['voucher'] = $kode_voucher;
		$data['record_jawaban'] = $this->JAWABAN_PARTISIPAN->getSingleJawabanPartisipan($kode_voucher);

		return view('dashboard/pages/lomba/reviu-lju', $data);
	}
}
