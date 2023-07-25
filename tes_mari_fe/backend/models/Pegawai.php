<?php

namespace backend\models;

use common\helpers\Makus;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id
 * @property int|null $satker_id
 * @property string|null $nip
 * @property string|null $password
 * @property string|null $nik
 * @property string|null $email
 * @property string|null $foto
 * @property string|null $nama_lengkap
 * @property string|null $gelar_depan
 * @property string|null $gelar_belakang
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $jenis_kelamin P=laki2\nL=perempuan
 * @property int|null $agama 1=Islam\n2=Kristen\n3=Katholik\n4=Hindu\n5=Budha\n6=Lainnya
 * @property string|null $alamat
 * @property string|null $alamat_pengiriman
 * @property string|null $no_telepon
 * @property string|null $pangkat_golongan
 * @property string|null $jabatan 0=Belum\n1=Ketua\n2=Wakil\n3=Panitera\n4=Sekretaris\n5=Kepala Bagian\n6=Panitera Pengganti\n7=Fungsional\n8=Kepala Sub Bagian\n9=Staf\n10=CPNS\n
 * @property int|null $status 0=belum aktif 1=aktif
 */
class Pegawai extends \yii\db\ActiveRecord
{

    const AGAMA = [
        '1' => 'Islam',
        '2' => 'Kristen',
        '3' => 'Budha',
        '4' => 'Katholik',
        '5' => 'Hindu',
        '6' => 'Konghuchu',
        '6' => 'Lainnya',
    ];
    const JENIS_KELAMIN = [
        'L' => 'Laki-Laki',
        'P' => 'Perempuan',
    ];
    const JABATAN = [
        'Analis Kepegawaian Pertama Sub Bagian Kepegawaian Dan Teknologi Informasi' => 'Analis Kepegawaian Pertama Sub Bagian Kepegawaian Dan Teknologi Informasi',
        'Analis Perencanaan, Evaluasi dan Pelaporan' => 'Analis Perencanaan, Evaluasi dan Pelaporan',
        'Analis Perkara Peradilan' => 'Analis Perkara Peradilan',
        'Analis Sumber Daya Manusia Aparatur' => 'Analis Sumber Daya Manusia Aparatur',
        'Bendahara Tingkat Banding/Eselon I' => 'Bendahara Tingkat Banding/Eselon I',
        'Hakim' => 'Hakim',
        'Hakim Tinggi' => 'Hakim Tinggi',
        'Juru Sita' => 'Juru Sita',
        'Juru Sita Pengganti' => 'Juru Sita Pengganti',
        'Kepala Bagian Perencanaan Dan Kepegawaian' => 'Kepala Bagian Perencanaan Dan Kepegawaian',
        'Kepala Bagian Umum Dan Keuangan' => 'Kepala Bagian Umum Dan Keuangan',
        'Kepala Sub Bagian Kepegawaian Dan Teknologi Informasi' => 'Kepala Sub Bagian Kepegawaian Dan Teknologi Informasi',
        'Kepala Sub Bagian Kepegawaian, Organisasi, Dan Tata Laksana' => 'Kepala Sub Bagian Kepegawaian, Organisasi, Dan Tata Laksana',
        'Kepala Sub Bagian Keuangan Dan Pelaporan' => 'Kepala Sub Bagian Keuangan Dan Pelaporan',
        'Kepala Sub Bagian Perencanaan Teknologi Informasi, Dan Pelaporan' => 'Kepala Sub Bagian Perencanaan Teknologi Informasi, Dan Pelaporan',
        'Kepala Sub Bagian Rencana Program Dan Anggaran' => 'Kepala Sub Bagian Rencana Program Dan Anggaran',
        'Kepala Sub Bagian Tata Usaha Dan Rumah Tangga' => 'Kepala Sub Bagian Tata Usaha Dan Rumah Tangga',
        'Kepala Sub Bagian Umum Dan Keuangan' => 'Kepala Sub Bagian Umum Dan Keuangan',
        'Ketua' => 'Ketua',
        'Panitera' => 'Panitera',
        'Panitera Muda Banding' => 'Panitera Muda Banding',
        'Panitera Muda Gugatan' => 'Panitera Muda Gugatan',
        'Panitera Muda Hukum' => 'Panitera Muda Hukum',
        'Panitera Muda Permohonan' => 'Panitera Muda Permohonan',
        'Panitera Pengganti' => 'Panitera Pengganti',
        'Pengadministrasi Kepegawaian' => 'Pengadministrasi Kepegawaian',
        'Pengadministrasi Pelaporan' => 'Pengadministrasi Pelaporan',
        'Pengadministrasi Persuratan, Sub Bagian Tata Usaha Dan Rumah Tangga' => 'Pengadministrasi Persuratan, Sub Bagian Tata Usaha Dan Rumah Tangga',
        'Pengadministrasi Umum' => 'Pengadministrasi Umum',
        'Pengelola Barang Milik Negara' => 'Pengelola Barang Milik Negara',
        'Pengelola Data PNBP' => 'Pengelola Data PNBP',
        'Pengelola Perkara' => 'Pengelola Perkara',
        'Pengelola Sistem Dan Jaringan' => 'Pengelola Sistem Dan Jaringan',
        'Pengolah Daftar Gaji' => 'Pengolah Daftar Gaji',
        'Penyusun laporan Keuangan' => 'Penyusun laporan Keuangan',
        'Penyusun Rencana Kegiatan dan Anggaran, Sub Bagian Rencana Program Dan Anggaran' => 'Penyusun Rencana Kegiatan dan Anggaran, Sub Bagian Rencana Program Dan Anggaran',
        'Pranata Komputer Ahli Pertama' => 'Pranata Komputer Ahli Pertama',
        'Sekretaris' => 'Sekretaris',
        'Verifikator Keuangan' => 'Verifikator Keuangan',
        'Wakil Ketua' => 'Wakil Ketua',
        'Pramubhakti' => 'Pramubhakti',
        'Sopir' => 'Sopir',
        'Satpam' => 'Satpam',
        'PPNPN' => 'PPNPN',
    ];

