<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
    public $multi_search;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'file_size', 'Seq', 'zip'], 'integer'],
            [['title', 'lang', 'annotation', 'filename', 'date', 'full_path', 'Created', 'srclang', 'keywords', 'FileDate', 'SeqNum', 'multi_search'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('autors');
        $query->joinWith('genreItems.genres');
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->orFilterWhere(['like', 'autors.first-name', $this->multi_search])
            ->orFilterWhere(['like', 'Genre.Name', $this->multi_search]);
        return $dataProvider;
    }
}
