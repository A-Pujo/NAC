<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php
    $pages = [
        'default' => 'Pilih Halaman',
        'pertanyaan-1' => 'Pertanyaan Webinar #1',
        'pertanyaan-2' => 'Pertanyaan Webinar #2',
        'pertanyaan-3' => 'Pertanyaan Webinar #3',
    ];
    $pages_key = array_keys($pages);
?>

    <div class="p-32 grid grid-cols-12 gap-24 text-base-100">
      <div class="col-span-12">
        <div class="form-select" x-data="{menu : '<?= $pages[$_GET['page'] ?? 'default'] ?>', dropdown: false}">
            <label>Pilih Data</label>
            <div
                @click="dropdown = !dropdown"
                >
                <span x-text="menu"></span>
                <i class="">
                    <svg
                    class="transition transform h-18"
                    :class="{'rotate-0': !dropdown,'rotate-180': dropdown}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
                </i>
            </div>
            <div x-show="dropdown" @click.outside="dropdown = false">
                <ul>
                    <?php $i = 0; foreach($pages as $page) : $i++?>
                        <li><a href="<?= base_url('dashboard/acara-webinar?page='.$pages_key[$i - 1]) ?>"><?= $page ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
      </div>
      <div class="col-span-12">
          <?php 
                if(($_GET['page'] ?? false) && str_contains($_GET['page'], 'pertanyaan')){
                    echo $this->include('dashboard/pages/acara/webinar/pertanyaan');
                } elseif(($_GET['page'] ?? false)) {
                    echo $this->include('dashboard/pages/acara/webinar/'.$_GET['page']);
                }
            ?>
      </div>
    </div>
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>