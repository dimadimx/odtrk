<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Speech */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Speeches'),
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Speeches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="speech-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
