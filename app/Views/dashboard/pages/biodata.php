<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-primary-100 p-32 text-14">
        <div class="bg-neutral-100 p-24 rounded-md inline-block">
            <table class="tabel-card">
                <tr>
                    <td>Nama Tim</td>
                    <td>:</td>
                    <td><?= $p->nama_tim ?></td>
                </tr>
                <tr>
                    <td>Nama Sekolah / Perguruan Tinggi</td>
                    <td>:</td>
                    <td><?= $p->pt ?></td>
                </tr>
                <tr>
                    <td>Alamat Sekolah / PT </td>
                    <td>:</td>
                    <td><?= $p->pt ?></td>
                </tr>
                <tr>
                    <td colspan="3">==========</td>
                </tr>
                <tr>
                    <td>Nama Ketua Tim</td>
                    <td>:</td>
                    <td><?= $p->nama_ketua ?></td>
                </tr>
                <tr>
                    <td>Nama Anggota 1</td>
                    <td>:</td>
                    <td><?= $p->nama_1 ?></td>
                </tr>
                <tr>
                    <td>Nama Anggota 2</td>
                    <td>:</td>
                    <td><?= $p->nama_2 ?></td>
                </tr>
                <tr>
                    <td>Jenis Lomba</td>
                    <td>:</td>
                    <td><?= $p->partisipan_jenis ?></td>
                </tr>
                <tr>
                    <td>Nomor Whatsapp</td>
                    <td>:</td>
                    <td><?= $p->wa ?></td>
                </tr>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>