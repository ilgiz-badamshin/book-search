<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "autors".
 *
 * @property integer $ID
 * @property integer $IDBook
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
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
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 100]
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
        ];
    }
}
