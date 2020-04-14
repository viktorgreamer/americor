<?php


/** @var \app\widgets\common\CommonRenderItem $model */

use app\widgets\DateTime\DateTime;

/** @var \yii\web\View $this */

?>

<?php if ($model->footer || $model->footerDatetime): ?>
    <div class="list-group-footer">
        <?= $model->footer ?: ''; ?>
        <?php if ($model->footerDatetime) { ?>
            <span class="list-group-datetime">
                    <?= DateTime::widget(['dateTime' => $model->footerDatetime]); ?>
            </span>
        <?php }; ?>
    </div>
<?php endif; ?>
