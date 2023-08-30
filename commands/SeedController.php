<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use app\helpers\App;
use yii\helpers\Console;
use yii\helpers\Inflector;
use app\commands\seeder\RegionSeeder;
use app\commands\seeder\CountrySeeder;
use app\commands\seeder\BarangaySeeder;
use app\commands\seeder\ProvinceSeeder;
use app\commands\seeder\MunicipalitySeeder;
use app\models\form\SpreadsheetReaderForm;
use app\models\Library;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SeedController extends Controller
{
    public function actionInit()
    {
        $this->actionTruncate(['users', 'roles', 'ips']);
        $classes = [
            'Role',
            'User',
            'Ip',
        ];

        foreach ($classes as $class) {
            $this->actionIndex($class, 5);
        }
    }

    public function actionIndex($class, $rows=1)
    {
        $class = Inflector::id2camel($class);
        $model = Yii::createObject([
            'class' => "\\app\\commands\\seeder\\{$class}Seeder",
            'rows' => $rows
        ]);
        $model->bulkSeed();
        // $model->seed();
    }

    public function actionLocation()
    {
        // $this->actionTruncate([
        //     // 'countries', 
        //     // 'regions', 
        //     // 'provinces', 
        //     // 'municipalities', 
        //     // 'barangays'
        // ]);
        
        $this->actionIndex('country', count(CountrySeeder::DATA));
        $this->actionIndex('region', count(RegionSeeder::DATA));
        $this->actionIndex('province', count(ProvinceSeeder::DATA));
        $this->actionIndex('municipality', count(MunicipalitySeeder::DATA));
        $this->actionIndex('barangay', count(BarangaySeeder::DATA));
    }

    public function actionLibrary()
    {
        $this->actionTruncate(['libraries']);

        $reader = new SpreadsheetReaderForm([
            'rootPath' => Yii::getAlias('@consoleWebroot') . '/default/tests/tree-library.xlsx'
        ]);

        $data = App::foreach($reader->getData()[0]['row'], fn ($array, $index) => $index > 0 ? [
            'family' => $array[0],
            'genus' => $array[1],
            'species' => $array[2],
            'sub_species' => $array[3],
            'varieta_and_infra_var_name' => $array[4],
            'common_name' => $array[5],
            'taxonomic_group' => $array[6],
            'conservation_status' => $array[7],
            'residency_status' => $array[8],
            'distribution' => $array[9],
        ]: '', false);
        
        Library::batchInsert($data);
    }
}
