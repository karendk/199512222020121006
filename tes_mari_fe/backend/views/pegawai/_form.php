<?php

use common\helpers\Makus;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */

$makus = new Makus();
/* ------------------------------- untuk form ------------------------------- */
$this->registerAssetBundle('backend\assets\FormAsset');

$content = file_get_contents($makus::API_PEGAWAI . 'satker/');
$response = json_decode($content, true); //because of true, it's in an array
$satker = $response['data'];
// var_dump($satker);die();
$satkerList = [];
foreach ($satker as $key => $value) {
    $satkerList[$value['id']] = $value['nama'];
}
// var_dump($satkerList);die();
?>

<?= $this->render('//layouts/_back_button') ?>
<style>
    .signature-pad--body canvas {
        /* position: absolute; */
        left: 0;
        top: 0;
        width: 300px;
        height: 200px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2) inset;
    }
</style>
<div class="pegawai-form card makus-card">

    <?php $form = ActiveForm::begin();

    // echo $form->field($model, 'satker_id')->textInput();

    // echo $form->field($model, 'nip')->textInput(['maxlength' => true]);
    if ($model->id == null) {
        echo $form->field($model, 'satker_id')->dropDownList($satkerList, [
            'prompt' => Yii::t('app', '==Select=='),
            'class' => 'form-control select2'
        ]);

        echo '<div class="row">';
        echo '<div class="col-12 col-lg-6">';
        echo $form->field($model, 'nip')->textInput(['disabled' => false]);
        echo '</div>';

        // if ($makus->findRole('superadmin') || $makus->findRole('admin')) {
        //     echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
        // }

        echo '<div class="col-12 col-lg-6">';
        echo $form->field($model, 'nik')->textInput(['maxlength' => true, 'disabled' => false]);
        echo '</div>';
        echo '</div>';

        echo '<div class="row">';
        echo '<div class="col-12 col-lg-3">';
        echo $form->field($model, 'gelar_depan')->textInput(['maxlength' => true]);
        echo '</div>';

        echo '<div class="col-12 col-lg-6">';
        echo $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]);
        echo '</div>';


        echo '<div class="col-12 col-lg-3">';
        echo $form->field($model, 'gelar_belakang')->textInput(['maxlength' => true]);
        echo '</div>';
        echo '</div>';

        echo $form->field($model, 'jabatan')->dropDownList($model::JABATAN, [
            'prompt' => Yii::t('app', '--Select--'),
            'class' => 'form-control select2'
        ]);
        // echo $form->field($model, 'pangkat_golongan')->textInput(['maxlength' => true]);
    } else {

        echo $form->field($model, 'satker_id')->dropDownList($satkerList, [
            'prompt' => Yii::t('app', '==Select=='),
            'class' => 'form-control select2'
        ]);

        echo '<div class="row">';
        echo '<div class="col-12 col-lg-6">';
        echo $form->field($model, 'nip')->textInput(['disabled' => true]);
        echo '</div>';

        // if ($makus->findRole('superadmin') || $makus->findRole('admin')) {
        //     echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
        // }

        echo '<div class="col-12 col-lg-6">';
        echo $form->field($model, 'nik')->textInput(['maxlength' => true, 'disabled' => true]);
        echo '</div>';
        echo '</div>';

        echo '<div class="row">';
        echo '<div class="col-12 col-lg-3">';
        echo $form->field($model, 'gelar_depan')->textInput(['maxlength' => true]);
        echo '</div>';

        echo '<div class="col-12 col-lg-6">';
        echo $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]);
        echo '</div>';


        echo '<div class="col-12 col-lg-3">';
        echo $form->field($model, 'gelar_belakang')->textInput(['maxlength' => true]);
        echo '</div>';
        echo '</div>';

        echo $form->field($model, 'jabatan')->dropDownList($model::JABATAN, [
            'prompt' => Yii::t('app', '--Select--'),
            'class' => 'form-control select2'
        ]);

        // echo $form->field($model, 'foto')->textInput(['maxlength' => true]);

        echo '<div class="row">';


        echo '<div class="col-12 col-lg-7">';
        // echo $form->field($model, 'pangkat_golongan')->textInput(['maxlength' => true]);

        echo $form->field($model, 'pangkat_golongan')->dropDownList($model::PANGKAT_GOLONGAN, [
            'prompt' => Yii::t('app', '--Select--'),
            'class' => 'form-control select2'
        ]);

        echo $form->field($model, 'email')->textInput(['maxlength' => true]);

        echo $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]);

        $fieldOptionDate = [
            'inputOptions' => [
                'class' => 'form-control datepicker'/* ,'data-date-start-date'=>'0d' */,
                'placeholder' => 'Tanggal Bulan Tahun',
            ],
            'template' => '
            <div class="form-group">
                {label}{input}
            </div>'
        ];
        echo $form->field($model, 'tanggal_lahir', $fieldOptionDate)->textInput();

        echo $form->field($model, 'jenis_kelamin')->dropDownList($model::JENIS_KELAMIN, [
            'prompt' => Yii::t('app', '--Select--'),
            'class' => 'form-control select2'
        ]);

        echo $form->field($model, 'agama')->dropDownList($model::AGAMA, [
            'prompt' => Yii::t('app', '--Select--'),
            'class' => 'form-control select2'
        ]);
        echo '</div>';


        echo '<div class="col-12 col-lg-5">';
        echo $form->field($model, 'tempFoto')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/jpeg,image/jpg,image/png,image/bmp',
                'multiple' => false,
            ],
            'pluginOptions' => [
                'initialPreview' => $model->fileUrl,
                'initialPreviewAsData' => true,
                'validateInitialCount' => true,
                // 'initialCaption'=>'Silahkan upload',
                'initialPreviewConfig' => $model->filePreview,
                'overwriteInitial' => true,
                // 'deleteUrl' => Url::to(['pegawai/delete-file']),
                'deleteUrl' => Url::to(['pegawai/delete-file']) . "?key=" . Yii::$app->request->get('id'),
                'uploadUrl' => Url::to(['pegawai/upload-file']) . "?id=" . Yii::$app->request->get('id'),
                // 'uploadExtraData'=>['penawaran_id'=>$model->penawaran_id],
                'allowedFileExtensions' => ['jpg', 'jpeg', 'png', 'bmp'],
                'maxFileSize' => 1024 * 8,
                // 'maxFileCount'=> 5, //max 5
                'uploadAsync' => true,
                'showUpload' => false, // hide upload button
                'showRemove' => false, // hide remove button
                'showCancel' => false,
                'showDownload' => true,
                'showBrowse' => false,
                'browseOnZoneClick' => true,
                'browseLabel' => Yii::t("app", "Upload"),
                // 'pdfRendererUrl'=>Url::to(['plugin/ViewerJS/index.html#../../']),
                // 'pdfRendererTemplate'=>'<iframe class="kv-preview-data file-preview-pdf" src="{renderer}{data}" {style}></iframe>',
                'preferIconicPreview' => false,
                // 'previewFileIconSettings'=>[
                //     'jpg'=>'<i class="fa fa-image text-warning"></i>', 
                //     'jpeg'=>'<i class="fa fa-image text-warning"></i>', 
                //     'png'=>'<i class="fa fa-image text-warning"></i>'    
                // ],
                'previewZoomButtonIcons' => [
                    'prev' => '',
                    'next' => '',
                ],
                'fileActionSettings' => [
                    'showDrag' => false,
                ],
                // 'hideThumbnailContent'=>true, // hide image, pdf, text or other content in the thumbnail preview
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
        echo ('<div class="help-block">' . ($model->getErrors() == null ? '' : $model->getErrors()['foto'][0]) . '</div><br>') . Yii::t('app', 'Masukan Pas foto PDH') . '<br>' . Yii::t('app', 'Maximum file is 8MB') . "<br>" . Yii::t('app', 'File is image: jpg, png, bmp.');
        echo '</div>';


        echo '</div>';


        echo $form->field($model, 'no_telepon')->textInput(['maxlength' => true]);

        echo $form->field($model, 'alamat')->textArea(['rows' => '2', 'maxlength' => true, 'class' => 'editor']);
        echo $form->field($model, 'alamat_pengiriman')->textArea(['rows' => '2', 'maxlength' => true, 'class' => 'editor']);

        // echo '
        // <div id="signature-pad" class="signature-pad">
        //     <div class="signature-pad--body">
        //         <canvas id="canvas-signature"></canvas>
        //     </div>
        //     <div class="signature-pad--footer">
        //         <div class="description">Sign above</div>
        //         <div class="signature-pad--actions">
        //             <button type="button" class="button clear" data-action="clear">Clear</button>
        //             <button type="button" class="button" data-action="undo">Undo</button>
        //             <button type="button" class="button save" data-action="save-png">Save as PNG</button>
        //         </div>
        //     </div>
        // </div>';

        // echo '
        // <div id="signature-pad" class="signature-pad">
        //     <div class="signature-pad--body">
        //         <canvas id="canvas-signature"></canvas>
        //     </div>
        //     <div class="signature-pad--footer">
        //         <div class="description">Sign above</div>
        //         <div class="signature-pad--actions">
        //         </div>
        //     </div>
        // </div>';

        echo '
        <center>Tanda Tangan dibawah ini:</center>
        <div id="signature-pad" class="row">
            <div class="col-12 col-lg-12">
            <div class="signature-pad--body" style="text-align:center">

                <canvas id="canvas-signature"></canvas>

                </div>
            </div>
            <div class="col-12 col-lg-12" style="text-align:center">
                '.($model->tanda_tangan!='' ? '<img src="' . $model->tanda_tangan . '" style="width:51px; height:34px; border: 1px solid #efefef" data-action="load-image"/>':"").'
                <button type="button" class="btn btn-secondary clear" data-action="clear"><span style="color:white" data-feather="trash"></span></button>
                <button type="button" class="btn btn-secondary" data-action="undo"><span style="color:white" data-feather="corner-up-left"></span></button>
                
            </div>
        </div>';

        // echo $form->field($model, 'jabatan')->textInput(['maxlength' => true]);


        // echo $form->field($model, 'status')->textInput();
    }

    ?>

    <?= $this->render('//layouts/_form_button') ?>

    <?php ActiveForm::end(); ?>

