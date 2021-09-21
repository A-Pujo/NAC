<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama Peserta</th>
                    <th>Nama Sekolah</th>
                    <th>Status Partisipan</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach($daftar_peserta as $peserta) : ?>
                            
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $peserta->email ?></td>
                        <td><?= $peserta->nama_peserta ?></td>
                        <td><?= $peserta->nama_sekolah ?></td>
                        <td>
                            <?php if($peserta->verifikasi_peserta == 1) : ?>
                                <span class="verif-sukses"> Terverifikasi <span>
                            <?php elseif($peserta->peserta_ditolak == 1): ?>
                                <span class="verif-gagal"> Peserta Ditolak <span>
                            <?php else : ?>
                                <span class="verif-gagal"> Belum Terverifikasi <span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>