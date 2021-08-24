<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <style>
        select{
            color: #fff;
        }
    </style>

    <div class="text-base-100">
        <h1>Ini Halaman Home</h1>
        <div>
            Pendaftaran awal:
            <?php if(userinfo()->partisipan_aktif == 0 or userinfo()->pembayaran_aktif == 0) : ?>
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
                        <select name="partisipan_jenis" class="select select-sm select-bordered select-info">
                            <option value="" <?= userinfo()->partisipan_jenis == 'individu' ? 'selected' : '' ?> >Pilih..</option>
                            <option value="individu" <?= userinfo()->partisipan_jenis == 'individu' ? 'selected' : '' ?> >individu</option>
                            <option value="tim" <?= userinfo()->partisipan_jenis == 'tim' ? 'selected' : '' ?> >Tim</option>
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
            <?php endif; ?>
        </div>
        Status Pembayaran:
        <div>
            <?php if(userinfo()->pembayaran_aktif == 0) : ?>
                <b>Belum bayar</b>
                Isi bukti pembayaran
                <?= form_open_multipart(base_url('/dashboard/update-pembayaran'), ['method' => 'post']) ?>
                <?= csrf_field() ?>
                    <div>
                        <label class="label">Nama Bank</label>
                        <input type="text" class="form-control" name="nama_bank" value="<?= userinfo()->nama_bank ?>" />
                        <?php if(initValidation()->hasError('nama_bank')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_bank'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="label">Nama Nasabah</label>
                        <input type="text" class="form-control" name="nama_nasabah" value="<?= userinfo()->nama_nasabah ?>" />
                        <?php if(initValidation()->hasError('nama_nasabah')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_nasabah'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="label">Nomor Rekening</label>
                        <input type="text" class="form-control" name="nomor_rekening" value="<?= userinfo()->nomor_rekening ?>" />
                        <?php if(initValidation()->hasError('nomor_rekening')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nomor_rekening'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="label">Jumlah Transfer</label>
                        <input type="number" class="form-control" name="jumlah_transfer" value="<?= userinfo()->jumlah_transfer ?>" />
                        <?php if(initValidation()->hasError('jumlah_transfer')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('jumlah_transfer'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="label">Bukti Transfer</label>
                        <input type="file" class="form-control" name="bukti_transfer" />
                        <input type="hidden" value="<?= userinfo()->bukti_transfer ?>" name="old_bukti_transfer" />
                        <?php if(initValidation()->hasError('bukti_transfer')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('bukti_transfer'); ?></small>
                        <?php endif; ?>
                        <?php 
                        if(userinfo()->bukti_transfer != null) : 
                            foreach(explode('|', userinfo()->bukti_transfer) as $bukti_transfer) :
                        ?>
                            <img src="<?= base_url('/uploads/pembayaran/bukti/'.$bukti_transfer) ?>" alt="">
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">submit</button>
                </form>
            <?php else :?>
                <b>Udah bayar</b>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>