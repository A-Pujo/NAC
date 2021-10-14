<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>
<div class="grid grid-cols-12 gap-24 p-32">
    <?php
    
    $judul = [
        'NAC DIGITAL SERIES #1 : WEBINAR INTERNASIONAL',
        'NAC DIGITAL SERIES #2 : WEBINAR NASIONAL',
        'NAC DIGITAL SERIES #3 : WEBINAR NASIONAL',
    ];

    $tema = [
        '“The Role of Accountant to Achieve Sustainable Development Goals in Digital Transformation Era”',
        '“The Urgency of Auditing Capability: Auditor’s Strategies Responding to Digital Transformation”',
        '“The Importance of Accounting as a Solution to Discover Loopholes in Economic Problems” '
    ];
    $peserta = user_webinar();
    $sudah_daftar = [
        $peserta->webinar_1 ?? false,
        $peserta->webinar_2 ?? false,
        $peserta->webinar_3 ?? false,
    ]
    
    ?>
    <?php for($i=1; $i<4; $i++ ) : ?>
        <div class="col-span-12 lg:col-span-4 card shadow-sm bg-neutral-200 text-accent-content p-24 flex flex-col md:flex-row lg:flex-col items-center space-x-8 space-y-8">
            <div class="rounded-xl overflow-hidden">
                <img src="<?= base_url('img/webinar_thumb_'.$i.'.jpg') ?>">
            </div> 
            <div>
                <h2 class="font-bold"><?= $judul[$i -1] ?></h2> 
                <p class="text-accent font-bold"><?= tanggal_human('webinar_start_'.$i) .'-'. jam_human('webinar_finish_'.$i)?></p>
                <p class="leading-4 font-light text-14"><?= $tema[$i - 1] ?></p> 
                <?php if($sudah_daftar[$i - 1]) :  ?>
                    <a href="<?= base_url('webinar/dashboard') ?>" class="btn btn-primary mt-16  btn-outline">Link Zoom</a>
                <?php else :?>
                    <a href="<?= base_url('webinar/pilih/'.$i) ?>" class="btn btn-primary mt-16">Daftar sekarang</a>
                <?php endif?>
            </div>
        </div>
    <?php endfor ?>


</div>
<?= $this->endSection() ?>