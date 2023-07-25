<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Izin $model */

$this->title = 'Tolak';
$this->params['breadcrumbs'][] = ['label' => 'Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Izin ".$model::JENIS[$model->jenis], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Tolak';
?>
<div class="tolak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_tolak', [
        'model' => $model,
    ]) ?>

</div>
