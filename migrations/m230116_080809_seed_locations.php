<?php

use app\models\Region;
use yii\db\Migration;
use yii\db\Expression;

/**
 * Class m230116_080809_seed_locations
 */
class m230116_080809_seed_locations extends Migration
{

    public function tableName()
    {
        return '{{%regions}}';
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // $rows = [];
        // foreach ($this->data() as $data) {
        //     list($id, $id_no, $name, $no) = $data;

        //     if ((int)$no == 4) {
        //         continue;
        //     }

        //     $rows[] = [
        //         'name' => $name,
        //         'no' => (int)$no,
        //         'country_id' => 1,
        //         'record_status' => Region::RECORD_ACTIVE,
        //         'created_by' => 1,
        //         'updated_by' => 1,
        //         'created_at' => new Expression('UTC_TIMESTAMP'),
        //         'updated_at' => new Expression('UTC_TIMESTAMP'),
        //     ];
        // }
        // $this->batchInsert($this->tableName(), array_keys($rows[0]), $rows);
    }

    public function region()
    {
        return [
            array('1', '010000000', 'REGION I (ILOCOS REGION)', '01'),
            array('2', '020000000', 'REGION II (CAGAYAN VALLEY)', '02'),
            array('3', '030000000', 'REGION III (CENTRAL LUZON)', '03'),
            array('4', '040000000', 'REGION IV-A (CALABARZON)', '04'),
            array('5', '170000000', 'REGION IV-B (MIMAROPA)', '17'),
            array('6', '050000000', 'REGION V (BICOL REGION)', '05'),
            array('7', '060000000', 'REGION VI (WESTERN VISAYAS)', '06'),
            array('8', '070000000', 'REGION VII (CENTRAL VISAYAS)', '07'),
            array('9', '080000000', 'REGION VIII (EASTERN VISAYAS)', '08'),
            array('10', '090000000', 'REGION IX (ZAMBOANGA PENINSULA)', '09'),
            array('11', '100000000', 'REGION X (NORTHERN MINDANAO)', '10'),
            array('12', '110000000', 'REGION XI (DAVAO REGION)', '11'),
            array('13', '120000000', 'REGION XII (SOCCSKSARGEN)', '12'),
            array('14', '130000000', 'NATIONAL CAPITAL REGION (NCR)', '13'),
            array('15', '140000000', 'CORDILLERA ADMINISTRATIVE REGION (CAR)', '14'),
            array('16', '150000000', 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)', '15'),
            array('17', '160000000', 'REGION XIII (Caraga)', '16'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // \Yii::$app->db->createCommand()->truncateTable($this->tableName())->execute();
    }
}
