<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="text-base-100 max-w-600 p-32">
        <div x-data="{ data: 'ketua' }">
            <?php // form_open_multipart(base_url('/Main_Round/submit-data-diri'), ['method' => 'post'], ['onsubmit' => 'return validasi()']); ?>
            <?= form_open(base_url('/Main_Round/submit-data-diri'), 'onsubmit="return validasi()"') ?>
                <?= csrf_field() ?>

                <input type="hidden" name="partisipan_id" value="<?= $user_info->partisipan_id ?>">


                <label>A. Data Tim</label>
                <!-- Nama Tim -->
                <div class="form-input">
                    <label>Nama Tim</label>
                    <div>
                        <input 
                            value="<?= $user_info->nama_tim ?>"
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
                    <label> Nama
                        <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                            Sekolah
                        <?php else: ?>
                            Perguruan Tinggi
                        <?php endif?>
                    </label>
                    <div>
                        <input                             
                            value="<?= $user_info->pt ?>"
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
                        <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                            Sekolah
                        <?php else: ?>
                            Perguruan Tinggi
                        <?php endif?>
                    </label>
                    <div>
                        <input 
                            placeholder="contoh : Jalan Gub. Sunandar, Kec. Krian, Kab. Sidoarjo" 
                            value="<?= old('alamat_instansi') ?>"
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
                <label>B. Data Anggota</label>
                <div class="tabs tabs-boxed bg-neutral-100 mt-8">
                    <a @click="data = 'ketua'" class="tab text-base-100" :class="data == 'ketua' ? 'tab-active' : ''" x-transition>Ketua</a> 
                    <a @click="data = 'anggota_1'" class="tab text-base-100" :class="data == 'anggota_1' ? 'tab-active' : ''" x-transition>Anggota 1</a> 
                    <a @click="data = 'anggota_2'" class="tab text-base-100" :class="data == 'anggota_2' ? 'tab-active' : ''" x-transition>Anggota 2</a>
                </div>
                <ul>
                    <?php if(
                        initValidation()->getError('nama_ketua') ||
                        initValidation()->getError('nis_nim_ketua') ||
                        initValidation()->getError('ttl_ketua') ||
                        initValidation()->getError('jurusan_ketua') ||
                        initValidation()->getError('kelas_semester_ketua') ||
                        initValidation()->getError('wa_ketua') ||
                        initValidation()->getError('alamat_ketua') ||
                        initValidation()->getError('email_ketua')

                    ):?>
                    <li class="text-error text-12">Data Ketua ada yang belum benar.</li>
                    <?php endif ?>
                    <?php if(
                        initValidation()->getError('nama_1') ||
                        initValidation()->getError('nis_nim_1') ||
                        initValidation()->getError('ttl_1') ||
                        initValidation()->getError('jurusan_1') ||
                        initValidation()->getError('kelas_semester_1') ||
                        initValidation()->getError('wa_1') ||
                        initValidation()->getError('alamat_1') ||
                        initValidation()->getError('email_1')

                    ):?>
                    <li class="text-error text-12">Data Anggota 1 ada yang belum benar.</li>
                    <?php endif ?>
                    <?php if(
                        initValidation()->getError('nama_2') ||
                        initValidation()->getError('nis_nim_2') ||
                        initValidation()->getError('ttl_2') ||
                        initValidation()->getError('jurusan_2') ||
                        initValidation()->getError('kelas_semester_2') ||
                        initValidation()->getError('wa_2') ||
                        initValidation()->getError('alamat_2') ||
                        initValidation()->getError('email_2')

                    ):?>
                    <li class="text-error text-12">Data Anggota 2 ada yang belum benar.</li>
                    <?php endif ?>
                </ul>
                
                <div x-show="data == 'ketua'">
                    <!-- ketua -->
                    <div class="form-input">
                        <label>Nama</label>
                        <div>
                            <input 
                                placeholder="contoh : Fulan Wulan"
                                value="<?= $user_info->nama_ketua ?>"
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
                        <label>
                            <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                                NIS
                            <?php else: ?>
                                NIM
                            <?php endif?>
                        </label>
                        <div>
                            <input 
                                placeholder="contoh : 111111111"
                                value="<?= old('nis_nim_ketua') ?>"
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
                        <label>Tempat, Tanggal Lahir</label>
                        <div>
                            <input 
                                placeholder="contoh : Kota, 31-01-1902"
                                value="<?= old('ttl_ketua') ?>"
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
                                placeholder="contoh : <?= ($user_info->partisipan_jenis == 'AccSMA') ? 'MIPA' : 'S1 Akuntansi'?>"
                                value="<?= old('jurusan_ketua') ?>"
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
                        <label>
                        <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                            Kelas
                        <?php else: ?>
                            Semester
                        <?php endif?>
                        </label>
                        <div>
                            <input 
                                placeholder="contoh :<?= ($user_info->partisipan_jenis == 'AccSMA') ? '12' : '2'?>"
                                value="<?= old('kelas_semester_ketua') ?>"
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
                                value="<?= old('wa_ketua') ?>"
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
                                value="<?= old('alamat_ketua') ?>"
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
                                placeholder="contoh : user@gmail.com"
                                value="<?= old('email_ketua') ?>"
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
                </div>
                <div>

                <!-- anggota 1 -->
                <div x-show="data == 'anggota_1'">      
                    <div class="form-input">
                        <label>Nama</label>
                        <div>
                            <input 
                                placeholder="contoh : Fulan Wulan"
                                value="<?= $user_info->nama_1 ?>"
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
                        <label>
                        <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                            NIS
                        <?php else: ?>
                            NIM
                        <?php endif?>
                        </label>
                        <div>
                            <input 
                                placeholder="contoh : 111111111"
                                value="<?= old('nis_nim_1') ?>"
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
                        <label>Tempat, Tanggal Lahir</label>
                        <div>
                            <input 
                                placeholder="contoh : Kota, 31-01-1902"
                                value="<?= old('ttl_1') ?>"
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
                                placeholder="contoh :<?= ($user_info->partisipan_jenis == 'AccSMA') ? 'IIS' : 'D3 Pajak'?>"
                                value="<?= old('jurusan_1') ?>"
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
                        <label>
                            <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                                Kelas
                            <?php else: ?>
                                Semester
                            <?php endif?>
                        </label>
                        <div>
                            <input 
                                placeholder="contoh :<?= ($user_info->partisipan_jenis == 'AccSMA') ? '12' : '2'?>"
                                value="<?= old('kelas_semester_1') ?>"
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
                                value="<?= old('wa_1') ?>"
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
                                value="<?= old('alamat_1') ?>"
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
                                placeholder="contoh : user@gmail.com"
                                value="<?= old('email_1') ?>"
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
                </div>
                <!-- anggota 2 -->
                <div x-show="data == 'anggota_2'">
                    <div class="form-input">
                        <label>Nama</label>
                        <div>
                            <input 
                                placeholder="contoh : Fulan Wulan"
                                value="<?= $user_info->nama_2 ?>"
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
                        <label>
                        <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                            NIS
                        <?php else: ?>
                            NIM
                        <?php endif?>    
                        </label>
                        <div>
                            <input 
                                placeholder="contoh : 111111111"
                                value="<?= old('nis_nim_2') ?>"
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
                        <label>Tempat, Tanggal Lahir</label>
                        <div>
                            <input 
                                placeholder="contoh : Kota, 31-01-1902"
                                value="<?= old('ttl_2') ?>"
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
                                placeholder="contoh :<?= ($user_info->partisipan_jenis == 'AccSMA') ? 'IBB' : 'S1 Ekonomi'?>"
                                value="<?= old('jurusan_2') ?>"
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
                        <label>
                        <?php if($user_info->partisipan_jenis == 'AccSMA'):?>
                            Kelas
                        <?php else: ?>
                            Semester
                        <?php endif?>
                        </label>
                        <div>
                            <input 
                                placeholder="contoh : <?= ($user_info->partisipan_jenis == 'AccSMA') ? '12' : '2'?>"
                                value="<?= old('kelas_semester_2') ?>"
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
                                value="<?= old('wa_2') ?>"
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
                                value="<?= old('alamat_2') ?>"
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
                                placeholder="contoh : user@gmail.com"
                                value="<?= old('email_2') ?>"
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
                </div>
                <small>*) Alamat domisili adalah alamat tempat tinggal Peserta saat perlombaan berlangsung.</small><br>
                <label>C. Kondisi Peserta</label>
                <!-- === Pernyataan === -->
                <div class="flex flex-col space-y-16 mt-8">

                    <!-- 1 -->
                    <div class="card bg-neutral-100 p-16 space-y-8" x-data="{val : '<?= old('kuisioner_1') ?? '' ?>'}">
                        <p>1. Apakah Peserta dapat berkumpul saat pelaksanaan Main Round (18-23 Oktober 2021) dengan tetap mematuhi protokol kesehatan?</p>
                        <label @click="val = 'ya'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= old('kuisioner_1') == 'ya' ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_1">
                            <span @click="val = 'ya'" class="">Ya</span>
                        </label>
                        <label @click="val = 'tidak'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= (old('kuisioner_1') != 'ya' && old('kuisioner_1') != '') ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_1">
                            <span class="">Tidak</span>
                        </label>
                        <div class="form-input" x-show="val != 'ya' && val != ''">
                            <label for="">Alasan</label>
                            <div>
                                <input 
                                    :value="val"
                                    type="text"
                                    name="kuisioner_1"/>
                                <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                </i>
                            </div>
                        </div>
                        <span class="mt-4 font-light text-12 text-error"><?= initValidation()->getError('kuisioner_1') ?? '' ?></span>
                    </div>
                    <!-- 2 -->
                    <div class="card bg-neutral-100 p-16 space-y-8" x-data="{val : '<?= old('kuisioner_2') ?? '' ?>'}">
                        <p>2. Apakah Peserta bersedia mengikuti seluruh rangkaian acara National Accounting Challenge 2021?</p>
                        <label @click="val = 'ya'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= old('kuisioner_2') == 'ya' ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_2">
                            <span @click="val = 'ya'" class="">Ya</span>
                        </label>
                        <label @click="val = 'tidak'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= (old('kuisioner_2') != 'ya' && old('kuisioner_2') != '') ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_2">
                            <span class="">Tidak</span>
                        </label>
                        <div class="form-input" x-show="val != 'ya' && val != ''">
                            <label for="">Alasan</label>
                            <div>
                                <input 
                                    :value="val"
                                    type="text"
                                    name="kuisioner_2"/>
                                <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                </i>
                            </div>
                        </div>
                        <span class="mt-4 font-light text-12 text-error"><?= initValidation()->getError('kuisioner_2') ?? '' ?></span>
                    </div>
                    <!-- 3 -->
                    <div class="card bg-neutral-100 p-16 space-y-8" x-data="{val : '<?= old('kuisioner_3') ?? '' ?>'}">
                        <p>3. Apakah Peserta bersedia mematuhi peraturan dan tata tertib selama perlombaan berlangsung?</p>
                        <label @click="val = 'ya'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= old('kuisioner_3') == 'ya' ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_3">
                            <span @click="val = 'ya'" class="">Ya</span>
                        </label>
                        <label @click="val = 'tidak'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= (old('kuisioner_3') != 'ya' && old('kuisioner_3') != '') ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_3">
                            <span class="">Tidak</span>
                        </label>
                        <div class="form-input" x-show="val != 'ya' && val != ''">
                            <label for="">Alasan</label>
                            <div>
                                <input 
                                    :value="val"
                                    type="text"
                                    name="kuisioner_3"/>
                                <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                </i>
                            </div>
                        </div>
                        <span class="mt-4 font-light text-12 text-error"><?= initValidation()->getError('kuisioner_3') ?? '' ?></span>
                    </div>
                    <!-- 4 -->
                    <div class="card bg-neutral-100 p-16 space-y-8" x-data="{val : '<?= old('kuisioner_4') ?? '' ?>'}">
                        <p>4. Apakah Peserta bersedia untuk menjunjung tinggi integritas dan berkompetisi secara sehat?</p>
                        <label @click="val = 'ya'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= old('kuisioner_4') == 'ya' ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_4">
                            <span @click="val = 'ya'" class="">Ya</span>
                        </label>
                        <label @click="val = 'tidak'" class="ml-8 flex flex-row space-x-8 items-center">
                            <input <?= (old('kuisioner_4') != 'ya' && old('kuisioner_4') != '') ? 'checked' : '' ?> type="radio" class="radio radio-primary flex-shrink-0" name="input_4">
                            <span class="">Tidak</span>
                        </label>
                        <div class="form-input" x-show="val != 'ya' && val != ''">
                            <label for="">Alasan</label>
                            <div>
                                <input 
                                    :value="val"
                                    type="text"
                                    name="kuisioner_4"/>
                                <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                </i>
                            </div>
                        </div>
                        <span class="mt-4 font-light text-12 text-error"><?= initValidation()->getError('kuisioner_4') ?? '' ?></span>
                    </div>
                </div>
                <div class="card bg-neutral-100 p-16 mt-16">
                    <div class="flex flex-row justify-start items-center space-x-8">
                        <input id="konsekuensi" type="checkbox" class="checkbox checkbox-primary flex-shrink-0" onclick="check()">
                        <label for="konsekuensi" >Saya menyatakan bahwa data yang telah saya isi adalah benar dan dapat dipertanggungjawabkan.</label>
                    </div>
                    <small class="text-error" id="err-konsekuensi">
                    </small>
                </div>


                <button type="submit" class="btn btn-block btn-primary mt-24">submit</button>
            </form>
        </div>
    </div>
    <script>
        function validasi(){
            let konsekuensi = document.getElementById('konsekuensi').checked;
            if(konsekuensi){
                return true;
            } else {
                document.getElementById('err-konsekuensi').innerHTML = `Harap isi pernyataan terlebih dahulu.`;
                return false;
            }
        }
        function check(){
            document.getElementById('err-konsekuensi').innerHTML = ``;
        }
    </script>

<?= $this->endSection() ?>