<?php

namespace App\Controllers;

class Admin_Lomba extends BaseController
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
		$data['daftar_partisipan'] = $this->PARTISIPAN_LOMBA->getAllPartisipan();

		return view('/test/admin-lomba-landing-page', $data);
	}

	public function cek_kalkulasi($kode_voucher){
		if(! $this->PARTISIPAN_LOMBA->isValid($kode_voucher)){
			return redirect()->to(base_url('/admin-lomba'));
		}

		$data['nilai'] = $this->NILAI->where(['kode_voucher' => $kode_voucher])->first();
		$data['jawaban_partisipan'] = $this->JAWABAN_PARTISIPAN->getSingleJawabanPartisipan($kode_voucher);
		
		return view('/test/cek-kalkulasi', $data);
	}

	public function update_kalkulasi($kode_voucher){
		if(! $this->PARTISIPAN_LOMBA->isValid($kode_voucher)){
			return redirect()->to(base_url('/admin-lomba'));
		}

		if($nilai_baru = $this->request->getPost('kuantitas_nilai')){
			$this->NILAI->where(['kode_voucher' => $kode_voucher])->update(null, ['kuantitas_nilai' => $nilai_baru]);
			return redirect()->to(base_url('/admin-lomba'));
		}
	}

	public function kalkulasi(){
		$daftar_jawaban_partisipan = $this->JAWABAN_PARTISIPAN->getFullJawabanPartisipan();
		$daftar_nilai = $this->NILAI->findAll();
		// print_r($daftar_jawaban_partisipan);
		foreach($daftar_nilai as $nilai){
			$dummy_nilai = 0;
			$jawaban_benar = 0;
			$counter = 0;
			foreach($daftar_jawaban_partisipan as $jawaban_partisipan){
				if($jawaban_partisipan->partisipan_kode_voucher == $nilai->kode_voucher){
					$counter++;
					if($jawaban_partisipan->jawaban_kode == $jawaban_partisipan->jawaban_kode_benar){
						$jawaban_benar++;
					}
				}
			}
			$dummy_nilai = $counter <= 0 ? 0 : $jawaban_benar/$counter * 100;
			$this->NILAI->where(['kode_voucher' => $nilai->kode_voucher])->update(null, ['kuantitas_nilai' => number_format((float)$dummy_nilai, 2, '.', '')]);
		}

		return redirect()->to(base_url('/admin-lomba'));
	}
}
