<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Jenis Partisipasi</th>
                    <th>Partisipan Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach($daftar_peserta as $peserta) : ?>
                            
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $peserta->nama_peserta ?></td>
                                <td><?= $peserta->nama_sekolah ?></td>
                                <td>
                                    <?php if($peserta->verifikasi_peserta == 1) : ?>
                                        <span class="verif-sukses"> Terverifikasi <span>
                                    <?php else: ?>
                                        <span class="verif-gagal"> Belum Terverifikasi <span>
                                    <?php endif ?>
                                </td>
                                <td><a class="btn btn-sm btn-primary" href="<?= base_url('kursus/verifikasi/'.$peserta->id_user) ?>">Periksa</a></td>
                            </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>