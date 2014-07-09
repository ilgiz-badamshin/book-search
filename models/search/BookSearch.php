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
    public $alternative;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'file_size', 'Seq', 'zip'], 'integer'],
            [['title', 'lang', 'annotation', 'filename', 'date', 'full_path', 'Created', 'srclang', 'keywords', 'FileDate', 'SeqNum', 'multi_search', 'alternative'], 'safe'],
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
        $query->joinWith('genreItems.genre');
        $query->distinct();
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->alternative) {
            $elements = explode(' ', $this->multi_search);
            foreach ($elements as $element) {
                $query->orFilterWhere(['like', 'book.title', $element])
                    ->orFilterWhere(['like', 'Genre.Name', $element])
                    ->orFilterWhere(['like', 'autors.first_name', $element])
                    ->orFilterWhere(['like', 'autors.last_name', $element])
                    ->orFilterWhere(['like', 'autors.middle_name', $element]);
            }
        } else {
            $query->orFilterWhere(['like', 'book.title', $this->multi_search])
                ->orFilterWhere(['like', 'Genre.Name', $this->multi_search])
                ->orFilterWhere(['like', 'autors.first_name', $this->multi_search])
                ->orFilterWhere(['like', 'autors.last_name', $this->multi_search])
                ->orFilterWhere(['like', 'autors.middle_name', $this->multi_search]);
        }

        return $dataProvider;
    }
}
