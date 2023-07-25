<?php

use common\helpers\Makus;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\models\Kegiatan */

$this->title = $model::JENIS[$model->jenis];;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kegiatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$makus = new Makus;
?>
<?= $this->render('//layouts/_back_button') ?>

<style>
    @media print {
        @page {
            size: A4;
        }

        body * {
            visibility: hidden;
            transform: scale(0.90);
        }

        #print-area,
        #print-area * {
            visibility: visible;
        }

        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            margin: 0;
            padding: 0;
        }
    }

    /* .frame-sertifikat { width: 100%; height: 600px; padding: 0; overflow: hidden; } */
    /* #print-area { width: 1366px; height: 768px; } */

    /* #print-area { width: 2400px; height: 1400px; } */

    /* #print-area { width: 100%; height: 600px; } */
    /* #print-area {
        -ms-zoom: 0.6;
        -moz-transform: scale(0.6);
        -moz-transform-origin: 0 0;
        -o-transform: scale(0.6);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.6);
        -webkit-transform-origin: 0 0;
    } */

    /* #print-area {
        width: 15000px;
        height: 10000px;
        zoom: 0.5;
        transform: scale(0.5, 0.5); 
        -moz-transform: scale(0.5);
        -moz-transform-origin: 0 0;
        -o-transform: scale(0.5);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.5);
        -webkit-transform-origin: 0 0;
    } */
</style>
<!-- <script type="application/javascript">
    function resizeIFrameToFitContent(iFrame) {

        iFrame.width = iFrame.contentWindow.document.body.scrollWidth;
        iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
    }
    window.addEventListener('DOMContentLoaded', function(e) {
        var iFrame = document.getElementById('print-area');
        resizeIFrameToFitContent(iFrame);

        // or, to resize all iframes:
        var iframes = document.querySelectorAll("iframe");
        for (var i = 0; i < iframes.length; i++) {
            resizeIFrameToFitContent(iframes[i]);
        }
    });
</script> -->


