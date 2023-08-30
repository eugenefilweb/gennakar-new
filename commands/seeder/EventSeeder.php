<?php

namespace app\commands\seeder;

use app\commands\models\Event;
use app\helpers\App;
use app\models\EventCategory;

class EventSeeder extends Seeder
{
	public $modelClass = 'app\commands\models\Event';

	public function __construct()
	{
		parent::__construct();
	}

	public function attributes($key)
	{
		$m = rand(1, 11);
		$d = rand(1, 28);
		$date = date("2022-{$m}-{$d} H:i:s A");
		$end = date('Y-m-d H:i:s A', strtotime("{$date} +5days"));
        $created_at = implode(' ', [$date, $this->faker->time]);

        if (strtotime($date) > time()) {
        	$status = Event::PENDING;
        }
        elseif (strtotime($end) > time()) {
        	$status = Event::COMPLETED;
        }
        else {
        	$status = $this->rand([
        		Event::ONGOING,
        		Event::CANCELLED,
        	]);
        }

        $type = $this->randParams('event_types');


        if ($type == Event::ASSISTANCE) {
        	$assistanceType = $this->rand([
        		Event::CASH,
        		Event::IN_KIND,
        	]);
        }
        else {
        	$assistanceType = Event::DEFAULT_TYPE;
        }

		return [
            'name' => $this->faker->firstName . "'s Program",
            'description' => $this->faker->text,
            'beneficiaries' => '{"head":["1"],"solo_parent":["1"],"sex":["1"],"civil_status":["1"],"pwd":["2"],"age_from":"20","age_to":"60"}',
            'date_from' => $date,
            'date_to' => $end,
            'token' => implode('-', [time(), $key]),
            'status' => $status,
            'amount' => rand(5000, 10000),
            'type' => $type,
            'assistance_type' => $assistanceType,
            'category_id' => $this->rand(array_keys(EventCategory::dropdown('id', 'id'))),
            'record_status' => Event::RECORD_ACTIVE,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $created_at,
            'updated_at' => $created_at,
		];
	}

	public function randParams($param)
	{
		return $this->faker->randomElement(array_keys(App::keyMapParams($param)));
	}

	public function rand($arr)
	{
		return $this->faker->randomElement($arr);
	}
}