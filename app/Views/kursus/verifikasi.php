<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <th>Nama</th>
            <th>Sekolah</th>
            <th>Verif</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php foreach($daftar_peserta as $peserta) : ?>
                <tr>
                    <td><?= $peserta->nama_peserta ?></td>
                    <td><?= $peserta->nama_sekolah ?></td>
                    <td><?= ($peserta->verifikasi_peserta == 1) ? 'Iya' : 'Tidak' ?></td>
                    <td><a href="<?= base_url('kursus/verifikasi/'.$peserta->id_user) ?>">Cek</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>