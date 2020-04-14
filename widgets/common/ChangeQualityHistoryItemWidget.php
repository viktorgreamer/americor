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

class ChangeQualityHistoryItemWidget extends ChangeTypeHistoryItemWidget implements HistoryItemWidgetInterface
{
    public function getOldValue()
    {
        return Customer::getQualityTextByQuality($this->model->getDetailOldValue('quality'));
    }

    public function getNewValue()
    {
        return Customer::getQualityTextByQuality($this->model->getDetailNewValue('quality'));
    }

}