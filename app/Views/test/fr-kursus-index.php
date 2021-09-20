<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100">

    <div class="card col-span-12 bg-primary-300 p-24 ">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/yHha7DVndZw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="card col-span-12 bg-primary-300 p-24 ">
        Stevanus Anggraeni - SMAN 9 Kebonjarak
    </div>

    <div class="card col-span-12 p-24">
        <table class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Materi</th>
                    <th>Akses Video</th>
                    <th>Nilai Course</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Akuntansi dagang vs akuntansi jasa</td>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </td>
                    <td>90</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Akuntansi dagang vs akuntansi jasa</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-xs">Tonton</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-xs">Kerjakan</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <small class="text-base-100">Sertifikat akan diterbitkan jika Anda telah menonton seluruh video dan mengerjakan seluruh kuis dengan nilai minimum XX per materi. </small>
    </div>

</div>


<?= $this->endSection() ?>