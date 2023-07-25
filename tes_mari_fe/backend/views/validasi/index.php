<?php

use dominus77\sweetalert2\Alert;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/** @var yii\web\View $this */
/** @var backend\models\ValidasiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Daftar Validasi';
$this->params['breadcrumbs'][] = $this->title;


/* ------------------------------- untuk form ------------------------------- */
$this->registerAssetBundle('backend\assets\FormAsset');

Alert::widget([
    'useSessionFlash' => true,
    'customAnimate' => true
]);
?>
<div class="izin-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
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
                // 'filter'=>ArrayHelper::map(Validasi::find()->asArray()->all(), 'tanggal', 'tanggal'),
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
                'label' => 'Pengaju',
                'value' => function ($data) {
                    $result = $data->nipPengaju->nama_lengkap;
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
                'visible' => (Yii::$app->request->get('ValidasiSearch')['tab'] ?? null) == '2',
                'value' => function ($data) {
                    $result = $data->alasan_tolak;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => (Yii::$app->request->get('ValidasiSearch')['tab'] ?? '0') == '0',
                'header' => Yii::t('app', 'Validasi'),
                'headerOptions' => ['class' => 'header-crud'],
                'template' => '<center><div class="text-center"><div class="btn-group btn-group-lg" role="group" aria-label="Large button group">
                    {setuju}
                    {tolak}
                </div></center>',
                'buttons' => [
                    'setuju' => function ($url, $model) {
                        if ($model->checkValidasi) {
                            $result = Html::a(Html::tag('span', '', ['class' => "", 'style' => 'color:white', 'data-feather' => 'check']), $url, [
                                'title' => Yii::t('app', 'Setujui'),
                                'class' => "btn btn-success",
                                'data-toggle' => "tooltip",
                                'data-placement' => "right",
                                'data-confirm' => Yii::t('app', 'Apakah anda yakin akan menyetujui izin <b>{title}</b> ini ?', [
                                    'title' => '<i>' . $model->keperluan . '</i>',
                                ]),
                                'data-method'  => 'post',
                            ]);
                        } else {
                            $result = "";
                        }
                        return $result;
                    },
                    'tolak' => function ($url, $model) {
                        if ($model->checkValidasi) {
                            $result = Html::a(Html::tag('span', '', ['class' => "", 'style' => 'color:white', 'data-feather' => 'x']), $url, [
                                'title' => Yii::t('app', 'Tolak'),
                                'class' => "btn btn-danger",
                                'data-toggle' => "tooltip",
                                'data-placement' => "right",
                                // 'data-confirm' => Yii::t('app', 'Apakah anda yakin akan menolak izin <b>{title}</b> ini ?', [
                                //     'title' => '<i>' . $model->keperluan . '</i>',
                                // ]),
                                // 'data-method'  => 'get',
                            ]);
                        } else {
                            $result = "";
                        }
                        return $result;
                    },
                ],
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
                '),
                'buttons' => [
                    //custom class
                    'view' => function ($url, $model) {
                        return Html::a("<button class='btn btn-secondary btn-sm'>" . Html::tag('span', '', [
                            'data-feather' => "eye"
                        ]) . "</button>", $url, [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "",
                            'title' => "Lihat",
                            'data-toggle' => "tooltip"
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a("<button class='btn btn-secondary btn-sm'>" . Html::tag('span', '', [
                            'data-feather' => "edit",
                        ]) . "</button>", $url, [
                            'title' => Yii::t('app', 'Do update'),
                            'class' => "",
                            'title' => "Ubah",
                            'data-toggle' => "tooltip"
                            // 'style'=>$style
                        ]);
                    },
                ],
            ],
        ],
    ]);
    ?>

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