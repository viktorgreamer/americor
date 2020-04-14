<?php
/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 16.11.2019
 * Time: 17:18
 */

namespace app\widgets\common;


use app\models\User;

interface HistoryItemWidgetInterface
{
    /**
     * @return string
     */
    public function getFooterDateTime(): string;

    /**
     * @return string
     */
    public function getIconIncome(): string;

    /**
     * @return string
     */

    public function getContent(): string;

    /**
     * @return string
     */
    public function getBody(): string;


    /**
     * @return string
     */
    public function getBodyDayTime(): string;


    /**
     * @return User|null
     */
    public function getUser();


    /**
     * @return string
     */
    public function getIconClass(): string;

    /**
     * @return string
     */
    public function getFooter(): string;

}