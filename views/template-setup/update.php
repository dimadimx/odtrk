<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateSetup */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Template'),
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Template Setups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="template-setup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
