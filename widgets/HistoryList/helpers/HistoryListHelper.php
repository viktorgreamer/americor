<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Call;
use app\models\Customer;
use app\models\History;

class HistoryListHelper
{
    public static function getBodyByModel(History $model)
    {

        if ($model->isTaskRelatedEvent()) {
            $task = $model->task;
            return "$model->eventText: " . ($task->title ?? '');
        } elseif ($model->isSmsRelatedEvent()) {
            return $model->sms->message ? $model->sms->message : '';
        } elseif ($model->isCallRelatedEvent()) {
            $call = $model->call;
            return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');

        } else if ($model->isChangeTypeRelatedEvent()) {
            return "$model->eventText " .
                (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
        } else if ($model->isChangeTypeRelatedEvent()) {
            return "$model->eventText " .
                (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
        } else {
            return $model->eventText;
        }
    }
}