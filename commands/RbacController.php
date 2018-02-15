<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "managerRadio"
        $managerRadio = $auth->createPermission('managerRadio');
        $managerRadio->description = 'Manager radio';
        $auth->add($managerRadio);
        // добавляем роль "radio" и даём роли разрешение "managerRadio"
        $radio = $auth->createRole('radio');
        $auth->add($radio);
        $auth->addChild($radio, $managerRadio);

        // добавляем разрешение "managerTb"
        $managerTb = $auth->createPermission('managerTb');
        $managerTb->description = 'Manager tb';
        $auth->add($managerTb);
        // добавляем роль "tb" и даём роли разрешение "managerTb"
        $tb = $auth->createRole('tb');
        $auth->add($tb);
        $auth->addChild($tb, $managerTb);

        // добавляем разрешение "managerAdmin"
        $managerAdmin = $auth->createPermission('managerAdmin');
        $managerAdmin->description = 'Manager admin';
        $auth->add($managerAdmin);
        // добавляем роль "admin" и даём роли все роли
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $managerAdmin);
        $auth->addChild($admin, $managerTb);
        $auth->addChild($admin, $managerRadio);

        // Назначение ролей пользователям. 100 и 101 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($radio, 101);
        $auth->assign($tb, 100);
    }
}
