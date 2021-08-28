<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?=print_r($daftar_partisipan)?><br>
    <a href="<?= base_url('/admin-lomba/kalkulasi') ?>">Kalkulasi Nilai</a>
    <table>
        <thead>
            <tr>
                <th>Nama Tim</th>
                <th>Nama Ketua</th>
                <th>Kode Lomba</th>
                <th>Kode Voucher</th>
                <th>Nilai</th>
                <th>Cek</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($daftar_partisipan as $partisipan) : ?>
            <tr>
                <td><?= $partisipan->nama_tim ?></td>
                <td><?= $partisipan->nama_ketua ?></td>
                <td><?= $partisipan->kode_lomba ?></td>
                <td><?= $partisipan->kode_voucher ?></td>
                <td><?= $partisipan->kuantitas_nilai ?></td>
                <td><a href="<?= base_url('/admin-lomba/cek-kalkulasi/'.$partisipan->kode_voucher) ?>">Cek</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>