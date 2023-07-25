<?php

namespace backend\controllers;

use backend\models\Pegawai;
use backend\models\PegawaiSearch;
use common\helpers\Makus;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * JsonController implements the CRUD actions for Pegawai model.
 */
class JsonController extends Controller
{
    /**
     * @inheritDoc
     */
    // public $makus;

    // public function init() {
    //     $this->makus=new Makus();
    // }
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pegawai models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('rekrutmen');
    }

    public function actionIndex()
    {
        return $this->render('rekrutmen');
    }
}
