<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="p-24 text-base-100" x-data="{instansi : '<?= old('is_stan') ?>'}">
        <?= form_open('webinar/pendaftaran') ?>
        <!-- Nama -->
        <div class="form-input">
            <label>Nama</label>
            <div>
                <input 
                    placeholder="contoh : Kevin"
                    value="<?= old('nama')?>"
                    type="text"
                    name="nama" />
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                </i>
            </div>
            <span><?= initValidation()->getError('nama') ?? '' ?></span>
        </div>
        <!-- WA -->
        <div class="form-input">
            <label>Whatsapp</label>
            <div>
                <input 
                    placeholder="contoh : 0888xxxxxxxx"
                    value="<?= old('wa')?>"
                    type="text"
                    name="wa" />
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                </i>
            </div>
            <span><?= initValidation()->getError('wa') ?? '' ?></span>
        </div>
        <!-- JS VIEW STAN NON STAN -->
        <div class="relative ml-8" x-data="{ dropdown: false }">
            <a class="btn btn-primary btn-sm "  @click="dropdown = !dropdown">Pilih Instansi</a><br>
            <small class="text-error"><?= initValidation()->getError('is_stan') ?? '' ?></small>
            <div x-show="dropdown" class="absolute left-0 top-48 bg-neutral-200 border border-neutral-60 hover:border-primary-100 rounded-md p-8 text-base-100 text-12 z-50">
                <ul class="divide-y divide-primary-100 max-h-300 overflow-auto">
                    <li class="cursor-pointer p-8" @click="instansi = 'stan', dropdown = false">Mahasiswa PKN STAN</li>
                    <li class="cursor-pointer p-8" @click="instansi = 'non', dropdown = false">Umum</li>
                </ul>
            </div>
        </div>
        <!-- Instansi -->
        <input type="hidden" name="is_stan" :value="instansi">
        <div class="form-input" x-show="instansi == 'non'">
            <label>Instansi</label>
            <div>
                <input 
                    placeholder="contoh : Kevin"
                    value="<?= old('instansi')?>"
                    type="text"
                    name="instansi" />
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                </i>
            </div>
            <span><?= initValidation()->getError('instansi') ?? '' ?></span>
        </div>
        <!-- NPM -->
        <div class="form-input" x-show="instansi == 'stan'">
            <label>NPM</label>
            <div>
                <input 
                    placeholder="contoh : Kevin"
                    value="<?= old('npm')?>"
                    type="text"
                    name="npm" />
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                </i>
            </div>
            <span><?= initValidation()->getError('npm') ?? '' ?></span>
        </div>
        <!-- Prodi -->
        <!-- <div class="form-input" x-show="instansi == 'stan'">
            <label>Progam Studi</label>
            <div>
                <input 
                    placeholder="contoh : Kevin"
                    value="<?= old('prodi')?>"
                    type="text"
                    name="prodi" />
                <i>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                </i>
            </div>
            <span><?= initValidation()->getError('prodi') ?? '' ?></span>
        </div> -->
        <!-- Provinsi -->
        <?php
            $prodis = [
                'DIII AKUNTANSI',
                'DIII PAJAK',
                'DIII PBB/PENILAI',
                'DIII KEPABEANAN DAN CUKAI',
                'DIII KEBENDAHARAAN NEGARA',
                'DIII MANAJEMEN ASET',
                'DIII AKUNTANSI AP',
                'DIII PAJAK AP',
                'DIII PBB/PENILAI AP',
                'DIII KEPABEANAN DAN CUKAI AP',
                'DIII KEBENDAHARAAN NEGARA AP',
                'DIII AKUNTANSI AP (NON AKUNTANSI)',
                'DIV AKUNTANSI SEKTOR PUBLIK',
                'DIV MANAJEMEN KEUANGAN NEGARA',
                'DIV MANAJEMEN ASET PUBLIK',
                'DIV AKUNTANSI SEKTOR PUBLIK AP',
                'DIV MANAJEMEN KEUANGAN NEGARA AP',
            ]
        ?>
        <div  x-show="instansi == 'stan'" class="form-select" x-data="{prodi : '<?= old('prodi') ?>', dropdown: false}">
            <label>Pilih prodi</label>
            <div
                @click="dropdown = !dropdown"
                >
                <span x-text="prodi == '' ? 'Pilih Program Studi' : prodi"></span>
                <i class="">
                    <svg
                    class="transition transform h-18"
                    :class="{'rotate-0': !dropdown,'rotate-180': dropdown}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
                </i>
            </div>
            <div x-show="dropdown" @click.outside="dropdown = false">
                <ul>
                    <?php foreach($prodis as $p) : ?>
                    <li @click="prodi = '<?= $p ?>', dropdown = false"><?= $p ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- <div class="border border-neutral-60 hover:border-primary-100 rounded-md p-8 text-base-100 text-12 mt-8">
                <ul class="divide-y divide-primary-100 max-h-300 overflow-auto">
                    <?php foreach($prodis as $p) : ?>
                    <li @click="prodi = '<?= $p ?>'" class="cursor-pointer p-8"><?= $p ?></li>
                    <?php endforeach; ?>
                </ul>
            </div> -->
            <span><?= initValidation()->getError('prodi') ?? '' ?></span>
            <!-- Input data -->
            <select name="prodi">
                <option x-text="prodi"></option>
            </select>
        </div>

        <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-sm m-8">
        <?= form_close() ?>
    </div>
<?= $this->endSection() ?>