<?php

namespace App\Controllers;

class Lomba extends BaseController
{
	protected $PARTISIPAN, $PARTISIPAN_LOMBA, $SOAL, $JAWABAN, $JAWABAN_PARTISIPAN, $NILAI;

	function __construct(){
		$this->PARTISIPAN = new \App\Models\M_Partisipan();
		$this->PARTISIPAN_LOMBA = new \App\Models\M_Partisipan_Lomba();
		$this->SOAL =  new \App\Models\M_Soal();
		$this->JAWABAN = new \App\Models\M_Jawaban();
		$this->JAWABAN_PARTISIPAN = new \App\Models\M_Jawaban_Partisipan();
		$this->NILAI = new \App\Models\M_Nilai();
	}

	public function index()
	{
		return view('/test/lomba-landing-page');
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

	public function generate_voucher(){
		foreach(explode('|', userinfo()->partisipan_jenis) as $kode_lomba){
			if($kode_lomba == ''){
				continue;
			}
			$this->PARTISIPAN_LOMBA->setPartisipanLomba(userinfo()->partisipan_id, $kode_lomba);
			if(! $this->PARTISIPAN_LOMBA->isExist(userinfo()->partisipan_id, $kode_lomba)){
				$this->NILAI->insert(['kode_voucher' => hash('crc32b', userinfo()->partisipan_id . '--' . $kode_lomba . '--' . date('d/m/Y'))]);
			}
		}
		return redirect()->to(base_url('/lomba/pengajuan-lomba'));
	}

	public function starting_page($kode_voucher = null){

		$kode_voucher = $this->request->getGet('kode_voucher') ? $this->request->getGet('kode_voucher') : $kode_voucher;

		if(!$this->PARTISIPAN_LOMBA->isValid($kode_voucher) or $kode_voucher == null){
			return redirect()->to(base_url('/lomba'));
		}
		$data = [
			'partisipan_info' => $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher),
			'kode_voucher' => $kode_voucher,
			'daftar_lomba' => [
				'AuditUniv' => 'Lomba Audit Universitas',
				'AccUniv' => 'Lomba Akuntansi Universitas',
				'AccSMA' => 'Lomba Akuntansi Tingkat SMA',
			],
		];
		return view('/test/lomba-partisipan-info', $data);
	}

	public function percobaan_lomba($kode_voucher){
		if(!$this->PARTISIPAN_LOMBA->isValid($kode_voucher) or $this->PARTISIPAN_LOMBA->isPercobaanHabis($kode_voucher)){
			return redirect()->to(base_url('/lomba'));
		}

		$data['partisipan_info'] = $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher);
		$data['daftar_lomba'] =  [
			'AuditUniv' => 'Lomba Audit Universitas',
			'AccUniv' => 'Lomba Akuntansi Universitas',
			'AccSMA' => 'Lomba Akuntansi Tingkat SMA',
		];
		$data['daftar_soal' ] = $this->SOAL->getSoal($data['partisipan_info']->kode_lomba, ($data['partisipan_info']->percobaan -1 ) * 2);
		$data['daftar_pilihan'] = $this->JAWABAN->findAll();
		
		return view('/test/percobaan-lomba', $data);
	}

	public function submit_jawaban($kode_voucher){
		if(!$this->PARTISIPAN_LOMBA->isValid($kode_voucher)){
			return redirect()->to(base_url('/lomba/pengajuan-lomba'));
		}

		// dd($this->request->getPost());
		$data['partisipan_info'] = $this->PARTISIPAN_LOMBA->getPartisipanInfo($kode_voucher);
		if($data['partisipan_info']->kode_lomba == 'AuditUniv'){
			if(! $this->validate([
				'jawaban_1' => [
					'rules' => 'uploaded[jawaban_1]|max_size[jawaban_1,10000]|ext_in[jawaban_1,pdf]',
					'errors' => [
						'uploaded' => lang('Validasi.required'),
						'max_size' => lang('Validasi.max_size', ['file jawaban', '10MB']),
						'ext_in' => lang('Validasi.ext_in', ['file jawaban', 'berupa pdf']),
					]
				],
				'jawaban_2' => [
					'rules' => 'max_size[jawaban_2,10000]|ext_in[jawaban_2,pdf]',
					'errors' => [
						'max_size' => lang('Validasi.max_size', ['file jawaban 1', '10MB']),
						'ext_in' => lang('Validasi.ext_in', ['file jawaban 2', 'berupa pdf']),
					]
				]
			])){
				return redirect()->to(base_url('/lomba/percobaan-lomba/'.$kode_voucher))->withInput();	
			} else {
				$img = $this->request->getFile('jawaban_1');
				if($img->isValid() and ! $img->hasMoved()){
					$jawabanFile = $img->getRandomName();
					$img->move(APPPATH . '../public/uploads/partisipan/lomba/audit/', $jawabanFile);
	
					$daftar_soal = $this->request->getVar('soal');
	
					foreach ($daftar_soal as $soal) {
						$jawaban = $this->JAWABAN->ifJawabanIsFile($soal, $jawabanFile);
	
						$this->JAWABAN_PARTISIPAN->insert([
							'soal_id' => $soal,
							'jawaban_id' => $jawaban->jawaban_id,
							'partisipan_kode_voucher' => $kode_voucher,
						]);
					}
				}
	
				$img = $this->request->getFile('jawaban_2');
				if($img->isValid() and ! $img->hasMoved()){
					$jawabanFile = $img->getRandomName();
					$img->move(APPPATH . '../public/uploads/partisipan/lomba/audit/', $jawabanFile);
	
					$daftar_soal = $this->request->getVar('soal');
	
					foreach ($daftar_soal as $soal) {
						$jawaban = $this->JAWABAN->ifJawabanIsFile($soal, $jawabanFile);
	
						$this->JAWABAN_PARTISIPAN->insert([
							'soal_id' => $soal,
							'jawaban_id' => $jawaban->jawaban_id,
							'partisipan_kode_voucher' => $kode_voucher,
						]);
					}
				}
			}
		} elseif($data['partisipan_info']->kode_lomba == 'AccUniv' or $data['partisipan_info']->kode_lomba == 'AccSMA'){
			$daftar_soal = $this->request->getVar('soal'); 
			$jawaban = $this->request->getVar('jawaban');

			foreach($daftar_soal as $soal){
				$this->JAWABAN_PARTISIPAN->insert([
					'soal_id' => $soal,
					'jawaban_id' => $jawaban[$soal],
					'partisipan_kode_voucher' => $kode_voucher,
				]);
			}
		} else {
			return 'asu';
		}

		$this->PARTISIPAN_LOMBA->where(['kode_voucher' => $kode_voucher])->update(null, ['percobaan' => $data['partisipan_info']->percobaan - 1]);
		return redirect()->to(base_url('/lomba'));
	}
}
