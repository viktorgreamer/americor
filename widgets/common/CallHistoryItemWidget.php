<?php

namespace app\widgets\common;

use app\models\Call;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use Yii;

/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 16.11.2019
 * Time: 13:43
 */
class CallHistoryItemWidget extends CommonHistoryItemWidget implements HistoryItemWidgetInterface
{

    private $call;
    private $answered = false;

    public function init()
    {
        $this->call = $this->model->call;
        $this->answered = $this->call && $this->call->status == Call::STATUS_ANSWERED;

        parent::init();
    }

    /**
     * @return string
     */
    public function getIconClass(): string
    {
        return $this->answered ? 'md-phone bg-green' : 'md-phone-missed bg-red';
    }

    /**
     * @return string
     */

    public function getFooter(): string
    {
        return isset($this->call->applicant) ? "Called <span>{$this->call->applicant->name}</span>" : '';
    }

    public function getIconIncome(): string
    {
        return $this->answered && $this->call->direction == Call::DIRECTION_INCOMING;
    }

    public function getBody(): string
    {
        $call = $this->model->call;
        return ($call ? $call->totalStatusText .
            ($call->getTotalDisposition(false) ? " <span class='text-grey'>" .
                $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
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
    public function getFooterDateTime(): string
    {
        return $this->model->ins_ts;
    }

    /**
     * @return string
     */
    public
    function getContent(): string
    {
        return $this->call->comment ?? '';
    }
}