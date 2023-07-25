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
 * PegawaiController implements the CRUD actions for Pegawai model.
 */
class PegawaiController extends Controller
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
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pegawai model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pegawai();
        $model->scenario = 'create';
        $mUser = new User();
        // var_dump($this->request->post());
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $mUser->id = $model->id;
                $mUser->nip = $model->nip;
                $mUser->username = $model->nip;
                $mUser->nik = $model->nik;
                $mUser->status = 0;
                $mUser->satker_id = $model->satker_id;
                $mUser->password = Yii::$app->security->generatePasswordHash("12345678");
                $mUser->save(false);

                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        // if($model->foto==''||$model->foto==null){
        // $model->scenario = 'update';
        // }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $mUser = User::find()
                // ->where('nip=' . $model->nip)
                ->where([
                    'AND',
                    ['=', 'nip', $model->nip],
                ])
                ->one();
            $mUser->status = 1;
            $mUser->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pegawai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = 0;
        $model->save(false);

        return $this->redirect(['index']);
    }

    public function actionUploadFile($id)
    {
        $makus = new Makus();
        $preview = [];
        $config = [];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        $model->tempFoto = UploadedFile::getInstances($model, 'tempFoto');
        if ($model->tempFoto) {
            foreach ($model->tempFoto as $key => $value) {
                $value->name = $makus->fileName($value, Yii::$app->user->identity->nip);
                $mPegawai = $this->findModel($id);
                $fileNameOld = $mPegawai->foto;
                $mPegawai->foto = $value->name;

                if ($mPegawai->save()) { //jika doc bisa di save maka upload
                    $mPegawai->uploadReplace($value, $fileNameOld);

                    $path = Url::to(['/']) . Yii::$app->params['pathFoto'];
                    // var_dump($mPegawai->save());
                    // die();
                    $ext = $makus->fileType($value->name);
                    $preview[] = $path . $value->name;

                    $config[] = [
                        'type' => $ext,
                        'key' => $mPegawai->id,
                        'caption' => $mPegawai->foto,
                        'size' => @filesize(Yii::$app->params['pathFotoUpload'] . $mPegawai->foto),
                        'downloadUrl' => Url::to(['/']) . Yii::$app->params['pathFoto'] . $mPegawai->foto,
                    ];
                    if ($ext != 'image') {
                        $config[0]['showZoom'] = false;
                    }
                }
            }
            $initial = [
                'initialPreview' => $preview,
                'initialPreviewConfig' => $config,
                'initialPreviewAsData' => true,
                // 'pdfRendererUrl' => Url::to(['plugin/ViewerJS/index.html#../../']),
                // 'pdfRendererTemplate' => '<iframe class="kv-preview-data file-preview-pdf" src="{renderer}{data}" {style}></iframe>',
                'hideThumbnailContent' => true, // hide image, pdf, text or other content in the thumbnail preview
                'theme' => 'explorer',
            ];
        } else {
            $initial = [];
        }

        if (empty($initial)) {
            $initial['error'] = 'Oh snap! We could not upload. Please try again later.';
        }
        $result = $initial;
        return $result;
    }

    public function actionDeleteFile($key)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = [];
        // $key = Yii::$app->request->post('key');
        // var_dump($key);
        // die();
        $mPegawai = $this->findModel($key);
        $fileNameOld = $mPegawai->foto;
        $mPegawai->foto = '';
        if ($mPegawai->save(false)) {
            if (file_exists(Yii::$app->params['pathFotoUpload'] . $fileNameOld)) {
                @unlink(Yii::$app->params['pathFotoUpload'] . $fileNameOld);
            }
            $mUser = User::find()
                ->where('nip=' . $mPegawai->nip)
                ->one();
            $mUser->status = 0;
            $mUser->save(false);
            $result['status'] = "terhapus";
        } else {
            $result['status'] = "gagal";
        }

        return $result;
    }

    public function actionUploadSignature()
    {
        $data = $_POST['tanda_tangan'];
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        // var_dump($_POST['tanda_tangan']);die();

        if (!file_exists(Yii::$app->params['pathTandaTanganUpload'])) {
            mkdir(Yii::$app->params['pathTandaTanganUpload'], 0777, true);
        }

        file_put_contents(Yii::$app->params['pathTandaTanganUpload'] . Yii::$app->user->identity->nip . '.png', $data);


        $mPegawai = $this->findModel($_POST['id']);
        $mPegawai->tanda_tangan=$_POST['tanda_tangan'];
        $mPegawai->save(false);
    }

    /**
     * Finds the Pegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $makus = new Makus();
        $model = Pegawai::find();
        if ($makus->findRole('pelaksana') || $makus->findRole('panitia')) {
            $model = $model
                ->where([
                    'AND',
                    ['=', 'nip', Yii::$app->user->identity->nip],
                ])
                ->one();
        } else {
            $model = $model
                ->where([
                    'AND',
                    ['=', 'id', $id],
                ])
                ->one();
        }

        if (($model) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
