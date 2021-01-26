<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\time\TimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-setup-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'template_id')->dropDownList(\app\models\Template::getList()); ?>

        <?= $form->field($model, 'telecast_id')->dropDownList(\app\models\Telecast::getList()); ?>

        <?= $form->field($model, 'genre_id')->dropDownList(\app\models\Genre::getList()); ?>

        <?= $form->field($model, 'speech_id')->dropDownList(\app\models\Speech::getList()); ?>

        <?= $form->field($model, 'code_id')->dropDownList(\app\models\Code::getList()); ?>

        <div class="row">
            <div class="col-sm-6">
                <?php if(empty($model->time_s) && !empty(\Yii::$app->session->get('template_time_s'))) $model->time_s = \Yii::$app->session->get('template_time_s'); ?>
                <?= $form->field($model, 'time_s')->widget(TimePicker::classname(), [
                        'pluginOptions' => [
	                        'showSeconds'  => true,
                            'showMeridian' => false,
                            'minuteStep'   => 1,
                        ]
                    ]
                ); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'time_e')->widget(TimePicker::classname(), [
                        'pluginOptions' => [
	                        'showSeconds'  => true,
                            'showMeridian' => false,
                            'minuteStep'   => 1,
                        ]
                    ]
                ); ?>
            </div>
        </div>

        <?= $form->field($model, 'kanal')->radioList(\app\models\Main::channelList()) ?>

        <?php echo $form->field($model, 'micf')->checkbox(); ?>

        <? if (\Yii::$app->user->can('managerRadio')) {
           echo $form->field($model, 'comment')->textarea(['rows' => 6]);
        } ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat enter-key']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$submitScript = <<< JS
    $(document).keydown(function (e) {
        if (e.ctrlKey && e.keyCode == 13) {
            $('.enter-key').click();
        }
    });
JS;
$this->registerJs($submitScript);
?>