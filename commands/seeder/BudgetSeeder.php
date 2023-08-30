<?php

namespace app\commands\seeder;

use app\commands\models\Budget;
use app\commands\models\Event;
use app\commands\models\Transaction;
use app\helpers\App;
use yii\db\Expression;

class BudgetSeeder extends Seeder
{
	public $modelClass = 'app\commands\models\Budget';

	public function __construct()
	{
		parent::__construct();
	}

	public function attributes($key)
	{
		$type = $this->rand([
			Transaction::EMERGENCY_WELFARE_PROGRAM,
			Transaction::SOCIAL_PENSION,
			Transaction::DEATH_ASSISTANCE
		]);

		$specific_to = $this->rand([
			Budget::TRANSACTION,
			Budget::EVENT,
		]);


		if ($specific_to == Budget::TRANSACTION) {
			$model = Transaction::find()
				->where(['transaction_type' => [
					Transaction::EMERGENCY_WELFARE_PROGRAM,
					Transaction::SOCIAL_PENSION,
					Transaction::DEATH_ASSISTANCE,
				]])
				->orderBy(new Expression('rand()'))
				->one();

			$budget = $model->amount;
		}
		else {
			$totalEvent = Event::find()->count();
			
			$model = Event::findOne(rand(1, $totalEvent));
			$budget = rand(5000, 10000);
		}

		$created_at = date('Y-m-d H:i:s A', strtotime(date('Y-m-d H:i:s A') . ' +1day'));

		return [
            'year' => date('Y'),
            'type' => $type,
            'budget' => $budget,
            'action' => Budget::SUBTRACT,
            'specific_to' => $specific_to,
            'model_id' => $model->id,
            'record_status' => Budget::RECORD_ACTIVE,
            'remarks' => '',
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