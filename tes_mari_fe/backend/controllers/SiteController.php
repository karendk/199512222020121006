<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'tes'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'jadwal', 'sertifikat', 'tes', 'manual-book'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionJadwal()
    {
        return $this->render('jadwal');
    }

    public function actionSertifikat($type=null)
    {
        // return $this->render('//template/_sertifikat');
        if(($type)==null) {
            return $this->render('sertifikat');
        }else
        if ($type == 'view') {
            return $this->renderPartial('//template/_sertifikat');
        }else if ($type == 'print') {
            return $this->renderPartial('//template/_sertifikat_print');
        }
    }

    public function actionManualBook()
    {
        // echo "Karen keren";die();
        return $this->render('manual_book');
    }

    public function actionTes()
    {
        echo Yii::$app->security->generatePasswordHash("bismillah");die();
        $result=User::find()
        ->where('status=1')
        ->count();
        var_dump($result);die();
        // get your HTML raw content without any layouts or scripts
        // $content = $this->renderPartial('//template/_sertifikat');
        // $content = $this->renderPartial('_sertifikat');
        $content='<div>Karen Keren</div>';

        // // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            // 'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'CIA - Certificate Integrated Application'],
            // call mPDF methods on the fly
            // 'methods' => [ 
            //     'SetHeader'=>['Krajee Report Header'], 
            //     'SetFooter'=>['{PAGENO}'],
            // ]
        ]);

        // $pdf = new Pdf; // or new Pdf();
        // $content='<img src="/uploads/bg.png">';
        // $content='<img src="/uploads/bg.jpg"> Karen Keren Dong';
        $mpdf = $pdf->api; // fetches mpdf api
        // $mpdf->SetHeader('Kartik Header'); // call methods or set any properties
        $mpdf->WriteHtml($content); // call mpdf write html
        $mpdf->useSubstitutions = false;
        echo $mpdf->Output(Yii::$app->user->identity->nip . '.pdf', 'D'); // call the mpdf api output as needed

        // return the pdf output as per the destination setting
        // return $pdf->render(); 
    }
}
