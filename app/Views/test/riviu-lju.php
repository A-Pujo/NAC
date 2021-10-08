<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<div class="text-base-100 px-64 pt-16 pb-96 flex flex-col items-start space-x-16">
    <?php for($i = 0 ; $i < 50; $i++) : ?>
        <div class="card bg-neutral-100 p-16 space-y-8 flex-1">
            <p><strong class="text-24"><?= $i+1 ?></strong>Ini soal ?</p>
        </div>
    <?php endfor;?>
</div>
<?= $this->endSection() ?>