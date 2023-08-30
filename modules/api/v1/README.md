# API Module v1

Create tables
	```yii migrate --migrationPath=modules\api\v1\migrations``` - Create tables

Install codeception if not exist
	```php vendor/bin/codecept bootstrap modules/api/v1``` - Install codeception
	you may need to adjust the unit.suite.yml (make sure to same it with the root test unit.suite.yml)


Doing tests
	```yii fixture * --namespace=app\modules\api\v1\tests\fixtures``` - Insert fixed data

	```php vendor/bin/codecept run -c modules/api/v1``` - Test
