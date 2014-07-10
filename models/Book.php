<?php

namespace app\models;

use Keboola\Csv\CsvFile;
use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "book".
 *
 * @property integer $ID
 * @property string $title
 * @property string $lang
 * @property string $annotation
 * @property string $filename
 * @property string $date
 * @property string $full_path
 * @property integer $file_size
 * @property string $Created
 * @property integer $Seq
 * @property string $srclang
 * @property string $keywords
 * @property integer $zip
 * @property string $FileDate
 * @property string $SeqNum
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['annotation'], 'string'],
            [['filename', 'full_path', 'file_size', 'Created', 'zip'], 'required'],
            [['file_size', 'Seq', 'zip'], 'integer'],
            [['Created', 'FileDate'], 'safe'],
            [['title', 'filename', 'full_path', 'keywords'], 'string', 'max' => 250],
            [['lang', 'date', 'srclang', 'SeqNum'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'title' => 'Title',
            'lang' => 'Lang',
            'annotation' => 'Annotation',
            'filename' => 'Filename',
            'date' => 'Date',
            'full_path' => 'Full Path',
            'file_size' => 'File Size',
            'Created' => 'Created',
            'Seq' => 'Seq',
            'srclang' => 'Srclang',
            'keywords' => 'Keywords',
            'zip' => 'Zip',
            'FileDate' => 'File Date',
            'SeqNum' => 'Seq Num',
            'autorsText' => 'Autors',
            'genresText' => 'Genres',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutors()
    {
        return $this->hasMany(Autors::className(), ['IDBook' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenreItems()
    {
        return $this->hasMany(GenreItems::className(), ['IDBook' => 'ID']);
    }

    /**
     * Собирает авторов книги в строку
     * @return string
     */
    public function getAutorsText()
    {
        $result = [];
        foreach ($this->autors as $autor) {
            $result[] = $autor->last_name . ' ' . $autor->first_name . ' ' . $autor->middle_name;
        }
        return implode(', ', $result);
    }

    /**
     * Собирает авторов книги в строку
     * @return string
     */
    public function getGenresText()
    {
        $result = [];
        foreach ($this->genreItems as $item) {
            if (!empty($item->genre)) {
                $result[] = $item->genre->Name;
            }
        }
        return implode(', ', $result);
    }

    /**
     * Импортирует книги из файла
     */
    public static function import($max_rows)
    {
        $index_last_name = 0;
        $index_first_name = 1;
        $index_middle_name = 2;
        $index_title = 3;
        $index_subtitle = 4;
        $index_language = 5;
        $index_year = 6;
        $index_series = 7;
        $index_id = 8;

        $csvFile = new CsvFile(\Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'catalog.csv', ';');
        $csvFile->next();
        $genre_id = 1;
        $genre_max = Genre::find()->count();
        $saved_books = [];
        $imported = 0;
        foreach ($csvFile as $key => $row) {
            try {
                if (empty($row[$index_first_name])) {
                    continue;
                }
                $title = $row[$index_title];
                if (isset($saved_books[$title])) {
                    $book_id = $saved_books[$title];
                } else {
                    $book = new Book();
                    $book->title = $title;
                    $book->filename = 'fake_filename';
                    $book->full_path = 'fake_full_path';
                    $book->file_size = 0;
                    $book->Created = date('Y-m-d H:i:s');
                    $book->zip = 0;
                    $book->lang = $row[$index_language];
                    $book->save();

                    $book_id = $book->ID;
                    $saved_books[$title] = $book_id;
                }


                $autor = new Autors();
                $autor->first_name = $row[$index_first_name];
                $autor->middle_name = $row[$index_middle_name];
                $autor->last_name = $row[$index_last_name];
                $autor->IDBook = $book_id;
                $autor->save();

                $gi = new GenreItems();
                $gi->IDBook = $book_id;
                $gi->IDGenre = $genre_id++;
                $gi->save();
                if ($genre_id > $genre_max) {
                    $genre_id = 1;
                }
                if ($key % 1000 == 0) {
                    echo "Обработано $key строк...\n";
                }
            } catch (Exception $e) {
                return false;
            }

            $imported++;
            if (!empty($max_rows) && ($imported >= $max_rows)) {
                return true;
            }

        }

        return true;
    }
}
