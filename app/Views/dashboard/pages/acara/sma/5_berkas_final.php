<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tim</th>
            <th>Berkas</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('sma')->getAll('semifinal', 1) as $peserta) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $peserta['nama_tim'] ?></td>
            <td><a class="btn btn-sm btn-primary <?= $peserta['berkas_3'] != '' ? '' : 'btn-disabled' ?>" href="<?= base_url('uploads/partisipan/lomba/berkas/'.$peserta['berkas_3']) ?>" download>Unduh berkas</a></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>