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
    ?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100">
    <div class="col-span-12 flex space-y-16 flex-col sticky top-8 z-50">
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
    <div class="card col-span-12 p-24 bg-neutral-100">
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

    </div>
    <div class="col-span-12 ">
        <table class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tahap</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Nilai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Simulasi Preliminary Round</td>
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
                        <?php if($peserta_nilai->prelim == null) : ?>
                            Informasi Belum Tersedia
                        <?php elseif($peserta_nilai->prelim == 1) : ?>
                            Tidak Lolos
                        <?php else: ?>
                            Lolos
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script>
    new ClipboardJS('.copy');
</script>


<?= $this->endSection() ?>