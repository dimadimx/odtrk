<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Main */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
