<?php

namespace app\controllers;

use app\models\Autors;
use app\models\Genre;
use app\models\GenreItems;
use Keboola\Csv\CsvFile;
use Yii;
use app\models\Book;
use app\models\search\BookSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAutoComplete($term)
    {
        Yii::$app->response->format = 'json';
        $books = Book::find()
            ->andWhere(['like', 'title', $term])
            ->limit(10)
            ->all();
        return ArrayHelper::map($books, 'ID', 'title');
    }
}
