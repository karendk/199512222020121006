<?php
//<</*
// @ Author: Karen Dharmakusuma
// @ Description: karendk.github.io
// @ Email: karenmakus@gmail.com
// @ Modified by: Karen Dharmakusuma
// @ Create Time: 2022-06-05 14:55:31
// @ Modified time: 2022-06-06 13:49:43
//>>*/

use backend\models\Kegiatan;
use common\helpers\Makus;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\KegiataniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kegiatan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php

        if (Helper::checkRoute('/kegiatan/create')) {
            echo Html::a(Yii::t('app', 'Tambah'), ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <?php if (Yii::$app->user->identity->status == 1) {
        echo GridView::widget([
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
                // [
                //     'class' => 'yii\grid\ActionColumn',
                //     'header' => Yii::t('app', 'Aksi'),
                //     'headerOptions' => ['class' => 'header-crud'],
                //     'template' =>
                //         Helper::filterActionColumn('<div class="dropdown">
                //         ' . $this->render('//layouts/_index_action') . '
                //         <div class="dropdown-menu dropdown-menu-left">
                //             {view}
                //             {update}
                //             {delete}
                //         </div>
                //     </div>'),
                //     'buttons' => [
                //         //custom class
                //         'view' => function ($url, $model) {
                //             return Html::a(Html::tag('span', '', ['class' => "fa fa-eye"]) . Yii::t('app', 'View'), $url, [
                //                 'title' => Yii::t('app', 'Do view'),
                //                 'class' => "dropdown-item"
                //             ]);
                //         },
                //         'update' => function ($url, $model) {
                //             return Html::a(Html::tag('span', '', ['class' => "fa fa-pencil"]) . Yii::t('app', 'Edit'), $url, [
                //                 'title' => Yii::t('app', 'Do update'),
                //                 'class' => "dropdown-item",
                //                 // 'style'=>$style
                //             ]);
                //         },
                //         'delete' => function ($url, $model) {
                //             return Html::a(Html::tag('span', '', ['class' => "fa fa-trash", 'style' => 'color:red']) . Yii::t('app', 'Delete'), $url, [
                //                 'title' => Yii::t('app', 'Do delete'),
                //                 'class' => "dropdown-item",
                //                 'data-confirm' => Yii::t('app', 'Are you sure you want to delete {title}?', [
                //                     'title' => "\"<i>" . $model->tema . "\"</i>",
                //                 ]),
                //                 'data-method'  => 'post',
                //             ]);
                //         },
                //     ],
                // ],

                // 'id',
                [
                    'label' => 'Tanggal',
                    'attribute' => 'tanggal_mulai',
                    'value' => function ($data) {
                        $makus = new Makus;
                        $result = $makus->dateSummary($data->tanggal_mulai, $data->tanggal_selesai);
                        return  $result;
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'jenis',
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
                'tema',
                // 'tanggal_mulai',
                // 'tanggal_selesai',
                'tempat',
                // 'jadwal',
                //'catatan:ntext',
                //'created_at',
                //'created_by',
                //'edited_at',
                //'edited_by',

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
                        {view}<hr>
                        {update}
                    '),
                    'buttons' => [
                        //custom class
                        'view' => function ($url, $model) {
                            return Html::a("<button class='btn btn-success'>" . Html::tag('span', '', ['class' => "bi bi-eye"]) . Yii::t('app', 'Lihat') . "</button>", $url, [
                                'title' => Yii::t('app', 'Do view'),
                                'class' => ""
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a("<button class='btn btn-warning'>" . Html::tag('span', '', ['class' => "fa fa-pencil"]) . Yii::t('app', 'Edit') . "</button>", $url, [
                                'title' => Yii::t('app', 'Do update'),
                                'class' => "",
                                // 'style'=>$style
                            ]);
                        },
                        // 'delete' => function ($url, $model) {
                        //     return Html::a("<button class='btn btn-danger'>" . Html::tag('span', '', ['class' => "fa fa-trash", 'style' => 'color:red']) . Yii::t('app', 'Delete') . "</button>", $url, [
                        //         'title' => Yii::t('app', 'Do delete'),
                        //         'class' => "",
                        //         'data-confirm' => Yii::t('app', 'Are you sure you want to delete {title}?', [
                        //             'title' => "\"<i>" . $model->tema . "\"</i>",
                        //         ]),
                        //         'data-method'  => 'post',
                        //     ]);
                        // },
                    ],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'visible' => ((($makus = new Makus)->findRole('peserta'))),
                    'header' => Yii::t('app', 'Registrasi'),
                    'headerOptions' => ['class' => 'header-crud'],
                    'template' => '<center>{registrasi}</center>',
                    'buttons' => [
                        'registrasi' => function ($url, $model) {
                            //Html::tag('span', '', ['class' => "", 'style' => 'color:grey', 'data-feather' => 'check'])
                            if ($model->checkRegistrasi) {
                                $result = Html::button(Html::tag('span', '', ['class' => "", 'style' => 'color:white', 'data-feather' => 'check']), [
                                    'title' => Yii::t('app', 'Registrasi'),
                                    'class' => "btn btn-info makus-btn-circle",
                                    'disabled' => 'disabled'
                                ]);
                            } else {
                                // if ($model->checkWaktu) {
                                //     $result = Html::button(Html::tag('span', '', ['class' => "", 'style' => 'color:white', 'data-feather' => 'minus']), [
                                //         'title' => Yii::t('app', 'Registrasi'),
                                //         'class' => "btn btn-warning makus-btn-circle",
                                //         'disabled' => 'disabled'
                                //     ]);
                                // } else {
                                //     $result = Html::a('', $url, [
                                //         'title' => Yii::t('app', 'Registrasi Sekarang'),
                                //         'class' => "btn btn-default makus-btn-circle",
                                //         'data-toggle' => "tooltip",
                                //         'data-placement' => "right",
                                //         'data-confirm' => Yii::t('app', 'Apakah anda yakin akan registrasi pada acara {title} ini ?', [
                                //             'title' => '"<i>' . $model->tema . '</i>"',
                                //         ]),
                                //         'data-method'  => 'post',
                                //     ]);
                                // }

                                $result = Html::a('', $url, [
                                    'title' => Yii::t('app', 'Registrasi Sekarang'),
                                    'class' => "btn btn-default makus-btn-circle",
                                    'data-toggle' => "tooltip",
                                    'data-placement' => "right",
                                    'data-confirm' => Yii::t('app', 'Apakah anda yakin akan registrasi pada acara {title} ini ?', [
                                        'title' => '"<i>' . $model->tema . '</i>"',
                                    ]),
                                    'data-method'  => 'post',
                                ]);
                            }
                            return $result;
                        },
                    ],
                ],
            ],
        ]);
    } else { ?>
        <div class="card" style="padding:16px 100px 16px 16px; width:100%;height:100vh; text-align:center;">
            Lengkapi Biodata Terlebih dahulu
            <center>
                <?= Html::a(Html::tag('span', '', ['class' => "fa fa-trash", 'style' => 'color:white', 'data-feather' => 'edit']) . Yii::t('app', 'Lengkapi Biodata'), ['/pegawai/update?id=' . Yii::$app->user->identity->id], [
                    'title' => Yii::t('app', 'Do Complete'),
                    'class' => "btn btn-info",
                    'style' => "width:200px; margin:16px;",
                    'data-confirm' => Yii::t('app', '<span style="color:red;font-weight:bold;">Perhatian.</span> Masukan Pas Foto Formal SIKEP, Lengkapi Gelar, dan seterusnya, karena biodata sebagai data untuk membuat sertifikat', [
                        'title' => "\"<i>" . Yii::$app->user->identity->pegawai->nama_lengkap . "\"</i>",
                    ]),
                    'data-method'  => 'post',
                ]); ?>
            </center>
        </div>
    <?php } ?>
    <?php Pjax::end(); ?>

</div>