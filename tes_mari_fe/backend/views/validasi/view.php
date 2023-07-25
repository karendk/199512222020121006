<?php

use backend\models\Pegawai;
use common\helpers\Makus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Izin $model */

$this->title = "Izin " . $model::JENIS[$model->jenis];

$this->params['breadcrumbs'][] = ['label' => 'Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

\dominus77\sweetalert2\Alert::widget([
    'useSessionFlash' => true,
    'customAnimate' => true
]);
?>

<div class="izin-view card makus-card table-responsive">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $this->render('//layouts/_back_button') ?>
        <?= $model->checkUbah ? Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) : "" ?>
        <?= $model->checkHapus ? Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda yakin ingin menghapus form pengajuan izin ini..?',
                'method' => 'post',
            ],
        ]) : "" ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'status',
                'value' => function ($data) {
                    $result=$data->customStatus;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'jenis',
                'value' => function ($data) {
                    $result=$data::JENIS[$data->jenis];
                    return  $result;
                },
                'format' => 'raw'
            ],
            // 'nipPengaju.nama_lengkap',
            [
                'attribute' => 'Pengaju',
                'value' => function ($data) {
                    $result = $data->nipPengaju->nama_lengkap;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'nipAtasan',
                'value' => function ($data) {
                    $result = $data->nipAtasan->nama_lengkap;
                    return  $result;
                },
                'format' => 'raw',
                'filter'=>ArrayHelper::map(Pegawai::find()->asArray()->all(), 'nama_lengkap', 'nama_lengkap'),
                'filterInputOptions' => ['class' => 'select2'],
            ],
            [
                'attribute' => 'keperluan',
                'value' => function ($data) {
                    $result = $data->keperluan;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'label' => 'Waktu',
                'value' => function ($data) {
                    $result = $data->waktu;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'tanggal',
                'value' => function ($data) {
                    $result = $data->tanggalLengkap;
                    return  $result;
                },
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>