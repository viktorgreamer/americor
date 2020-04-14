<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'options' => [
            'tag' => 'ul',
            'class' => 'list-group list-group-history'
        ],
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'list-group-item'
        ],
        'emptyTextOptions' => ['class' => 'empty p-20'],
        'layout' => '{items}{pager}',
    ]); ?>

    <?php Pjax::end(); ?>

</div>
