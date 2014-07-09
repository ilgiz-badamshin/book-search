<?php

namespace app\models;

use Yii;

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
        return $this->hasMany(GenreItems::className(), ['Idbook' => 'ID']);
    }


}
