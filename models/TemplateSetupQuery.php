<?php

namespace app\models;

use app\models\traits\QueryRole;
/**
 * This is the ActiveQuery class for [[TemplateSetup]].
 *
 * @see TemplateSetup
 */
class TemplateSetupQuery extends \yii\db\ActiveQuery
{
    use QueryRole;
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TemplateSetup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TemplateSetup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
