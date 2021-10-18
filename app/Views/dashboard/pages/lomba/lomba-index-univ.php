<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
<?php 
    // === INIT DATA === //
    // users : data login
    // data_partisipan : biodata tim
    // partisipan_lomba : voucher dan kuota prelim
    // nilai_acc_sma : data nilai SMA

    $user_id = userinfo()->id;
    $peserta = db()->table('data_partisipan')
        ->where('user_id', $user_id)
        ->get()->getRow();
    $peserta_prelim = db()->table('partisipan_lomba')
        ->where('partisipan_id', $peserta->partisipan_id)
        ->get()->getRow();
    $peserta_nilai = db()->table('nilai_acc_univ')
        ->where('partisipan_id', $peserta->partisipan_id)
        ->get()->getRow();
    $peserta_biodata = user_main_round();
        ?>
    
    <div class="grid grid-cols-12 gap-24 p-32 text-base-100" 
x-data="{
    berkas_id : 0,
    absen_id:0,
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
    <!-- <div class="card col-span-12 p-24 bg-neutral-100">
        <?php 
            if(isset($peserta_prelim->kode_voucher)) :
        ?>
            <span>Voucher untuk pengerjaan soal Preliminary Round tim Anda adalah 
                    <?php
                        $kode_segmen = ['qw', 'as', 'zx'];
                        foreach($kode_segmen as $segmen) : 
                    ?>
                    <?= $peserta_prelim->kode_voucher.$segmen ?>
                    <div 
                        data-tip="Salin voucher"
                        class="inline tooltip tooltip-primary"
                    >
                        <svg 
                            data-clipboard-text="<?= $peserta_prelim->kode_voucher.$segmen ?>" 
                            class="h-5 w-5 copy cursor-pointer inline"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <?php endforeach ?>
            </span>


            <small>Satu kode voucher diperuntukkan untuk satu anggota tim.</small>
            <small>Jaga kerahasiaan voucher tim Anda. Pastikan tidak ada peserta selain anggota tim Anda yang mengetahuinya.</small>
        <?php else : ?>
            <span>Sebelum Anda memulai pengerjaan Preliminary Round, silakan Anda mengambil voucher dengan mengunjungi
                <a href="<?= base_url('lomba/generate-voucher') ?>" class="btn btn-xs btn-primary">tautan ini</a>
            </span>
        <?php endif?>

    </div> -->

    <!-- == REVIEW LJU == -->
    <!-- <div class="col-span-12 flex space-y-16 flex-col">
        <?php 
            if($peserta_prelim):
                if($peserta_prelim->kuota_1 == 0 && $peserta_prelim->kuota_2 == 0 && $peserta_prelim->kuota_3 == 0):
        ?>
                    <div class="alert alert-info" x-data="{active: true}" x-show="active" id="info">
                        <div class="flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                            </svg>
                            <span>Data jawaban Preliminary Round dapat diakses pada <a class="btn btn-xs" href="<?= base_url('lomba/reviu-lju/' . $peserta_prelim->kode_voucher) ?>" target="_blank">tautan ini</a></span>
                        </div>
                        <svg
                            @click="active = false"
                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
        <?php 
                endif;
            endif;
        ?>
    </div> -->
    <!-- == END RIVEW LJU == -->

    <!-- == UPDATE BIODATA == -->
    <?php if($peserta_nilai->prelim == 1 && sekarang() > tanggal('acc-univ-pre-peng') ) : ?>
        <div class="col-span-12 flex space-y-16 flex-col">
            <div class="alert alert-info" x-data="{active: true}" x-show="active" id="info">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                    </svg>
                        <span>Selamat Anda lolos tahap Preliminary Round. Silakan Anda bergabung grup Whatsapp Peserta Semifinal pada <a target="_blank" class="btn btn-xs" href="https://chat.whatsapp.com/BShE1hDXpOK0Z4Ps5rvZFu" >tautan ini</a></span>
                </div>
                <svg
                    @click="active = false"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <?php if(!$peserta_biodata) : ?>
        <div class="col-span-12 flex space-y-16 flex-col">
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

