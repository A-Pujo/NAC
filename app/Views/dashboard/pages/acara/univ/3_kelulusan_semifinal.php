<?=  form_open('acara/verif-kelulusan/univ/semifinal')?>
<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tim</th>
            <th>Lulus</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('univ')->getAll('prelim', 1) as $peserta) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $peserta['nama_tim'] ?></td>
            <td><input type="checkbox" class="checkbox checkbox-primary" <?= $peserta['semifinal'] ? 'checked': '' ?> name="check[]" value="<?= $peserta['id'] ?>"></td>
            <input type="hidden" name="ids[]" value="<?= $peserta['id'] ?>">
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= form_submit('submit', 'submit') ?>
<?= form_close() ?>