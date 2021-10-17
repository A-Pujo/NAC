<?=  form_open('lomba/cfp-verif-full-paper')?>

<table class="tabel">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Data Full Paper</th>
            <th>Nilai</th>
            <th>Lulus</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('cfp')->getAll() as $peserta):?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $peserta->nama_tim ?></td>
                <td>
                    <?php if($peserta->file_paper != '' && str_contains($peserta->file_paper, '|')) : ?>
                        <?php foreach(explode('|', $peserta->file_paper) as $berkas):?>    
                            <a href="<?= $berkas ?>" target="_blank" class="btn btn-sm btn-primary">Berkas<a>
                        <?php endforeach ?>
                    <?php elseif($peserta->file_paper != ''):?>
                        <a href="<?= $peserta->file_paper ?>" target="_blank" class="btn btn-sm btn-primary">Berkas<a>
                    <?php else :?>
                        <span class="verif-gagal">Tidak ada berkas yang diunggah</span>
                    <?php endif?>
                <td><input type="text" class="w-full bg-neutral-200 border border-neutral-60 focus:border-primary-100 rounded-md p-8 text-base-100 text-12"></td>
                <td><input type="checkbox" class="checkbox checkbox-primary" <?= $peserta->full_paper ? 'checked': '' ?> name="check[]" value="<?= $peserta->id ?>"></td>
                <input type="hidden" name="ids[]" value="<?= $peserta->id ?>">
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<button class="btn btn-primary">Submit</button>

<?= form_close() ?>