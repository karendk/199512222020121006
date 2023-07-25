<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
?>
    
<div class="">
    <div class="">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <h3><?=Yii::$app->params['appName']?></h3>
        <center>
        <h6><?=Yii::$app->params['appDescription']?></h6>
        </center>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <a href="https://wa.me/6285772906772" target="_blank" rel="noopener noreferrer" style="color:orange">Kendala Akun? Hubungi superadmin</a>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
