<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $giveAwayTimestamp  */

$this->title = 'Animals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Put in a shelter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'type',
                'label' => 'type',
                'content' => function ($data) {
                    return \common\models\Animal::ANIMAL_TYPES[$data->type];
                }
            ],
            'age',
            'status',
            [
                'attribute' => 'timestamp',
                'label' => 'date',
                'content' => function ($data) {
                    return date('Y-m-d H:i:s', $data->timestamp);
                }
            ],
            [
                'attribute' => 'is_active',
                'label' => 'active',
                'content' => function ($data) {
                    if($data->timestamp == \common\models\Animal::$giveAwayTimeStamp){
                        return Html::a('give away', ["/animal/give-away?id=$data->id"],['class' => 'btn btn-sm btn-success']);
                    }
                    //todo CheckISActiveTake
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} -- {delete}',
            ],
        ],
    ]); ?>


</div>
