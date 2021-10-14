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
    $peserta_nilai = db()->table('nilai_acc_sma')
        ->where('partisipan_id', $peserta->partisipan_id)
        ->get()->getRow();
    $peserta_biodata = user_main_round();
    ?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100" x-data="{absen_id:0}">
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
                <td>Accounting for High School</td>
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
    <div class="col-span-12 flex space-y-16 flex-col">
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
    </div>
<!-- == END RIVEW LJU == -->
<!-- == UPDATE BIODATA == -->
    <?php if($peserta_nilai->prelim == 1 && sekarang() > tanggal('acc-sma-pre-peng') ) : ?>
        <div class="col-span-12 flex space-y-16 flex-col">
            <div class="alert alert-info" x-data="{active: true}" x-show="active" id="info">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                    </svg>
                    <span>Selamat Anda lolos tahap Preliminary Round. Silakan Anda bergabung grup Whatsapp Peserta Semifinal pada <a target="_blank" class="btn btn-xs" href="https://chat.whatsapp.com/LkkOiPIZO60BOjTgHtKVCl" >tautan ini</a></span>
                </div>
                <svg
                    @click="active = false"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <?php if(!$peserta_biodata) : ?>
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
    <div class="col-span-12 ">
        <table class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kegiatan</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Nilai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Preliminary Round</td>
                    <td><?= tanggal('start_pre') ?></td>
                    <td>
                        <?php 
                            if($peserta_nilai):
                        ?>
                            <?= $peserta_nilai->segmen_1 + $peserta_nilai->segmen_2 + $peserta_nilai->segmen_3 ?>
                        <?php   
                            endif;
                        ?>
                    </td>
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
                <tr>
                    <td>
                        2
                    </td>
                    <td>
                        Absensi TM
                    </td>
                    <td>
                        14 Oktober 2021 pukul 20:00 WIB
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" @click="absen_id = 1">Absen</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        2
                    </td>
                    <td>
                        Absensi TM 2
                    </td>
                    <td>
                        20 Oktober 2021 pukul 20:00 WIB
                    </td>
                    <td>
                        -
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" @click="absen_id = 2">Absen</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div x-show="absen_id != 0" class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div @click.outside="absen_id = ''" class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
            <h2 class="text-24 font-bold text-center">Form absen #<span x-text="absen_id"></span></h2>
            <form method="post" action="<?=base_url('') ?>">
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
                    <span><?= initValidation()->getError('twibbon') ?? '' ?></span>

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
</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script>
    new ClipboardJS('.copy');
</script>


<?= $this->endSection() ?>