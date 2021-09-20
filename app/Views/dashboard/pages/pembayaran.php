<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php 
    $isError = empty(initValidation()->getErrors()) ? false : true;
    if($isError){
        $nama_bank = ! initValidation()->hasError('nama_bank') ? old('nama_bank') : '';
        $nama_nasabah = ! initValidation()->hasError('nama_nasabah') ? old('nama_nasabah') : '';
        $nomor_rekening = ! initValidation()->hasError('nomor_rekening') ? old('nomor_rekening') : '';
    } else {
        $nama_bank = userinfo()->nama_bank;
        $nama_nasabah = userinfo()->nama_nasabah;
        $nomor_rekening = userinfo()->nomor_rekening;
    }
    // print_r(initValidation()->getErrors());

    // dd([date(userinfo()->pertama_input) <= date('2021-09-04 23:59:59'), date(userinfo()->pertama_input)]);
    // echo countPartisipan(['pt'=>'aa']);
    
    $jumlah_transfer = 0;
    if(userinfo()->partisipan_jenis == 'AccUniv'){
        if(date(userinfo()->pertama_input) <= date('2021-09-04 23:59:59')){
            $jumlah_transfer = '110000';
        } else {
            $jumlah_transfer = '120000';
        }
    } elseif(userinfo()->partisipan_jenis == 'AccSMA'){
        if(date(userinfo()->pertama_input) <= date('2021-09-04 23:59:59')){
            $jumlah_transfer = '80000';
        } else {
            $jumlah_transfer = '90000';
        }
    } else{
        if(date(userinfo()->partisipan_diupdate) <= date('2021-10-09 23:59:59')){
            $jumlah_transfer = '50000';
        } else {
            $jumlah_transfer = '70000';
        }
    }
    $jumlah_transfer = substr($jumlah_transfer, 0, (strlen($jumlah_transfer) - strlen(userinfo()->id + 1))) . userinfo()->id;
?>
    <div class="text-base-100 p-32">
        <div>
            <?php if(userinfo()->pembayaran_aktif == 0) : ?>
                <!-- <b>Belum bayar</b>
                Isi bukti pembayaran -->
                <?= form_open_multipart(base_url('/dashboard/update-pembayaran'), ['method' => 'post']) ?>
                <?= csrf_field() ?>
                    <!-- Nama Bank -->
                    <div class="form-input">
                        <label>Nama Bank</label>
                        <div>
                            <input 
                                placeholder="contoh : BRI"
                                value="<?= $nama_bank ?>"
                                type="text"
                                name="nama_bank" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nama_bank') ?? '' ?></span>
                    </div>

                    <!-- Nama Nasabah -->
                    <div class="form-input">
                        <label>Nama Nasabah</label>
                        <div>
                            <input 
                                placeholder="contoh : Fulan"
                                value="<?= $nama_nasabah ?>"
                                type="text"
                                name="nama_nasabah" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nama_nasabah') ?? '' ?></span>
                    </div>

                    <!-- Nomor Rekening -->
                    <div class="form-input">
                        <label>Nomor Rekening</label>
                        <div>
                            <input 
                                placeholder="contoh : 652311xxxx"
                                value="<?= $nomor_rekening ?>"
                                type="text"
                                name="nomor_rekening" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nomor_rekening') ?? '' ?></span>
                    </div>

                    <!-- Jumlah Transfer -->
                    <div class="form-input hidden">
                        <label>Jumlah Transfer</label>
                        <div>
                            <input 
                                placeholder="contoh : 2360000"
                                value="<?= $jumlah_transfer ?>"
                                type="text"
                                name="jumlah_transfer" readonly />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('jumlah_transfer') ?? '' ?></span>
                    </div>
                    
                    <!-- Bukti Transfer -->
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="bukti_transfer">Foto Bukti Transfer</label>
                        <div x-show="files">
                            <!-- Loop the image -->
                            <template x-for="file in files" x-if="files">
                                <div>
                                    <img :src="URL.createObjectURL(file)">
                                    <div>
                                        <span x-text="file.name"></span>
                                        <span x-text="file.size / 1000 + ' Kb'"></span>
                                    </div> 
                                </div>
                            </template>
                        </div>
                        <label for="bukti_transfer">Upload Data</label>
                        <input type="file" id="bukti_transfer" @change="files = $event.target.files" name="bukti_transfer" />
                        <input type="hidden" value="<?= userinfo()->bukti_transfer ?>" name="old_bukti_transfer" />
                        <span><?= initValidation()->getError('surat_pernyataan') ?? '' ?></span>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">submit</button>
                </form>
            <?php else :?>
                <!-- <b>Udah bayar</b> -->
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>