<?php 
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
?>
<main class="content">
    <div class="container-fluid p-0">

    <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
    <?= $content ?>
    </div>
</main>