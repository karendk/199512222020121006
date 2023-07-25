<?php

use backend\models\Pegawai;
use common\components\MyPagination;
use common\helpers\Makus;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pegawai');
$this->params['breadcrumbs'][] = $this->title;

\dominus77\sweetalert2\Alert::widget([
    'useSessionFlash' => true,
    'customAnimate' => true
]);
?>
<div class="pegawai-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pegawai'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
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
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'yii\grid\SerialColumn',
                'header' => Yii::t('app', 'No.'),
                'headerOptions' => ['class' => 'header-crud'],
            ],

            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, Pegawai $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],


            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Actions'),
                'headerOptions' => ['class' => 'header-crud'],
                'template' =>
                Helper::filterActionColumn('<div class="dropdown">
                    ' . $this->render('//layouts/_index_action') . '
                    <div class="dropdown-menu dropdown-menu-left">
                        {view}
                        {update}
                        {delete}
                    </div>
                </div>'),
                'buttons' => [
                    //custom class
                    'view' => function ($url, $model) {
                        return Html::a(Html::tag('span', '', ['class' => "fa fa-eye"]) . Yii::t('app', 'View Detail'), $url, [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "dropdown-item"
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a(Html::tag('span', '', ['class' => "fa fa-pencil"]) . Yii::t('app', 'Edit'), $url, [
                            'title' => Yii::t('app', 'Do update'),
                            'class' => "dropdown-item",
                            // 'style'=>$style
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(Html::tag('span', '', ['class' => "fa fa-trash", 'style' => 'color:red']) . Yii::t('app', 'Delete'), $url, [
                            'title' => Yii::t('app', 'Do delete'),
                            'class' => "dropdown-item",
                            'data-confirm' => Yii::t('app', 'Are you sure you want to delete {title}?', [
                                'title' => "\"<i>" . $model->nama_lengkap . "\"</i>",
                            ]),
                            'data-method'  => 'post',
                        ]);
                    },
                ],
            ],
            // 'id',
            // 'satker_id',
            'nip',
            'nama_lengkap',
            // 'password',
            // 'nik',
            'email:email',
            'no_telepon',
            'jabatan',
            // 'foto',

            [
                'attribute' => 'foto',
                'value' => function ($data) {
                    $makus= new Makus;
                    if (isset($data->foto)) {
                        $result =  '<img 
                        src="'.Url::to(['/']).Yii::$app->params['pathFoto'].$data->foto.'" 
                        class="avatar img-fluid rounded me-1" alt="'.$data->nama_lengkap.'"
                        style="object-position: top;object-fit: cover;"/>';
                    } else {
                        // $result = null;
                        $result =  '<img 
                        src="'.$makus->avatar($data->nip).'" 
                        class="avatar img-fluid rounded me-1" alt="'.$data->nama_lengkap.'" 
                        style="object-position: top;object-fit: cover;"/>';
                    }
                    return  $result;
                },
                'format' => 'raw'
            ],
           
            // 'gelar_depan',
            // 'gelar_belakang',
            // 'tempat_lahir',
            // 'tanggal_lahir',
            // 'jenis_kelamin',
            // 'agama',

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
                    return $data->alamat_pengiriman;
                },
                'format' => 'raw'
            ],
            // 'pangkat_golongan',
            'status',
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>