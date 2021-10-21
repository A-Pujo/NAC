<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
<?php 
    $peserta = md('cfp')->getUserData();
    $peserta_bio = md('bio')->getDataUser(userinfo()->partisipan_id);
?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100"
x-data="{
    absen_id:<?= old('absen_id') ?? 0 ?>,
    berkas_id:<?= old('berkas_id') ?? 0 ?>,
    video_id:<?= old('video_id') ?? 0 ?>,
    judul:'',
    zoom_id : '',
    zoom_id_join : '',
    zoom_pass : '',
    zoom_link : '',

}"
>

    <div class="card col-span-12 p-24 bg-neutral-100">
        <table class="tabel-card text-12 lg:text-16">
            <tr>
                <td>Nama Tim</td>
                <td>:</td>
                <td><?= $peserta->nama_tim ?></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td><?= $peserta->pt ?></td>
            </tr>
            <tr>
                <td>Nama Ketua Tim</td>
                <td>:</td>
                <td><?= $peserta->nama_ketua ?></td>
            </tr>
            <tr>
                <td>Nama Anggota 1</td>
                <td>:</td>
                <td><?= $peserta->nama_1 ?></td>
            </tr>
            <tr>
                <td>Nama Anggota 2</td>
                <td>:</td>
                <td><?= $peserta->nama_2 ?></td>
            </tr>
            <tr>
                <td>Jenis Lomba</td>
                <td>:</td>
                <td>Accounting for University</td>
            </tr>
            <tr>
                <td>Nomor Whatsapp</td>
                <td>:</td>
                <td><?= $peserta->wa ?></td>
            </tr>
        </table>
    </div>
    <!-- FLash Data -->
    <div class="col-span-12">
        <?= $this->include('component/pesan') ?>
    </div>

    <!-- == UPDATE BIODATA == -->
    <?php if($peserta->full_paper == 1 && sekarang() > tanggal('cfp-full-paper-peng') ) : ?>
        <div class="col-span-12 flex space-y-16 flex-col sticky top-8 z-50">
            <div class="alert alert-info" x-data="{active: true}" x-show="active" id="info">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                    </svg>
                        <span>Selamat Anda lolos tahap Full Paper. Silakan Anda bergabung grup Whatsapp Peserta Semifinal pada <a target="_blank" class="btn btn-xs" href="https://chat.whatsapp.com/BShE1hDXpOK0Z4Ps5rvZFu" >tautan ini</a></span>
                </div>
                <svg
                    @click="active = false"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <?php if(is_null($peserta_bio)) : ?>
        <div class="col-span-12 flex space-y-16 flex-col sticky top-8 z-50">
            <div class="alert alert-info" x-data="{active: true}" x-show="active" id="info">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                    </svg>
                    <span>Segera lengkapi biodata Anda pada <a target="_blank" class="btn btn-xs" href="<?= base_url('Main_Round/lengkapi-data-diri') ?>" >tautan ini</a></span>
                </div>
                <svg
                    @click="active = false"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <?php endif ?>
    <?php endif ?>
    <!-- == END UPDATE BIODATA == -->
    <div class="alert alert-info col-span-12">
  <div class="flex-1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
    </svg> 
    <label>Downlad logo NAC <a class="btn btn-xs btn-primary" href="<?= base_url('file/logo.png') ?>" download>disini</a></label>
  </div>
