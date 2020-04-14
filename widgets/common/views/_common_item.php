<?php

use yii\helpers\Html;

/* @var $model \app\widgets\common\CommonRenderItem */

?>

<?php if ($model->iconIncome) {
    $icon = Html::tag('i', '', ['class' => "icon icon-circle icon-main white $model->iconClass"]);
    ?>
    <div class="icon-group position-relative pull-xs-left">
        <?= $icon ?>
        <span class="tag tag-pill tag-danger up"><i class="icon md-long-arrow-down" aria-hidden="true"></i></span>
    </div>
<?php } else echo $icon; ?>

<div class="list-group-content">
    <div class="list-group-inner">
        <div class="list-group-body">

            <div class="list-group-message">
                <?php echo $model->body ?>
                <?php if ($model->bodyDatetime): ?>
                    <span class="list-group-datetime">
                        <?= \app\widgets\DateTime\DateTime::widget(['dateTime' => $model->bodyDatetime]) ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if ($model->user): ?>
                <div class="list-group-side">
                    <?= $model->user->username; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <?php if ($model->content): ?>
        <div class="list-group-footer">
            <?php echo $model->content ?>
        </div>
    <?php endif; ?>
    <?php echo $this->render('_footer', compact('model')); ?>


</div>