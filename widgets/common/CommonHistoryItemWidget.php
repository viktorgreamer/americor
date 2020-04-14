<?php

namespace app\widgets\common;

use app\models\History;
use app\models\User;
use app\widgets\HistoryList\helpers\HistoryListHelper;
use yii\base\Widget;

/**
 * @property History $model
 * @property CommonRenderItem $renderItem
 */
class CommonHistoryItemWidget extends Widget implements HistoryItemWidgetInterface
{
    private $renderItem;

    public $model;


    public function init()
    {
        $this->renderItem = new CommonRenderItem();
        $this->renderItem->user = $this->getUser();
        $this->renderItem->body = $this->getBody();
        $this->renderItem->iconClass = $this->getIconClass();
        $this->renderItem->bodyDatetime = $this->getBodyDayTime();
        $this->renderItem->footer = $this->getFooter();
        $this->renderItem->footerDatetime = $this->getFooterDateTime();
        $this->renderItem->iconIncome = $this->getIconIncome();
        $this->renderItem->content = $this->getContent();

        parent::init();
    }


    public function run()
    {
        return $this->render('_common_item', ['model' => $this->getRenderItem()]);
    }

    /**
     * @return string
     */
    public function getIconClass(): string
    {
        return 'fa-gear bg-purple-light';
    }

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
     * @return mixed
     */
    public function getRenderItem()
    {
        return $this->renderItem;
    }

    /**
     * @param mixed $renderItem
     */
    public function setRenderItem($renderItem): void
    {
        $this->renderItem = $renderItem;
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

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->model->eventText;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->model->user;
    }

}