<?php

use backend\models\Pegawai;
use common\components\MyPagination;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sertifikat');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #print-area,
        #print-area * {
            visibility: visible;
        }

        #print-area {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
<script type="application/javascript">
    // function resizeIFrameToFitContent(iFrame) {

    //     iFrame.width = iFrame.contentWindow.document.body.scrollWidth;
    //     iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
    // }
    // window.addEventListener('DOMContentLoaded', function(e) {
    //     var iFrame = document.getElementById('print-area');
    //     resizeIFrameToFitContent(iFrame);

    //     // or, to resize all iframes:
    //     var iframes = document.querySelectorAll("iframe");
    //     for (var i = 0; i < iframes.length; i++) {
    //         resizeIFrameToFitContent(iframes[i]);
    //     }
    // });
</script>
<?php if (Yii::$app->user->identity->status == 1) { ?>
    <!-- <div class="card" style="padding:16px">
        <iframe src="<?php //= Url::to(['site/sertifikat?type=view']) ?>" id="print-area" onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="height:200px;width:100%;border:none;overflow:hidden;" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
    </div>
    <center>
        <div class="stage" style="margin:0 16px 0 50px">
            <a href="<?php //= Url::to(['site/sertifikat?type=print']) ?>" target="_blank" rel="noopener noreferrer" class="makus-btn-stage" ><i data-feather="download"></i>
                Download</a>
        </div>
    </center> -->
    <iframe src="<?= Url::to(['/']) ?>plugin/ViewerJS/#../../uploads/sertifikat/manual/<?=Yii::$app->user->identity->pegawai->nip?>.1.pdf" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
    <iframe src="<?= Url::to(['/']) ?>plugin/ViewerJS/#../../uploads/sertifikat/manual/<?=Yii::$app->user->identity->pegawai->nip?>.2.pdf" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
<?php } else { ?>
    <div class="card" style="padding:16px 100px 16px 16px; width:100%;height:100vh; text-align:center;">
        Lengkapi Biodata Terlebih dahulu
        <center>
        <?= Html::a(Html::tag('span', '', ['class' => "fa fa-trash", 'style' => 'color:white','data-feather'=>'edit']) . Yii::t('app', 'Lengkapi Biodata'), ['/pegawai/view?id=' . Yii::$app->user->identity->id], [
            'title' => Yii::t('app', 'Do Complete'),
            'class' => "btn btn-info",
            'style'=>"width:200px; margin:16px;",
            'data-confirm' => Yii::t('app', '1. Klik tombol update berwarna biru<br>2. Klik tombol save berwarna tosca', [
                'title' => "\"<i>" . Yii::$app->user->identity->pegawai->nama_lengkap . "\"</i>",
            ]),
            'data-method'  => 'post',
        ]); ?>
        </center>
    </div>
<?php } ?>