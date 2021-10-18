<?php 

namespace App\Controllers;
class Acara extends BaseController
{
    // === CFP ===
    public function cfp_verif_full_paper(){
		$cfp = md('cfp');
		// === Check kelulusan === //
		$ids = $this->request->getVar('ids');
		$cfp->update($ids, ['full_paper' => 0]); // set ke 0 semua
		$checks = $this->request->getVar('check');
		if($checks){
			$cfp->update($checks, ['full_paper' => 1]); // set 1 bagi yang terpilih
		}
		// === Set Nilai === //
		$nilais = $this->request->getVar('nilai');
		foreach($nilais as $id => $nilai ){
			$cfp->update($id, ['nilai_1' => $nilai]);
		}
		session()->setFlashdata('pesan-success', 'Perubahan data berhasil disimpan');
		return redirect()->to(previous_url());
	}
}