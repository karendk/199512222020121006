<?php

use backend\models\Izin;
use common\helpers\Makus;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\IzinSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Daftar Izin';
$this->params['breadcrumbs'][] = $this->title;


/* ------------------------------- untuk form ------------------------------- */
$this->registerAssetBundle('backend\assets\FormAsset');

\dominus77\sweetalert2\Alert::widget([
    'useSessionFlash' => true,
    'customAnimate' => true
]);
?>
<div class="izin-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        echo Html::a('Ajukan Izin', ['create'], ['class' => 'btn btn-success']);
        echo $searchModel->tabPanel();
        ?>
    </p>

    <?php //Pjax::begin(); 
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{pager}<div class='table-responsive card' style='scrollbar-x-position: top; padding:16px 16px 50px 16px;'>{items}</div>\n{summary}\n{pager}",
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover halign-center',
        ],
        'pager' => [
            'class' => 'common\components\MyPagination'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => Yii::t('app', 'No.'),
                'headerOptions' => ['class' => 'header-crud'],
            ],
            [
                'attribute' => 'tanggal',
                'value' => function ($data) {
                    $result = $data->tanggalLengkap;
                    return  $result;
                },
                'format' => 'raw',
                // 'filter'=>ArrayHelper::map(Izin::find()->asArray()->all(), 'tanggal', 'tanggal'),
                'filterInputOptions' => ['class' => 'datepicker', 'style' => 'width:100%'],
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
                'label' => 'Jenis',
                'value' => function ($data) {
                    if (isset($data->jenis)) {
                        $result = $data::JENIS[$data->jenis];
                    } else {
                        $result = null;
                    }
                    return  $result;
                },
                'format' => 'raw'
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
                'attribute' => 'alasan_tolak',
                'visible' => (Yii::$app->request->get('IzinSearch')['tab'] ?? null) == '2',
                'value' => function ($data) {
                    $result = $data->alasan_tolak;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'label' => 'Atasan',
                'value' => function ($data) {
                    $result = $data->nipAtasan->nama_lengkap;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Aksi'),
                'headerOptions' => ['class' => 'header-crud'],
                'template' =>
                // Helper::filterActionColumn('
                //     {view}<hr>
                //     {update}<hr>
                //     {delete}
                // '),
                Helper::filterActionColumn('
                    {view}
                    {update}
                    {delete}
                    {print}
                    {hubungi}
                '),
                'buttons' => [
                    //custom class
                    'view' => function ($url, $model) {
                        return Html::a("<button class='btn btn-secondary'>" . Html::tag('span', '', [
                            'data-feather' => "eye"
                        ]) . "</button>", $url, [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "",
                            'title' => "Lihat",
                            'data-toggle' => "tooltip"
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return $model->checkUbah ? Html::a("<button class='btn btn-warning'>" . Html::tag('span', '', [
                            'data-feather' => "edit",
                        ]) . "</button>", $url, [
                            'class' => "",
                            'title' => "Ubah",
                            'data-toggle' => "tooltip"
                            // 'style'=>$style
                        ]) : "";
                    },
                    'delete' => function ($url, $model) {
                        return $model->checkHapus ? Html::a("<button class='btn btn-danger'>" . Html::tag('span', '', [
                            'data-feather' => "trash"
                        ]) . "</button>", $url, [
                            'class' => "",
                            'data-confirm' => "Anda yakin ingin menghapus pengajuan izin ini ?<br>" . $model->tanggal,
                            'data-method'  => 'post',
                            'title' => "Hapus",
                            'data-toggle' => "tooltip"
                        ]) : "";
                    },
                    'print' => function ($url, $model) {
                        return $model->status=='1' ? Html::a("<button class='btn btn-success'>" . Html::tag('span', '', [
                            'data-feather' => "printer",
                        ]) . "</button>", $url, [
                            'class' => "",
                            'title' => "Cetak",
                            'data-toggle' => "tooltip",
                            'target'=>'_blank',
                            // 'style'=>$style
                        ]) : "";
                    },
                    'hubungi' => function ($url, $model) {
                        return $model->checkHapus ? Html::a("<button class='btn btn-secondary'>" . Html::tag('span', '', [
                            'data-feather' => "phone"
                        ]) . "</button>", 'https://wa.me/62'.substr($model->nipAtasan->no_telepon,1).'/?text='.urlencode('Assalamualaikum wr.wb. Mohon diterima Izin '.$model::JENIS[$model->jenis].' Saya, atas nama '.$model->nipPengaju->nama_lengkap), [
                            'class' => "",
                            'target'=>'_blank',
                            'title' => "Hubungi",
                            'data-toggle' => "tooltip"
                        ]) : "";
                    },
                ],
            ],
        ],
    ]); ?>

    <?php //Pjax::end(); 
    ?>

</div>

<?php
$js = "";
$js .= <<<JS
$(function() {
    $('.select2').select2()

    $('.datepicker').datepicker({
        // title:'Plan-On',
        // multidate:true,
        // language:'id',
        todayHighlight:true,
        disableTouchKeyboard:false,
        format:'yyyy-mm-dd',
        // format:'dd MM yyyy',
        // viewMode: "months", 
        // minViewMode: "months",
        // startView: "months",
        // setDate: new Date('yyyy-mm-dd'),
        orientation: 'bottom',
        autoclose: true,
        todayBtn:"linked",
        // clearBtn:true,
    })
    $('.datepicker').keydown(function(){
        return false
    })
});
JS;

$this->registerJs($js, View::POS_END);
?>