</div>
    <div class="col-span-12 overflow-x-auto">
        <table class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kegiatan</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Data</th>
                    <th>Aksi</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody
            <?php
                        $absen = [
                            //start zoom, id, pass, link, judul acara, tanggal
                            ['2021-10-21 09:30','843 9684 2914','digital','https://us02web.zoom.us/j/84396842914?pwd=Q3FwUktIVk1sUzFyWjBNSDNRZzJRQT09','NAC Digital Series #3: Webinar Nasional', '21 Oktober 2021 pukul 09:30 - 13:00 WIB'],
                        ];
                        $absen_peserta = [
                            $peserta->absen_1,
                        ];
                        // ['Pengumuman Tahap Semifinal Accounting Challange', '12 Oktober 2021 pukul 12:00 WIB'],
                ?>
            >
                <tr>
                    <td>1</td>
                    <td>Pengumuman Full Paper</td>
                    <td>20 Oktober 2021</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <?php if(sekarang() < tanggal('cfp-full-paper-peng')) : ?>
                            <span class="verif-gagal">Data belum tersedia</span>
                        <?php elseif($peserta->full_paper == 1) : ?>
                            <span class="verif-sukses">Lolos</span>
                        <?php else: ?>
                            <span class="verif-gagal">Tidak Lolos</span>
                        <?php endif ?>
                    </td>
                    <td>-</td>
                </tr>
                <?php $no= 2; for($i=0; $i < 1; $i++):?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $absen[$i][4] ?></td>
                        <td><?= $absen[$i][5] ?></td>
                        <td>
                            <?php if($i == 1):?>
                                    <a class="btn btn-primary btn-sm" target="_blank" href="https://youtu.be/7zvrtkgPcVA">Tautan Youtube</a>
                                    <div 
                                        data-tip="Salin tautan"
                                        class="inline tooltip tooltip-primary"
                                    >
                                        <svg 
                                            data-clipboard-text="https://youtu.be/7zvrtkgPcVA" 
                                            class="h-5 w-5 copy cursor-pointer inline"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                                <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </div>
                                <?php else: ?>
                                    <a class="btn btn-primary btn-sm 
                                            <?= sekarang() > $absen[$i][0]? '' : 'btn-disabled' ?>
                                            " @click="judul = '<?= $absen[$i][4] ?>', zoom_id = '<?= $i ?>', zoom_id_join = '<?= $absen[$i][1] ?>', zoom_pass='<?= $absen[$i][2] ?>', zoom_link='<?= $absen[$i][3] ?>'">
                                    Join zoom
                                    </a>
                            <?php endif?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" @click="absen_id = '<?= $i+1 ?>', judul='<?= $absen[$i][4] ?>'">Absen</a>
                        </td>
                        <td>
                            <?php if($absen_peserta[$i] == '1') : ?>
                                <span class="verif-sukses">Terverifikasi</span>
                            <?php elseif($absen_peserta[$i] == '') :?>
                                <span class="verif-gagal">Belum absen</span>
                            <?php else :?>
                                <span class="verif-gagal">Dalam konfirmasi</span>
                            <?php endif?>
                        </td>
                        <td>-</td>
                    </tr>
                    <?php if($no == 3 ):?>
                        <tr>
                            <td><?= $no++?></td>
                            <td>Final CFP (Unggah Berkas)</td>
                            <td>22 Oktober 2021 pukul 20:00</td>
                            <td>-</td>
                            <td><a class="btn btn-neutral btn-sm" @click="video_id = 1">Unggah Link</a></td>
                            <?php if($peserta->video_1 == '') : ?>
                                <td><span class="verif-gagal">Belum mengunggah</span></td>
                                <td>-</td>
                            <?php else :?>
                                <td><span class="verif-sukses">Link berhasil diunggah</span></td>
                                <td><a class="btn btn-xs btn-primary" target="_blank" href="<?= $peserta->video_1 ?>">Lihat Video</a></td>
                            <?php endif?>
                        </tr>
                    <?php endif ?>
                <?php endfor ?>
            </tbody>
        </table>
    </div>
    <!-- === MODAL ABSEN === -->
    <div x-show="absen_id != 0" class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div @click.outside="absen_id = ''" class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
            <h2 class="text-24 font-bold text-center">Form absen <span x-text="judul"></span></h2>
            <?= form_open_multipart(base_url('lomba/upload-absen-cfp'), ['method' => 'post']) ?>
            <?= csrf_field() ?>

                <div class="form-upload" x-data="{files : ''}">
                    <label for="bukti">Bukti Kehadiran</label>
                    <div x-show="files">
                        <!-- Loop the image -->
                        <template x-for="file in files" x-if="files">
                            <div>
                                <img :src="URL.createObjectURL(file)">
                                <div>
                                    <span x-text="file.name"></span>
                                    <span x-text="file.size / 1000 + ' Kb'"></span>
                                </div> 
                            </div>
                        </template>
                    </div>
                    <label for="bukti">Upload Data</label>
                    <input type="file" id="bukti" @change="files = $event.target.files" name="bukti[]" multiple/>
                    <input type="hidden" name="absen_id" :value="absen_id">
                    <input type="hidden" name="id" value="<?= $peserta->id ?>" >
                    <span><?= initValidation()->getError('bukti') ?? '' ?></span>

                    <small>Foto bukti kehadiran berupa gambar dengan format jpg, jpeg atau png</small>
                    <small>Ukuran maksimal untuk setiap file 500 Kb</small>
                    <small>Gunakan tombol <b>ctrl</b> untuk menyeleksi lebih dari satu gambar</small>
                </div>
            <!-- SUBMIT -->
            <input type="hidden" name="absen_id" :value="absen_id">
            <input type="hidden" name="peserta_id" value="<?= $peserta->id ?>">
            <div class="flex flex-row justify-between">
                <span class="btn btn-error btn-sm" @click="absen_id = 0">Cancel</span>
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>
        </div>
    </div>
    <!-- === END MODAL ABSEN === -->
        <!-- == MODAL ZOOM == -->
        <div x-show="zoom_id != ''"  class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div @click.outside="zoom_id = ''" class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
        <h2 class="text-24 font-bold text-center">Data zoom <span x-text="judul"></span></h2>
            <table class="tabel">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Salin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ID Zoom</td>
                        <td><span x-text="zoom_id_join"></td>
                        <td>
                            <div 
                                data-tip="Salin ID zoom"
                                class="inline tooltip tooltip-primary"
                            >
                                <svg 
                                    :data-clipboard-text="zoom_id_join" 
                                    class="h-5 w-5 copy cursor-pointer inline"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                        <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Passcode Zoom</td>
                        <td><span x-text="zoom_pass"></td>
                        <td>
                            <div 
                                data-tip="Salin passcode zoom"
                                class="inline tooltip tooltip-primary"
                            >
                                <svg 
                                    :data-clipboard-text="zoom_pass" 
                                    class="h-5 w-5 copy cursor-pointer inline"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                        <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tautan Zoom</td>
                        <td><a class="btn btn-sm btn-primary" :href="zoom_link">Buka Tautan</td>
                        <td>
                            <div 
                                data-tip="Salin tautan zoom"
                                class="inline tooltip tooltip-primary"
                            >
                                <svg 
                                    :data-clipboard-text="zoom_link" 
                                    class="h-5 w-5 copy cursor-pointer inline"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                        <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-sm btn-error" @click="zoom_id = ''">cancel</a>
        </div>
    </div>
    <!-- == END ZOOM == -->
        <!-- === MODAL UPLOAD BERKAS === -->
        <div x-show="berkas_id != 0" class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div @click.outside="berkas_id = ''" class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
            <h2 class="text-24 font-bold text-center">Form upload Berkas</h2>
            <?= form_open_multipart(base_url('peserta/upload-berkas/nilai_acc_sma'), ['method' => 'post']) ?>

                <div class="form-upload" x-data="{files : ''}">
                    <label for="berkas">Berkas</label>
                    <div x-show="files">
                        <!-- Loop the image -->
                        <template x-for="file in files" x-if="files">
                            <div>
                                <img :src="URL.createObjectURL(file)">
                                <div>
                                    <span x-text="file.name"></span>
                                    <span x-text="file.size / 1000 + ' Kb'"></span>
                                </div> 
                            </div>
                        </template>
                    </div>
                    <label for="berkas">Upload Data</label>
                    <input type="file" id="berkas" @change="files = $event.target.files" name="berkas[]" multiple/>
                    <input type="hidden" name="berkas_id" :value="berkas_id">
                    <input type="hidden" name="id" value="<?= $peserta->id ?>" >
                    <span><?= initValidation()->getError('berkas') ?? '' ?></span>

                    <small>Format yang diizinkan ppt, pdf, dan doc</small>
                    <small>Ukuran maksimal untuk setiap berkas 5 Mb</small>
                    <small>Gunakan tombol <b>ctrl</b> untuk menyeleksi lebih dari satu berkas</small>
                </div>
            <!-- SUBMIT -->
            <input type="hidden" name="berkas_id" :value="berkas_id">
            <input type="hidden" name="peserta_id" value="<?= $peserta->id ?>">
            <div class="flex flex-row justify-between">
                <span class="btn btn-error btn-sm" @click="berkas_id = 0">Cancel</span>
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>
        </div>
    </div>
    <!-- === END MODAL UPLOAD BERKAS === -->
    <!-- == MODAL REGIS == -->
    <div x-show="video_id != 0" class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div @click.outside="video_id = 0 " class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
        <h2 class="text-24 font-bold text-center">Form Upload Link</h2>
            <form method="post" action="<?= base_url('peserta/upload-video/nilai_cfp') ?>" name="video-up" onsubmit="return validasi()">
            <?= csrf_field() ?>
            <!-- IG -->
            <div class="form-input">
                <label>Link share file gdrive</label>
                <div>
                    <input 
                        placeholder="contoh : https://drive.google.com/file/d/dascdvmISifnp/view?usp=sharing"
                        value="<?= old('link-file') ?>"
                        type="text"
                        name="link-file" />
                    <i>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                    </svg>
                    </i>
                </div>
                <span id="err-link"><?= initValidation()->getError('link-file') ?? '' ?></span>
            </div>
            <!-- SUBMIT -->
            <input type="hidden" name="video_id" :value="video_id">
            <input type="hidden" name="id" value="<?= $peserta->id ?>">
            <div class="flex flex-row justify-between">
                <span class="btn btn-error btn-sm" @click="video_id = 0">Cancel</span>
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>
        </div>
    </div>
    <!-- == END REGIS == -->
</div>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script>
    new ClipboardJS('.copy');
    function validasi(){
        let link = document.forms['video-up']['link-file'].value;
        if(!link.includes("drive.google.com/file/")){
            document.getElementById('err-link').innerHTML = "Link gdrive video tidak valid."
            return false
        }
    }
</script>


<?= $this->endSection() ?>