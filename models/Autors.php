<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "autors".
 *
 * @property integer $ID
 * @property integer $IDBook
 * @property string $first-name
 * @property string $last-name
 * @property string $middle-name]
 */
class Autors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IDBook'], 'required'],
            [['IDBook'], 'integer'],
            [['first-name', 'last-name', 'middle-name]'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDBook' => 'Idbook',
            'first-name' => 'First Name',
            'last-name' => 'Last Name',
            'middle-name]' => 'Middle Name]',
        ];
    }
}
