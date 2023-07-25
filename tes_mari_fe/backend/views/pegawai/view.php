<?php

use common\helpers\Makus;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pegawai */

$this->title = $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pegawai'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= $this->render('//layouts/_back_button') ?>
<div class="pegawai-view card makus-card">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php

        if (Helper::checkRoute('/pegawai/update')) {
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary float-right']);
        }
        // if (Helper::checkRoute('/pegawai/delete')) {
        //     echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        //         'class' => 'btn btn-danger',
        //         'data' => [
        //             'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        //             'method' => 'post',
        //         ],
        //     ]);
        // }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'satker_id',
            [
                'label' => 'Satuan Kerja',
                'value' => function ($data) {
                    $makus=new Makus();
                    $result = '';
                    $content = file_get_contents($makus::API_PEGAWAI.'satker/' . $data->satker_id);
                    $response = json_decode($content, true); //because of true, it's in an array
                    $result = $response['data']['nama_panjang'];

                    return $result;
                },
                'format' => 'raw'
            ],
            'nip',
            // 'password',
            'nik',
            'email:email',

            [
                'attribute' => 'foto',
                'value' => function ($data) {
                    $result = '';
                    if ($data->foto != null) {
                        $result = Html::img(Url::to(['/']) . Yii::$app->params['pathFoto'] . $data->foto, ['alt' => 'Foto Profile', 'style' => 'width:200px;height:auto;']);
                    } else {
                        $result = '-';
                    }
                    return $result;
                },
                'format' => 'raw'
            ],
            // 'foto',
            'nama_lengkap',
            'gelar_depan',
            'gelar_belakang',
            'tempat_lahir',
            'tanggal_lahir',
            // 'jenis_kelamin',
            [
                'attribute' => 'jenis_kelamin',
                'value' => function ($data) {
                    if (isset($data->jenis_kelamin)) {
                        $result = $data::JENIS_KELAMIN[$data->jenis_kelamin];
                    } else {
                        $result = null;
                    }
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'agama',
                'value' => function ($data) {
                    if (isset($data->agama)) {
                        $result = $data::AGAMA[$data->agama];
                    } else {
                        $result = null;
                    }
                    return  $result;
                },
                'format' => 'raw'
            ],

            [
                'attribute' => 'alamat',
                'value' => function ($data) {
                    return $data->alamat;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'alamat_pengiriman',
                'value' => function ($data) {
                    return $data->alamat;
                },
                'format' => 'raw'
            ],
            // 'alamat',
            // 'alamat_pengiriman',
            'no_telepon',
            'pangkat_golongan',
            'jabatan',

            [
                'attribute' => 'tanda_tangan',
                'value' => function ($data) {
                    $result= '<img src="'.$data->tanda_tangan.'" style="width:auto; height:150px; border: 1px solid #efefef"/>';
                    return $result;
                },
                'format' => 'raw'
            ],
            // 'status',
        ],
    ]) ?>

</div>