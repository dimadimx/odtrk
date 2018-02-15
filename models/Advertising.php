<?php

namespace app\models;

use Yii;
use app\models\traits\GeneralTraits;

/**
 * This is the model class for table "{{%advertising}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $channel
 * @property integer $time
 * @property integer $kanal
 * @property integer $role
 */
class Advertising extends \yii\db\ActiveRecord
{
    public $channel;

    use GeneralTraits;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%advertising}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date','channel'], 'safe'],
            [['time', 'kanal', 'role'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
            'kanal' => Yii::t('app', 'Kanal'),
            'role' => Yii::t('app', 'Role'),
        ];
    }

    /**
     * @inheritdoc
     * @return AdvertisingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdvertisingQuery(get_called_class());
    }
}
