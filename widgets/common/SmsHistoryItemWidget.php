<?php

namespace app\widgets\common;

use app\models\Call;
use app\models\Sms;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use Yii;

/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 16.11.2019
 * Time: 13:43
 */
class SmsHistoryItemWidget extends CommonHistoryItemWidget implements HistoryItemWidgetInterface
{

    /**
     * @return string
     */
    public function getIconClass(): string
    {
        return 'icon-sms bg-dark-blue';
    }

    public function getBody(): string
    {
        return $this->model->sms->message ? $this->model->sms->message : '';
    }

    /**
     * @return string
     */

    public function getFooter(): string
    {
        return $this->model->sms->direction == Sms::DIRECTION_INCOMING ?
            Yii::t('app', 'Incoming message from {number}', [
                'number' => $model->sms->phone_from ?? ''
            ]) : Yii::t('app', 'Sent message to {number}', [
                'number' => $model->sms->phone_to ?? ''
            ]);
    }

    public function getIconIncome(): string
    {
        return $this->model->sms->direction == Sms::DIRECTION_INCOMING;
    }


    /**
     * @return string
     */
    public function getBodyDayTime(): string
    {
        return '';
    }

    public function getFooterDateTime(): string
    {
        return $this->model->ins_ts;
    }
}