    const PANGKAT_GOLONGAN = [
        '-' => '-',
        'Juru Muda, I/a' => 'Juru Muda, I/a',
        'Juru Muda Tingkat, I/b' => 'Juru Muda Tingkat, I/b',
        'Juru, I/c'=>'Juru, I/c',
        'Juru Tingkat I, I/d'=>'Juru Tingkat I, I/d',
        'Pengatur Muda, II/a'=>'Pengatur Muda, II/a',
        'Pengatur Muda Tingkat I, II/b'=>'Pengatur Muda Tingkat I, II/b',
        'Pengatur, II/c'=>'Pengatur, II/c',
        'Pengatur Tingkat I, II/d'=>'Pengatur Tingkat I, II/d',
        'Penata Muda, III/a'=>'Penata Muda, III/a',
        'Penata Muda Tingkat 1, III/b'=>'Penata Muda Tingkat 1, III/b',
        'Penata, III/c'=>'Penata, III/c',
        'Penata Tingkat I, III/d'=>'Penata Tingkat I, III/d',
        'Pembina, IV/a'=>'Pembina, IV/a',
        'Pembina Tingkat I, IV/b'=>'Pembina Tingkat I, IV/b', 
        'Pembina Muda, IV/c'=>'Pembina Muda, IV/c',
        'Pembina Madya, IV/d'=>'Pembina Madya, IV/d',
        'Pembina Utama, IV/e'=>'Pembina Utama, IV/e',
    ];

    public $makus;
    public $tempFoto;

