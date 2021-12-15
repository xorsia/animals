<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnimalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'type')->dropDownList($model::ANIMAL_TYPES) ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset',['/animal/'],['class' => 'btn btn-sm-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
