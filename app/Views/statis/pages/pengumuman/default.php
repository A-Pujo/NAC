<div class="flex flex-col space-y-16">
    <?php
    
    $data = [
        ['cfp-abstrak','Peserta lolos seleksi abstrak Call for Paper.'],
        ['acc-sma-pre','Peserta lolos seleksi Preliminary Raound Accounting High Scholl.'],
        ['acc-univ-pre','Peserta lolos seleksi Preliminary Raound Accounting University.'],
    ]
    
    ?>

    <?php foreach($data as $i) : ?>
        <a href='<?= base_url("pengumuman?halaman=". $i[0]) ?>' class="group card p-8 border border-primary-100 cursor-pointer flex flex-row justify-between items-center">
            <span><?= "[". tanggal($i[0]) ."] ". $i[1] ?> </span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="h-5 w-5 transition mr-0 group-hover:mr-8"
            >
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </a>
    <?php endforeach?>
</div>