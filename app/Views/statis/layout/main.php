<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css')?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="shortcut icon" href="<?= base_url('img/logo.png')?>" type="image/x-icon">
    <title>NAC</title>
</head>
<body style="font-family: 'Raleway', sans-serif;">
    <header><?= $this->include('statis/layout/header') ?></header>
    <main class="bg-neutral-300"><?= $this->renderSection('content') ?></main>
    <footer><?= $this->include('statis/layout/footer') ?></footer>
</body>
</html>