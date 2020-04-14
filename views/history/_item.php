<?php

/** @var $model \app\models\search\HistorySearch */
/** @var \app\widgets\common\CommonHistoryItemWidget::class $widgetClassName */
$widgetClassName = $model->getWidgetClass();
echo $widgetClassName::widget(['model' => $model]);
