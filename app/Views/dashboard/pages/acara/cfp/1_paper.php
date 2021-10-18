<?=  form_open('acara/cfp-verif-full-paper')?>

<div class="overflow-auto">
    <table class="tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tim</th>
                <th>Nama Ketua</th>
                <th>Nama Anggota 1</th>
                <th>Nama Anggota 2</th>
                <th>Sudah Diverifikasi Bendahara</th>
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
                    <td><?= $peserta->nama_ketua ?></td>
                    <td><?= $peserta->nama_1 ?></td>
                    <td><?= $peserta->nama_2 ?></td>
                    <td>
                        <?php if($peserta->pembayaran_aktif):?>
                            <span class="verif-sukses">Terverifikasi</span>
                        <?php else :?>
                            <span class="verif-gagal">Belum diverifikasi</span>
                        <?php endif?>
                    </td>
                    <td>
                        <?php if($peserta->file_paper != '' && str_contains($peserta->file_paper, '|')) : ?>
                            <?php foreach(explode('|', $peserta->file_paper) as $berkas):?>    
                                <a href="<?= base_url('uploads/partisipan/lomba/paper/'.$berkas) ?>" target="_blank" class="btn btn-sm btn-primary">Berkas<a>
                            <?php endforeach ?>
                        <?php elseif($peserta->file_paper != ''):?>
                            <a href="<?= base_url('uploads/partisipan/lomba/paper/'.$peserta->file_paper) ?>" target="_blank" class="btn btn-sm btn-primary">Berkas<a>
                        <?php else :?>
                            <span class="verif-gagal">Tidak ada berkas yang diunggah</span>
                        <?php endif?>
                    <td><input type="text" class="w-full bg-neutral-200 border border-neutral-60 focus:border-primary-100 rounded-md p-8 text-base-100 text-12" name="nilai[<?= $peserta->id ?>]" value="<?= $peserta->nilai_1 ?>"></td>
                    <td><input type="checkbox" class="checkbox checkbox-primary" <?= $peserta->full_paper ? 'checked': '' ?> name="check[]" value="<?= $peserta->id ?>"></td>
                    <input type="hidden" name="ids[]" value="<?= $peserta->id ?>">
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<button class="btn btn-primary">Submit</button>

<?= form_close() ?>