<?php
//<</*
// @ Author: Karen Dharmakusuma
// @ Description: karendk.github.io
// @ Email: karenmakus@gmail.com
// @ Modified by: Karen Dharmakusuma
// @ Create Time: 2022-06-05 14:55:31
// @ Modified time: 2022-06-06 02:49:07
//>>*/

use backend\models\Pegawai;
use common\helpers\Makus;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Kegiatan */
/* @var $form yii\widgets\ActiveForm */

$makus = new Makus();

/* -------------------------------------------------------------------------- */
/*                                  KETUA PTA                                 */
/* -------------------------------------------------------------------------- */
$ketuaPta = Pegawai::find()
    ->where([
        'AND',
        ['=', 'jabatan', 'Ketua'],
        ['=', 'satker_id', 576260]
    ])
    ->all();
$ketuaPtaList = [];
foreach ($ketuaPta as $key => $value) {
    $ketuaPtaList[$value['nip']] = $value['nama_lengkap'];
}
/* -------------------------------------------------------------------------- */
/*                                    KETUA                                   */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                KETUA PANITIA                               */
/* -------------------------------------------------------------------------- */
$ketuaPanitia = Pegawai::find()
    ->where([
        'AND',
        // ['=', 'jabatan', 'Ketua'],
        ['=', 'satker_id', 576260]
    ])
    ->all();
$ketuaPanitiaList = [];
foreach ($ketuaPanitia as $key => $value) {
    $nama = ($value['gelar_depan'] != null ? $value['gelar_depan'] . ',' : '');
    $nama .= ($value['nama_lengkap']);
    $nama .= ($value['gelar_belakang'] != null ? ', ' . $value['gelar_belakang'] : '');
    $ketuaPanitiaList[$value['nip']] = $nama;
}
/* -------------------------------------------------------------------------- */
/*                                KETUA PANITIA                               */
/* -------------------------------------------------------------------------- */

/* ------------------------------- untuk form ------------------------------- */
$this->registerAssetBundle('backend\assets\FormAsset');
?>

