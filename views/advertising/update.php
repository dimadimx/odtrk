<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Advertising */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Advertisings'),
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Advertisings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="advertising-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
