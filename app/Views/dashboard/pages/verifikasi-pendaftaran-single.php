<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-base-100">
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
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.2/dist/js/uikit-icons.min.js"></script>
<?= $this->endSection() ?>