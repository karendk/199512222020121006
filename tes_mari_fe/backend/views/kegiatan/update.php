<?php
//<</*
 // @ Author: Karen Dharmakusuma
 // @ Description: karendk.github.io
 // @ Email: karenmakus@gmail.com
 // @ Modified by: Karen Dharmakusuma
 // @ Create Time: 2022-06-05 14:55:31
 // @ Modified time: 2022-06-05 21:01:05
 //>>*/
 
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kegiatan */

$this->title = Yii::t('app', 'Update Kegiatan: {name}', [
    'name' => $model->tema,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kegiatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tema, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
