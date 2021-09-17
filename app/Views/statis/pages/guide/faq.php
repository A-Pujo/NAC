<!-- FAQ -->
<div class="flex flex-col items-center">
        <h1 class="text-36 font-bold mb-16">Frequently Asked Questions (FAQ)</h1>
        <div class="w-ful md:w-640"
            x-data="{
                faq: [
                    {
                        tanya : 'Apa syarat dan ketentuan untuk dapat mengikuti perlombaan National Accounting Challenge 2021?',
                        jawab : `
                                <p>
                                    <span>Ketentuan Umum <strong>Accounting Challenge for High School</strong></span>
                                    <ul class='list-decimal'>
                                        <li>Peserta merupakan siswa/i aktif SMA/SMK/MA/sederajat di seluruh Indonesia yang tergabung dalam sebuah tim.</li>
                                        <li>Satu tim terdiri atas 3 siswa/i yang berasal dari SMA/SMK/MA/sederajat yang sama.</li>
                                        <li>Setiap sekolah diperbolehkan untuk mengirim maksimal 3 tim.</li>
                                    </ul>
                                </p>
                                <p class='mt-16'>
                                    <span>Ketentuan Umum <strong>Accounting Challenge for University</strong></p>
                                    <ul class='list-decimal'>
                                        <li>Peserta merupakan mahasiswa/i aktif D3/D4/S1/sederajat di seluruh Indonesia yang tergabung dalam sebuah tim.</li>
                                        <li>Satu tim terdiri atas 3 mahasiswa/i yang berasal dari Perguruan Tinggi/sederajat yang sama.</li>
                                        <li>Setiap perguruan tinggi diperbolehkan untuk mengirim maksimal 5 tim.</li>
                                    </ul>
                                </p> 
                                <p class='mt-16'>
                                    <span>Ketetuan Umum <strong>NAC Call For Paper</strong></span>
                                    <ul class='list-decimal'>
                                        <li>Peserta merupakan mahasiswa aktif D3/D4/S1 perguruan tinggi di seluruh Indonesia
                                        <li>Lomba boleh diikuti secara individu atau berkelompok dengan anggota berjumlah 2-3 orang per kelompok
                                        <li>Peserta yang merupakan individu atau kelompok diperkenankan mengirim maksimal 2 abstrak dan full paper (apabila lolos seleksi abstrak)
                                    </ul>
                                </p> 
                        `,
                        id : 1
                    },
                    {
                        tanya :'Apa itu NAC 2021?',
                        jawab : `NAC 2021 merupakan kompetisi akuntansi terbesar yang diadakan oleh BEM Politeknik Keuangan Negara STAN.`,
                        id : 2,
                    },
                    {
                        tanya :'Apa saja jenis perlombaan pada NAC 2021?',
                        jawab : `
                        <span>Tahun ini ada tiga jenis perlombaan yang bisa diikuti, yaitu:</span><br>
                        <ul class='list-decimal'>
                            <li>Accounting Challenge for High School</li>
                            <li>Accounting Challeng for University</li>
                            <li>NAC Call For Paper</li>
                        </ul>
                        `,
                        id : 3,
                    },
                    {
                        tanya :'Apakah lombanya secara tim atau individu?',
                        jawab : `
                        Untuk <strong>Accounting Challenge</strong>, lombanya secara tim. Untuk <strong>Call For Paper</strong> lombanya dapat dilakukan secara individu maupun tim. 
                        `,
                        id : 4,
                    },
                    {
                        tanya :'Siapa saja yang boleh mengikuti NAC 2021? Apakah mahasiswa STAN diperbolehkan ikut?',
                        jawab : `
                            NAC 2021 terbuka untuk seluruh pelajar SMA/SMK/MA/sederajat dan mahasiswa perguruan tinggi di seluruh Indonesia. Sehingga mahasiswa dari PKN STAN juga diperbolehakan ikut.
                        `,
                        id : 5,
                    },
                    {
                        tanya :'Apakah peserta dalam satu tim harus berasal dari sekolah/perguruan tinggi yang sama?',
                        jawab : `
                            Ya, harus
                        `,
                        id : 6,
                    },
                    {
                        tanya :'Apakah satu tim diperbolehkan mengikuti dua lomba sekaligus?',
                        jawab : `
                            Ya, untuk lomba perguruan tinggi diperbolehkan mengikuti <strong>Accounting Challenge</strong> dan <strong>Call for Paper</strong> sekaligus
                        `,
                        id : 7,
                    },
                    {
                        tanya :'Kapan pendaftaran NAC 2021 dibuka?',
                        jawab : `
                            Pendaftaran telah dibuka serentak pada 6 September 2021 untuk seluruh jenis lomba.
                        `,
                        id : 8,
                    },
                    {
                        tanya :'Kapan pendaftaran NAC 2021 ditutup?',
                        jawab : `
                            Pendaftaran <strong>Accounting Challenge</strong> akan ditutup pada 7 Oktober 2021 sedangkan pendaftaran <strong>Call For Paper</strong> akan ditutup pada tanggal 20 September 2021.
                        `,
                        id : 9,
                    },
                    {
                        tanya :'Pendaftaran NAC 2021 dilakukan melalui apa?',
                        jawab : `
                            Pendaftaran NAC 2021 dilakukan melalui website <a href='https://nacstan.com' class='link link-primary'>nacstan.com</a>
                        `,
                        id : 10,
                    },
                    {
                        tanya :'Dimana peserta bisa mengakses booklet perlombaan?',
                        jawab : `
                            Booklet dapat diakses melalui <a href='https://nacstan.com' class='link link-primary'>nacstan.com</a>
                        `,
                        id : 11,
                    },
                    {
                        tanya :'Berapa biaya pendaftaran NAC 2021?',
                        jawab : `
                            <p>
                                <strong>Accounting Challenge for High School</strong>
                                <ul class='list-decimal'>
                                    <li>Gelombang 1(6-24 Sept 2021): 80.000</li>
                                    <li>Gelombang 2 (25 Sept-7 Okt 2021): 90.000</li>
                                </ul>
                            </p>
                            <p class='mt-16'>
                                <strong>Accounting Challenge for University</strong>
                                <ul class='list-decimal'>
                                    <li>Gelombang 1 (6-24 Sept 2021): 110.000</li>
                                    <li>Gelombang 2 (25 Sept-7 Okt 2021): 120.000</li>
                                </ul>
                            </p> 
                            <p class='mt-16'>
                                <strong>NAC Call For Paper</strong>
                                <ul class='list-decimal'>
                                    <li>Pengumpulan abstrak Call for Paper tidak dikenai biaya (Gratis)</li>
                                </ul>
                            </p>
                        `,
                        id : 12,
                    },
                    {
                        tanya :'Apa saja benefit yang didapatkan dengan mengikuti lomba NAC 2021?',
                        jawab : `
                        <ul class='list-decimal'>
                            <li><i>E-certificate</i> untuk seluruh peserta.</li>
                            <li>Rangkaian webinar dengan narasumber yang ahli di bidangnya.</li>
                            <li>Total hadiah mencapai puluhan juta rupiah.</li>
                        </ul>
                        `,
                        id : 13,
                    },
                    ],
                active : 0,
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
        <div>
 
        </div>
    </div>