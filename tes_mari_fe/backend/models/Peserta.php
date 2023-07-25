<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "peserta".
 *
 * @property int $id
 * @property int|null $kegiatan_id
 * @property int|null $user_id
 * @property int|null $status
 * @property string|null $created_at
 */
class Peserta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peserta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kegiatan_id', 'user_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kegiatan_id' => Yii::t('app', 'Kegiatan ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }
}