</div>
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
        startView: "months",
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
                // toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
                toolbar: [ 'undo', 'redo' ]
            } )
            .catch( error => {
                console.log( error );
        });
    }

    // $('.datepicker').onclick(function(){
    //     const dataURLTandaTangan = signaturePad.toDataURL();
    //     download(dataURLTandaTangan, "signature.png");
    // })
JS;

$js .= "
$(':submit').on('click',function(){
// $('#canvas-signature').on('click',function(){
    // var photo = canvas.toDataURL('image/jpeg');        
    // const dataURL = signaturePad.toDataURL('image/png')  
    if (signaturePad.isEmpty()){
        alert('Silahkan Isi Tanda Tangan')
    }else{  
        const dataURL = signaturePad.toDataURL()        
        $.ajax({
            method: 'POST',
            url: '" . Url::to(['pegawai/upload-signature']) . "',
            data: {
                id : '" . $model->id . "',
                tanda_tangan: dataURL
            }
        });
    }
    // alert(dataURL)
    // $('input[name=Pegawai[tanda_tangan]]').val(dataURL)
})

const canvasOld = document.getElementById('canvas-signature')
const ctx = canvasOld.getContext('2d')
var image = new Image();
image.onload = () => { ctx.drawImage(image, 0, 0, 300, 300 * image.height / image.width) }
image.src = '".$model->tanda_tangan."'


const loadButton = wrapper.querySelector('[data-action=load-image]');
loadButton.addEventListener('click', () => {
    signaturePad.clear()
    var image = new Image();
    // image.onload = () => { ctx.drawImage(image, 0, 0) }
    image.onload = () => { ctx.drawImage(image, 0, 0, 300, 300 * image.height / image.width) }
    image.src = '".$model->tanda_tangan."' 
});
";

$this->registerJs($js, View::POS_END);
?>