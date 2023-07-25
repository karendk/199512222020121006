<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\web\View;

$this->registerJs("
        //replace alert dengan alertify
        yii.confirm = function (message, okCallback, cancelCallback) {
            alertify.confirm('".Html::encode($this->title)."', message, 
                okCallback,
                cancelCallback,
                // function factory(){
                //     return{
                //         build:function(){
                //             var errorHeader='<span class=\"fa fa-times-circle fa-2x\" '
                //                 +'style=\"vertical-align:middle;color:#e10000;\">'
                //                 +'</span> Application Error'
                //             this.setHeader(errorHeader)
                //         }
                //     }
                // },
            )
            .setHeader('<span class=\"fa fa fa-warning fa-2x\" '
                +'style=\"vertical-align:middle;color:#FADA5E;margin-right:15px\">'
                +'</span> '+'".Html::encode($this->title)."')
            .set('modal', true)
            .set('maximizable', true)
            .set('resizable', true)
            .set('padding',true)
            .set({transition:'pulse'}).show() 
            .set('labels', {ok:'".Yii::t('app', 'Yes')."', cancel:'".Yii::t('app', 'Cancel')."'})
        }
        ",View::POS_END);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="<?=Url::to(['/'])?>favicon.ico" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <?php AppAsset::register($this); ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <!-- <div id="preloader"> 
        <div id="status">
            Karen Keren
        </div> 
    </div> -->
    <div class="wrapper">
        <?= $this->render(
            'sidebar.php',
            // ['directoryAsset' => $directoryAsset]
        )
        ?>
        <div class="main">
            <?= $this->render(
                'navbar.php',
                // ['directoryAsset' => $directoryAsset],
            ) ?>
            <?= $this->render(
                'content.php',
                ['content' => $content],
                // ['content' => $content, 'directoryAsset' => $directoryAsset],
            ) ?>
            <?= $this->render(
                'footer.php',
                // ['directoryAsset' => $directoryAsset],
            ) ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage(); ?>