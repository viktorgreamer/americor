<?php

use app\models\History;
use app\widgets\Export\Export;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\HistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-search">
    <div class="row">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>
        <div class="col-lg-4">
            <? echo $form->field($model, 'event')->dropDownList([null => 'Any'] + History::getEventTexts()) ?>

        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <div class="col-lg-4">
            <?= Html::a('Export',Export::getLinkExport(),['class' => 'btn btn-success']); ?>
        </div>
    </div>


</div>
