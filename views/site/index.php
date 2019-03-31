<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php if(Yii::$app->user->isGuest): ?>
        Login required (user1/password, user2/password)
    <?php else: ?>
        <?php $allowedGain = $user->allowedGain ?>

        <?= $user->name ?><br>
        Bonuses: <?= $user->bonuses ?><br>
        Money: <?= $user->money ?><br>

        <?php if(!empty($allowedGain)): ?>
            <?php foreach($allowedGain as $gain): ?>
                <?= $gain->getDescription() ?>
                <?php $form = \yii\bootstrap\ActiveForm::begin([
                    'method' => 'post'
                ]) ?>
                <input type="hidden" name='prize_id' value="<?= $gain->getId() ?>">
                <input type="radio" name="prize_action" value="accept"> Забрать
                <input type="radio" name="prize_action" value="decline"> Отказаться
                <button>Ok</button>
                <?php \yii\bootstrap\ActiveForm::end(); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php $form = \yii\bootstrap\ActiveForm::begin([
                'method' => 'post'
        ]) ?>

            <input type="hidden" name="generate" value="1">
            <button name="generate">Generate</button>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    <?php endif; ?>

</div>
