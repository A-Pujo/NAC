<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>
<body>
    <div>
        <table id="test">
            <thead>
                <tr>
                    <th>Nama Tim</th>
                    <th>jenis Partisipasi</th>
                    <th>Nama Ketua</th>
                    <th>Partisipan Aktif</th>
                    <th>Pembayaran Aktif</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data_partisipan as $partisipan) : ?>
                <tr>
                    <td><?= $partisipan->nama_tim ?></td>
                    <td><?= $partisipan->partisipan_jenis ?></td>
                    <td><?= $partisipan->nama_ketua ?></td>
                    <td><?= $partisipan->partisipan_aktif == 0 ? 'Belum Diverifikasi' : 'Terverifikasi' ?></td>
                    <td><?= $partisipan->pembayaran_aktif == 0 ? 'Belum Bayar' : 'Sudah Bayar' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#test').DataTable();
        } );
    </script>
</body>
</html>