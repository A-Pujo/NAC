<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Prodi</th>
            <th>Instansi</th>
            <th>WA</th>
            <th>Webinar 1</th>
            <th>Webinar 2</th>
            <th>Webinar 3</th>
            <th>Opening</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('webinar')->getAll() as $peserta) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $peserta->nama ?></td>
            <td><?= $peserta->npm ?></td>
            <td><?= $peserta->prodi ?></td>
            <td><?= $peserta->instansi ?></td>
            <td><?= $peserta->wa ?></td>
            <td><?= $peserta->webinar_1 ?></td>
            <td><?= $peserta->webinar_2 ?></td>
            <td><?= $peserta->webinar_3 ?></td>
            <td><?= $peserta->webinar_4 ?></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>