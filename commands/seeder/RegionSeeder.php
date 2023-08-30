<?php

namespace app\commands\seeder;

use yii\db\Expression;
use app\commands\models\Region;
use app\commands\models\Country;

class RegionSeeder extends Seeder
{
	public $modelClass = 'app\commands\models\Region';
    const DATA = [
        array(608, 'I - ILOCOS REGION', 1),
        array(608, 'II - CAGAYAN VALLEY', 2),
        array(608, 'III - CENTRAL LUZON', 3),
        array(608, 'IVA - SOUTHERN TAGALOG (CALABARZON)', 4),
        array(608, 'V - BICOL REGION', 5),
        array(608, 'VI - WESTERN VISAYAS', 6),
        array(608, 'VII - CENTRAL VISAYAS', 7),
        array(608, 'VIII - EASTERN VISAYAS', 8),
        array(608, 'IX - ZAMBOANGA PENINSULA', 9),
        array(608, 'X - NORTHERN MINDANAO', 10),
        array(608, 'XI - DAVAO REGION', 11),
        array(608, 'XII - SOCCSKSARGEN', 12),
        array(608, 'NCR - NATIONAL CAPITAL REGION', 13),
        array(608, 'CAR - CORDILLERA ADMINISTRATIVE REGION', 14),
        array(608, 'ARMM - AUTONOMUS REGION IN MUSLIM MINDANAO', 15),
        array(608, 'XIII - CARAGA', 16),
        array(608, 'IVB - SOUTHERN TAGALOG (MIMAROPA)', 17)
    ];

	public function attributes($key)
	{
        list($country_no, $name, $no) = self::DATA[$key - 1];
        $country = Country::findOne(['no' => $country_no]);
		return [
            'name' => $name,
            'country_id' => ($country)? $country->id: 0,
            'no' => $no,
            'created_at' => new Expression('UTC_TIMESTAMP'),
            'updated_at' => new Expression('UTC_TIMESTAMP'),
		];
	}
}