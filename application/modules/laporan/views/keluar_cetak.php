<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Masuk</title>
    <link rel="stylesheet" href="<?= base_url('assets/admin/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 align="center">LAPORAN BARANG KELUAR</h2>
        <hr>
        <table border="1" width="100%" class="table">
            <thead>
                <tr align="center" cellpadding="200">
                    <th width="30"><b>NO</b></th>
                    <th><b>ID BARANG</b></th>
                    <th><b>TANGGAL TRANSAKSI</b></th>
                    <th><b>NAMA BARANG</b></th>
                    <th><b>JUMLAH BARANG</b></th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                foreach ($keluar as $row) {
                    ?>
                    <tr>
                        <td width="30"><?= $no ?></td>
                        <td><?= $row->id_barang ?></td>
                        <td><?= $row->tanggal ?></td>
                        <td><?= $row->nama_barang ?></td>
                        <td><?= $row->jumlah  . ' ' . $row->nama_satuan  ?></td>
                    </tr>
                    <?php $no++;
                } ?>
            </tbody>
        </table><br><br><br><br><br><br>

        <div class="row">
            <div class="pull-right">
                Makassar, <?= $tanggal ?><br>
                Pimpinan Perusahaan
                <br><br><br><br><br>
                <?= $konfigurasi->nama_pimpinan ?>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>