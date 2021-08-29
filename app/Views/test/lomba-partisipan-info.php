<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= print_r($partisipan_info) ?>
    <br>
    Lagi lomba <b><?= $daftar_lomba[$partisipan_info->kode_lomba] ?></b>
    <br>
    <p>Coba</p>
    <?php if($partisipan_info->kode_lomba == 'AuditUniv') : ?>
        <a href="<?=base_url('/lomba/percobaan-lomba/'.$kode_voucher)?>">Mulai</a>
    <?php else: ?>
        <a href="<?=base_url('/lomba/percobaan-lomba/'.$kode_voucher.'/1')?>">Mulai Soal Paket 1</a>
        &nbsp;&nbsp;
        <a href="<?=base_url('/lomba/percobaan-lomba/'.$kode_voucher.'/2')?>">Mulai Soal Paket 2</a>
        &nbsp;&nbsp;
        <a href="<?=base_url('/lomba/percobaan-lomba/'.$kode_voucher.'/3')?>">Mulai Soal Paket 3</a>
    <?php endif; ?>
</body>
</html>