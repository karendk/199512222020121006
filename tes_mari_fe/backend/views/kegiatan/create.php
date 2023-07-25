<?php
//<</*
 // @ Author: Karen Dharmakusuma
 // @ Description: karendk.github.io
 // @ Email: karenmakus@gmail.com
 // @ Modified by: Karen Dharmakusuma
 // @ Create Time: 2022-06-05 14:55:31
 // @ Modified time: 2022-06-05 21:01:31
 //>>*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kegiatan */

$this->title = Yii::t('app', 'Tambah Kegiatan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kegiatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
