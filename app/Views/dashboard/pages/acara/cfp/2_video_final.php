<table class="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tim</th>
            <th>Video</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach(md('cfp')->getAll('full_paper', 1) as $peserta) : ?>
        <tr>
            <td><?=  $no++?></td>
            <td><?=  $peserta['nama_tim']?></td>
            <td><a class="btn btn-xs btn-primary" href="<?= $peserta['video_1']?>" target="_blank">Video</td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>