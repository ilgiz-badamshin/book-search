<?php

use yii\db\Schema;
use yii\db\Migration;

class m140709_124624_init_db extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%autors}}', [
            'ID' => Schema::TYPE_PK,
            'IDBook' => Schema::TYPE_INTEGER . ' NOT NULL',
            'first-name' => Schema::TYPE_STRING . '(100)  NULL',
            'last-name' => Schema::TYPE_STRING . '(100)  NULL',
            'middle-name]' => Schema::TYPE_STRING . '(100)  NULL',
        ], $tableOptions);

        $this->createTable('{{%book}}', [
            'ID' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(250)  NULL',
            'lang' => Schema::TYPE_STRING . '(50)  NULL',
            'annotation' => Schema::TYPE_TEXT . ' NULL',
            'filename' => Schema::TYPE_STRING . '(250) NOT NULL',
            'date' => Schema::TYPE_STRING . '(50)  NULL',
            'full_path' => Schema::TYPE_STRING . '(250) NOT NULL',
            'file_size' => Schema::TYPE_INTEGER . ' NOT NULL',
            'Created' => Schema::TYPE_DATETIME . ' NOT NULL',
            'Seq' => Schema::TYPE_INTEGER . '  NULL',
            'srclang' => Schema::TYPE_STRING . '(50)  NULL',
            'keywords' => Schema::TYPE_STRING . '(250)  NULL',
            'zip' => Schema::TYPE_INTEGER . ' NOT NULL',
            'FileDate' => Schema::TYPE_DATETIME . ' NULL',
            'SeqNum' => Schema::TYPE_STRING . '(50)  NULL',
        ], $tableOptions);


        $this->createTable('{{%Genre}}', [
            'ID' => Schema::TYPE_PK,
            'IDG' => Schema::TYPE_INTEGER . ' NOT NULL',
            'Name' => Schema::TYPE_STRING . '(50) NOT  NULL',
            'Title' => Schema::TYPE_STRING . '(50) NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%GenreGroup}}', [
            'ID' => Schema::TYPE_PK,
            'Name' => Schema::TYPE_STRING . '(50) NULL',
        ], $tableOptions);


        $this->createTable('{{%GenreItems}}', [
            'ID' => Schema::TYPE_PK,
            'IDGenre' => Schema::TYPE_INTEGER . ' NOT NULL',
            'IDBook' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%Sequence}}', [
            'ID' => Schema::TYPE_PK,
            'Name' => Schema::TYPE_STRING . '(250) NOT  NULL',
        ], $tableOptions);
    }

    public function down()
    {
        echo "m140709_124624_init_db cannot be reverted.\n";

        return false;
    }
}
