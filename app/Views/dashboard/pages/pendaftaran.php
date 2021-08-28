<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <style>
        select, *{
            color: blue;
        }
    </style>

    <div class="text-base-100">
    <h1>Ini Halaman Home</h1>
        <div>
            <?php if(userinfo()->partisipan_aktif == 0 or userinfo()->pembayaran_aktif == 0) : ?>
                Pendaftaran awal:
                <?= form_open_multipart(base_url('/dashboard/update-pendaftaran'), ['method' => 'post']) ?>
                    <?= csrf_field() ?>
                    <div>
                        <label class="label">Perguruan Tinggi</label>
                        <input type="text" class="form-control" name="pt" value="<?= userinfo()->pt ?>" />
                        <?php if(initValidation()->hasError('pt')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('pt'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Nama Tim</label>
                        <input type="text" class="form-control" name="nama_tim" value="<?= userinfo()->nama_tim ?>" />
                        <input type="hidden" class="form-control" name="nama_tim_lama" value="<?= userinfo()->nama_tim ?>" />
                        <?php if(initValidation()->hasError('nama_tim')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_tim'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Nama Ketua</label>
                        <input type="text" class="form-control" name="nama_ketua" value="<?= userinfo()->nama_ketua ?>" />
                        <?php if(initValidation()->hasError('nama_ketua')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_ketua'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Nama Anggota 1</label>
                        <input type="text" class="form-control" name="nama_1" value="<?= userinfo()->nama_1 ?>" />
                        <?php if(initValidation()->hasError('nama_1')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_1'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Nama Anggota 2</label>
                        <input type="text" class="form-control" name="nama_2" value="<?= userinfo()->nama_2 ?>" />
                        <?php if(initValidation()->hasError('nama_2')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_2'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Jenis Partisipsi</label>
                        <select name="partisipan_jenis[]" class="select select-sm select-bordered select-info" multiple>
                            <option value="AuditUniv" <?= in_array('AuditUniv', explode('|', userinfo()->partisipan_jenis)) ? 'selected' : '' ?> >Audit Perguruan Tinggi</option>
                            <option value="AccUniv" <?= in_array('AccUniv', explode('|', userinfo()->partisipan_jenis)) ? 'selected' : '' ?> >Akuntansi Perguruan Tinggi</option>
                            <option value="AccSMA" <?= in_array('AccSMA', explode('|', userinfo()->partisipan_jenis)) ? 'selected' : '' ?> >Akuntansi SMA</option>
                        </select>
                        <?php if(initValidation()->hasError('partisipan_jenis')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('partisipan_jenis'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Whatsapp</label>
                        <input type="text" class="form-control" name="wa" value="<?= userinfo()->wa ?>" />
                        <?php if(initValidation()->hasError('wa')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('wa'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Surat Pernyataan</label>
                        <input type="file" class="form-control" name="surat_pernyataan"/>
                        <input type="hidden" value="<?= userinfo()->surat_pernyataan ?>" name="old_surat_pernyataan">
                        <?php if(initValidation()->hasError('surat_pernyataan')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('surat_pernyataan'); ?></small>
                        <?php endif; ?>
                        <?php if(userinfo()->surat_pernyataan != null) : ?>
                            <a style="color: red;" href="<?= base_url('/uploads/partisipan/surat-pernyataan/'.userinfo()->surat_pernyataan) ?>" target="_blank">Surat Pernyataan</a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="label">Kartu Tanda Mahasiswa</label>
                        <input type="file" class="form-control" name="ktm[]" multiple/>
                        <input type="hidden" value="<?= userinfo()->ktm ?>" name="old_ktm">
                        <?php if(initValidation()->hasError('ktm')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('ktm'); ?></small>
                        <?php endif; ?>
                        <?php 
                        if(userinfo()->ktm != null) : 
                            foreach(explode('|', userinfo()->ktm) as $ktm) :
                        ?>
                            <img src="<?= base_url('/uploads/partisipan/ktm/'.$ktm) ?>" alt="">
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                    <div>
                        <label class="label">Bukti Twibbon</label>
                        <input type="file" class="form-control" value="<?= userinfo()->twibbon ?>" name="twibbon[]" multiple/>
                        <input type="hidden" value="<?= userinfo()->twibbon ?>" name="old_twibbon">
                        <?php if(initValidation()->hasError('twibbon')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('twibbon'); ?></small>
                        <?php endif; ?>
                        <?php 
                        if(userinfo()->twibbon != null) : 
                            foreach(explode('|', userinfo()->twibbon) as $twibbon) :
                        ?>
                            <img src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon) ?>" alt="">
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">submit</button>
                </form>
            <?php else: ?>
                <p>
                    <small>Perguruan Tinggi</small><br>
                    <b><?= userinfo()->pt ?></b><br>
                    <small>Nama TIm</small><br>
                    <b><?= userinfo()->nama_tim ?></b><br>
                    <small>Nama Ketua</small><br>
                    <b><?= userinfo()->nama_ketua ?></b><br>
                    <small>Nama Anggota 1</small><br>
                    <b><?= userinfo()->nama_1 ?></b><br>
                    <small>Nama Anggota 2</small><br>
                    <b><?= userinfo()->nama_2 ?></b><br>
                    <small>Jenis Partisipasi</small><br>
                    <b><?= userinfo()->partisipan_jenis ?></b><br>
                    <small>Whatsapp</small><br>
                    <b><?= userinfo()->wa ?></b><br>
                    <small>KTM</small><br>
                    <?php 
                    if(userinfo()->ktm != null) : 
                        foreach(explode('|', userinfo()->ktm) as $ktm) :
                    ?>
                        <img src="<?= base_url('/uploads/partisipan/ktm/'.$ktm) ?>" alt="">
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                    <small>Twibbon</small><br>
                    <?php 
                    if(userinfo()->twibbon != null) : 
                        foreach(explode('|', userinfo()->twibbon) as $twibbon) :
                    ?>
                        <img src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon) ?>" alt="">
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>