<?php 

namespace App\Controllers;
class Peserta extends BaseController
{
    public function upload_berkas($table){
        if($records = $this->request->getPost()){
			if(!$this->validate([
				'berkas' => [
					'rules' => 'uploaded[berkas]|max_size[berkas,600]|ext_in[berkas,doc,docx]',
					'errors' => [
						'uploaded' => lang('Validasi.required'),
						'max_size' => lang('Validasi.max_size', ['berkas', '5 MB']),
						'ext_in' => lang('Validasi.ext_in', ['berkas', 'pdf, ppt, atau pptx']),
					],
				]
			])){
				session()->setFlashdata('pesan-error', 'Berkas gagal terupload');
				return redirect()->to('lomba/dashboard')->withInput();
			} else {
				// file berkas
				$strBerkas = [];
				if($files = $this->request->getFiles()){
					foreach($files['berkas'] as $file){
						if ($file->isValid() && ! $file->hasMoved()) {
							$newName = $file->getRandomName();
							$file->move(APPPATH . '../public/uploads/partisipan/lomba/berkas', $newName);
							array_push($strBerkas, $newName);
						}
					}

					// update db
					$strBerkas = implode('|', $strBerkas);
					db()->table($table)->where('id', $records['id'])->update(['berkas_' . $records['berkas_id'] => $strBerkas]);
					session()->setFlashdata('pesan-success', 'Berkas berhasil tersimpan');
					return redirect()->to('lomba/dashboard');
				}
			}
		}
    }
}