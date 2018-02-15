<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Telecast */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Telecasts'),
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Telecasts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="telecast-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
