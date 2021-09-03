<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php
    $isError = empty(initValidation()->getErrors()) ? false : true;
    if($isError){
        // handling kalo error
        $pt = ! initValidation()->hasError('pt') ? old('pt') : '' ;
        $nama_tim = ! initValidation()->hasError('nama_tim') ? old('nama_tim') : '' ;
        $nama_ketua = ! initValidation()->hasError('nama_ketua') ? old('nama_ketua') : '' ;
        $nama_1 = ! initValidation()->hasError('nama_1') ? old('nama_1') : '' ;
        $nama_2 = ! initValidation()->hasError('nama_2') ? old('nama_2') : '' ;
        $wa = ! initValidation()->hasError('wa') ? old('wa') : '';
    } else {
        // seed awal value input
        $pt = userinfo()->pt;
        $nama_tim = userinfo()->nama_tim;
        $nama_ketua = userinfo()->nama_ketua;
        $nama_1 = userinfo()->nama_1;
        $nama_2 = userinfo()->nama_2;
        $wa = userinfo()->wa;
    }

?>
    <div class="text-base-100 p-32">
    <h1>Ini Halaman Home</h1>
        <div>
            <?php if(userinfo()->partisipan_aktif == 0 or userinfo()->pembayaran_aktif == 0) : ?>
                <?= form_open_multipart(base_url('/dashboard/update-pendaftaran'), ['method' => 'post']) ?>
                    <?= csrf_field() ?>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Perguruan Tinggi</span>
                        </label>
                        <input type="text" class="form-input" name="pt" value="<?= $pt ?>" />
                        <?php if(initValidation()->hasError('pt')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('pt'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Nama Tim -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Tim</span>
                        </label>
                        <input type="text" class="form-input" name="nama_tim" value="<?= $nama_tim  ?>" />
                        <input type="hidden" class="form-input" name="nama_tim_lama" value="<?= userinfo()->nama_tim ?>" />
                        <?php if(initValidation()->hasError('nama_tim')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_tim'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Ketua -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Ketua Tim</span>
                        </label>
                        <input type="text" class="form-input" name="nama_ketua" value="<?= $nama_ketua ?>" />
                        <?php if(initValidation()->hasError('nama_ketua')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_ketua'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Anggota 1 -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Anggota 1</span>
                        </label>
                        <input type="text" class="form-input" name="nama_1" value="<?= $nama_1 ?>" />
                        <?php if(initValidation()->hasError('nama_1')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_1'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Anggota 2 -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Anggota 2</span>
                        </label>
                        <input type="text" class="form-input" name="nama_2" value="<?= $nama_2 ?>" />
                        <?php if(initValidation()->hasError('nama_2')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_2'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Jenis Lomba</span>
                        </label>
                        <select name="partisipan_jenis[]" class="text-primary-100" multiple>
                            <option value="AuditUniv" <?= in_array('AuditUniv', explode('|', userinfo()->partisipan_jenis)) ? 'selected' : '' ?> >Audit Perguruan Tinggi</option>
                            <option value="AccUniv" <?= in_array('AccUniv', explode('|', userinfo()->partisipan_jenis)) ? 'selected' : '' ?> >Akuntansi Perguruan Tinggi</option>
                            <option value="AccSMA" <?= in_array('AccSMA', explode('|', userinfo()->partisipan_jenis)) ? 'selected' : '' ?> >Akuntansi SMA</option>
                        </select>
                        <?php if(initValidation()->hasError('partisipan_jenis')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('partisipan_jenis'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- WA -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Whatsapp</span>
                        </label>
                        <input type="text" class="form-input" name="wa" value="<?= $wa ?>" />
                        <?php if(initValidation()->hasError('wa')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('wa'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- SP -->
                    <div class="form-control">
                        <label class="label" for="surat_pernyataan">
                            <span class="label-text text-base-100">Surat Pernyataan</span>
                        </label>
                        <div class="inline-block">
                            <label for="surat_pernyataan" class="btn btn-primary">Upload Data</label>
                        </div>
                        <input type="file" class="form-input hidden" name="surat_pernyataan" id="surat_pernyataan" />
                        <input type="hidden" value="<?= userinfo()->surat_pernyataan ?>" name="old_surat_pernyataan">
                        <?php if(initValidation()->hasError('surat_pernyataan')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('surat_pernyataan'); ?></small>
                        <?php endif; ?>
                        <?php if(userinfo()->surat_pernyataan != null) : ?>
                            <a style="color: red;" href="<?= base_url('/uploads/partisipan/surat-pernyataan/'.userinfo()->surat_pernyataan) ?>" target="_blank">Surat Pernyataan</a>
                        <?php endif; ?>
                    </div>

                    <!-- KTM -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Kartu Tanda Mahasiswa</span>
                        </label>
                        <input type="file" class="form-input" name="ktm[]" multiple/>
                        <input type="hidden" value="<?= userinfo()->ktm ?>" name="old_ktm">
                        <?php if(initValidation()->hasError('ktm')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('ktm'); ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">submit</button>
                </form>

                    <?php endif; ?>
                    </div>
                    </div>

<?= $this->endSection() ?>