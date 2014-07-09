<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'title',
            'lang',
            'autorsText',
            'genresText',
//            'annotation:ntext',
//            'filename',
            // 'date',
            // 'full_path',
            // 'file_size',
            // 'Created',
            // 'Seq',
            // 'srclang',
            // 'keywords',
            // 'zip',
            // 'FileDate',
            // 'SeqNum',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
