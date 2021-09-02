<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <title>Dashboard</title>
</head>
<body class="antialiased min-h-screen relative lg:flex" x-data="{sidebar : false, sidebarExpand : true }">
    <!-- Sidebar -->
    <nav 
        class="bg-neutral-200 absolute inset-0 z-10 lg:relative min-h-full transform lg:transform-none inline-block transition"
        :class="
            {'-translate-x-full' : sidebar == false }
        "
        >
        <?= $this->include('dashboard/layout/sidebar') ?>
    </nav>
    <!-- End of Sidebar -->
    <div class="relative z-0 w-full flex-grow-0 bg-neutral-300 overflow-scroll"
        :class="{'hidden' : sidebar == true }"
    >
        <div class="h-163 flex justify-between items-center p-32">
            <?= $this->include('dashboard/layout/topbar') ?> 
        </div>
        <div class="">
            <?= $this->renderSection('content')?>
        </div>
        <div class="bg-gray-500">
            <?= $this->include('dashboard/layout/footer') ?>
        </div>
    </div>
</body>
</html>