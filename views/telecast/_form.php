<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Telecast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="telecast-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?php
        if (\Yii::$app->user->can('managerTb')) {
            echo $form->field($model, 'genre_id')->dropDownList(\app\models\Genre::getList(), ['prompt' => 'Не задано']);
        }
        ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?php
        if (\Yii::$app->user->can('managerTb')) {
            echo $form->field($model, 'hron')->textInput();
        }
        ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
