<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Izin $model */

$this->title = 'Form Pengajuan Izin';
$this->params['breadcrumbs'][] = ['label' => 'Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="izin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
