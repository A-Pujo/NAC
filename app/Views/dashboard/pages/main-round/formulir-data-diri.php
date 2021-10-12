<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="text-base-100 max-w-600 p-32">
        <div>
            <?= form_open_multipart(base_url('/main-round/submit-data-diri'), ['method' => 'post']) ?>
                <?= csrf_field() ?>

                <input type="hidden" name="partisipan_id" value="<?= userinfo()->partisipan_id ?>">
            
                <!-- Nama Tim -->
                <div class="form-input">
                    <label>A. Nama Tim</label>
                    <div>
                        <input 
                            placeholder="contoh : Elang"
                            value="<?= userinfo()->nama_tim ?>"
                            type="text"
                            name="nama_tim"
                            readonly />
                        <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('nama_tim') ?? '' ?></span>
                </div>

                <!-- nama instansi -->
                <div class="form-input">
                    <label>B. Data Sekolah/Perguruan Tinggi</label>
                    <label> Nama
                        <?php if(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccSMA'):?>
                            Sekolah
                        <?php else: ?>
                            Perguruan Tinggi
                        <?php endif?>
                    </label>
                    <div>
                        <input 
                            
                            <?php if(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccSMA'):?>
                                placeholder="contoh : SMAN 1 Muara Karang"
                            <?php else: ?>
                                placeholder="contoh : Politeknik Keuangan Negara STAN"
                            <?php endif?>
                            
                            value="<?= userinfo()->pt ?>"
                            type="text"
                            name="instansi"
                            readonly />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('instansi') ?? '' ?></span>
                </div>

                <!-- alamat instansi -->
                <div class="form-input">
                    <label> Alamat
                        <?php if(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccSMA'):?>
                            Sekolah
                        <?php else: ?>
                            Perguruan Tinggi
                        <?php endif?>
                    </label>
                    <div>
                        <input 
                            placeholder="contoh : Jalan Gub. Sunandar, Kec. Krian, Kab. Sidoarjo" 
                            value=""
                            type="text"
                            name="alamat_instansi" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('alamat_instansi') ?? '' ?></span>
                </div>

                <!-- data peserta -->
                <!-- ketua -->
                <div class="form-input">
                    <label>C. Data Peserta</label>
                    <label>Ketua Tim</label>
                    <label>Nama</label>
                    <div>
                        <input 
                            placeholder="contoh : Fulan Wulan"
                            value="<?= userinfo()->nama_ketua ?>"
                            type="text"
                            name="nama_ketua" 
                            readonly />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('nama_ketua') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>NIS/NIM</label>
                    <div>
                        <input 
                            placeholder="contoh : 111111111"
                            value=""
                            type="text"
                            name="nis_nim_ketua" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('nis_nim_ketua') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>TTL</label>
                    <div>
                        <input 
                            placeholder="contoh : Kota, 31-01-1902"
                            value=""
                            type="text"
                            name="ttl_ketua" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('ttl_ketua') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Jurusan</label>
                    <div>
                        <input 
                            placeholder="contoh : S3 Akupuntur"
                            value=""
                            type="text"
                            name="jurusan_ketua" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('jurusan_ketua') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Kelas/Semester</label>
                    <div>
                        <input 
                            placeholder="contoh : 3"
                            value=""
                            type="text"
                            name="kelas_semester_ketua" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('kelas_semester_ketua') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>No. HP (WA)</label>
                    <div>
                        <input 
                            placeholder="contoh : 089999xxxxxx"
                            value=""
                            type="text"
                            name="wa_ketua" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('wa_ketua') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Alamat Domisili*</label>
                    <div>
                        <input 
                            placeholder="contoh : Gg Setia Kel. Pondok Aren, Tangerang Selatan"
                            value=""
                            type="text"
                            name="alamat_ketua" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('alamat_ketua') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>E-mail</label>
                    <div>
                        <input 
                            placeholder="contoh : hayo@test.mail"
                            value=""
                            type="text"
                            name="email_ketua" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('email_ketua') ?? '' ?></span>
                </div>
                        
                <!-- anggota 1 -->
                <div class="form-input">
                    <label>Anggota 1</label>
                    <label>Nama</label>
                    <div>
                        <input 
                            placeholder="contoh : Fulan Wulan"
                            value="<?= userinfo()->nama_1 ?>"
                            type="text"
                            name="nama_1" 
                            readonly
                            />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('nama_1') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>NIS/NIM</label>
                    <div>
                        <input 
                            placeholder="contoh : 111111111"
                            value=""
                            type="text"
                            name="nis_nim_1" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('nis_nim_1') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>TTL</label>
                    <div>
                        <input 
                            placeholder="contoh : Kota, 31-01-1902"
                            value=""
                            type="text"
                            name="ttl_1" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('ttl_1') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Jurusan</label>
                    <div>
                        <input 
                            placeholder="contoh : S3 Akupuntur"
                            value=""
                            type="text"
                            name="jurusan_1" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('jurusan_1') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Kelas/Semester</label>
                    <div>
                        <input 
                            placeholder="contoh : 3"
                            value=""
                            type="text"
                            name="kelas_semester_1" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('kelas_semester_1') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>No. HP (WA)</label>
                    <div>
                        <input 
                            placeholder="contoh : 089999xxxxxx"
                            value=""
                            type="text"
                            name="wa_1" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('wa_1') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Alamat Domisili*</label>
                    <div>
                        <input 
                            placeholder="contoh : Gg Setia Kel. Pondok Aren, Tangerang Selatan"
                            value=""
                            type="text"
                            name="alamat_1" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('alamat_1') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>E-mail</label>
                    <div>
                        <input 
                            placeholder="contoh : hayo@test.mail"
                            value=""
                            type="text"
                            name="email_1" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('email_1') ?? '' ?></span>
                </div>

                <!-- anggota 2 -->
                <div class="form-input">
                    <label>Anggota 2</label>
                    <label>Nama</label>
                    <div>
                        <input 
                            placeholder="contoh : Fulan Wulan"
                            value="<?= userinfo()->nama_2 ?>"
                            type="text"
                            name="nama_2" 
                            readonly
                            />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('nama_2') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>NIS/NIM</label>
                    <div>
                        <input 
                            placeholder="contoh : 111111111"
                            value=""
                            type="text"
                            name="nis_nim_2" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('nis_nim_2') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>TTL</label>
                    <div>
                        <input 
                            placeholder="contoh : Kota, 31-01-1902"
                            value=""
                            type="text"
                            name="ttl_2" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('ttl_2') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Jurusan</label>
                    <div>
                        <input 
                            placeholder="contoh : S3 Akupuntur"
                            value=""
                            type="text"
                            name="jurusan_2" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('jurusan_2') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Kelas/Semester</label>
                    <div>
                        <input 
                            placeholder="contoh : 3"
                            value=""
                            type="text"
                            name="kelas_semester_2" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('kelas_semester_2') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>No. HP (WA)</label>
                    <div>
                        <input 
                            placeholder="contoh : 089999xxxxxx"
                            value=""
                            type="text"
                            name="wa_2" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('wa_2') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>Alamat Domisili*</label>
                    <div>
                        <input 
                            placeholder="contoh : Gg Setia Kel. Pondok Aren, Tangerang Selatan"
                            value=""
                            type="text"
                            name="alamat_2" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('alamat_2') ?? '' ?></span>
                </div>

                <div class="form-input">
                    <label>E-mail</label>
                    <div>
                        <input 
                            placeholder="contoh : hayo@test.mail"
                            value=""
                            type="text"
                            name="email_2" />
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </div>
                    <span><?= initValidation()->getError('email_2') ?? '' ?></span>
                </div>

                <small>*) Alamat domisili adalah alamat tempat tinggal Peserta saat perlombaan berlangsung.</small>

                <button type="submit" class="btn btn-block btn-primary">submit</button>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>