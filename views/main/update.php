<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Main */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Main',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="main-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
