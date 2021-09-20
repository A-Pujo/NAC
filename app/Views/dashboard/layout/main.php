<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('img/logo.png')?>" type="image/x-icon">
    <title>Dashboard</title>
</head>
<body style="font-family : Raleway" class="antialiased min-h-screen static lg:flex" x-data="{sidebar : false, sidebarExpand : true, imgShow : false, imgSrc: '', imgTitle:'' }">
    <!-- Show Image -->
    <div x-show="imgShow" x-transition class="fixed top-0 bg-neutral-400 bg-opacity-75 w-full h-full flex justify-center items-center z-10 ">
        <div class="relative" @click.outside="imgShow = false">
            <h2 class="absolute text-center left-0 top-0 w-full -top-32 text-16 font-bold text-base-100" x-text="imgTitle"></h2>
            <img :src="imgSrc" class="rounded-md overflow-hidden bg-base-100 max-w-1/2 max-h-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-primary-100 absolute -top-32 -right-32 cursor-pointer " viewBox="0 0 20 20" fill="currentColor"
            @click="imgShow = false"
            >
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    <!-- Sidebar -->
    <nav 
        class="bg-neutral-200 absolute inset-0 z-0 lg:relative min-h-full transform lg:transform-none inline-block transition"
        :class="
            {'-translate-x-full' : sidebar == false }
        "
        >
        <?= $this->include('dashboard/layout/sidebar') ?>
    </nav>
    <!-- End of Sidebar -->
    <div class="relative z-0 w-full bg-neutral-300 overflow-hidden"
        :class="{'hidden' : sidebar == true }"
    >
        <div class="">
            <?= $this->include('dashboard/layout/topbar') ?> 
        </div>
        <div class="">
            <?= $this->renderSection('content')?>
        </div>
        <div class="">
            <?= $this->include('statis/layout/footer') ?>
        </div>
    </div>
</body>
</html>