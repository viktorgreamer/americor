<?php

namespace app\widgets\Export;


use backend\controllers\ReportsController;
use kartik\export\ExportMenu;
use yii\base\ActionEvent;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Export extends ExportMenu
{
    public $exportType = self::FORMAT_CSV;

    public function init()
    {
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (empty($this->exportRequestParam)) {
            $this->exportRequestParam = 'exportFull_' . $this->options['id'];
        }

        $_POST[\Yii::$app->request->methodParam] = 'POST';
        $_POST[$this->exportRequestParam] = true;
        $_POST[$this->exportTypeParam] = $this->exportType;
        $_POST[$this->colSelFlagParam] = false;

        parent::init();
    }

    /**
     * @return string
     */
    public static function getLinkExport()
    {
        $params = \Yii::$app->getRequest()->getQueryParams();
        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = 'history/export';

        return Url::to($params);
    }

}