<?php

use common\helpers\Makus;
use SebastianBergmann\CodeCoverage\Report\PHP;
use yii\helpers\Html;
use yii\helpers\Url;

$makus = new Makus;
?>
<style>
    body {
        margin: 0;
    }

    a,
    a:hover {
        text-decoration: none;
        color: white;
    }

    .sertifikat {
        text-align: center;
        /* width: 1366px; */
        width: 1500px;
        height: 1000px;
    }

    .sertifikat2 {
        text-align: center;
        /* width: 1366px; */
        width: 1500px;
        height: 1000px;
    }

    .sertifikat2 table {
        width: 1000px;
        /* height: 500px; */
        border-collapse: collapse;
        border: 1px solid;
    }

    .sertifikat2 tr,
    .sertifikat2 td {
        height: 50px;
        border: 1px solid;
        padding: 8px;
    }

    .foto {
        padding-top:86px;
        /* height: 350px; */
        height: 150px;
    }

    .ukuran-atas {
        /* height: 350px; */
        height: 50px;
    }

    .tulisan-atas {
        color: #17450D;
        font-size: 55pt;
        text-align: center;
    }

    .ukuran-atas2 {
        height: 50px;
    }

    .tulisan-atas2 {
        color: grey;
        font-size: 16pt;
        text-align: center;
    }

    .tema {
        padding: 0px 120px 0px 120px;
    }

    .ukuran-nama {
        height: 50px;
    }

    .tulisan-nama {
        font-size: 33pt;
        text-align: center;
    }

    @media print {
        .page-break {
            page-break-before: always;
        }

    }
</style>
<!--<POSISI GAMBAR DIBELAKANG>-->
<!-- onLoad="window.print()" -->
<div class="page-break">
    <img src="<?= Url::to(['/']) ?>uploads/sertifikat/<?=$model->id?>/bg.jpg" style="position:absolute" class="sertifikat">
    <!--<POSISI TABEL DIDEPAN>-->
    <div style="position:relative">
        <table border="0px" class="sertifikat">
            <tr>
                <td class="foto">
                    <p><?php
                        if (Yii::$app->user->identity->pegawai->foto != null) {
                            $result = Html::img(Url::to(['/']) . Yii::$app->params['pathFoto'] . Yii::$app->user->identity->pegawai->foto, ['alt' => 'Foto Profile', 'style' => 'width:150px;height:auto;']);
                        } else {
                            $result = '-';
                        }
                        echo $result;
                        ?></p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:bottom" class="ukuran-atas">
                    <p class="tulisan-atas">SERTIFIKAT</p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top" class="ukuran-atas2">
                    <p class="tulisan-atas2 tema"><?= $model::JENIS[$model->jenis] ?>: <?= $model->tema ?></p>
                </td>
            </tr>
            <tr>
                <td class="ukuran-nama">
                    <p class="tulisan-nama"><strong>
                            <u><?= (Yii::$app->user->identity->pegawai->gelar_depan != null ? Yii::$app->user->identity->pegawai->gelar_depan . ',' : ''); ?></u>
                            <u><?= (Yii::$app->user->identity->pegawai->nama_lengkap); ?></u>
                            <u><?= (Yii::$app->user->identity->pegawai->gelar_belakang != null ? ', ' . Yii::$app->user->identity->pegawai->gelar_belakang : ''); ?></u>
                        </strong>
                        <br><span style="font-size:25px"><?= Yii::$app->user->identity->pegawai->jabatan ?> (<?= Yii::$app->user->identity->pegawai->pangkat_golongan ?>)</span>
                        <br><span style="font-size:30px">
                            <?php
                            $content = file_get_contents($makus::API_PEGAWAI.'satker/' . Yii::$app->user->identity->pegawai->satker_id);
                            $response = json_decode($content, true); //because of true, it's in an array
                            echo $response['data']['nama_panjang'];
                            ?></span>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top">
                    <p class="tulisan-atas2">
                        Alhamdullilahirobil'alamin, puji syukur kehadirat Allah SWT yang telah melimpahkan rahmat dan karunia-Nya.<br>
                        Lembaran ini sebagai bukti otentik bahwa nama di atas telah mengikuti <?= $model::JENIS[$model->jenis] ?> pada tanggal <br> <i><?= $makus->dateSummary($model->tanggal_mulai, $model->tanggal_selesai) ?></i>.<br>
                        Sertifikat ini diberikan karena telah mengikuti semua materi di <?= $model::JENIS[$model->jenis] ?>.
                    <table width="100%" height="210px" border="0px">
                        <tr>
                            <!-- <td colspan="2"><img src="/uploads/sertifikat/ttd-ketua.png" height="120px" width="200px" style="padding-left:270px; padding-top:10px; position:absolute"></td> -->
                            <td colspan="2" style="text-align:center"><img src="<?= Url::to(['/']) ?>uploads/sertifikat/ttd/<?= $model->ketua_pta ?>.png" height="120px" width="400px"></td>
                            <!-- <td></td> -->
                        </tr>
                        <tr>
                            <td style="vertical-align:bottom; color:grey;" colspan="2">
                                <p class="tulisan-atas2"><span style="text-decoration:underline">
                                        <?= ($model->ketuaPTA->gelar_depan != null ? $model->ketuaPTA->gelar_depan : ''); ?>
                                        <?= ($model->ketuaPTA->nama_lengkap); ?>
                                        <?= ($model->ketuaPTA->gelar_belakang != null ? ', ' . $model->ketuaPTA->gelar_belakang : ''); ?>
                                    </span><br>Ketua Pengadilan Tinggi Agama Kupang</p>
                            </td>

                            <!-- <td style="vertical-align:bottom; color:grey;">
                            <p class="tulisan-atas2">Dr. Dra. Hj. SISVA YETTI, S.H., M.H.</p>
                        </td>
                        <td style="vertical-align:bottom; color:grey;">
                            <p class="tulisan-atas2">Tanda Tangan Pemilik</p>
                        </td> -->
                        </tr>
                    </table>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div style="position:absolute; top:680px;left:-150px;">
        <div class="sertifikat">
            <img src="<?= Url::to(['/']) ?>uploads/sertifikat/cap.png" height="200px" width="150px">
        </div>
    </div>
