<?php

use backend\models\Pegawai;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Izin $model */
/** @var yii\widgets\ActiveForm $form */
/* ------------------------------- untuk form ------------------------------- */
$this->registerAssetBundle('backend\assets\FormAsset');


?>
<div class="izin-form card makus-card">

    <?php $form = ActiveForm::begin();
    // echo $form->field($model, 'nip_pengaju')->textInput(['maxlength' => true]);

    echo $form->field($model, 'jenis')->dropDownList($model::JENIS, [
        'prompt' => '--Pilih--',
        'class' => 'form-control select2'
    ]);
    $Pegawai = Pegawai::find()
        ->where([
            'AND',
            ['=', 'satker_id', Yii::$app->user->identity->satker_id],
            ['<>', 'nip', Yii::$app->user->identity->nip],
        ])
        ->all();
    $atasanList = [];
    foreach ($Pegawai as $key => $value) {
        $atasanList[$value['nip']] = $value['nama_lengkap'] . " (" . $value['nip'] . ")";
    }
    echo $form->field($model, 'nip_atasan')->dropDownList($atasanList, [
        'prompt' => '--Pilih Atasan--',
        'class' => 'form-control select2'
    ]);


    $fieldOptionTimeMulai = [
        'inputOptions' => [
            'id' => 'timedropper-mulai',
            'class' => 'form-control'/* ,'data-date-start-date'=>'0d' */,
            'placeholder' => 'Jam:Menit',
        ],
        'template' => '
        <div class="form-group">
            {label}{input}
        </div>'
    ];
    $fieldOptionTimeSelesai = [
        'inputOptions' => [
            'id' => 'timedropper-selesai',
            'class' => 'form-control'/* ,'data-date-start-date'=>'0d' */,
            'placeholder' => 'Jam:Menit',
        ],
        'template' => '
        <div class="form-group">
            {label}{input}
        </div>'
    ];
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
    echo $form->field($model, 'tanggal', $fieldOptionDate)->textInput(['value' => date('Y-m-d')]);
    echo '</div >';
    echo '<div class="col-md-3">';
    echo $form->field($model, 'jam_mulai', $fieldOptionTimeMulai)->textInput();
    echo '</div >';
    echo '<div class="col-md-3">';
    echo $form->field($model, 'jam_selesai', $fieldOptionTimeSelesai)->textInput();
    echo '</div >';
    echo '</div>';


    echo $form->field($model, 'keperluan')->textArea(['rows' => 6, 'maxlength' => true, 'class' => 'editor']);



    // echo $form->field($model, 'nip_atasan')->textInput(['maxlength' => true]);
    //  echo $form->field($model, 'alasan_tolak')->textarea(['rows' => 6]);
    //  echo $form->field($model, 'status')->dropDownList([ '0', '1', '2', ], ['prompt' => '']) 

    ?>

    <div class="form-group">
        <?= $this->render('//layouts/_form_button', ['text' => 'Ajukan']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = "";
$js .= <<<JS
$(function() {
    $('.select2').select2()

    $('#timedropper-mulai').timeDropper({
        // theme: 'leaf',
        format: 'HH:mm',
        // meridians: true,
        setCurrentTime: true,
        mousewheel: true,
        init_animation: 'dropDown',
        autoswitch: true,
        customClass: 'karen-picker'
    })
    $('#timedropper-selesai').timeDropper({
        // theme: 'leaf,
        format: 'HH:mm',
        // meridians: true,
        setCurrentTime: true,
        mousewheel: true,
        init_animation: 'dropDown',
        autoswitch: true,
        customClass: 'karen-picker'
    })

    $('#timedropper-mulai').keydown(function(){
        return false
    })
    $('#timedropper-selesai').keydown(function(){
        return false
    })

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
        // setDate: new Date('yyyy-mm-dd'),
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

// $js .= <<<JS

// Swal.fire({
//     title: 'Submit your Github username',
//     input: 'text',
//     inputAttributes: {
//       autocapitalize: 'off'
//     },
//     showCancelButton: true,
//     confirmButtonText: 'Look up',
//     showLoaderOnConfirm: true,
//     preConfirm: (login) => {
//       return fetch(`//api.github.com/users/${login}`)
//         .then(response => {
//           if (!response.ok) {
//             throw new Error(response.statusText)
//           }
//           return response.json()
//         })
//         .catch(error => {
//           Swal.showValidationMessage(
//             `Request failed: ${error}`
//           )
//         })
//     },
//     allowOutsideClick: () => !Swal.isLoading()
//   }).then((result) => {
//     if (result.isConfirmed) {
//       Swal.fire({
//         title: `${result . value . login}'s avatar`,
//         imageUrl: result.value.avatar_url
//       })
//     }
//   })
  
// JS;

$this->registerJs($js, View::POS_END);
