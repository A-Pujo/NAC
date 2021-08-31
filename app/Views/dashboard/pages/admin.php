<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-32">

        <a class="btn btn-primary" href="<?= base_url('/dashboard/admin/tim-regis') ?>">Kelola Tim Regis</a>
        <a class="btn btn-primary ml-4 mb-32" href="<?= base_url('/dashboard/admin/tim-bendahara') ?>">Kelola Tim Bendahara</a>

        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data_partisipan as $partisipan) : ?>
                <tr>
                    <td><?= $partisipan->email ?></td>
                    <td><?= $partisipan->nama ?></td>
                    <td><?= $partisipan->role_name ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>