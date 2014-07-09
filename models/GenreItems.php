<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "GenreItems".
 *
 * @property integer $ID
 * @property integer $IDGenre
 * @property integer $IDBook
 */
class GenreItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'GenreItems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IDGenre', 'IDBook'], 'required'],
            [['IDGenre', 'IDBook'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDGenre' => 'Idgenre',
            'IDBook' => 'Idbook',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasOne(Genre::className(), ['ID' => 'IDGenre']);
    }
}
