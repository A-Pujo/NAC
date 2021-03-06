<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<div class="p-32 max-w-600 text-base-100">
    <!-- <?php print_r(initValidation()->getErrors()) ?> -->

    <?= form_open_multipart(base_url('kursus/registrasi'), ['method' => 'post']) ?>
    
                    <!-- Nama Peserta -->
                    <div class="form-input">
                        <label>Nama Peserta</label>
                        <div>
                            <input 
                            placeholder="contoh : Fulan"
                            value="<?= old('nama_peserta') ?? $peserta->nama_peserta ?? '' ?>"
                                type="text"
                                name="nama_peserta" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nama_peserta') ?? '' ?></span>
                    </div>
                    <!-- Nama Sekolah -->
                    <div class="form-input">
                        <label>Nama Sekolah</label>
                        <div>
                            <input 
                            placeholder="contoh : MAN 1 Samudra"
                                value="<?= old('nama_sekolah') ?? $peserta->nama_sekolah ?? '' ?>"
                                type="text"
                                name="nama_sekolah" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nama_sekolah') ?? '' ?></span>
                    </div>
                    <!-- WA -->
                    <div class="form-input">
                        <label>WA</label>
                        <div>
                            <input 
                            placeholder="contoh : 0888XXX"
                                value="<?= old('wa') ?? $peserta->wa ?? '' ?>"
                                type="text"
                                name="wa" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('wa') ?? '' ?></span>
                    </div>
                    <!-- Kartu Pelajar / NISN -->
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="kp">Foto Kartu Pelajar / NISN</label>
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
                        <label for="kp">Upload Data</label>

                        <input type="file" id="kp" name="kartu_pelajar" @change="files = $event.target.files">
                        <input type="hidden" name="old_kartu_pelajar" value="<?=(! empty($peserta->kartu_pelajar)) ? $peserta->kartu_pelajar : '' ?>">

                        <span><?= initValidation()->getError('kartu_pelajar') ?? '' ?></span>

                        <small>Foto Kartu Pelajar / Kartu NISN berupa gambar dengan format jpg, jpeg atau png</small>
                        <small>Ukuran maksimal file sebesar 500 Kb</small>
                        <small>Anda diperkenankan untuk memilih antara Kartu Pelajar atau Kartu NISN</small>
                    </div>
                    <!-- Twibbon -->
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="kt">Foto Twibbon</label>
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
                        <label for="kt">Upload Data</label>

                        <input type="file" id="kt" name="twibbon_kursus" @change="files = $event.target.files">
                        <input type="hidden" name="old_twibbon_kursus" value="<?=(! empty($peserta->twibbon_kursus)) ? $peserta->twibbon_kursus : '' ?>">

                        <span><?= initValidation()->getError('twibbon_kursus') ?? '' ?></span>

                        <small>Foto twibbon berupa gambar dengan format jpg, jpeg atau png</small>
                        <small>Ukuran maksimal file sebesar 500 Kb</small>
                    </div>
        <input type="submit" value="submit" class="btn btn-block btn-primary">
    </form>
</div>
    <?= $this->endSection() ;?>