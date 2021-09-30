<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<div class="p-32 ">
    <div class="card bg-neutral-100 w-min p-32">
        <div class="card">
            <iframe src="<?= $video ?>" frameborder="0" width="400px" height="300px" allowfullscreen></iframe><br>
        </div>
    </div>
    <div>
        <a class="btn btn-primary mt-24" target="_blank" href="<?= base_url('kursus/kuis/video-'.$index) ?>">Kerjakan Kuis</a>
    </div>
</div>
<?= $this->endSection() ?>  