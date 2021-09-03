<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-base-100">
        Status Pembayaran:
        <div>
            <?php if(userinfo()->pembayaran_aktif == 0) : ?>
                <b>Belum bayar</b>
                Isi bukti pembayaran
                <?= form_open_multipart(base_url('/dashboard/update-pembayaran'), ['method' => 'post']) ?>
                <?= csrf_field() ?>
>>>>>>> 69de7630ff46d5ac7fedd93494aebf604b087457
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Bank</span>
                        </label>
                        <input type="text" class="form-input" name="nama_bank" value="<?= ! initValidation()->hasError('nama_bank') ? old('nama_bank') : userinfo()->nama_bank ?>" />
                        <?php if(initValidation()->hasError('nama_bank')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_bank'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nama Nasabah</span>
                        </label>
                        <input type="text" class="form-input" name="nama_nasabah" value="<?= ! initValidation()->hasError('nama_nasabah') ? old('nama_nasabah') : userinfo()->nama_nasaba ?>" />
                        <?php if(initValidation()->hasError('nama_nasabah')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_nasabah'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Nomor Rekening</span>
                        </label>
                        <input type="text" class="form-input" name="nomor_rekening" value="<?= ! initValidation()->hasError('nomor_rekening') ? old('nomor_rekening') : userinfo()->nomor_rekening ?>" />
                        <?php if(initValidation()->hasError('nomor_rekening')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nomor_rekening'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Jumlah Transfer</span>
                        </label>
                        <input type="number" class="form-input" name="jumlah_transfer" value="<?= ! initValidation()->hasError('jumlah_transfer') ? old('jumlah_transfer') : userinfo()->jumlah_transfer ?>" />
                        <?php if(initValidation()->hasError('jumlah_transfer')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('jumlah_transfer'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-base-100">Bukti Transfer</span>
                        </label>
                        <input type="file" class="form-input" name="bukti_transfer" />
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