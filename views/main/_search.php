<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-search container-fluid">
    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
    ]); ?>
    <div class="col-sm-2">
        <?php $model->date = (int)$model->date ? $model->date : '';?>
        <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-mm-yyyy'
            ]
        ]); ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'kanal')->dropDownList(\app\models\Main::channelList(),['prompt' => 'Не задано']) ?>
    </div>
    <div class="col-sm-2">
        <div class="form-group" style="padding-top: 24px">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-sm-2">
        <?= $form->field($model, 'template_id')->dropDownList(\app\models\Template::getList(),['prompt' => 'Не задано']) ?>
    </div>
    <div class="col-sm-4">
        <div class="form-group" style="padding-top: 24px">
            <?= Html::submitButton(Yii::t('app', 'Save as Template'), ['class' => 'btn btn-default', 'name'=> 'template', 'value' => 1]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
