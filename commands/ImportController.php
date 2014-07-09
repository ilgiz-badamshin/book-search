<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Keboola\Csv\CsvFile;
use yii\console\Controller;

class ImportController extends Controller
{
    public function actionIndex($message = 'hello world')
    {
        $csvFile = new CsvFile( \Yii::getAlias('@app') .  DIRECTORY_SEPARATOR . 'catalog.csv');
        foreach($csvFile as $row) {
            var_dump($row);
        }
    }
}
