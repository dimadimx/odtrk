<?php

namespace app\models;

use Yii;
use app\models\traits\GeneralTraits;

/**
 * This is the model class for table "{{%code}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $code_in
 * @property integer $role
 */
class Code extends \yii\db\ActiveRecord
{
    use GeneralTraits;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code_in'], 'required'],
            [['code_in', 'role'], 'integer'],
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
            'code_in' => Yii::t('app', 'Code In'),
            'role' => Yii::t('app', 'Role'),
        ];
    }

    /**
     * @inheritdoc
     * @return CodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodeQuery(get_called_class());
    }
}
