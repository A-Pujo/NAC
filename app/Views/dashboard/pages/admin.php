<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <style>
        .modal{
            overflow-y: initial !important
        }

        .modal-box{
            height: 90vh;
            overflow-y: auto;
        }

    </style>

    <div class="text-base-100">
        <table id="tabel-partisipan" class="table w-full text-accent-content">
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
        <a class="btn btn-secondary" href="<?= base_url('/dashboard/admin/tim-regis') ?>">Kelola Tim Regis</a>
        <a class="btn btn-secondary" href="<?= base_url('/dashboard/admin/tim-bendahara') ?>">Kelola Tim Bendahara</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit-icons.min.js"></script>
    <script>

        $(document).ready( function () {
            $('#tabel-partisipan').DataTable();
        } );
    </script>
<?= $this->endSection() ?>