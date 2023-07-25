<?php
use yii\helpers\Html;
?>
<div class="box-footer text-right">
<?php 
    // echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-secondary','style'=>'color:white']);
    // echo "&nbsp;&nbsp;";
    echo Html::submitButton($text??'Simpan', ['class' => 'btn btn-info']);
?>
</div>