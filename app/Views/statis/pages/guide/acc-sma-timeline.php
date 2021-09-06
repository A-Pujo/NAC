    <!-- Timeline -->
    <h1 class="text-24 font-bold mb-16">Panduan Accounting Challenge for High School</h1>
    <span class="text-18">Timeline kegiatan Accounting Challenge for High School</span>
    <div class="flex flex-col items-center overflow-hidden">
        <div class="relative w-full flex justify-between items-center mt-24 h-112" 
            x-data="{ 
                tl : [
                {
                    judul : 'Pendaftaran gelombang 1',
                    jam : '12:00 WIB',
                    tanggal : '6-24',
                    bulan : 'Sept',
                    pos : 0,
                }, 
                {
                    judul : 'Pendaftaran gelombang 2',
                    jam : '',
                    tanggal : '25 - 7',
                    bulan : 'Sept - Okt',
                    pos : 1,
                }, 
                {
                    judul : 'Pre Eliminary Round',
                    jam : '09.00 WIB',
                    tanggal : '10',
                    bulan : 'Okt',
                    pos : 2,
                }, 
                {
                    judul : 'Main Round',
                    jam : '',
                    tanggal : '18-23',
                    bulan : 'Okt',
                    pos : 3,
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
                        '-translate-x-311 opacity-0' : item.pos < (active -1 ),
                        '-translate-x-311 opacity-50' : item.pos == (active -1),
                        '' : item.pos == active,
                        'translate-x-311 opacity-50' : item.pos == (active + 1),
                        'translate-x-311 opacity-0' : item.pos > (active +1),
                    }"
                    class="z-0 transition duration-1000 left-timeline transform top-0 absolute p-32 bg-primary-100 rounded-md flex justify-center items-center  w-300 h-112 flex items-center justify-between space-x-8">
                    <div class="text-base-100 bg-neutral-400 rounded-full h-64 w-64 text-center flex-shrink-0">
                        <p x-text="item.tanggal" class="font-bold text-20"></p>
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