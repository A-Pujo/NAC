<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="p-32">
        <a class="btn btn-secondary mb-32" href="<?= base_url('/dashboard/tambah-anggota/tim-regis') ?>">Tambah</a>
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data_partisipan as $partisipan) : 
                    if($partisipan->role_name == 'tim registrasi') :?>
                <tr>
                    <td><?= $partisipan->email ?></td>
                    <td><?= $partisipan->nama ?></td>
                    <td><a href="<?= base_url('dashboard/hapus-role/'.$partisipan->id) ?>" class="btn btn-error btn-sm">Hapus</a></td>
                </tr>
                <?php 
                    endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>