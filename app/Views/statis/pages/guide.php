<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="flex flex-row text-base-100 py-48 px-96">
        <!-- List -->
        
        <div class="w-480 pr-36">
            <h2 class="font-bold text-20">Daftar Panduan</h2>
            <?php 
            // Daftar halaman guide book
            $halaman = [
                [
                    'Acc for SMA',
                    [
                        ['Booklet', 'acc-sma-booklet'],
                        ['Pendaftaran', 'acc-sma-pendaftaran'],
                        ['Timeline', 'acc-sma-timeline'],
                    ]
                ],
                [
                    'Acc for Univ',
                    [
                        ['Booklet', 'acc-univ-booklet'],
                        ['Pendaftaran', 'acc-univ-pendaftaran'],
                        ['Timeline', 'acc-univ-timeline'],
                    ]
                ],
                [
                    'Call for Paper',
                    [
                        ['Booklet', 'cfp-booklet'],
                        ['Pendaftaran', 'cfp-pendaftaran'],
                        ['Timeline', 'cfp-timeline'],
                    ]
                ],
                [
                    'Course',
                    [
                        
                    ]
                ],
                [
                    'FAQ',
                    [
                        ['FAQ', 'faq'],
                    ]
                ],
            ];
            
            ?>
            <ul x-data="{show : 

                <?php 
                    if (in_array(($_GET['halaman'] ?? ''), ['acc-sma-booklet','acc-sma-pendaftaran','acc-sma-timeline'])){
                        echo 1;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['acc-univ-booklet','acc-univ-pendaftaran','acc-univ-timeline'])) {
                        echo 2;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['cfp-booklet','cfp-pendaftaran','cfp-timeline'])) {
                        echo 3;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['course-pendaftaran'])) {
                        echo 4;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['faq'])) {
                        echo 5;
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
                                <li class="link-guide <?= ($_GET['halaman'] ?? '') == $item[1] ? 'link-guide-aktif' : '' ?>"> <a href="<?= base_url('guide?halaman='.$item[1]) ?>"><?= $item[0] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </li>
            <?php endfor ?>

            </ul>
        </div>
        <!-- Main -->
        <div class="w-full">
            <!-- Get data php sesuai parameter halaman -->

            <?php 
                echo $this->include('/statis/pages/guide/'. ($_GET['halaman'] ?? 'default'))
                
            ?>
        </div>
    </div>
    <div class="flex justify-between bg-base-100 relative">
        <img src="<?= base_url('img/guide-p-kiri.png') ?>" alt="" class="opacity-30">
        <img src="<?= base_url('img/guide-p-kanan.png') ?>" alt="" class="opacity-30">
        <div class="w-full h-full flex justify-center items-center absolute">
            <p class="text-center text-neutral-200 font-bold text-36">The Presence of Accounting in Digital Transformation of the Economy for Resilient, Sustainable, and Inclusive Recovery</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy');
    </script>
<?= $this->endSection() ?>