<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Genre".
 *
 * @property integer $ID
 * @property integer $IDG
 * @property string $Name
 * @property string $Title
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Genre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IDG', 'Name', 'Title'], 'required'],
            [['IDG'], 'integer'],
            [['Name', 'Title'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDG' => 'Idg',
            'Name' => 'Name',
            'Title' => 'Title',
        ];
    }
}
