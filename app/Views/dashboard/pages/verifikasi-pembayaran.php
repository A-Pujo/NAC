<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-base-100">
        <table id="tabel-partisipan" class="table w-full text-accent-content">
            <thead>
                <tr>
                    <th>Nama Tim</th>
                    <th>jenis Partisipasi</th>
                    <th>Nama Ketua</th>
                    <th>Pembayaran Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data_partisipan as $partisipan) : 
                    if($partisipan->role_id == 0 or $partisipan->role_id == 2):?>
                <tr>
                    <td><?= $partisipan->nama_tim ?></td>
                    <td><?= $partisipan->partisipan_jenis ?></td>
                    <td><?= $partisipan->nama_ketua ?></td>
                    <td><?= $partisipan->pembayaran_aktif == 0 ? 'Belum Bayar' : 'Sudah Bayar' ?></td>
                    <td><a class="btn btn-primary" href="<?= base_url('/dashboard/verifikasi-pembayaran/'.$partisipan->user_id) ?>">Periksa</a></td>
                </tr>
                <?php endif;
                endforeach; ?>
            </tbody>
        </table>
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