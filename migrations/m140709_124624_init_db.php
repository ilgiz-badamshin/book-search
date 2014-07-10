<?php

use app\models\Book;
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
            'first_name' => Schema::TYPE_STRING . '(100)  NULL',
            'last_name' => Schema::TYPE_STRING . '(100)  NULL',
            'middle_name' => Schema::TYPE_STRING . '(100)  NULL',
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

        $this->addForeignKey('FK_autors_to_book', '{{%autors}}', 'IDBook', '{{%book}}', 'ID');
        $this->addForeignKey('FK_GenreItems_to_book', '{{%GenreItems}}', 'IDBook', '{{%book}}', 'ID');
        $this->addForeignKey('FK_GenreItems_to_Genre', '{{%GenreItems}}', 'IDGenre', '{{%Genre}}', 'ID');

        $this->createIndex('IDX_autors', '{{%autors}}', ['first_name', 'last_name', 'middle_name']);
        $this->createIndex('IDX_genre', '{{%Genre}}', ['Name']);
        $this->createIndex('IDX_book', '{{%book}}', ['title']);

        $groups = [
            'Деловая литература' => [
                'Деловая литература',
                'Карьера, кадры',
                'Маркетинг, PR',
                'Финансы',
                'Экономика',
            ],
            'Детективы и Триллеры' => [
                'Боевик',
                'Детективы',
                'Иронический детектив, дамский детективный роман',
                'Исторический детектив',
                'Классический детектив',
                'Криминальный детектив',
                'Крутой детектив',
                'Политический детектив',
                'Полицейский детектив',
                'Про маньяков',
                'Советский детектив',
                'Триллер',
                'Шпионский детектив',
            ],
            'Документальная литература' => [

                'Биографии и Мемуары ',
                'Военная документалистика и аналитика',
                'Военное дело',
                'География, путевые заметки',
                'Документальная литература',
                'Публицистика',
            ],
            'Дом и семья' => ['Дом и семья'],
            'Драматургия' => ['Драматургия'],
            'Искусство, Искусствоведение, Дизайн' => ['Искусство, Искусствоведение, Дизайн'],
            'Компьютеры и Интернет' => ['Компьютеры и Интернет'],
            'Литература для детей' => ['Литература для детей'],
            'Любовные романы' => ['Любовные романы'],
            'Наука, Образование' => ['Наука, Образование'],
            'Поэзия' => ['Поэзия'],
            'Приключения' => ['Приключения'],
            'Проза' => ['Проза'],
            'Прочее' => ['Прочее'],
            'Религия, духовность, эзотерика' => ['Религия, духовность, эзотерика'],
            'Справочная литература' => ['Справочная литература'],
            'Старинное' => ['Старинное'],
            'Техника' => ['Техника'],
            'Учебники и пособия' => ['Учебники и пособия'],
            'Фантастика' => ['Фантастика'],
            'Фольклор' => ['Фольклор'],
            'Юмор' => ['Юмор'],
        ];

        foreach ($groups as $name => $items) {
            $group = new \app\models\GenreGroup();
            $group->Name = $name;
            $group->save();
            foreach ($items as $item) {
                $genre = new \app\models\Genre();
                $genre->IDG = $group->ID;
                $genre->Name = $item;
                $genre->Title = $item;
                $genre->save();
            }
        }

        echo "import start...";

        Book::import(10000);
        echo "import done\n";
    }

    public function down()
    {

        $this->dropIndex('IDX_autors', '{{%autors}}');
        $this->dropIndex('IDX_genre', '{{%Genre}}');
        $this->dropIndex('IDX_book', '{{%book}}');


        $this->dropForeignKey('FK_autors_to_book', '{{%autors}}');
        $this->dropForeignKey('FK_GenreItems_to_book', '{{%GenreItems}}');
        $this->dropForeignKey('FK_GenreItems_to_Genre', '{{%GenreItems}}');

        $this->dropTable('{{%autors}}');
        $this->dropTable('{{%book}}');
        $this->dropTable('{{%Genre}}');
        $this->dropTable('{{%GenreGroup}}');
        $this->dropTable('{{%GenreItems}}');
        $this->dropTable('{{%Sequence}}');
    }
}
