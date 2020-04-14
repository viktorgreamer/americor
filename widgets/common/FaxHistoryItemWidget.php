<?php

namespace app\widgets\common;

use app\models\User;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use Yii;
use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 16.11.2019
 * Time: 13:43
 */
class FaxHistoryItemWidget extends CommonHistoryItemWidget implements HistoryItemWidgetInterface
{

    /**
     * @return string
     */
    public function getIconClass(): string
    {
        return 'fa-fax bg-green';
    }

    /**
     * @return string
     */

    public function getFooter(): string
    {
        $fax = $this->model->fax;

        return Yii::t('app', '{type} was sent to {group}', [
            'type' => $fax ? $fax->getTypeText() : 'Fax',
            'group' => isset($fax->creditorGroup) ? \yii\helpers\Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
        ]);
    }

    public function getIconIncome(): string
    {
        return '';
    }

    public function getBody(): string
    {



        $fax = $this->model->fax;

        return $this->model->eventText .
            ' - ' .
            (isset($fax->document) ? \yii\helpers\Html::a(
                Yii::t('app', 'view document'),
                $fax->document->getViewUrl(),
                [
                    'target' => '_blank',
                    'data-pjax' => 0
                ]
            ) : '');
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

    /**
     * @return string
     */
    public function getContent(): string
    {
        return '';
    }


}