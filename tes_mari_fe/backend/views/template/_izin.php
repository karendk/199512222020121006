<?php
$apiSatkerContent = file_get_contents(Yii::$app->makus::API_PEGAWAI . 'satker/' . $model->nipPengaju->satker_id);
$apiSatker = json_decode($apiSatkerContent, true); //because of true, it's in an array
// Yii::$app->makus->d($apiSatker['data']);
?>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12pt;
    }

    @page {
        margin-left: 3cm;
        margin-right: 2cm;
    }

    /* .kop-border {
        padding-bottom: 10px;
        margin-bottom: 10px;
        border-bottom: solid 1px black;
        position: relative;
    }

    .kop-border:after {
        content: '';
        border-bottom: solid 3px black;
        width: 100%;
        position: absolute;
        bottom: -6px;
        left: 0;
    } */

    .kop-border {
        padding-bottom: 10px;
        margin-bottom: 10px;
        border-bottom: solid 3px black;
    }

    .kop-border2 {
        padding-top: 1px;
        border-bottom: solid 1px black;
        box-shadow: 0 1px 0 red;
        content: "";
    }

    .center {
        text-align: center;
    }

    .indent {
        padding: 15px 0;
    }

    .bold {
        font-weight: bold;
    }

    .underline {
        text-decoration: underline;
    }
</style>
<div style="
        z-index: 1;
        position: absolute;
        bottom: 180px;
        left: 20px;">
    <img src="<?= $apiSatker['data']['cap'] ?>" style="width:auto; height:210px; ">
</div>
<div>
    <table style="border-collapse: collapse; width:100%">
        <tr>
            <td class="kop-border" style="text-align:center;">
                <img src="<?= $apiSatker['data']['logo'] ?>" style="width:auto; height:100px; text-align:center">
            </td>
            <td class="kop-border" style="text-align:center; ">
                <span class="bold"><?= strtoupper($apiSatker['data']['nama_panjang']) ?></span><br>
                <span class="bold"><?= strtoupper($apiSatker['data']['alamat']) ?></span><br>
                email: <?= ($apiSatker['data']['email']) ?><br>
                <?= strtoupper($apiSatker['data']['kota']) . " - " . strtoupper($apiSatker['data']['provinsi']) . " " . $apiSatker['data']['kode_pos'] ?>
            </td>
            <td class="kop-border indent" style="width:50px">
        </tr>
        <tr>
            <td class="kop-border2" colspan="3"></td>
        </tr>
    </table>
    <div class="center indent bold underline">
        SURAT PERMOHONAN IZIN <?= strtoupper($model::JENIS[$model->jenis]) ?>
    </div>
    <div class="indent"></div>
    <div class="indent">
        Yang bertanda tangan dibawah ini:
    </div>
    <table style="border-collapse: collapse; width:100%">
        <tr>
            <td style="width: 150px;">
                Nama
            </td>
            <td class="center" style="width: 50px;">:</td>
            <td>
                <?= ($model->nipPengaju->gelar_depan != null ? $model->nipPengaju->gelar_depan . ',' : ''); ?>
                <?= ($model->nipPengaju->nama_lengkap); ?><?= ($model->nipPengaju->gelar_belakang != null ? ', ' . $model->nipPengaju->gelar_belakang : ''); ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px;">
                NIP
            </td>
            <td class="center" style="width: 50px;">:</td>
            <td>
                <?= ($model->nip_pengaju) ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px;">
                Jabatan
            </td>
            <td class="center" style="width: 50px;">:</td>
            <td>
                <?= ($model->nipPengaju->jabatan) ?>
            </td>
        </tr>
    </table>
    <div class="indent">
        Mengajukan izin / memberitahukan keluar kantor untuk keperluan: <br>
        <div class="underline"><?= $model->keperluan ?></div>
    </div>

    <table style="border-collapse: collapse; width:100%">
        <tr>
            <td style="width: 150px;">
                Pukul
            </td>
            <td class="center" style="width: 50px;">:</td>
            <td>
                <?= Yii::$app->makus->timeSummary($model->jam_mulai, $model->jam_selesai) ?>
            </td>
        </tr>
        <tr>
            <td style="width: 150px;">
                Hari/Tanggal
            </td>
            <td class="center" style="width: 50px;">:</td>
            <td>
                <?= Yii::$app->makus->convertDateInitial($model->tanggal) ?>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse; width:100%;margin-top:200px; position:relative;">
        <tr>
            <td>
                Mengetahui,
            </td>
            <td style="width:250px;">
                <?= ($apiSatker['data']['kota']) ?>, <?= Yii::$app->makus->convertDateInitial($model->tanggal) ?>
            </td>
        </tr>
        <tr>
            <td style="">
                <?= ($model->nipAtasan->jabatan) ?> <?= ($apiSatker['data']['nama']) ?>
            </td>
            <td>
                Hormat saya
            </td>
        </tr>
        <tr>
            <td><img src="<?= $model->nipAtasan->tanda_tangan ?>" height="120px" width="auto">
            </td>
            <td><img src="<?= $model->nipPengaju->tanda_tangan ?>" height="120px" width="auto"></td>
        </tr>
        <tr>
            <td>
                <?= ($model->nipAtasan->gelar_depan != null ? $model->nipAtasan->gelar_depan . ',' : ''); ?>
                <?= ($model->nipAtasan->nama_lengkap); ?><?= ($model->nipAtasan->gelar_belakang != null ? ', ' . $model->nipAtasan->gelar_belakang : ''); ?>
            </td>
            <td>
                <?= ($model->nipPengaju->gelar_depan != null ? $model->nipPengaju->gelar_depan . ',' : ''); ?>
                <?= ($model->nipPengaju->nama_lengkap); ?><?= ($model->nipPengaju->gelar_belakang != null ? ', ' . $model->nipPengaju->gelar_belakang : ''); ?>
            </td>
        </tr>
        <tr>
            <td>NIP. <?= $model->nip_atasan ?></td>
            <td>NIP. <?= $model->nip_pengaju ?></td>
        </tr>
    </table>



</div>

<!-- <pagebreak /> -->