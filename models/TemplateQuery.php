<?php

namespace app\models;

use app\models\traits\QueryRole;
/**
 * This is the ActiveQuery class for [[Template]].
 *
 * @see Template
 */
class TemplateQuery extends \yii\db\ActiveQuery
{
    use QueryRole;
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Template[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Template|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
