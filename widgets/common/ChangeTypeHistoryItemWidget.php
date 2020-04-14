<?php

namespace app\widgets\common;

use app\models\Customer;
use app\models\History;
use app\models\User;
use yii\base\Widget;

/**
 * @property History $model
 * @property mixed oldValue
 * @property mixed newValue
 */
class ChangeTypeHistoryItemWidget extends CommonHistoryItemWidget implements HistoryItemWidgetInterface
{

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return '';
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
        return $this->model->ins_ts;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getFooterDateTime(): string
    {
        return '';
    }

    public function getOldValue()
    {
        return Customer::getTypeTextByType($this->model->getDetailOldValue('type'));
    }

    public function getNewValue()
    {
        return Customer::getTypeTextByType($this->model->getDetailNewValue('type'));
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return "{$this->model->eventText} " .
            "<span class='tag'>" . ($this->oldValue ?? "<i>not set</i>") . "</span>" .
            "<span class='arrow'></span>" .
            "<span class='tag'>" . ($this->newValue ?? "<i>not set</i>") . "</span>";
    }


}