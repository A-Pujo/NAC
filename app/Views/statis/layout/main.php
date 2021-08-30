<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css')?>">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header><?= $this->include('statis/layout/header') ?></header>
    <main class="bg-neutral-300"><?= $this->renderSection('content') ?></main>
    <footer><?= $this->include('statis/layout/footer') ?></footer>
</body>
</html>