<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Genre */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Genres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
