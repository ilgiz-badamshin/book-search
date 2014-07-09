<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'ID') ?>

    <?= $form->field($model, 'multi_search') ?>
    <?= $form->field($model, 'alternative')->checkbox() ?>

    <?php // $form->field($model, 'lang') ?>

    <?php // $form->field($model, 'annotation') ?>

    <?php // $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'full_path') ?>

    <?php // echo $form->field($model, 'file_size') ?>

    <?php // echo $form->field($model, 'Created') ?>

    <?php // echo $form->field($model, 'Seq') ?>

    <?php // echo $form->field($model, 'srclang') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'FileDate') ?>

    <?php // echo $form->field($model, 'SeqNum') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
