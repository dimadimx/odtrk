<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Advertising */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Advertisings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertising-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
