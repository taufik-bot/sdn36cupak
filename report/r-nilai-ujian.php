<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

$noUjian = $_GET['noUjian'];

$dataUjian = mysqli_query($koneksi, "SELECT * FROM tbl_ujian WHERE no_ujian = '$noUjian' ");
$data = mysqli_fetch_array($dataUjian);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .title{
            text-align: center;
        }
        h3{
            margin-top: 20px;
        }
        h2{
            margin-bottom: 30px;
        }
        .head-left{
            width: 100px;
            padding-left: 7px;
            padding-bottom: 5px;
        }
        .head-right{
            color: red;
        }
        hr{
            margin-bottom: 2px;
            margin-left: 5px;
        }
        .head-no{
            padding-left: 20px;
        }
        .head-mapel{
            width: 400px;
        }
        .head-nilai{
            width: 170px;
            text-align: center;
        }
        .data-no{
            padding-left: 20px;
        }
        .data-nilai{
            text-align: center;
        }
        .foot{
            padding-left: -28px;
            padding-bottom: 5px;
        }
        .sum-colon{
            margin-left: 28px;
        }
        .min-nilai{
            margin-left: -5px;
        }
        .max-colon{
            margin-left: 3px;
        }
        .foot-nilai{
            margin-left: 5px;
        }
        .avg-colon{
            margin-left: 34px;
        }
    </style>
</head>
<body>

<div class="title">
    <h3>Laporan Nilai Ujian</h3>
    <h2>SDN 36 Cupak</h2>

</div>

<table>
    <thead>
        <tr>
            <th class="head-left">No Ujian </th>
            <th class="head-left"> : <?= $data['no_ujian'] ?></th>
            <th>Cupak, <?= date('j F Y') ?></th>
            
        </tr>
        <tr>
            <th class="head-left">Tgl Ujian</th>
            <th class="head-left">: <?= date("d-m-Y,", strtotisme($data['tlg_ujian'])) ?></th>
        </tr>
        <tr>
            <th class="head-left">NIS</th>
            <th class="head-left">:</th>
        </tr>
        <tr>
            <th class="head-left">Jurusan</th>
            <th class="head-left">:</th>
            <th class="head-right">Hasil Ujian :</th>
            
        </tr>
        <tr>
            <th colspan="3">
                <hr>
            </th>
        </tr>
        <tr>
            <th class="head-no">No</th>
            <th class="head-mapel">Mata Pelajaran</th>
            <th class="head-nilai">Nilai</th>
        </tr>
        <tr>
            <th colspan="3">
                <hr>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="data-no"></td>
            <td></td>
            <td class="data-nilai"></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">
                <hr>
            </th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th class="foot">Total Nilai <span class="sum-colon"> :</span></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th class="foot">Nilai Terendah :<span class="min-nilai"></span></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th class="foot">Nilai Tertinggi <span class="max-colon">:</span> <span class="foot-nilai"></span></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th class="foot">Rata-rata <span class="avg-colon">:</span> <span class="foot-nilai"></span></th>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    window.print();
</script>
    
</body>
</html>