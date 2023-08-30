<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\widgets\Anchor;
use app\widgets\JsonEditor;
use app\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%roles}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $main_navigation
 * @property string|null $role_access
 * @property string|null $module_access
 * @property string $slug
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Role extends ActiveRecord
{
    const DEVELOPER = 1;
    const SUPERADMIN = 2;
    const ADMIN = 3;

    const MSWDO_CLERK = 4;
    const MSWDO_HEAD = 5;
    const MHO = 6;
    const MAYOR = 7;
    const BUDGET_OFFICER = 8;
    const ACCOUNTING_OFFICER = 9;
    const DISBURSING_OFFICER = 10;
    const TREASURER = 11;

    const PLANNING_OFFICER = 12;

    const SIAD = 13;
    const DRRM = 14;
    const REQUEST_APPROVER = 15;
    const BIODIVERSITY_MANAGER = 16;
    const PATROLLER = 17;

    const TEAM_LEADER = 18;
    const DRR_OPERATIONS = 19;
    const FORESTER = 20;
    const TLX = 21;
    const TLY = 22;
    const BARANGAY_DRR_COUNCILS = 24;
    const DRR_DISPATCHER = 25;
    const DRR_ADMIN = 26;
    const DRR_PLANNING = 27;
    const DASHBOARD_ONLY = 28;
    const BERTSEC = 29;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%roles}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'role',
            'mainAttribute' => 'name',
            'paramName' => 'slug',
            'relatedModels' => ['users']
        ];
    }

    public function getCanDelete()
    {
        return App::ifElse(
            App::identity('role_id') == $this->id, 
            false, 
            App::ifElse($this->users, false, true)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['name',], 'required'],
            [['main_navigation', 'role_access', 'module_access'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'name' => 'Name',
            'main_navigation' => 'Main Navigation',
            'role_access' => 'Role Access',
            'module_access' => 'Module Access',
            'slug' => 'Slug',
            'jsonMainNavigation' => 'Main Navigation',
            'jsonRoleAccess' => 'Role Access',
            'jsonModuleAccess' => 'Module Access',
        ]);
    }

    public function getIsSiad()
    {
        return $this->id == self::SIAD;
    }

    public function getIsDrrm()
    {
        return $this->id == self::DRRM;
    }


    public function getIsDeveloper()
    {
        return $this->id == self::DEVELOPER;
    }

    public function getIsSuperadmin()
    {
        return $this->id == self::SUPERADMIN;
    }

    public function getIsAdmin()
    {
        return $this->id == self::ADMIN;
    }

    public function getIsClerk()
    {
        return $this->id == self::MSWDO_CLERK;
    }

    public function getIsHead()
    {
        return $this->id == self::MSWDO_HEAD;
    }

    public function getIsMho()
    {
        return $this->id == self::MHO;
    }

    public function getIsMayor()
    {
        return $this->id == self::MAYOR;
    }

    public function getIsBudgetOfficer()
    {
        return $this->id == self::BUDGET_OFFICER;
    }

    public function getIsAccountingOfficer()
    {
        return $this->id == self::ACCOUNTING_OFFICER;
    }

    public function getIsDisbursingOfficer()
    {
        return $this->id == self::DISBURSING_OFFICER;
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RoleQuery(get_called_class());
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }
    
    public function getJsonRoleAccess()
    {
        return JsonEditor::widget([
            'data' => $this->role_access,
        ]);
    }

    public function getJsonMainNavigation()
    {
        return JsonEditor::widget([
            'data' => $this->main_navigation,
        ]);
    }

    public function getJsonModuleAccess()
    {
        return JsonEditor::widget([
            'data' => $this->module_access,
        ]);
    }

    public function getGridColumns()
    {
        $columns = parent::getGridColumns();
        unset($columns['active']);

        $columns['record_status'] = [
            'attribute' => 'record_status',
            'label' => 'record status',
            'format' => 'raw', 
            'value' => 'recordStatusBadge'
        ];

        return $columns;
    }

    public function gridColumns()
    {
        return [
            'name' => [
                'attribute' => 'name', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->name,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            // 'main_navigation' => ['attribute' => 'main_navigation', 'format' => 'raw'],
            // 'role_access' => ['attribute' => 'role_access', 'format' => 'raw'],
            // 'module_access' => ['attribute' => 'module_access', 'format' => 'raw'],
            // 'slug' => ['attribute' => 'slug', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'name:raw',
            'main_navigation:jsonEditor',
            'role_access:jsonEditor',
            'module_access:jsonEditor',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['JsonBehavior']['fields'] = [
            'role_access', 
            'main_navigation',
            'module_access',
        ];
        $behaviors['SluggableBehavior'] = [
            'class' => 'yii\behaviors\SluggableBehavior',
            'attribute' => 'name',
            'ensureUnique' => true,
        ];

        return $behaviors;
    }


    public static function dropdownAccess($key='id', $value='name', $condition=[], $map=true, $limit=false)
    {
        $condition['id'] = App::identity('roleAccess') ?: App::identity('id');
        
        $models = self::find()
            ->where($condition)
            ->orderBy([$value => SORT_ASC])
            ->limit($limit)
            ->all();

        $models = ($map)? ArrayHelper::map($models, $key, $value): $models;

        return $models;
    }
}