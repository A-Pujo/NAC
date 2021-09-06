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