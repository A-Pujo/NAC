<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tim</th>
            <th>Berkas</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('sma')->getAll('prelim', 1) as $peserta) : ?>
        <tr>
            <?php 
                if($peserta['berkas_1'] != ''){
                    list($tgl, $file) = explode('|', $peserta['berkas_1']);
                } else {
                    $tgl = '';
                    $file = '#';
                }
            ?>
            <td><?= $no++ ?></td>
            <td><?= $peserta['nama_tim'] ?></td>
            <td><?= $tgl ?></td>
            <td><a class="btn btn-sm btn-primary <?= $peserta['berkas_1'] != '' ? '' : 'btn-disabled' ?>" href="<?= base_url('uploads/partisipan/lomba/berkas/'.$file) ?>" download>Unduh berkas</a></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>