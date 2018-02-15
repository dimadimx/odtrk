<?php

namespace app\models\traits;

use yii\base\InvalidCallException;
use yii\db\Query;

trait QueryRole
{

    /**
     * @return mixed
     */
    public function role()
    {
        /**
         * @var Query $this
         */
        if(!$this instanceof Query)
            throw new InvalidCallException('Use this trait for ActiveQuery only');

        return $this->andWhere('[[role]] = :role')->addParams([
            ':role' => \Yii::$app->user->identity->role
        ]);
    }

}
