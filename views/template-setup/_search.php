<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateSetupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-setup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'template_id') ?>

    <?= $form->field($model, 'telecast_id') ?>

    <?= $form->field($model, 'genre_id') ?>

    <?= $form->field($model, 'speech_id') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'time_s') ?>

    <?php // echo $form->field($model, 'time_e') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <?php // echo $form->field($model, 'kanal') ?>

    <?php // echo $form->field($model, 'micf') ?>

    <?php // echo $form->field($model, 'role') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
