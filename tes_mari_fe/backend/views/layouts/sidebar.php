<?php

use common\helpers\Makus;
use yii\helpers\Url;
use mdm\admin\components\Helper;
use yii\bootstrap4\Html;

$makus = new Makus();

?>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= Url::to(['/']) ?>">
            <img src="<?= Url::to(['/']) ?>uploads/icon/apple-touch-icon.png" alt="" srcset="" width="32px" height="32px" style="box-shadow: 0px 0px 1px #000;border-radius:100%; margin:3px;">
            <span class="align-middle"><?=strtoupper(Yii::$app->params['appName'])?></span>
        </a>

        <ul class="sidebar-nav">
            <?php
            if (!Yii::$app->user->isGuest) {

                echo ' <li class="sidebar-header">Profile</li>';

                if (Helper::checkRoute('/site/index')) {
                    echo '<li class="sidebar-item">' . Html::a(
                        '<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>',
                        ['/site/index'],
                        [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "sidebar-link"
                        ]
                    ) . '</li>';
                }

                if ($makus->findRole('panitia') || $makus->findRole('peserta')) {
                    echo '<li class="sidebar-item active">' . Html::a(
                        '<i class="align-middle" data-feather="user"></i> <span class="align-middle">Biodata</span>',
                        ['/pegawai/view?id=' . Yii::$app->user->identity->id],
                        [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "sidebar-link"
                        ]
                    ) . '</li>';
                }

                echo ' <li class="sidebar-header">JSON</li>';
                echo '<li class="sidebar-item '.($makus->urlSegment(0) == 'rekrutment' ? 'active' : '').'">' . Html::a(
                    '<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Daftar Rekrutmen</span>',
                    ['/izin/index'],
                    [
                        'title' => Yii::t('app', 'Do view'),
                        'class' => "sidebar-link"
                    ]
                ) . '</li>';

                if (Helper::checkRoute('/pegawai/index')) {
                    echo ' <li class="sidebar-header">Kepegawaian</li>';
                }
                if (Helper::checkRoute('/pegawai/index')) {
                    echo '<li class="sidebar-item '.($makus->urlSegment(0) == 'pegawai' ? 'active' : '').'">' . Html::a(
                        '<i class="align-middle" data-feather="users"></i> <span class="align-middle">Pegawai</span>',
                        ['/pegawai/index'],
                        [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "sidebar-link"
                        ]
                    ) . '</li>';
                }

                if (Helper::checkRoute('/rbac/*')) {
                    echo ' <li class="sidebar-header">Superadmin</li>';
                }
                if (Helper::checkRoute('/gii/*')) {
                    echo '<li class="sidebar-item">' . Html::a(
                        '<i class="align-middle" data-feather="database"></i> <span class="align-middle">GII</span>',
                        ['/gii'],
                        [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "sidebar-link"
                        ]
                    ) . '</li>';
                }

                if (Helper::checkRoute('/rbac/*')) {
                    echo '<li class="sidebar-item">' . Html::a(
                        '<i class="align-middle" data-feather="users"></i> <span class="align-middle">RBAC</span>',
                        ['/rbac'],
                        [
                            'title' => Yii::t('app', 'Do view'),
                            'class' => "sidebar-link"
                        ]
                    ) . '</li>';
                }
            }
            ?>
        </ul>
    </div>
</nav>