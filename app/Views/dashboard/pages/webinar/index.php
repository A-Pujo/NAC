<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="grid grid-cols-12 p-24 gap-24 text-base-100">
        <div class="card col-span-12 lg:col-span-8 p-24 bg-neutral-100">
            <table class="tabel-card text-12 lg:text-16">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $peserta->nama ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?= $peserta->email ?></td>
                </tr>
                <tr>
                    <td>Instansi</td>
                    <td>:</td>
                    <td><?= $peserta->instansi ?></td>
                </tr>
                
                <?php if($peserta->npm) : // Warga STAN?>
                    <tr>
                        <td>NPM</td>
                        <td>:</td>
                        <td><?= $peserta->npm ?></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?= $peserta->prodi ?></td>
                    </tr>
                <?php endif ?>
                <tr>
                    <td>Nomor Whatsapp</td>
                    <td>:</td>
                    <td><?= $peserta->wa ?></td>
                </tr>
            </table>
        </div>
        <div class="col-span-12">
            <table class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Seminar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Absensi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Seminar Internasional</td>
                        <td>20 Oktober 2021</td>
                        <td>Belum mendaftar</td>
                        <td>
                            <a class="btn btn-primary btn-sm">Daftar Sekarang</a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm">-</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Seminar Universe</td>
                        <td>20 Oktober 2021</td>
                        <td>Telah mendaftar</td>
                        <td>
                            <a class="btn btn-primary btn-sm">Join Zoom</a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm">-</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Seminar RT</td>
                        <td>Sedang berlangsung</td>
                        <td>Telah mendaftar</td>
                        <td>
                            <a class="btn btn-primary btn-sm"> - </a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm"> Absen </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <small>*Batas waktu absensi hingga 1 jam setelah acara usai</small>
        </div>
    </div>
<?= $this->endSection() ?>