<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>

    <?php $form = ActiveForm::begin();
    echo '<div class="kegiatan-form card makus-card">';
    echo $form->field($model, 'jenis')->dropDownList($model::JENIS, [
        'prompt' => Yii::t('app', '--Select--'),
        'class' => 'form-control select2'
    ]);
    echo $form->field($model, 'tema')->textInput(['maxlength' => true]);

    echo $form->field($model, 'tempat')->textInput(['maxlength' => true]);

    $fieldOptionDate = [
        'inputOptions' => [
            'class' => 'form-control datepicker'/* ,'data-date-start-date'=>'0d' */,
            'placeholder' => 'Tahun-Bulan-Tanggal',
        ],
        'template' => '
        <div class="form-group">
            {label}{input}
        </div>'
    ];
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    echo $form->field($model, 'tanggal_mulai', $fieldOptionDate)->textInput();
    echo '</div ><div class="col-md-6">';
    echo $form->field($model, 'tanggal_selesai', $fieldOptionDate)->textInput();
    echo '</div></div>';
    echo $form->field($model, 'catatan')->textArea(['rows' => 6, 'maxlength' => true, 'class' => 'editor']);



    /* if ($model->id) {
        echo '<div class="row">';
        echo '<div class="col-12 col-lg-6">';
        echo $form->field($model, 'tempJadwal')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'application/pdf',
                'multiple' => false,
            ],
            'pluginOptions' => [
                'initialPreview' => $model->jadwalUrl,
                'initialPreviewAsData' => true,
                'validateInitialCount' => true,
                'initialPreviewConfig' => $model->jadwalPreview,
                'overwriteInitial' => true,
                'deleteUrl' => Url::to(['kegiatan/delete-jadwal']) . "?id=" . Yii::$app->request->get('id'),
                'uploadUrl' => Url::to(['kegiatan/upload-jadwal']) . "?id=" . Yii::$app->request->get('id'),
                'allowedFileExtensions' => ['pdf'],
                'maxFileSize' => 1024 * 8,
                'uploadAsync' => true,
                'showUpload' => false, // hide upload button
                'showRemove' => false, // hide remove button
                'showCancel' => false,
                'showDownload' => true,
                'showBrowse' => false,
                'browseOnZoneClick' => true,
                'browseLabel' => Yii::t("app", "Upload"),
                'pdfRendererUrl' => Url::to(['plugin/ViewerJS/index.html#../../']),
                'pdfRendererTemplate' => '<iframe class="kv-preview-data file-preview-pdf" src="{renderer}{data}" {style}></iframe>',
                'preferIconicPreview' => false,
                'previewZoomButtonIcons' => [
                    'prev' => '',
                    'next' => '',
                ],
                'fileActionSettings' => [
                    'showDrag' => false,
                ],
            ],
            'pluginEvents' => [
                'filepredelete' => "function(event, key){return (!confirm('" . Yii::t('app', 'Are you sure you want to delete this?') . "'))}",
                //UPLOAD OTOMATIS
                'filebatchselected' => 'function(event, files) {
                // $(".fileinput-upload-button").click()
                $(".kv-file-upload").click()
            }',
                'fileuploaded' => "function(event, previewId, index, fileId){
                // console.log('File uploaded', previewId, index, fileId)
                $('.kv-zoom-cache').hide()
            }",
            ],
        ]);
        echo ('<div class="help-block"></div><br>') . Yii::t('app', 'Maximum file is 8MB') . "<br>" . Yii::t('app', 'File is application: pdf.');
        echo '</div>';

        echo '<div class="col-12 col-lg-6">';
        
        echo $form->field($model, 'tempMateri[]')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/jpeg,image/jpg,image/png,image/bmp,application/pdf,.doc,.docx,.xls,.xlsx',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'initialPreview'=>$model->materiUrl,
                'initialPreviewAsData'=>true,
                'validateInitialCount'=>true,
                'initialPreviewConfig' =>$model->materiPreview,
                'overwriteInitial'=>false,
                'deleteUrl'=>Url::to(['kegiatan/delete-materi']),
                'uploadUrl' => Url::to(['kegiatan/upload-materi'])."?id=".Yii::$app->request->get('id'),
                'uploadExtraData'=>['kegiatan_id'=>$model->id],
                'allowedFileExtensions'=>['jpg','jpeg','png','bmp','pdf','doc','docx','xls','xlsx','ppt','pptx'],
                'maxFileSize'=>1024*8,
                'maxFileCount'=> 5, //max 5
                'uploadAsync'=>true,
                'showUpload' => false, // hide upload button
                'showRemove' => false, // hide remove button
                'showCancel' => false,
                'showDownload' => true,
                'showBrowse' => false,
                'browseOnZoneClick' => true,
                'browseLabel'=>Yii::t("app","Upload"),
                'pdfRendererUrl'=>Url::to(['plugin/ViewerJS/index.html#../../']),
                'pdfRendererTemplate'=>'<iframe class="kv-preview-data file-preview-pdf" src="{renderer}{data}" {style}></iframe>',
                'preferIconicPreview'=>true,
                'previewFileIconSettings'=>[// configure your icon file extensions
                    'doc'=>'<i class="fa fa-file-text text-primary"></i>',
                    'docx'=>'<i class="fa fa-file-text text-primary"></i>',
                    'xls'=>'<i class="fa fa-table text-success"></i>',
                    'xlsx'=>'<i class="fa fa-table text-success"></i>',
                    'ppt'=>'<i class="fa fa-table text-success"></i>',
                    'pptx'=>'<i class="fa fa-table text-success"></i>',
                    'pdf'=>'<i class="fa fa-file text-danger"></i>',
                    'jpg'=>'<i class="fa fa-image text-warning"></i>', 
                    'jpeg'=>'<i class="fa fa-image text-warning"></i>', 
                    'png'=>'<i class="fa fa-image text-warning"></i>'    
                ],
                'previewZoomButtonIcons'=>[
                    'prev'=>'',
                    'next'=>'',
                ],
                'fileActionSettings'=>[
                    'showDrag'=>false,
                ],
                'hideThumbnailContent'=>true, // hide image, pdf, text or other content in the thumbnail preview
            ],
            'pluginEvents'=>[
                'filepredelete'=>"function(event, key){return (!confirm('".Yii::t('app','Are you sure you want to delete this?')."'))}",
                //UPLOAD OTOMATIS
                'filebatchselected'=>'function(event, files) {
                    // $(".fileinput-upload-button").click()
                    $(".kv-file-upload").click()
                }',
                'fileuploaded'=>"function(event, previewId, index, fileId){
                    // console.log('File uploaded', previewId, index, fileId)
                    $('.kv-zoom-cache').hide()
                }",
            ],
        ]);

        echo ('<div class="help-block"></div><br>') . Yii::t('app', 'Maximum file is 8MB') . "<br>" . Yii::t('app', 'File is power point, pdf, image, word');
        echo '</div>';

        echo '</div>';
        echo $this->render('//layouts/_form_button');
    } else {
        echo Html::submitButton(Yii::t('app', 'Upload Jadwal dan Materi'), ['class' => 'btn btn-info float-right']);
    } */

    echo $form->field($model, 'url_jadwal')->textInput(['maxlength' => true]);
    echo $form->field($model, 'url_materi')->textInput(['maxlength' => true]);

    echo '</div>';

    if ($model->id != null) {
        $form_sertifikat= '<div class="card" id="sertifikat">
            <div class="card-header">
                <h5 class="card-title mb-0">Sertifikat</h5>
            </div>
            <div class="card-body">';
        $form_sertifikat.='</div>';
        $form_sertifikat.='<div class="row">';
            $form_sertifikat.='<div class="col-12 col-lg-6">';
            // $form_sertifikat=$form->field($model, 'ketua_panitia')->textInput(['maxlength' => true]);
            $form_sertifikat.=$form->field($model, 'ketua_pta')->dropDownList($ketuaPtaList, [
                'prompt' => Yii::t('app', '==Select=='),
                'class' => 'form-control select2'
            ]);
            $form_sertifikat.='</div>';
            $form_sertifikat.='<div class="col-12 col-lg-6">';
            // $form_sertifikat=$form->field($model, 'ketua_panitia')->textInput(['maxlength' => true]);
            $form_sertifikat.=$form->field($model, 'ketua_panitia')->dropDownList($ketuaPanitiaList, [
                'prompt' => Yii::t('app', '==Select=='),
                'class' => 'form-control select2'
            ]);
            $form_sertifikat.='</div>';
        $form_sertifikat.='</div>';
        $form_sertifikat.='</div>';
        echo $form_sertifikat;

    }
    // echo '<div class="col-12 col-lg-6">';
    // echo $form->field($model, 'ketua_pta')->textInput(['maxlength' => true]);
    // echo '</div>';
    // echo '</div>';

    // if($model->id){
    //     echo $form->field($model, 'url_materi')->textInput(['maxlength' => true]);
    // }
    echo '<div class="card" id="sertifikat"><div class="card-body">';
    echo $this->render('//layouts/_form_button');
    echo '</div></div>'
    ?>

    <?php ActiveForm::end(); ?>

<!-- </div> -->

<?php
$js = "";
$js .= <<<JS
$(function() {
    $('.select2').select2()

    $('.datepicker').datepicker({
        // title:'Plan-On',
        // multidate:true,
        // language:'id',
        todayHighlight:true,
        disableTouchKeyboard:false,
        format:'yyyy-mm-dd',
        // format:'dd MM yyyy',
        // viewMode: "months", 
        // minViewMode: "months",
        // startView: "months",
        orientation: 'bottom',
        autoclose: true,
        todayBtn:"linked",
        // clearBtn:true,
    })
    $('.datepicker').keydown(function(){
        return false
    })
});
JS;

$js .= <<<JS
    // Remove a few plugins from the default setup.
var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i], {
                // removePlugins: [ 'Heading', 'Link' ],
                toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote','undo', 'redo' ],
                // toolbar: [ 'undo', 'redo' ]
            } )
            .catch( error => {
                console.log( error );
        });
    }
JS;

$this->registerJs($js, View::POS_END);
?>