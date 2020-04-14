<?php

namespace app\widgets\common;

use app\models\User;
use yii\base\Widget;

class TaskHistoryItemWidget extends CommonHistoryItemWidget implements HistoryItemWidgetInterface
{

    /**
     * @return string
     */
    public function getIconClass(): string
    {
        return 'fa-check-square bg-yellow';
    }

    public function getFooterDateTime(): string
    {
        return $this->model->ins_ts;
    }

    public function getBody(): string
    {
        $model = $this->model;
        $task = $model->task;
        return "$model->eventText: " . ($task->title ?? '');
    }

    /**
     * @return string
     */

    public function getFooter(): string
    {
        $task = $this->model->task;;
        return isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : '';
    }

    public function getIconIncome(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getBodyDayTime(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return '';
    }
}