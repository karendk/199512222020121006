<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\IzinSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="izin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nip_pengaju') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'keperluan') ?>

    <?= $form->field($model, 'jam_mulai') ?>

    <?php // echo $form->field($model, 'jam_akhir') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'nip_atasan') ?>

    <?php // echo $form->field($model, 'alasan_tolak') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
