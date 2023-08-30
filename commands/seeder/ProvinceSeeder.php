<?php

namespace app\commands\seeder;

use app\helpers\App;
use yii\db\Expression;
use app\commands\models\Region;
use app\commands\models\Province;

class ProvinceSeeder extends Seeder
{
	public $modelClass = 'app\commands\models\Province';
    const DATA = [
        array('ILOCOS NORTE', 1, 28),
        array('ILOCOS SUR', 1, 29),
        array('LA UNION', 1, 33),
        array('PANGASINAN', 1, 55),
        array('BATANES', 2, 9),
        array('CAGAYAN', 2, 15),
        array('ISABELA', 2, 31),
        array('NUEVA VIZCAYA', 2, 50),
        array('QUIRINO', 2, 57),
        array('BATAAN', 3, 8),
        array('BULACAN', 3, 14),
        array('NUEVA ECIJA', 3, 49),
        array('PAMPANGA', 3, 54),
        array('TARLAC', 3, 69),
        array('ZAMBALES', 3, 71),
        array('AURORA', 3, 77),
        array('BATANGAS', 4, 10),
        array('CAVITE', 4, 21),
        array('LAGUNA', 4, 34),
        array('QUEZON', 4, 56),
        array('RIZAL', 4, 58),
        array('ALBAY', 5, 5),
        array('CAMARINES NORTE', 5, 16),
        array('CAMARINES SUR', 5, 17),
        array('CATANDUANES', 5, 20),
        array('MASBATE', 5, 41),
        array('SORSOGON', 5, 62),
        array('AKLAN', 6, 4),
        array('ANTIQUE', 6, 6),
        array('CAPIZ', 6, 19),
        array('ILOILO', 6, 30),
        array('NEGROS OCCIDENTAL', 6, 45),
        array('GUIMARAS', 6, 79),
        array('BOHOL', 7, 12),
        array('CEBU', 7, 22),
        array('NEGROS ORIENTAL', 7, 46),
        array('SIQUIJOR', 7, 61),
        array('EASTERN SAMAR', 8, 26),
        array('LEYTE', 8, 37),
        array('NORTHERN SAMAR', 8, 48),
        array('SAMAR (WESTERN SAMAR)', 8, 60),
        array('SOUTHERN LEYTE', 8, 64),
        array('BILIRAN', 8, 78),
        array('ZAMBOANGA DEL NORTE', 9, 72),
        array('ZAMBOANGA DEL SUR', 9, 73),
        array('ZAMBOANGA SIBUGAY', 9, 83),
        array('BUKIDNON', 10, 13),
        array('CAMIGUIN', 10, 18),
        array('LANAO DEL NORTE', 10, 35),
        array('MISAMIS OCCIDENTAL', 10, 42),
        array('MISAMIS ORIENTAL', 10, 43),
        array('DAVAO (DAVAO DEL NORTE)', 11, 23),
        array('DAVAO DEL SUR', 11, 24),
        array('DAVAO ORIENTAL', 11, 25),
        array('COMPOSTELA VALLEY', 11, 82),
        array('COTABATO (NORTH COTABATO)', 12, 47),
        array('SOUTH COTABATO', 12, 63),
        array('SULTAN KUDARAT', 12, 65),
        array('SARANGANI', 12, 80),
        array('COTABATO CITY', 12, 98),
        array('NCR - Manila', 13, 39),
        array('NCR 2', 13, 74),
        array('NCR 3', 13, 75),
        array('NCR 4', 13, 76),
        array('ABRA', 14, 1),
        array('BENGUET', 14, 11),
        array('IFUGAO', 14, 27),
        array('KALINGA', 14, 32),
        array('MOUNTAIN PROVINCE', 14, 44),
        array('APAYAO', 14, 81),
        array('BASILAN', 15, 7),
        array('LANAO DEL SUR', 15, 36),
        array('MAGUINDANAO', 15, 38),
        array('SULU', 15, 66),
        array('TAWI-TAWI', 15, 70),
        array('AGUSAN DEL NORTE', 16, 2),
        array('AGUSAN DEL SUR', 16, 3),
        array('SURIGAO DEL NORTE', 16, 67),
        array('SURIGAO DEL SUR', 16, 68),
        array('DINAGAT ISLANDS', 16, 85),
        array('MARINDUQUE', 17, 40),
        array('OCCIDENTAL MINDORO', 17, 51),
        array('ORIENTAL MINDORO', 17, 52),
        array('PALAWAN', 17, 53),
        array('ROMBLON', 17, 59)
    ];

	public function attributes($key)
	{
        list($name, $region_no, $no) = self::DATA[$key - 1];
        $region = Region::findOne(['no' => $region_no]);

        return [
            'name' => $name,
            'region_id' => ($region)? $region->id: 0,
            'no' => $no,
            'created_at' => new Expression('UTC_TIMESTAMP'),
            'updated_at' => new Expression('UTC_TIMESTAMP'),
        ];
	}
}