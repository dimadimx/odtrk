<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Speech */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Speeches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="speech-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
