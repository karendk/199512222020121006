<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Manual Book';
?>
<h1 class="h3 mb-3"><?=$this->title?></h1>
<iframe src="<?=Url::to(['/']) . 'plugin/ViewerJS/#../../uploads/manual_book.pdf' ?>" width="100%" height="600px" allowfullscreen webkitallowfullscreen></iframe>