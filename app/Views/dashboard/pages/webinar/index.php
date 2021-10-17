<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php
$judul = [
    'NAC DIGITAL SERIES #1 : WEBINAR INTERNASIONAL',
    'NAC DIGITAL SERIES #2 : WEBINAR NASIONAL',
    'NAC DIGITAL SERIES #3 : WEBINAR NASIONAL',
    'Opening Ceremony NAC 2021'
];
$data_webinar_peserta = [
    $peserta->webinar_1,
    $peserta->webinar_2,
    $peserta->webinar_3,
    $peserta->webinar_4,
];
$zoom_id = session('zoom_id') ?? 0;
$zoom_id_join = false;
$zoom_pass = false;
$zoom_link = false;
if($zoom_id){
    $zoom_id_join = info('webinar_zoom_id_1');
    $zoom_pass = info('webinar_zoom_pass_1');
    $zoom_link = info('webinar_zoom_link_1');
}
?>
<div
    x-data="{
        webinar_id: <?= session('webinar_id') ?? old('webinar_id') ?? 0 ?>,
        zoom_id : <?= session('zoom_id') ?? 0 ?>,
        zoom_id_join : '<?= $zoom_id_join ?>',
        zoom_pass : '<?= $zoom_pass ?>',
        zoom_link : '<?= $zoom_link ?>',
        absen_id: <?= old('absen_id') ?? 0 ?>,
        judul: '<?= session('webinar_id') || session('zoom_id') ? $judul[(session('webinar_id') ?? session('zoom_id')) -1 ] : '' ?>'
    }"
    <?php
     session()->remove('webinar_id');
     session()->remove('zoom_id')
    ?>
