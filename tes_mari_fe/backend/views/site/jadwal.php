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

$this->title = Yii::t('app', 'Jadwal');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index card" style="padding:16px">
    <iframe src="<?= Url::to(['/']) ?>plugin/ViewerJS/#../../uploads/jadwal.pdf" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>
</div>
<div class="stage">
    <a href="https://drive.google.com/drive/folders/1z8eIZLg5vJDEpLYtAKQUvv81CnoQcac6?usp=sharing" target="_blank" rel="noopener noreferrer" class="makus-btn-stage">Kumpulan Materi</a>
</div>