<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
<?php 
    $user_lomba = db()->table('partisipan_lomba')->where('partisipan_id', userinfo()->partisipan_id)->get()->getRow();

    $kuota_habis_semua = false;

    if($user_lomba->kuota_1 == 0 and $user_lomba->kuota_2 == 0 and $user_lomba->kuota_3 == 0){
        $kuota_habis_semua = true;
    }
?>

<?php
    # daftar nilai top 20
    $nilai_top_20 = db()->table('nilai_acc_univ')->select('partisipan_id, (segmen_1 + segmen_2 + segmen_3) as nilai_total') # cari top 20
                    ->orderBy('nilai_total', 'DESC')->get('20')->getResult(); # tampilkan hasil banyak dari yg terbesar
    $lolos = false;
    // dd($nilai_top_20);

    foreach($nilai_top_20 as $n){
        if(userinfo()->partisipan_id == $n->partisipan_id){
            $lolos = true;
            break;
        }
    }
?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100">
    <div class="col-span-12 flex space-y-16 flex-col sticky top-8 z-50">
        <?php 
            $user_lomba = db()->table('partisipan_lomba')->where('partisipan_id', userinfo()->partisipan_id)->get()->getRow();
            $kuota_habis_semua = false;
            if($user_lomba->kuota_1 == 0 and $user_lomba->kuota_2 == 0 and $user_lomba->kuota_3 == 0) :
        ?>
        <div class="alert alert-info" x-data="{active: true}" x-show="active" id="info">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                </svg>
                <span>Data jawaban Preliminary Round dapat diakses pada <a class="btn btn-xs" href="<?= base_url('lomba/reviu-lju/' . $voucher) ?>" target="_blank">tautan ini</a></span>
            </div>
            <svg
                @click="active = false"
                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
        <?php endif ?>
    </div>

    <div class="card col-span-12 p-24 bg-neutral-100">
        <table class="tabel-card text-12 lg:text-16">
            <tr>
                <td>Nama Tim</td>
                <td>:</td>
                <td><?= userinfo()->nama_tim ?></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td><?= userinfo()->pt ?></td>
            </tr>
            <tr>
                <td>Nama Ketua Tim</td>
                <td>:</td>
                <td><?= userinfo()->nama_ketua ?></td>
            </tr>
            <tr>
                <td>Nama Anggota 1</td>
                <td>:</td>
                <td><?= userinfo()->nama_1 ?></td>
            </tr>
            <tr>
                <td>Nama Anggota 2</td>
                <td>:</td>
                <td><?= userinfo()->nama_2 ?></td>
            </tr>
            <tr>
                <td>Jenis Lomba</td>
                <td>:</td>
                <td>Accounting for High School</td>
                <!-- <td><?= userinfo()->partisipan_jenis == 'AccSMA' ? 'Accounting for High School' : (userinfo()->partisipan_jenis == 'AccUniv'  ? 'Accounting for University' : 'Call for Paper') ?></td> -->
            </tr>
            <tr>
                <td>Nomor Whatsapp</td>
                <td>:</td>
                <td><?= userinfo()->wa ?></td>
            </tr>
        </table>
    </div>
    <div class="card col-span-12 p-24 bg-neutral-100">
        <?php 
            if($voucher) :
        ?>
            <span>Voucher untuk pengerjaan soal Preliminary Round tim Anda adalah 
                    <?php foreach($kode_segmen as $segmen) : ?>
                    <?= $voucher.$segmen ?>
                    <div 
                        data-tip="Salin voucher"
                        class="inline tooltip tooltip-primary"
                    >
                        <svg 
                            data-clipboard-text="<?= $voucher.$segmen ?>" 
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
                    <?php if($kuota_habis_semua or date('Y-m-d H:i') > tanggal('finish_pre')) : ?>
                    <th>Lolos</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Simulasi Preliminary Round</td>
                    <td><?= tanggal('start_pre') ?></td>
                    <td>
                        <?php if($kuota_habis_semua or date('Y-m-d H:i') > tanggal('finish_pre')) : ?>
                        <a href="<?= base_url('lomba/reviu-lju/' . $voucher) ?>" target="_blank">cek di sini</a>
                        <?php else : ?>
                        Nilai belum
                        <?php endif; ?>
                    </td>
                    <?php if($kuota_habis_semua or date('Y-m-d H:i') > tanggal('finish_pre')) : ?>
                    <td>
                        <?php if($lolos) : ?>
                            Lolos
                        <?php else : ?>
                            Tidak Lolos
                        <?php endif; ?>
                    </td>
                    <?php endif;?>
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