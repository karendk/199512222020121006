<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rekrutmen".
 *
 * @property int $id
 * @property string|null $nip
 * @property string|null $token
 */
class Rekrutmen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekrutmen';
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
            [['id'], 'required'],
            [['id'], 'integer'],
            [['nip'], 'string', 'max' => 64],
            [['token'], 'string', 'max' => 256],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'token' => 'Token',
        ];
    }
}
