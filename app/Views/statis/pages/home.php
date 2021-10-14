<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>


    <!-- == NOTIFICATION == -->
    <div class="flex space-y-16 flex-col p-24 sticky top-8 z-50">
        <div class="alert alert-info" x-data="{active: true}" x-show="active">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                </svg> 
                <label>Batas waktu pengumpulan Full Paper untuk perlombaan Call for Paper pada hari Kamis, 16 Oktober pukul 23:59 WIB</label>
            </div>
            <svg
                @click="active = false"
                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="alert alert-info" x-data="{active: true}" x-show="active">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                </svg> 
                <label>Hasil pelaksanaan NAC Accounting Course dapat dilihat di <a class="btn btn-xs btn-primary" href="<?= base_url('kursus') ?>">Dashboard</a> akun masing-masing peserta</label>
            </div>
            <svg
                @click="active = false"
                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
        <!-- FLash Data -->
        <?= $this->include('component/pesan') ?>
    </div>
    <!-- == END NOTIFICATION == -->


    

    <!-- Hero -->
    <div class="flex flex-col items-center pt-120 mx-auto  text-base-100
        px-32 w-full
        sm:px-0 sm:w-554
        ">
        <h1 class="text-36 font-black tracking-6.5 m-8 text-center">NATIONAL ACCOUNTING CHALLENGE</h1>
        <h2 class="text-18 tracking-30 font-light">POLITEKNIK KEUANGAN NEGARA STAN</h2>
        <p class="text-16 my-16 text-center">NAC 2021 merupakan kompetisi akuntansi terbesar yang diadakan oleh BEM Politeknik Keuangan Negara STAN. Acara ini melibatkan siswa/i SMA/SMK/MA/sederajat, mahasiswa/i PKN STAN serta mahasiswa/i perguruan tinggi di seluruh Indonesia. Total hadiah yang diperebutkan mencapai puluhan juta rupiah. Jangan lewatkan kesempatan ini dan jadilah juara!</p>
        <div>
            <a href="<?= base_url('dashboard/pendaftaran_index') ?>" class="btn btn-primary mr-24">Daftar</a>
            <a href="<?= base_url('guide?halaman=acc-sma-booklet') ?>" class="btn btn-primary btn-outline">Booklet</a>
        </div>
    </div>
    <!-- Image -->
    <div class="mt-96 flex justify-center">
        <div class="relative 
            h-370 
            sm:w-560 w-370
            ">
            <figure class="rounded-lg overflow-hidden">
                <img src="<?= base_url('img/home-1.jpg') ?>" alt=""> 
            </figure>
            <div class="absolute -bottom-16 text-center w-full">
                <div class="px-32 py-16 text-base-100 font-bold rounded-md text-24 bg-neutral-100 shadow-sm inline">
                    Get Ready to Transform
                </div>
            </div>
        </div>
    </div>
    <!-- Thema -->
    <h2 class="text-center font-bold text-base-100 text-36 mt-96">
        The Presence of Accountant in Digital Transformation of the Economy for Resilient, Sustainable, dan Inclusive Recovery
    </h2>
    <!-- Lomba -->
    <div class="flex justify-center mt-96">
        <div class=" text-base-100 grid grid-cols-1 sm:grid-cols-2 justify-items-center w-full sm:w-590 gap-x-16 gap-y-24 px-24">
            <div class="col-span-1 sm:col-span-2 text-center">
                <h2 class="font-extrabold text-base-80 text-24">Siapa yang bisa ikut?</h2>
                <span class="font-light text-14 text-base-500">Semua bisa ikut asal</span>
            </div>
            <div class="bg-neutral-100 rounded-md shadow-sm p-24 text-center">
                <h2 class="font-bold text-18">SMA </h2>
                <p class="text-16">Terbuka untuk seluruh siswa/i SMA/SMK/MA/sederajat di seluruh Indonesia.</p>
            </div>
            <div class="bg-neutral-100 rounded-md shadow-sm p-24 text-center">
                <h2 class="font-bold text-18">Perguruan Tinggi </h2>
                <p class="text-16">Terbuka untuk seluruh mahasiswa/i DIII/DIV/S1 perguruan tinggi di seluruh Indonesia.</p>
            </div>
        </div>
    </div>
    <!-- Timeline -->
    <div class="mt-96 flex flex-col items-center overflow-hidden">
        <h2 class="text-base-100 font-extrabold text-24 text-center">Time Line Event</h2>
        <div class="text-base-500 text-center">
            <span class="text-16">Timeline utama acara NAC 2021</span>
            <br><span class="text-14 text-base-100">untuk timeline tiap kegiatan, silakan kunjungi <a href="<?= base_url('guide') ?>" class="btn btn-xs btn-primary">panduan</a></span>
            <!-- <button class="btn btn-primary text-14">Lihat Kalender</button> -->
        </div>
        <div class="relative w-full flex justify-between items-center mt-24 h-112 max-w-1000" 
            x-data="{ 
                tl : [
                {
                    judul : 'Opening Pendaftaran Lomba',
                    jam : '12:00 WIB',
                    tanggal : '6',
                    bulan : 'Sept',
                    pos : 0,
                }, 
                {
                    judul : 'Opening Puncak Acara',
                    jam : '',
                    tanggal : '17',
                    bulan : 'Okt',
                    pos : 1,
                }, 
                {
                    judul : 'Awarding dan Closing',
                    jam : '',
                    tanggal : '24',
                    bulan : 'Okt',
                    pos : 2,
                }, 
                ],
                active : 0
            }"
            >
            <button 
                :class="{
                    'btn-disabled' : (active == 0),
                    'btn-primary' : (active != 0),
                }"
                class="btn btn-ghost z-10" @click=" active -= 1"
            >
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none" opacity=".87"/><path d="M17.51 3.87L15.73 2.1 5.84 12l9.9 9.9 1.77-1.77L9.38 12l8.13-8.13z"/></svg>
            </button>
            <button  
                :class="{
                    'btn-disabled' : (active == tl.length - 1),
                    'btn-primary' : (active != tl.length - 1),
                }"
                class="btn z-10 btn-ghost" @click=" active += 1">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><polygon points="6.23,20.23 8,22 18,12 8,2 6.23,3.77 14.46,12"/></g></svg>
            </button>
            <template x-for="item in tl">
                <div 
                    :class="{ 
                        '-translate-x-311 scale-75 opacity-0' : item.pos < (active -1 ),
                        '-translate-x-311 scale-75 opacity-50' : item.pos == (active -1),
                        '' : item.pos == active,
                        'translate-x-311 scale-75 opacity-50' : item.pos == (active + 1),
                        'translate-x-311 scale-75 opacity-0' : item.pos > (active +1),
                    }"
                    class="z-0 transition duration-1000 left-timeline transform top-0 absolute p-32 bg-primary-100 rounded-md flex justify-center items-center  w-300 h-112 flex items-center justify-between space-x-8">
                    <div class="text-base-100 bg-neutral-400 rounded-full h-64 w-64 text-center flex-shrink-0">
                        <p x-text="item.tanggal" class="font-bold text-24"></p>
                        <p x-text="item.bulan" class="text-10"></p>
                    </div>
                    <div class="text-neutral-100">
                        <h3 class="font-bold text-16" x-text="item.judul"></h3>
                        <span x-text="item.jam"></span>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- FAQ -->
    <div class="mt-96 flex flex-col items-center px-16">
        <h2 class="text-base-100 font-extrabold text-24">FAQ</h2>
        <p class="text-base-500 text-16 mt-4 mb-8">Frequented Asked Question</p>
        <br><span class="text-14 text-base-100">untuk faq yang lebih lengkap, silakan kunjungi <a href="<?= base_url('guide?halaman=faq') ?>" class="btn btn-xs btn-primary">panduan</a></span>
        <div class="w-ful md:w-640"
            x-data="{
                faq: [
                    {
                        tanya : 'Kapan pelaksanaan rangkaian acara National Accounting Challenge 2021?',
                        jawab : 'Rangkaian acara National Accounting Challenge 2021 akan dibuka dengan opening ceremony pada tanggal 17 Oktober 2021 dan ditutup dengan closing ceremony dan awarding night pada tanggal 24 Oktober 2021.',
                        id : 1
                    },
                    {
                        tanya : 'Apa saja perlombaan yang diselenggarakan dalam National Accounting Challenge 2021?',
                        jawab : `Tahun ini National Accounting Challenge 2021 menyelenggarakan tiga jenis perlombaan, yaitu Accounting Challenge for High School, Accounting Challenge for University, dan <a href='<?= base_url('/guide') ?>'>NAC Call For Paper</a>.`,
                        id : 2
                    },
                    ],
                active : 1,
            }"
        >
        <template x-for="i in faq">
            <div class="h-auto">
                <div 
                    class="text-base-100 flex justify-between items-start py-24 px-32 rounded-md border-2 border-neutral-80 cursor-pointer mt-32"
                    @click="active = i.id"
                    >
                    <h3 class="font-bold text-18" x-text="i.tanya"></h3>
                    <span 
                        :class="{
                            'rotate-0' : active != i.id,
                            'rotate-180' : active != i.id
                        }"
                        class="transform transition bg-primary-200 p-4 rounded-full"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
                    </span>
                </div>
                <div 
                    :class="{
                        'h-0 pt-0' : active != i.id,
                        'h-auto  pt-32' : active == i.id
                    }"
                    class="text-base-100 px-24 transition-collapse transform overflow-hidden" 
                    x-html="i.jawab"
                ></div>
            </div>
        </template>
        </div>
    </div>
    <!-- Pattern -->
    <div class="mt-96 flex justify-center pb-96">
        <img src="<?= base_url('img/pattern-1.png') ?>" alt="" srcset="">
        <img src="<?= base_url('img/pattern-1.png') ?>" alt="" srcset="" class="hidden lg:inline-block">
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    <?php if(session()->has('sudah_akses')) : ?>
        swal("Ups!", "<?= session()->get('sudah_akses') ?>", "error");
    <?php endif; ?>
</script>
<?= $this->endSection() ?>
