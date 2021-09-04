<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody >
                <?php foreach($data_partisipan as $partisipan) : 
                    if($partisipan->role_name == 'umum') :?>
                <tr>
                    <td><?= $partisipan->email ?></td>
                    <td ><?= $partisipan->nama ?></td>
                    <td ><a href="<?= base_url('dashboard/tambah-tim-lomba/'.$partisipan->id) ?>" class="btn btn-sm btn-neutral">Pilih</a></td>
                </tr>
                <?php 
                    endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>