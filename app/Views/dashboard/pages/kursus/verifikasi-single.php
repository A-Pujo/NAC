<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<div class="p-32">
    <div class="bg-neutral-100 p-24 rounded-md inline-block">
        <table class="tabel-card">
            <tr>
                <td>Nama Peserta</td>
                <td>:</td>
                <td><?= $peserta->nama_peserta ?></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td><?= $peserta->nama_sekolah ?></td>
            </tr>
        </table>
    </div>
    <div class="bg-neutral-100 p-24 rounded-md flex flex-row space-x-24 mb-24">
        <div 
            class="rounded-md overflow-hidden cursor-pointer" 
            @click="imgShow = true, imgSrc = '<?= base_url('uploads/kursus/kartu-pelajar/'.$peserta->kartu_pelajar) ?>', imgTitle = 'Bukti Pendukung'"
        >
            <img class="bg-base-100 object-cover h-full" src="<?= base_url('uploads/kursus/kartu-pelajar/'.$peserta->kartu_pelajar) ?>" alt="" />
        </div>
    </div>
    <?php if($peserta->verifikasi_peserta == 1) : ?>
            <a class="btn btn-primary" href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/0') ?>">Cabut</a>
        <?php else : ?>
            <a class="btn btn-primary" href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/1') ?>">Aktivasi</a>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>