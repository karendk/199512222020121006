<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property int|null $izin_id
 * @property string|null $created_by nip pembuat
 * @property string|null $created_at
 * @property string|null $keterangan 0 dibuat 1 diedit 2 disetujui 3 ditolak
 */
class Log extends \yii\db\ActiveRecord
{

    const KETERANGAN = [
        '0' => 'dibuat',
        '1' => 'diedit',
        '2' => 'disetujui',
        '3' => 'ditolak',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['izin_id'], 'integer'],
            [['created_at'], 'safe'],
            [['keterangan'], 'string'],
            [['created_by'], 'string', 'max' => 18],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'izin_id' => 'Izin ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'keterangan' => 'Keterangan',
        ];
    }
}
