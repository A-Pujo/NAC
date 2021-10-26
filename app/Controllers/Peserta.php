<?php 

namespace App\Controllers;
class Peserta extends BaseController
{
    public function upload_berkas($table){
        if($records = $this->request->getPost()){
			if(!$this->validate([
				'berkas' => [
					'rules' => 'uploaded[berkas]|max_size[berkas,5128]|ext_in[berkas,ppt,pptx,pdf,doc,docx]',
					'errors' => [
						'uploaded' => lang('Validasi.required'),
						'max_size' => lang('Validasi.max_size', ['berkas', '5 MB']),
						'ext_in' => lang('Validasi.ext_in', ['berkas', 'ppt, pptx,pdf,doc, atau docx']),
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
							$newName = $file->getClientName();
							$file->move(APPPATH . '../public/uploads/partisipan/lomba/berkas', $newName);
							array_push($strBerkas, $file->getName());
						}
					}

					// update db
					$strBerkas = implode('|', $strBerkas);
					db()->table($table)->where('id', $records['id'])->update(['berkas_' . $records['berkas_id'] => date('Y-m-d_H:i:s') . '|' . $strBerkas]);
					session()->setFlashdata('pesan-success', 'Berkas berhasil tersimpan');
					return redirect()->to('lomba/dashboard');
				}
			}
		}
    }

	public function upload_video($table){
		if($records = $this->request->getPost()){
			db()->table($table)->where('id', $records['id'])->update(['video_' . $records['video_id'] => $records['link-file']]);
			if(db()->affectedRows() > 0){
				session()->setFlashdata('pesan-success', 'Link berhasil tersimpan');
				return redirect()->to('lomba/dashboard');
			} else {
				session()->setFlashdata('pesan-error', 'Link gagal terupload');
				return redirect()->to('lomba/dashboard')->withInput();
			}
		}
	}
}