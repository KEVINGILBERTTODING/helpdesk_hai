<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style type="text/css">
        .container {
            display: flex;
            align-items: center;
        }

        .container img {
            max-width: 10%;
            height: auto;
        }

        .header {
            flex-grow: 1;
            text-align: center;
        }

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
    <div class="container">
        <div class="header">
            <img src="{{ $main_logo }}" alt="Main Logo">
            <h3>Laporan Permohonan Bidang {{ $nama_bidang }}</h3>
            <h3>Kejaksaan Tinggi Jawa Tengah</h3>
            <p style="font-style: italic">{{ $address }}</p>
            <hr>
        </div>
    </div>
    <p>Periode <?= date('d-m-Y', strtotime($date_start)) ?> s/d <?= date('d-m-Y', strtotime($date_end)) ?></p>
    <br>

    <table class="table">

        <tr>
            <th>No</th>
            <th>Tanggal Permohonan</th>
            <th>NRP</th>
            <th>Nama Lengkap</th>
            <th>Subjek</th>
            <th>Layanan</th>
            <th>Bidang</th>
            <th>Tipe</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>

        <?php
		$no = 1;
		foreach ($dataPermohonan as $p) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p->created_at ?></td>
            <td><?= $p->nrp ?></td>
            <td><?= $p->nama_lengkap ?></td>
            <td><?= $p->subject ?></td>
            <td><?= $p->nama_layanan ?></td>
            <td><?= $p->nama_bidang ?></td>
            <td><?= $p->nama_type ?></td>
            <td><?= $p->keterangan ?></td>
            <td>
                <?php if ($p->status == 1) {
                    echo 'Selesai';
                } elseif ($p->status == 2) {
                    echo 'Proses';
                } else {
                    echo 'Ditolak';
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

                    Daskrimti,<br>
                    Kejaksaan Tinggi Jawa Tengah
                    <br>

                    <br><br><br><br><br>
                    {{ $nama_daskrimti }}

                </td>

            </tr>

            <tr>

            </tr>

        </table>
</body>

</html>
