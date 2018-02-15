<?php

namespace app\models\traits;

use yii\helpers\ArrayHelper;

trait GeneralTraits
{
    /**
     * @return mixed
     */

    public function init()
    {
        $this->role = empty($this->role) ? \Yii::$app->user->identity->role : $this->role;
    }

    /**
     * @return mixed
     */
    public static function getList()
    {
        return @ArrayHelper::map(self::find()->andWhere(['role' => \Yii::$app->user->identity->role])->all(), 'id', 'name');
    }
}
