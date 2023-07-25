<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    /* ---------------------------- kartik fileinput ---------------------------- */
    'bsDependencyEnabled' => false, // this will not load Bootstrap CSS and JS for all Krajee extensions
    // you need to ensure you load the Bootstrap CSS/JS manually in your view layout before Krajee CSS/JS assets
    //
    // other params settings below
    'bsVersion' => '4',
    // 'adminEmail' => 'admin@example.com'
    'appName'=>'Tes MARI',
    'appDescription'=>'Tes Mahkamah Agung RI',
    /* ---------------------------------- path ---------------------------------- */
    'pathFotoUpload'=>Yii::getAlias('@backend').'/web/uploads/foto/',
    'pathFoto'=>'uploads/foto/',
    'pathJadwalUpload'=>Yii::getAlias('@backend').'/web/uploads/kegiatan/',
    'pathJadwal'=>'uploads/kegiatan/',
    'pathMateriUpload'=>Yii::getAlias('@backend').'/web/uploads/kegiatan/',
    'pathMateri'=>'uploads/kegiatan/',
    'pathTandaTanganUpload'=>Yii::getAlias('@backend').'/web/uploads/tanda_tangan/',
    'pathTandaTangan'=>'uploads/tanda_tangan/',
];