</div>

<div class="page-break"></div>
<img src="<?= Url::to(['/']) ?>uploads/sertifikat/<?=$model->id?>/bg2.jpg" style="position:absolute; filter: opacity(50%);" class="sertifikat">
<div class="sertifikat2" style="position:relative">
    <br><br><br><br>
    <p style="margin-top: 60px;">
    <h2>DAFTAR MATERI </h2>
    <h2><?= strtoupper($model::JENIS[$model->jenis]) ?></h2>
    </p>
    <center>
        <table style="margin-top: 100px;">
            <tr style='text-align:center'>
                <td>NO</td>
                <td>NAMA MATERI</td>
                <td>JAM PELAJARAN</td>
            </tr>
            <?php
            $total = 0;
            foreach ($model->materi as $key => $value) {
                echo "<tr>";
                echo "<td style='text-align:right;'>" . ($key + 1) . ". </td>";
                echo "<td>" . $value['nama'] . "</td>";
                echo "<td style='text-align:center'>" . $value['jpl'] . " JPL</td>";
                echo "</tr>";
                $total = $total + $value['jpl'];
            }
            echo "<tr>";
            echo "<td colspan='2' style='text-align:center'>TOTAL</td>";
            echo "<td style='text-align:center'>" . $total . " JPL</td>";
            echo "</tr>";
            ?>
        </table>
    </center>
    <div style="margin-top: 150px;">Kupang, <?= $makus->convertDateInitial($model->tanggal_selesai) ?></div>
    <div>Ketua Panitia Penyelenggara</div>
    <div><img src="<?= Url::to(['/']) ?>uploads/sertifikat/ttd/<?= $model->ketua_panitia ?>.png" height="120px" width="auto"></div>
    <div style="margin-top: 0px;">
        <?= ($model->ketuaPanitia->gelar_depan != null ? $model->ketuaPanitia->gelar_depan: ''); ?>
        <?= ($model->ketuaPanitia->nama_lengkap); ?>
        <?= ($model->ketuaPanitia->gelar_belakang != null ? ', ' . $model->ketuaPanitia->gelar_belakang : ''); ?>
    </div>
    <div style="margin-top: 0px;">
        NIP. <?= ($model->ketua_panitia); ?>
    </div>
</div>