    public function init() {
        $this->makus=new Makus;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['satker_id', 'agama', 'status'], 'integer'],
            [['tanggal_lahir','tanda_tangan'], 'safe'],
            [['nip'], 'string', 'max' => 18],
            // [['password'], 'string', 'max' => 64],
            [['nik'], 'string', 'max' => 45],
            ['nip', 'unique'],
            ['nik', 'unique'],
            [['email', 'foto', 'tempat_lahir', 'jabatan'], 'string', 'max' => 128],
            [['nama_lengkap'], 'string', 'max' => 256],
            [['gelar_depan', 'gelar_belakang'], 'string', 'max' => 64],
            [['jenis_kelamin'], 'string', 'max' => 1],
            [['alamat', 'alamat_pengiriman'], 'string', 'max' => 512],
            [['pangkat_golongan'], 'string', 'max' => 128],
            // [['no_telepon'], 'number', 'max' => 20],
            // [['nama_lengkap', 'tanggal_lahir', 'pangkat_golongan', 'jenis_kelamin', 'email', 'alamat', 'alamat_pengiriman', 'agama', 'no_telepon'], 'required'],
            [['nama_lengkap', 'tanggal_lahir', 'pangkat_golongan', 'jenis_kelamin', 'email', 'alamat', 'alamat_pengiriman', 'agama', 'no_telepon'], 'required','on'=>'update'],
            [['nip', 'nik'], 'required','on'=>'create'],
            [['tempFoto'], 'file',
                'extensions' => 'jpg,jpeg',
                'mimeTypes' => 'image/jpeg',
                'maxSize' => 1024 * 1024 * 8, // 8MB
                'skipOnEmpty' => true,
                'tooBig' => Yii::t('app', 'Exceded maximum size'),
            ],
            // [['foto'],'required','on'=>['update']],
            // [['tanda_tangan'],'required','on'=>['update']],
            // [['tanda_tangan','foto'],'required','on'=>['update']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'satker_id' => Yii::t('app', 'Satuan Kerja'),
            'nip' => Yii::t('app', 'Nip'),
            'password' => Yii::t('app', 'Password'),
            'nik' => Yii::t('app', 'Nik'),
            'email' => Yii::t('app', 'Email'),
            'foto' => Yii::t('app', 'Foto'),
            'nama_lengkap' => Yii::t('app', 'Nama Lengkap'),
            'gelar_depan' => Yii::t('app', 'Gelar Depan'),
            'gelar_belakang' => Yii::t('app', 'Gelar Belakang'),
            'tempat_lahir' => Yii::t('app', 'Tempat Lahir'),
            'tanggal_lahir' => Yii::t('app', 'Tanggal Lahir'),
            'jenis_kelamin' => Yii::t('app', 'Jenis Kelamin'),
            'agama' => Yii::t('app', 'Agama'),
            'alamat' => Yii::t('app', 'Alamat'),
            'alamat_pengiriman' => Yii::t('app', 'Alamat Pengiriman'),
            'no_telepon' => Yii::t('app', 'No Telepon'),
            'pangkat_golongan' => Yii::t('app', 'Pangkat Golongan'),
            'jabatan' => Yii::t('app', 'Jabatan'),
            'tanda_tangan' => Yii::t('app', 'Tanda Tangan'),
            'status' => Yii::t('app', 'Status'),
            'tempFoto' => Yii::t('app', 'Foto'),
        ];
    }

    public function uploadReplace($file,$filenameOld)
    {
        // var_dump($filenameOld);die();
        if ($this->foto != null) {
            if ($this->validate('tempFoto')) {
                $uploadDir = Yii::$app->params['pathFotoUpload'];
                // $uploadDir=Yii::$app->params['pathFotoUpload'].'/'.Yii::$app->user->identity->username.'/'.date('Y').'/'.date('mm').'/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }
                //hapus file yang sudah ada
                if(file_exists(Yii::$app->params['pathFotoUpload'].$filenameOld)) {
                    @unlink(Yii::$app->params['pathFotoUpload'].$filenameOld);
                }

                // var_dump(Yii::$app->params['pathFotoUpload'].$filenameOld);die();
                $file->saveAs($uploadDir . $file->name);

                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function getFileUrl()
    {
        $result = [];
        if($this->foto!=''){
            $result[] = Url::to(['/']).Yii::$app->params['pathFoto'] . $this->foto;
        }
        return $result;
    }

    public function getFilePreview()
    {
        $makus=new Makus();
        $result = [];
        $ext = $makus->fileType($this->foto);
        $result['type'] = $ext;
        $result['caption'] = $this->foto;
        // $result['size'] = @filesize(Yii::$app->params['pathFotoUpload'] . $this->foto);
        $result['key'] = $this->id;
        $result['downloadUrl'] = Url::to(['/']).Yii::$app->params['pathFoto'] . $this->foto;
        if ($ext != 'image') {
            $result['showZoom'] = false;
        }
        // var_dump($result);die(); 
        return $result;
    }
}
