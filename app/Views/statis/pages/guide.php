<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="flex flex-row text-base-100 py-48 px-96">
        <!-- List -->
        
        <div class="w-480 pr-36">
            <h2 class="font-bold text-20">Daftar Panduan</h2>
            <ul x-data="{show : 

                <?php 
                    if (in_array(($_GET['halaman'] ?? ''), ['acc-sma-pendaftaran','acc-sma-pre'])){
                        echo 1;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['acc-univ-pendaftaran','acc-univ-pre'])) {
                        echo 2;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['cfp-pendaftaran','cfp-pre'])) {
                        echo 3;
                    } elseif(in_array(($_GET['halaman'] ?? ''), ['course-pendaftaran','course-pre'])) {
                        echo 4;
                    } else {
                        echo 0;
                    }
                    
                ?>
            
            }">

            <?php 
            // Daftar halaman guide book
            $halaman = [
                [
                    'Acc for SMA',
                    [
                        ['Pendaftaran', 'acc-sma-pendaftaran'],
                        ['Pre Eleminary', 'acc-sma-pre'],
                    ]
                ],
                [
                    'Acc for Univ',
                    [
                        ['Pendaftaran', 'acc-univ-pendaftaran'],
                        ['Pre Eleminary', 'acc-univ-pre'],
                    ]
                ],
                [
                    'Call for Paper',
                    [
                        ['Latar Belakang', 'cfp-latar'],
                        ['Pendaftaran', 'cfp-pendaftaran'],
                    ]
                ],
                [
                    'Course',
                    [
                        ['Pendaftaran', 'course-pendaftaran'],
                    ]
                ],
            ];
            
            ?>

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
                                <li class="link-guide <?= ($_GET['halaman'] ?? '') == $item[1] ? 'link-guide-aktif' : '' ?>"> <a href="<?= base_url('home/guide?halaman='.$item[1]) ?>"><?= $item[0] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </li>
            <?php endfor ?>

            </ul>
        </div>
        <!-- Main -->
        <div>
            <?php 
            if(($_GET['halaman'] ?? '') == 'cfp-pendaftaran'){
                echo($this->include('statis/pages/guide-cfp-pendaftaran'));
            } else {
                echo('Halaman Sambutan');
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy');
    </script>
<?= $this->endSection() ?>