<div class="kegiatan-view card makus-card table-responsive">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        // if (Helper::checkRoute('/kegiatan/delete')) {
        //     echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        //         'class' => 'btn btn-danger',
        //         'data' => [
        //             'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        //             'method' => 'post',
        //         ],
        //     ]);
        // }
        echo "&nbsp;";
        if (Helper::checkRoute('/kegiatan/update')) {
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']);
        }
        ?>
    </p>

    <?php
    // if ($model->checkRegistrasi == false && $makus->findRole('peserta')) {
    //     echo '<div style="text-align:center;"> Silahkan Registrasi kegiatan ini untuk melihat detail Acara dengan klik tombol dibawah ini:<br><br>';
    //     echo Html::a('Registrasi Sekarang', ['kegiatan/registrasi', 'id' => $model->id], [
    //         'title' => Yii::t('app', 'Registrasi Acara Ini'),
    //         'class' => "btn btn-info",
    //         'data-toggle' => "tooltip",
    //         'data-placement' => "right",
    //         'data-confirm' => Yii::t('app', 'Apakah anda yakin akan registrasi pada acara {title} ini ?', [
    //             'title' => '"<i>' . $model->tema . '</i>"',
    //         ]),
    //         'data-method'  => 'post',
    //     ]);
    //     echo '<br><br></div>';
    // } else {
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // [
            [
                'label' => 'Jumlah Peserta',
                'value' => function ($data) {
                        $result = $data->pesertaAll;
                
                    return  $result;
                },
                'format' => 'raw'
            ],    
            [
                'visible' => $makus->findRole('peserta'),
                'label' => 'Status Peserta',
                'value' => function ($data) {

                    if ($data->checkRegistrasi) {
                        $result = 'Terdaftar ' . Html::tag('button', Html::tag('span', '', ['class' => "", 'style' => 'color:white', 'data-feather' => 'check']), [
                            'title' => Yii::t('app', 'Registrasi'),
                            'class' => "btn btn-info makus-btn-circle makus-btn-sm",
                            'disabled' => 'disabled'
                        ]);
                    } else {
                        $result = 'Tidak Terdaftar ' . Html::tag('button', Html::tag('span', '', ['class' => "", 'style' => 'color:white', 'data-feather' => 'x']), [
                            'title' => Yii::t('app', 'Registrasi'),
                            'class' => "btn btn-warning makus-btn-circle makus-btn-sm",
                            'disabled' => 'disabled'
                        ]);
                    }
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
            // 'catatan:ntext',
            [
                'label' => 'Tanggal',
                'value' => function ($data) {
                    $makus = new Makus;
                    $result = $makus->dateSummary($data->tanggal_mulai, $data->tanggal_selesai);
                    return  $result;
                },
                'format' => 'raw'
            ],
            'tempat',
            [
                'attribute' => 'catatan',
                'value' => function ($data) {
                    $result = $data->catatan;
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'visible' => $model->url_materi != null || $model->url_materi != '',
                'label' => 'Materi',
                'value' => function ($data) {
                    $result = '<div class="stage">
                    <a href="' . $data->url_materi . '" target="_blank" rel="noopener noreferrer" class="makus-btn-stage">Unduh Materi</a>
                </div>';
                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'visible' => $model->url_jadwal != null || $model->url_jadwal != '',
                'label' => 'Jadwal',
                'value' => function ($data) {
                    // $result = '<div class="stage">
                    //     <a href="' . $data->url_jadwal . '" target="_blank" rel="noopener noreferrer" class="makus-btn-stage">Unduh Jadwal</a>
                    // </div>';
                    $result = '<iframe src="' . $data->url_jadwal . '" width="100%" height="600px" allow="autoplay"></iframe>';

                    return  $result;
                },
                'format' => 'raw'
            ],
            [
                'visible' => $model->checkRegistrasi || $makus->findRole('admin') || $makus->findRole('superadmin'),
                // 'visible' => $makus->findRole('admin') || $makus->findRole('superadmin'),
                'label' => 'Sertifikat',
                'value' => function ($data) {
                    // if ($data->checkRegistrasi) {
                    //     $result = '<div class="card" style="padding:16px">
                    //     <iframe src="' . Url::to(['kegiatan/sertifikat?type=view&id=']) . $data->id . '" id="print-area" onload="javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+\"px\";}(this));" style="height:400px;width:100%;border:none;overflow:hidden;" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
                    // </div>
                    // <center>
                    //     <div class="stage" style="margin:0 16px 0 50px">
                    //         <a href="' . Url::to(['kegiatan/sertifikat?type=print&id=']) . $data->id . '" target="_blank" rel="noopener noreferrer" class="makus-btn-stage"><i data-feather="download"></i>
                    //             Download</a>
                    //     </div>
                    // </center>';
                    // } else {
                    //     $result = 'Tidak Terdaftar ' . Html::tag('button', Html::tag('span', '', ['class' => "", 'style' => 'color:white', 'data-feather' => 'x']), [
                    //         'title' => Yii::t('app', 'Registrasi'),
                    //         'class' => "btn btn-warning makus-btn-circle makus-btn-sm",
                    //         'disabled' => 'disabled'
                    //     ]);
                    // }
                    $result = "";
                    if ($data->is_certificate_manual == 1) {
                        $result = '
                            <iframe src="' . Url::to(['/']) . 'plugin/ViewerJS/#../../uploads/sertifikat/' . $data->id . '/' . Yii::$app->user->identity->pegawai->nip . '.pdf" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
                            <iframe src="' . Url::to(['/']) . 'plugin/ViewerJS/#../../uploads/sertifikat/' . $data->id . '/belakang.pdf" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
                        ';
                    } else {
                        $result = '<div class="card" style="padding:16px">
                        <iframe src="' . Url::to(['kegiatan/sertifikat?type=view&id=']) . $data->id . '" id="print-area" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
                        </div>
                        <center>
                            <div class="stage" style="margin:0 16px 0 50px">
                                <a href="' . Url::to(['kegiatan/sertifikat?type=print&id=']) . $data->id . '" target="_blank" rel="noopener noreferrer" class="makus-btn-stage"><i data-feather="download"></i>
                                    Download</a>
                            </div>
                        </center>';
                    }
                    return  $result;
                },
                'format' => 'raw'
            ],
        ],
    ]);
    // }
    ?>
</div>
<?php
// $js .= "
//     function dafLog(title,id){
//         request=$.ajax({
//             type: 'POST',
//             url: '" . Url::to(['permohonan/log']) . "',
//             data:{
//                 penawaran_id:id,
//                 // '_csrf': '" . Yii::$app->request->getCsrfToken() . "',
//             },
//             dataType:'json',
//             success: function(r){
//                 var html=''
//                 html+='<div class=\"table-responsive\" style=\"height:100%;padding:0;\">'

//                 html+='<div class=\"\" style=\"height:100%;\">'
//                 html+='<table class=\"halign-center\" style=\"margin:16px;\">'
//                 html+='<thead></thead>'
//                 html+='<tbody>'
//                 html+='<tr>'
//                 html+='<td style=\"width:0px;font-weight:600;\">" . Yii::t('app', 'Activity Title') . "</td>'
//                 html+='<td style=\"width:30px;text-align:center\"> : </td>'
//                 html+='<td>'+r.dafLog[0].dafPenawaran.judul_penawaran+'</td>'
//                 html+='</tr>'
//                 html+='<tr>'
//                 html+='<td style=\"width:0px;font-weight:600;\">" . Yii::t('app', 'Country') . " / " . Yii::t('app', 'City') . "</td>'
//                 html+='<td style=\"width:30px;text-align:center\"> : </td>'
//                 html+='<td>'+r.dafLog[0].dafPenawaran.tempat+'</td>'
//                 html+='</tr>'
//                 html+='<tr>'
//                 html+='<td style=\"width:0px;font-weight:600;\">" . Yii::t('app', 'Activity Date') . "</td>'
//                 html+='<td style=\"width:30px;text-align:center\"> : </td>'
//                 html+='<td>'+r.dafLog[0].dafPenawaran.tanggal+'</td>'
//                 html+='</tr>'
//                 html+='<tr>'
//                 html+='<td style=\"width:0px;font-weight:600;\">" . Yii::t('app', 'Classification') . "</td>'
//                 html+='<td style=\"width:30px;text-align:center\"> : </td>'
//                 html+='<td>'+r.dafLog[0].dafPenawaran.jenisKlasifikasiKeg.nama+'</td>'
//                 html+='</tr>'
//                 html+='<tr>'
//                 html+='<td style=\"width:0px;font-weight:600;\">" . Yii::t('app', 'Fund') . "</td>'
//                 html+='<td style=\"width:30px;text-align:center\"> : </td>'
//                 html+='<td>'+r.dafLog[0].dafPenawaran.jenisStatusDana.nama+'</td>'
//                 html+='</tr>'
//                 html+='</tbody>'
//                 html+='</table>'

//                 html+='<div class=\"log-title\">" . Yii::t('app', '{subject} {verb}', ['subject' => Yii::t('app', 'PROCESS'), 'verb' => 'LOG']) . "</div>'
//                 html+='<table class=\"table table-striped table-bordered table-hover halign-center\" style=\"margin:0%;padding:0;\">'
//                 html+='<thead><tr>'
//                 html+='<th>" . Yii::t('app', 'No.') . "</th>'
//                 html+='<th>" . Yii::t('app', 'Created at') . "</th>'
//                 html+='<th>" . Yii::t('app', 'Status') . "</th>'
//                 // html+='<th>" . Yii::t('app', 'Title') . "</th>'
//                 html+='<th>" . Yii::t('app', 'By') . "</th>'
//                 html+='</tr></thead>'
//                 html+='<tbody>'
//                 $.each(r.dafLog, function(key, value) {
//                     // console.log(value.dafUser)
//                     var nama=value.dafUser.masterPegawai?value.dafUser.masterPegawai.nama:'-'
//                     html+='<tr>'
//                     html+='<td style=\"text-align:right;vertical-align:top;\">'+(key+1)+'</td>'
//                     html+='<td nowrap=\"nowrap\">'+value.dibuat_pada+'</td>'
//                     html+='<td nowrap=\"nowrap\">'+value.jenisStatusPenawaran.nama+'</td>'
//                     // html+='<td>'+value.dafPenawaran.judul_penawaran+'</td>'
//                     html+='<td>'+nama+'</td>'
//                     html+='</tr>'
//                 })
//                 html+='</tbody>'
//                 html+='</table>'
//                 if(r.dafDisposisi!=''){
//                     html+='</br></br>'
//                     html+='<div class=\"log-title\">" . Yii::t('app', '{subject} {verb}', ['subject' => Yii::t('app', 'DISPOSITION'), 'verb' => 'LOG']) . "</div>'
//                     html+='<table class=\"table table-striped table-bordered table-hover halign-center\" style=\"margin:0%;padding:0;\">'
//                     html+='<thead><tr>'
//                     html+='<th>" . Yii::t('app', 'No.') . "</th>'
//                     html+='<th>" . Yii::t('app', 'Created at') . "</th>'
//                     html+='<th nowrap=\"nowrap\">" . Yii::t('app', 'Document Status') . "</th>'
//                     html+='<th nowrap=\"nowrap\">" . Yii::t('app', 'Disposition Status') . "</th>'
//                     // html+='<th>" . Yii::t('app', 'Title') . "</th>'
//                     html+='<th>" . Yii::t('app', 'Disposition') . "</th>'
//                     html+='</tr></thead>'
//                     html+='<tbody>'
//                     $.each(r.dafDisposisi, function(key, value) {
//                         html+='<tr>'
//                         html+='<td style=\"text-align:right;vertical-align:top;\">'+(key+1)+'</td>'
//                         html+='<td nowrap=\"nowrap\">'+value.dibuat_pada+'</td>'
//                         html+='<td nowrap=\"nowrap\">'+value.jenisStatusPenawaran.nama+'</td>'
//                         if(value.status_disposisi=='1'){
//                             status_disposisi='sudah'
//                         }else{
//                             status_disposisi='belum'
//                         }
//                         html+='<td nowrap=\"nowrap\">'+status_disposisi+'</td>'
//                         // html+='<td>'+value.dafPenawaran.judul_penawaran+'</td>'
//                         html+='<td>'+value.dafUnit.ket+'</td>'
//                         html+='</tr>'
//                     })
//                     html+='</tbody>'
//                     html+='</table>'
//                 }
//                 if(r.dafPersonil!=''){
//                     html+='</br></br>'
//                     html+='<div class=\"log-title\">" . Yii::t('app', '{subject} {verb}', ['subject' => Yii::t('app', 'FORM'), 'verb' => 'LOG']) . "</div>'
//                     html+='<table class=\"table table-striped table-bordered table-hover halign-center\" style=\"margin:0%;padding:0;\">'
//                     html+='<thead><tr>'
//                     html+='<th>" . Yii::t('app', 'No.') . "</th>'
//                     html+='<th>" . Yii::t('app', 'Created at') . "</th>'
//                     html+='<th nowrap=\"nowrap\">" . Yii::t('app', 'Document Status') . "</th>'
//                     html+='<th nowrap=\"nowrap\">" . Yii::t('app', 'Complete Status') . "</th>'
//                     // html+='<th>" . Yii::t('app', 'Title') . "</th>'
//                     html+='<th>" . Yii::t('app', 'Staff/Unit') . "</th>'
//                     html+='</tr></thead>'
//                     html+='<tbody>'
//                     $.each(r.dafPersonil, function(key, value) {
//                         var nama=value.masterPegawai?value.masterPegawai.nama:'-'
//                         html+='<tr>'
//                         html+='<td style=\"text-align:right;vertical-align:top;\">'+(key+1)+'</td>'
//                         html+='<td nowrap=\"nowrap\">'+value.dibuat_pada+'</td>'
//                         html+='<td nowrap=\"nowrap\">'+value.jenisStatusPenawaran.nama+'</td>'
//                         if(value.status_kelengkapan=='1'){
//                             status_kelengkapan='sudah'
//                         }else{
//                             status_kelengkapan='belum'
//                         }
//                         html+='<td nowrap=\"nowrap\">'+status_kelengkapan+'</td>'
//                         // html+='<td>'+value.dafPenawaran.judul_penawaran+'</td>'
//                         // html+='<td>'+value.nip_tujuan+'</td>'
//                         html+='<td>'+nama+'</td>'
//                         html+='</tr>'
//                     })
//                     html+='</tbody>'
//                     html+='</table>'
//                 }
//                 html+='</div>'
//                 title=''
//                 alertify.alert(title,html)
//                     // .maximize()
//                     .set({transition:'zoom'}).show() 
//                     .set('padding',false)
//                     .set('resizable', true)
//                     .set('maximizable', true)
//                     .set('overflow',false)
//                     .resizeTo('70%','70%')
//                     .set('label', '" . Yii::t('app', 'Back') . "')
//                 // console.log(r)
//             },
//             error:function(r) {
//                 console.log(r)
//             }
//         })
//     }
//     ";

// $this->registerJs($js, View::POS_END);
?>