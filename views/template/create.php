<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Template */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
