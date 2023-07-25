<?php

use dominus77\sweetalert2\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pegawai */

$this->title = Yii::t('app', 'Update Pegawai: {name}', [
    'name' => $model->nama_lengkap,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pegawais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_lengkap, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

if(Yii::$app->user->identity->status==0){
    Alert::widget([
        'options' => [
            'title' => 'Lengkapi Biodata',
            'icon' => Alert::TYPE_WARNING,
            'text' => 'Lengkapi Biodata Terlebih dahulu',
        ]
    ]);
}

?>
<div class="pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>