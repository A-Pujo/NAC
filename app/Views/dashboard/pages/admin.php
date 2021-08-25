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
                    <th>Nama Tim</th>
                    <th>jenis Partisipasi</th>
                    <th>Nama Ketua</th>
                    <th>Partisipan Aktif</th>
                    <th>Pembayaran Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data_partisipan as $partisipan) : ?>
                <tr>
                    <td><?= $partisipan->nama_tim ?></td>
                    <td><?= $partisipan->partisipan_jenis ?></td>
                    <td><?= $partisipan->nama_ketua ?></td>
                    <td><?= $partisipan->partisipan_aktif == 0 ? 'Belum Diverifikasi' : 'Terverifikasi' ?></td>
                    <td><?= $partisipan->pembayaran_aktif == 0 ? 'Belum Bayar' : 'Sudah Bayar' ?></td>
                    <td><a class="btn btn-primary" href="#modal-aksi-<?= $partisipan->user_id ?>">Periksa</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php foreach($data_partisipan as $partisipan) : ?>
    <div id="modal-aksi-<?= $partisipan->user_id ?>" class="modal">
        <div class="modal-box">
            <small>Nama Tim</small>
            <p><?= $partisipan->nama_tim ?></p>
            <small>Perguruan Tinggi</small>
            <p><?= $partisipan->pt ?></p>
            <small>Nama Ketua</small>
            <p><?= $partisipan->nama_ketua ?></p>
            <small>Anggota 1</small>
            <p><?= $partisipan->nama_1 ?></p>
            <small>Anggota 2</small>
            <p><?= $partisipan->nama_2 ?></p>
            <small>Jenis Partisipasi</small>
            <p><?= $partisipan->partisipan_jenis ?></p>
            <small>Whatsapp</small>
            <p><?= $partisipan->wa ?></p>
            <small>Bukti KTM</small>
            <p>
            <?php foreach(explode('|', $partisipan->ktm) as $ktm) : ?>
                <img src="<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>" alt="" />
            <?php endforeach; ?>
            </p>
            <small>Bukti Twibbon</small>
            <p>
            <?php foreach(explode('|', $partisipan->twibbon) as $twibbon) : ?>
                <img src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>" alt="" />
            <?php endforeach; ?>
            </p>
            <small>Partisipan</small>
            <?php if($partisipan->partisipan_aktif == 0) : ?>
            <p><a href="<?= base_url('/dashboard/aktivasi-partisipan/'.$partisipan->user_id) ?>" class="btn btn-sm btn-primary">Aktivasi</a></p>
            <?php else: ?>
            <p><a href="<?= base_url('/dashboard/deaktivasi-partisipan/'.$partisipan->user_id) ?>" class="btn btn-sm btn-primary">Deaktivasi</a></p>
            <?php endif; ?>
            <small>Nama Bank</small>
            <p><?= $partisipan->nama_bank ?></p>
            <small>Nama Nasabah</small>
            <p><?= $partisipan->nama_nasabah ?></p>
            <small>Nomor Rekening</small>
            <p><?= $partisipan->nomor_rekening ?></p>
            <small>Jumlah Transfer</small>
            <p><?= $partisipan->jumlah_transfer ?></p>
            <small>Bukti Transfer</small>
            <p>
            <?php foreach(explode('|', $partisipan->bukti_transfer) as $bt) : ?>
                <img src="<?= base_url('/uploads/pembayaran/bukti/'.$bt)?>" alt="" />
            <?php endforeach; ?>
            </p>
            <small>Pembayaran</small>
            <?php if($partisipan->pembayaran_aktif == 0) : ?>
            <p><a href="<?= base_url('/dashboard/aktivasi-pembayaran/'.$partisipan->user_id) ?>" class="btn btn-sm btn-primary">Aktivasi</a></p>
            <?php else: ?>
            <p><a href="<?= base_url('/dashboard/deaktivasi-pembayaran/'.$partisipan->user_id) ?>" class="btn btn-sm btn-primary">Deaktivasi</a></p>
            <?php endif; ?>
            <div class="modal-action">
                <a href="#" class="btn btn-primary">Close</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
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