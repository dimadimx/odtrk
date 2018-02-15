<?php

namespace app\models;

use Yii;
use app\models\traits\GeneralTraits;

/**
 * This is the model class for table "{{%telecast}}".
 *
 * @property integer $id
 * @property integer $genre_id
 * @property string $name
 * @property integer $hron
 * @property integer $role
 *
 * @property Genre[] $genre
 */
class Telecast extends \yii\db\ActiveRecord
{
    use GeneralTraits;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%telecast}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['genre_id', 'hron', 'role'], 'integer'],
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
            'genre_id' => Yii::t('app', 'Genre ID'),
            'name' => Yii::t('app', 'Name'),
            'hron' => Yii::t('app', 'Hron'),
            'role' => Yii::t('app', 'Role'),
        ];
    }

    /**
     * @inheritdoc
     * @return TelecastQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TelecastQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'genre_id']);
    }
}
