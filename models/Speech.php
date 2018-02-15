<?php

namespace app\models;

use Yii;
use app\models\traits\GeneralTraits;

/**
 * This is the model class for table "{{%speech}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $role
 */
class Speech extends \yii\db\ActiveRecord
{
    use GeneralTraits;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%speech}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['role'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'role' => Yii::t('app', 'Role'),
        ];
    }

    /**
     * @inheritdoc
     * @return SpeechQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpeechQuery(get_called_class());
    }
}
