<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-base-100">
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
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit-icons.min.js"></script>
<?= $this->endSection() ?>