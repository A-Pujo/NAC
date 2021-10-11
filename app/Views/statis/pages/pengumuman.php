<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="flex flex-row text-base-100 py-48 px-32 lg:px-96 relative lg:space-x-36" x-data="{menu : false}">
        <!-- List -->
        
        <div
            :class="{

                'block' : menu == true,
                'lg:block hidden' : menu == false
            }"
            class="w-full h-full overflow-y-auto sm:w-480 bg-neutral-200 lg:bg-neutral-300 z-10 p-32 lg:p-0 lg:relative absolute top-0 right-0">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-20">Daftar Pengumuman</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer lg:hidden" viewBox="0 0 20 20" fill="currentColor"
                    @click="menu = false"
                >
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <?php 
            // Daftar halaman guide book
            $halaman = [
                [
                    'Acc for SMA',
                    [
                        ['Preliminary', 'acc-sma-pre-peng'],
                    ]
                ],
                [
                    'Acc for Univ',
                    [
                        ['Preliminary', 'acc-univ-pre-peng'],
                    ]
                ],
                [
                    'CFP',
                    [

                    ]
                ],
            ];
            ?>
            <ul x-data="{show : 

                <?php 
                    if (in_array(($_GET['halaman'] ?? ''), ['acc-sma-pre-peng'])){
                        echo 1;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['acc-univ-pre-peng'])) {
                        echo 2;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['cfp-paper'])) {
                        echo 3;
                        
                    } else {
                        echo 0;
                    }
                    
                ?>
            
            }">

            <?php for($i = 0 ; $i < count($halaman); $i++) :?>
                <li>
                    <div class="link-guide-dropdown" @click="show = <?= $i+1 ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="h-5 w-5 transform"
                            :class="{'rotate-90' : show == <?= $i+1 ?>}"                    
                            x-transition
                            >
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span><?= $halaman[$i][0] ?></span>
                    </div>
                    <div class="ml-24" x-show="show == <?= $i+1 ?>" x-transition>
                        <ul class="">
                            <?php foreach($halaman[$i][1] as $item) : ?>
                                <li class="link-guide <?= ($_GET['halaman'] ?? '') == $item[1] ? 'link-guide-aktif' : '' ?>"> <a href="<?= base_url('pengumuman?halaman='.$item[1]) ?>"><?= $item[0] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </li>
            <?php endfor ?>

            </ul>
        </div>
        <!-- Main -->
        <div class="w-full min-h-300 h:min-h-0">
            <button 
                @click="menu = true"
                class="btn btn-sm btn-primary lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
                <span>Daftar Pengumuman</span>
            </button>
            <!-- Get data php sesuai parameter halaman -->
            <?php if(sekarang() < tanggal($_GET['halaman'] ?? '')) : ?>
                Halaman pengumuman ini baru akan tersedia dalam 
                <a href="<?= base_url('pengumuman?halaman='. $_GET['halaman']) ?>" id="time" class="btn btn-primary btn-xs"></a href="">
            <?php else : ?>
                <?php echo $this->include('/statis/pages/pengumuman/'. ($_GET['halaman'] ?? 'default')) ?>
            <?php endif ?>
        </div>
    </div>
    <div class="flex justify-between bg-base-100 relative">
        <img src="<?= base_url('img/guide-p-kiri.png') ?>" alt="" class="opacity-30 h-80 sm:h-96 lg:h-144">
        <img src="<?= base_url('img/guide-p-kanan.png') ?>" alt="" class="opacity-30 h-80 sm:h-96 lg:h-144">
        <div class="w-full h-full flex justify-center items-center absolute">
            <p class="text-center text-neutral-200 font-bold text-18 md:text-24 lg:text-36">The Presence of Accounting in Digital Transformation of the Economy for Resilient, Sustainable, and Inclusive Recovery</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy');
        // Set target : bulan 0-11
let countDownDate = new Date('<?= tanggal($_GET['halaman'] ?? '') ?>').getTime();
// Adjustment time
let serverTime = <?= time()*1000 ?>;
let now = new Date().getTime();
let diff = serverTime - now;


// Update the count down every 1 second
let x = setInterval(function() {

  // Get today's date and time
  let now = new Date().getTime() + diff;
  
    
  // Find the distance between now and the count down date
  let distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="time"
  document.getElementById("time").innerHTML = days + "hari " + hours + "jam "
  + minutes + "menit " + seconds + "detik ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "Reload Halaman ini";
  }
}, 1000);
    </script>
<?= $this->endSection() ?>