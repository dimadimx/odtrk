<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Main */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'prog')->dropDownList(\app\models\Telecast::getList()); ?>

        <?= $form->field($model, 'genre_id')->dropDownList(\app\models\Genre::getList()); ?>

        <?= $form->field($model, 'speech_id')->dropDownList(\app\models\Speech::getList()); ?>

        <?= $form->field($model, 'code_id')->dropDownList(\app\models\Code::getList()); ?>

        <div class="row">
            <div class="col-sm-6">
                <?php if(!empty(\Yii::$app->session->get('main_time_s'))) $model->time_s = \Yii::$app->session->get('main_time_s'); ?>
                <?= $form->field($model, 'time_s')->widget(TimePicker::classname(), [
                        'pluginOptions' => [
                            'showSeconds'  => false,
                            'showMeridian' => false,
                            'minuteStep'   => 1,
                        ]
                    ]
                ); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'time_e')->widget(TimePicker::classname(), [
                        'pluginOptions' => [
                            'showSeconds'  => false,
                            'showMeridian' => false,
                            'minuteStep'   => 1,
                        ]
                    ]
                ); ?>
            </div>
        </div>
        <?php $model->date = (int)$model->date ? Yii::$app->formatter->asDate($model->date) : ''; ?>
        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
            'options'       => ['placeholder' => ''],
            'pluginOptions' => [
                'autoclose' => true,
                'format'    => 'dd-mm-yyyy'
            ]
        ]); ?>

        <?= $form->field($model, 'kanal')->radioList(\app\models\Main::channelList()) ?>

        <?php echo $form->field($model, 'micf')->checkbox(); ?>

        <?php if (\Yii::$app->user->can('managerRadio')) {
            echo $form->field($model, 'comment')->textarea(['rows' => 6]);
        } ?>

        <?php if (!$model->isNewRecord or $model->auto) {
            echo 'При рекрусивному збереженні до кінця року <b>ДАТУ і Час</b> не міняти!';
        } ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat enter-key']) ?>
        <?php if ($model->isNewRecord or $model->auto) {
            echo Html::submitButton(
                Yii::t('app', 'Рекрусивне збереження до кінця року'),
                [
                    'name'  => 'auto-save',
                    'value' => 1,
                    'class' => 'btn btn-danger btn-flat',
                    'data'  => ['confirm' => 'Ви дійсно цего хочете?'],
                ]
            );
        } ?>
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