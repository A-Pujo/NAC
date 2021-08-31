<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-base-100 p-32">
    <h1>Ini Halaman Home</h1>
        <div>
            <?php if(userinfo()->partisipan_aktif == 0 or userinfo()->pembayaran_aktif == 0) : ?>
                Pendaftaran awal:
                <?= form_open_multipart(base_url('/dashboard/update-pendaftaran'), ['method' => 'post']) ?>
                    <?= csrf_field() ?>
<<<<<<< HEAD

                    <!-- PT -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Perguruan Tinggi</span>
                        </label>
                        <input type="text" class="form-input" name="pt" value="<?= userinfo()->pt ?>" />
=======
                    <div>
                        <label class="label">Perguruan Tinggi</label>
                        <input type="text" class="form-control" name="pt" value="<?= ! initValidation()->hasError('pt') ? old('pt') : userinfo()->pt ?>" />
>>>>>>> 45fc7503f388e795fe1ca2aac6061be85f6d129f
                        <?php if(initValidation()->hasError('pt')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('pt'); ?></small>
                        <?php endif; ?>
                    </div>
<<<<<<< HEAD

                    <!-- Nama Tim -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Tim</span>
                        </label>
                        <input type="text" class="form-input" name="nama_tim" value="<?= userinfo()->nama_tim ?>" />
                        <input type="hidden" class="form-input" name="nama_tim_lama" value="<?= userinfo()->nama_tim ?>" />
=======
                    <div>
                        <label class="label">Nama Tim</label>
                        <input type="text" class="form-control" name="nama_tim" value="<?= ! initValidation()->hasError('nama_tim') ? old('nama_tim') : userinfo()->nama_tim ?>" />
                        <input type="hidden" class="form-control" name="nama_tim_lama" value="<?= userinfo()->nama_tim ?>" />
>>>>>>> 45fc7503f388e795fe1ca2aac6061be85f6d129f
                        <?php if(initValidation()->hasError('nama_tim')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_tim'); ?></small>
                        <?php endif; ?>
                    </div>
<<<<<<< HEAD

                    <!-- Ketua -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Ketua Tim</span>
                        </label>
                        <input type="text" class="form-input" name="nama_ketua" value="<?= userinfo()->nama_ketua ?>" />
=======
                    <div>
                        <label class="label">Nama Ketua</label>
                        <input type="text" class="form-control" name="nama_ketua" value="<?= ! initValidation()->hasError('nama_ketua') ? old('nama_ketua') : userinfo()->nama_ketua ?>" />
>>>>>>> 45fc7503f388e795fe1ca2aac6061be85f6d129f
                        <?php if(initValidation()->hasError('nama_ketua')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_ketua'); ?></small>
                        <?php endif; ?>
                    </div>
<<<<<<< HEAD

                    <!-- Anggota 1 -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Anggota 1</span>
                        </label>
                        <input type="text" class="form-input" name="nama_1" value="<?= userinfo()->nama_1 ?>" />
=======
                    <div>
                        <label class="label">Nama Anggota 1</label>
                        <input type="text" class="form-control" name="nama_1" value="<?= ! initValidation()->hasError('nama_1') ? old('nama_1') : userinfo()->nama_1 ?>" />
>>>>>>> 45fc7503f388e795fe1ca2aac6061be85f6d129f
                        <?php if(initValidation()->hasError('nama_1')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_1'); ?></small>
                        <?php endif; ?>
                    </div>
<<<<<<< HEAD

                    <!-- Anggota 2 -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Anggota 2</span>
                        </label>
                        <input type="text" class="form-input" name="nama_2" value="<?= userinfo()->nama_2 ?>" />
=======
                    <div>
                        <label class="label">Nama Anggota 2</label>
                        <input type="text" class="form-control" name="nama_2" value="<?= ! initValidation()->hasError('nama_2') ? old('nama_2') : userinfo()->nama_2 ?>" />
>>>>>>> 45fc7503f388e795fe1ca2aac6061be85f6d129f
                        <?php if(initValidation()->hasError('nama_2')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_2'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- Jenis Lomba -->
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
<<<<<<< HEAD

                    <!-- WA -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Whatsapp</span>
                        </label>
                        <input type="text" class="form-input" name="wa" value="<?= userinfo()->wa ?>" />
=======
                    <div>
                        <label class="label">Whatsapp</label>
                        <input type="text" class="form-control" name="wa" value="<?= initValidation()->hasError('wa') ? old('wa') : userinfo()->wa ?>" />
>>>>>>> 45fc7503f388e795fe1ca2aac6061be85f6d129f
                        <?php if(initValidation()->hasError('wa')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('wa'); ?></small>
                        <?php endif; ?>
                    </div>

                    <!-- SP -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Surat Pernyataan</span>
                        </label>
                        <input type="file" class="form-input" name="surat_pernyataan"/>
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

                    <!-- Twib -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Bukti Twibbon</span>
                        </label>
                        <input type="file" class="form-input" value="<?= userinfo()->twibbon ?>" name="twibbon[]" multiple/>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var arr = new Array();
            $("select[multiple]").change(function() {
                $(this).find("option:selected")
                if ($(this).find("option:selected").length > 2) {
                    $(this).find("option").removeAttr("selected");
                    $(this).val(arr);
                }
                else {
                    arr = new Array();
                    $(this).find("option:selected").each(function(index, item) {
                        arr.push($(item).val());
                    });
                }
            });
        });
    </script>
<?= $this->endSection() ?>