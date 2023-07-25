<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Izin $model */

$this->title = 'Ubah Form Izin';
$this->params['breadcrumbs'][] = ['label' => 'Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Izin ".$model::JENIS[$model->jenis], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="izin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