>
    <div class="grid grid-cols-12 p-24 gap-24 text-base-100">
        <div class="card col-span-12 lg:col-span-8 p-24 bg-neutral-100">
            <table class="tabel-card text-12 lg:text-16">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $peserta->nama ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?= $peserta->email ?></td>
                </tr>
                <tr>
                    <td>Instansi</td>
                    <td>:</td>
                    <td><?= $peserta->instansi ?></td>
                </tr>
                
                <?php if($peserta->npm) : // Warga STAN?>
                    <tr>
                        <td>NPM</td>
                        <td>:</td>
                        <td><?= $peserta->npm ?></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?= $peserta->prodi ?></td>
                    </tr>
                <?php endif ?>
                <tr>
                    <td>Nomor Whatsapp</td>
                    <td>:</td>
                    <td><?= $peserta->wa ?></td>
                </tr>
            </table>
        </div>
        <div class="col-span-12">
            <?= $this->include('component/pesan') ?>
        </div>
        <div class="col-span-12 card bg-neutral-200 p-16">
            Rangkain acara Webinar NAC 2021
        </div>
        <div class="col-span-12 overflow-x-auto">
            <table class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Webinar </th>
                        <th>Tanggal</th>
                        <th>Sisa kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Absensi</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1; $i<4; $i++):?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $judul[$i-1] ?></td>
                            <td><?= tanggal_human('webinar_start_'.$i) .' - '. jam_human('webinar_finish_'.$i)  ?></td>
                            <td>
                                <?php if($kuota[$i -1] > 0) : ?>
                                    <span class="verif-sukses">Masih tersisa</span>
                                <?php else :?>
                                    <span class="verif-gagal">Habis</span>
                                <?php endif?>
                            </td>
                            <td>
                                <!-- Daftar -->
                                <?php if($data_webinar_peserta[$i-1] != '0') : ?>
                                    <span class="verif-sukses">Telah mendaftar</span>    
                                <?php else:?>
                                    <span class="verif-gagal">Belum mendaftar</span>    
                                <?php endif?>
                            </td>
                            <td>
                                <!-- Join Zoom : telah daftar (0) ? -->
                                <?php if($data_webinar_peserta[$i-1] != '0') : ?>
                                    <a class="btn btn-primary btn-sm 
                                    <?= sekarang() > tanggal('webinar_start_join_zoom_'.$i) && sekarang() < tanggal('webinar_finish_join_zoom_'.$i) ? '' : 'btn-disabled' ?>
                                    " @click="judul = '<?= $judul[$i -1] ?>', zoom_id = '<?= $i ?>', zoom_id_join = '<?= info('webinar_zoom_id_'.$i) ?>', zoom_link='<?= info('webinar_zoom_link_'.$i) ?>', zoom_pass='<?= info('webinar_zoom_pass_'.$i) ?>'">Join zoom</a>
                                <?php else:?>
                                        <a @click="judul = '<?= $judul[$i -1] ?>',webinar_id = '<?= $i ?>'" class="btn btn-primary btn-sm
                                        <?= (sekarang() > tanggal('webinar_open_regis_'.$i) && sekarang() < tanggal('webinar_close_regis_'.$i) && $kuota[$i -1] > 0 ) ? '' : 'btn-disabled' ?>"
                                        >Daftar Sekarang</a>
                                <?php endif?>
                            </td>
                            <td>
                                <!-- Absensi : sudah daftar(1) ? -->
                                <?php if($data_webinar_peserta[$i-1] == '2') : ?>
                                    <a class="verif-sukses">Berhasil</a>
                                <?php elseif($data_webinar_peserta[$i-1] != '0') : ?>
                                    <a class="btn btn-primary btn-sm 
                                        <?= sekarang() > tanggal('webinar_start_absen_'.$i) && sekarang() < tanggal('webinar_finish_absen_'.$i) ? '' : 'btn-disabled' ?>
                                    "
                                    @click="judul = '<?= $judul[$i -1] ?>',absen_id = '<?= $i ?>'"
                                    >Absen</a>
                                <?php else:?>
                                    <a class="verif-gagal">-</a>
                                <?php endif?>
                            </td>
                            <td>
                                <!-- Sertifikat : sudah valid(2) ? -->
                                <?php if($data_webinar_peserta[$i-1] == '0'):?>
                                    <a class="verif-gagal">-</a>
                                <?php elseif($data_webinar_peserta[$i-1] == '1') : ?>
                                    <a class="btn btn-primary btn-sm btn-disabled">Download</a>
                                <?php elseif($data_webinar_peserta[$i-1] == '2') : ?>
                                    <a class="btn btn-primary btn-sm">Download</a>
                                <?php else:?>
                                    <a class="verif-gagal">Password Absensi Salah</a>
                                <?php endif?>
                            </td>
                        </tr>
                    <?php endfor?>
                </tbody>
            </table>
            <small>*Sisa kuota pendaftar untuk <?= $peserta->instansi == "PKN STAN" ? 'mahasiswa PKN STAN' : 'umum' ?></small><br>
            <small>*Batas waktu absensi hingga 2,5 jam setelah acara usai</small>
        </div>
        <div class="col-span-12 card bg-neutral-200 p-16">
            Acara Opening Ceremony NAC 2021
        </div>
        <?php $j=4 ?>
        <div class="col-span-12 overflow-x-auto">
            <table class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Agenda </th>
                        <th>Tanggal</th>
                        <th>Sisa kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Absensi</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>1</td>
                            <td><?= $judul[$j-1] ?></td>
                            <td><?= tanggal_human('webinar_start_'.$j) .' - '. jam_human('webinar_finish_'.$j)  ?></td>
                            <td>
                                <?php if($kuota[$j -1] > 0) : ?>
                                    <span class="verif-sukses">Masih tersisa</span>
                                <?php else :?>
                                    <span class="verif-gagal">Habis</span>
                                <?php endif?>
                            </td>
                            <td>
                                <!-- Daftar -->
                                <?php if($data_webinar_peserta[$j-1] != '0') : ?>
                                    <span class="verif-sukses">Telah mendaftar</span>    
                                <?php else:?>
                                    <span class="verif-gagal">Belum mendaftar</span>    
                                <?php endif?>
                            </td>
                            <td>
                                <!-- Join Zoom : telah daftar (0) ? -->
                                <?php if($data_webinar_peserta[$j-1] != '0') : ?>
                                    <a class="btn btn-primary btn-sm" href="https://youtu.be/7zvrtkgPcVA" target="_blank">Link Youtube</a>
                                <?php else:?>
                                        <a @click="judul = '<?= $judul[$j -1] ?>',webinar_id = '<?= $j ?>'" class="btn btn-primary btn-sm
                                        <?= (sekarang() > tanggal('webinar_open_regis_'.$j) && sekarang() < tanggal('webinar_close_regis_'.$j) && $kuota[$j -1] > 0 ) ? '' : 'btn-disabled' ?>"
                                        >Daftar Sekarang</a>
                                <?php endif?>
                            </td>
                            <td>
                                <!-- Absensi : sudah daftar(1) ? -->
                                <?php if($data_webinar_peserta[$j-1] == '2') : ?>
                                    <a class="verif-sukses">Berhasil</a>
                                <?php elseif($data_webinar_peserta[$j-1] != '0') : ?>
                                    <a class="btn btn-primary btn-sm 
                                        <?= sekarang() > tanggal('webinar_start_absen_'.$j) && sekarang() < tanggal('webinar_finish_absen_'.$j) ? '' : 'btn-disabled' ?>
                                    "
                                    @click="judul = '<?= $judul[$j -1] ?>',absen_id = '<?= $j ?>'"
                                    >Absen</a>
                                <?php else:?>
                                    <a class="verif-gagal">-</a>
                                <?php endif?>
                            </td>
                        </tr>
                </tbody>
            </table>
            <small>*Sisa kuota pendaftar untuk <?= $peserta->instansi == "PKN STAN" ? 'mahasiswa PKN STAN' : 'umum' ?></small><br>
            <small>*Batas waktu absensi hingga 2,5 jam setelah acara usai</small>
        </div>
    </div>
    <!-- == MODAL REGIS == -->
    <div x-show="webinar_id != 0" class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div @click.outside="webinar_id = 0 " class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
        <h2 class="text-24 font-bold text-center">Form pendaftaran <span x-text="judul"></span></h2>
            <form method="post" action="<?=base_url('webinar/klaim') ?>" name="klaimTiket" onsubmit="return validasi()">
            <?= csrf_field() ?>
            <!-- IG -->
            <div class="form-input">
                <label>Link postingan twibbon NAC di Instagram</label>
                <div>
                    <input 
                        placeholder="contoh : https://www.instagram.com/p/CU40Gj-hVa7/?utm_source=ig_web_copy_link"
                        value="<?= old('ig') ?>"
                        type="text"
                        name="ig" />
                    <i>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                    </svg>
                    </i>
                </div>
                <span id="err-ig"><?= initValidation()->getError('ig') ?? '' ?></span>
            </div>
            <!-- PERTANYAAN -->
            <div class="form-input">
                <label>Pertanyaan untuk webinar ini?</label>
                <div>
                    <input 
                        placeholder="contoh : Bagaimana pengaruh ekonomi global terhadap keuangan daerah?"
                        value="<?= old('pertanyaan')?>"
                        type="text"
                        name="pertanyaan" />
                    <i>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    </i>
                </div>
            </div>

            <div class="alert alert-info p-4 m-8">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                    </svg> 
                    <label>Panduan terkait twibbon dapat diakses pada <a target="_blank" href="https://www.twibbonize.com/nacdigitalseries" class="btn btn-xs btn-primary">halaman ini</a></label>
                </div>
            </div>
            <!-- SUBMIT -->
            <input type="hidden" name="webinar_id" :value="webinar_id">
            <input type="hidden" name="peserta_id" value="<?= $peserta->peserta_id ?>">
            <input type="hidden" name="instansi" value="<?= $peserta->instansi ?>">
            <input type="hidden" name="judul" :value="judul">
            <div class="flex flex-row justify-between">
                <span class="btn btn-error btn-sm" @click="webinar_id = 0">Cancel</span>
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>
        </div>
    </div>
    <!-- == END REGIS == -->
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
            <div class="flex flex-row justify-between mt-8">
                <a target="_blank" :href="'<?= base_url('file/vb_webinar_') ?>'+zoom_id+'.png'" class="btn btn-sm btn-info" download>Unduh Virtual Background</a>
                <a class="btn btn-sm btn-error" @click="zoom_id = ''">Tutup</a>
            </div>
        </div>
    </div>
    <!-- == END ZOOM == -->
    <!-- == MODAL ABSEN == -->
    <div x-show="absen_id != 0" class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div @click.outside="absen_id = ''" class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
            <h2 class="text-24 font-bold text-center">Form absen <span x-text="judul"></span></h2>
            <form method="post" action="<?=base_url('webinar/absen') ?>" name="klaimAbsen" onsubmit="return validasiAbsen()">
            <?= csrf_field() ?>
            <!-- Password -->
            <div class="form-input">
                <label>Password absen</label>
                <div>
                    <input 
                        placeholder="contoh : WebinarAkuntansiJaya"
                        value="<?= old('pass') ?>"
                        type="text"
                        name="pass" />
                    <i>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                    </svg>
                    </i>
                </div>
                <span id="err-pass"><?= initValidation()->getError('pass') ?? '' ?></span>
            </div>
            <!-- SUBMIT -->
            <input type="hidden" name="absen_id" :value="absen_id">
            <input type="hidden" name="peserta_id" value="<?= $peserta->peserta_id ?>">
            <input type="hidden" name="judul" :value="judul">
            <div class="flex flex-row justify-between">
                <span class="btn btn-error btn-sm" @click="absen_id = 0">Cancel</span>
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>
        </div>
    </div>
    <!-- == END ABSEN == -->
</div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy');
        function validasi(){
            let ig = document.forms['klaimTiket']['ig'].value;
            if(!ig.includes("instagram.com/p/")){
                document.getElementById('err-ig').innerHTML = "Link bukti share twibbon tidak valid."
                return false
            }
        }
        function validasiAbsen(){
            let pass = document.forms['klaimAbsen']['pass'].value;
            if(pass == ''){
                document.getElementById('err-pass').innerHTML = "Harap isi password terlebih dahulu."
                return false
            }
        }
    </script>
<?= $this->endSection() ?>