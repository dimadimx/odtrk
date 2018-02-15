<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Telecast */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Telecasts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telecast-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