<!-- === PENGUMUMAN === -->
<div class="alert alert-info col-span-12">
  <div class="flex-1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
    </svg> 
    <label>Unduh Virtual Background NAC Digital Series #1: Webinar Internasional pada <a class="btn btn-info btn-xs" download href="<?= base_url('file/vb_webinar_1.png')?>">tautan ini</a></label>
  </div>
</div>
<div class="alert alert-info col-span-12">
  <div class="flex-1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
    </svg> 
    <label>Gunakan <a class="btn btn-info btn-xs" download href="<?= base_url('file/vb_lomba_acc.png')?>">Virtual Background</a> yang telah disediakan selama rangkain acara perlombaan berlangsung</label>
  </div>
</div>
<!-- === END PENGUMUMAN === -->
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
                </tr>
            </thead>
            <tbody>

                <?php
                        $absen = [
                            //start zoom, id, pass, link, judul acara, tanggal
                            ['2021-10-11 11:00', 'id', 'pass', 'link','Technical Meeting Semifinal', '14 Oktober 2021 pukul 19:00 - 20:00 WIB'],
                            ['2021-10-11 11:00', 'id', 'pass', 'link','Opening Ceremony', '17 Oktober 2021 pukul 11:00 - 12:05 WIB'],
                            ['2021-10-17 13:30', '938 2889 7613', '900923', 'https://zoom.us/j/93828897613?pwd=M3Z2Wnp6aDdsaTlWdGZheW9iZUZqQT09','NAC Digital Series #1: Webinar Internasional', '17 Oktober 2021 pukul 13:30 - 17:15 WIB'],
                            ['2021-10-18 07:30', 'id', 'pass', 'link','FGD X Essay', '18 Oktober 2021 pukul 07:30 - 13:15 WIB'],
                            ['2021-10-19 07:30', 'id', 'pass', 'link','Fun Games', '19 Oktober 2021 pukul 07:30 - 10:50 WIB'],
                            ['2021-10-20 07:30', '963 7865 0991', '983980', 'https://zoom.us/j/96378650991?pwd=YmphNWZsaEJLUHh5T0hEeUxjREcwQT09','NAC Digital Series #2: Webinar Nasional', '20 Oktober 2021 pukul 07:30 - 11:00 WIB'],
                            ['2021-10-21 09:30', 'id', 'pass', 'link','NAC Digital Series #3: Webinar Nasional', '21 Oktober 2021 pukul 09:30 - 13:00 WIB'],
                            ['2021-10-22 00:00', 'id', 'pass', 'link','Technical Meeting Final Round', ''],
                            ['2021-10-23 08:30', 'id', 'pass', 'link','Final Round Accounting Challenge', '23 Oktober 2021 pukul 08:30 - 10:40 WIB'],
                            ['2021-10-24 19:00', 'id', 'pass', 'link','Closing Ceremony and Awarding Night', '24 Oktober 2021 pukul 19:00 - 20:30 WIB'],
                        ];
                        $absen_peserta = [
                            $peserta_nilai->absen_1,
                            $peserta_nilai->absen_2,
                            $peserta_nilai->absen_3,
                            $peserta_nilai->absen_4,
                            $peserta_nilai->absen_5, // 2
                            $peserta_nilai->absen_6, // 1
                            $peserta_nilai->absen_7, // 1
                            $peserta_nilai->absen_8,
                            $peserta_nilai->absen_9,
                            $peserta_nilai->absen_10,
                        ];
                        // ['Pengumuman Tahap Semifinal Accounting Challange', '12 Oktober 2021 pukul 12:00 WIB'],
                ?>
                <tr>
                    <td>1</td>
                    <td>Pengumuman Preliminary Round</td>
                    <td>12 Oktober 2021 pukul 12:00</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <?php if($peserta_nilai == null || sekarang() < tanggal('acc-sma-pre-peng')) : ?>
                            Informasi Belum Tersedia
                        <?php else: ?>
                            <?php if($peserta_nilai->prelim == 1) : ?>
                                <span class="verif-sukses">Lolos</span>
                            <?php else: ?>
                                <span class="verif-gagal">Tidak Lolos</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $no= 2; for($i=0; $i < 10; $i++):?>
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
                            <?php if($absen_peserta[$i] == '') : ?>
                                <a class="btn btn-sm btn-primary" @click="absen_id = '<?= $i+1 ?>', judul='<?= $absen[$i][4] ?>'">Absen</a>
                            <?php elseif($absen_peserta[$i] == '1') :?>
                                <span class="verif-sukses">Terverifikasi</span>
                            <?php else :?>
                                <span class="verif-gagal">Dalam konfirmasi</span>
                            <?php endif?>
                        </td>
                        <td>
                            -
                        </td>
                    </tr>
                    <?php if($no == 7 ):?>
                        <tr>
                            <td><?= $no++?></td>
                            <td>Accounting in Row</td>
                            <td>19 Oktober 2021</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td><?= $no++?></td>
                            <td>Choose in Advance</td>
                            <td>19 Oktober 2021</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    <?php endif ?>
                    <?php if($no == 6 ):?>
                        <tr>
                            <td><?= $no++?></td>
                            <td>FGD X Essay (Unggah Berkas)</td>
                            <td>18 Oktober 2021 pukul 11:30 - 12:12</td>
                            <td><a class="btn btn-neutral btn-sm" href="<?= base_url('file/logo.png') ?>" download>Unduh Logo</a></td>
                            <td><a class="btn btn-neutral btn-sm" @click="berkas_id = 1">Unggah Berkas</a></td>
                            <td>-</td>
                        </tr>
                    <?php endif ?>
                    <?php if($no == 9 ):?>
                        <tr>
                            <td><?= $no++?></td>
                            <td>Pengumuman Finalis</td>
                            <td></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
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
            <?= form_open_multipart(base_url('lomba/upload-absen-univ'), ['method' => 'post']) ?>
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
                    <input type="hidden" name="id" value="<?= $peserta_nilai->id ?>" >
                    <span><?= initValidation()->getError('bukti') ?? '' ?></span>

                    <small>Foto bukti kehadiran berupa gambar dengan format jpg, jpeg atau png</small>
                    <small>Ukuran maksimal untuk setiap file 500 Kb</small>
                    <small>Gunakan tombol <b>ctrl</b> untuk menyeleksi lebih dari satu gambar</small>
                </div>
            <!-- SUBMIT -->
            <input type="hidden" name="absen_id" :value="absen_id">
            <input type="hidden" name="peserta_id" value="<?= $peserta_nilai->id ?>">
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
            <?= form_open_multipart(base_url('peserta/upload-berkas/nilai_acc_univ'), ['method' => 'post']) ?>

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
                    <input type="hidden" name="id" value="<?= $peserta_nilai->id ?>" >
                    <span><?= initValidation()->getError('berkas') ?? '' ?></span>

                    <small>Format yang diizinkan doc, docx</small>
                    <small>Ukuran maksimal untuk setiap berkas 5 Mb</small>
                    <small>Gunakan tombol <b>ctrl</b> untuk menyeleksi lebih dari satu berkas</small>
                </div>
            <!-- SUBMIT -->
            <input type="hidden" name="berkas_id" :value="berkas_id">
            <input type="hidden" name="peserta_id" value="<?= $peserta_nilai->id ?>">
            <div class="flex flex-row justify-between">
                <span class="btn btn-error btn-sm" @click="berkas_id = 0">Cancel</span>
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>
        </div>
    </div>
    <!-- === END MODAL UPLOAD BERKAS === -->
</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script>
    new ClipboardJS('.copy');
</script>>


<?= $this->endSection() ?>