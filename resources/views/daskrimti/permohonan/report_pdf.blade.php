<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/' . $surat_penolakan['logo_kop_surat']); ?>">
    <style type="text/css">
        .table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;

        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>

<body>
    <img src="assets/img/<?= $surat_penolakan['logo_kop_surat'] ?>" width="250" height="130">
    <center>
        <h3>Laporan Proposal Bantuan Program TJSL</h3>
        <h3>PT. Jasa Raharja Cabang Utama Jawa tengah</h3>

    </center>

    <p>Tanggal <?= date('d-m-Y', strtotime($date_start)) ?> s/d <?= date('d-m-Y', strtotime($date_end)) ?></p>
    <br><br>

    <table class="table">

        <tr>
            <th>No</th>
            <th>No Proposal</th>
            <th>Tanggal Proposal</th>
            <th>Instansi</th>
            <th>Email</th>
            <th>Bantuan</th>
            <th>Loket</th>
            <th>Status</th>
        </tr>

        <?php
		$no = 1;
		foreach ($proposal as $p) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p->no_proposal ?></td>
            <td><?= $p->tgl_proposal ?></td>
            <td><?= $p->asal_proposal ?></td>
            <td><?= $p->email_pengaju ?></td>
            <td><?= $p->bantuan_diajukan ?></td>
            <td><?= $p->nm_loket ?></td>
            <td>
                <?php if ($p->status == '') {
                    echo 'Diproses';
                } else {
                    echo $p->status;
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>



    </table>
    <br><br><br><br>

    <table>
        <table width="0">

            <tr>
                <td width="0"><br><br></td>
                <td>
                    PT. Jasa Raharja
                    <br>
                    Cabang Utama Jawa Tengah
                    <br><br>
                    <img src="uploads/qrcode/<?= $kacab['file_qrcode'] ?>" width="100" height="100">
                    <br><br><?= $kacab['nama_lengkap'] ?>
                    <br>
                    Kepala Cabang
                </td>

            </tr>

            <tr>

            </tr>

        </table>
</body>

</html>
