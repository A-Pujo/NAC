<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Prodi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('webinar')->getSKPM(2) as $peserta) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $peserta->nama ?></td>
            <td><?= $peserta->npm ?></td>
            <td><?= $peserta->prodi ?></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>