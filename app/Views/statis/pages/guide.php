<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="flex flex-row text-base-100">
        <!-- List -->
        <div>

        </div>
        <!-- Main -->
        <div>
            <h1 class="text-48 font-bold">Guide Book Accounting for SMA</h1>
            <h2 class="text-36 font-bold">Pendaftaran Peserta</h2>
            <p>
                <span>Alur Pendaftaran calon peserta Accounting Challange for SMA<span>
                <ul>
                    <li>Masuk ke <a href="<?= base_url('dashboard/') ?>">dashbord</a> website menggunakan gmail.<br>
                    (satu akun hanya untuk satu jenis perlombaan)</li>
                </ul>
            </p>
        </div>

    </div>
<?= $this->endSection() ?>