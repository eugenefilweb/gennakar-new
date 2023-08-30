<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\StringHelper;
use app\helpers\Url;
use app\models\form\CustomEmailForm;
use app\widgets\Anchor;
use app\widgets\Label;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%notifications}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $message
 * @property string|null $link
 * @property string $type
 * @property string $token
 * @property int $status
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Notification extends ActiveRecord
{
    const IMPORT_HOUSEHOLD = 'import_household';
    const IMPORT_MEMBER = 'import_member';
    const CHANGED_PASSWORD = 'notification_change_password';
    const NEW_TRANSACTION = 'new_transaction';
    const MHO_TRANSACTION = 'mho_transaction';
    const CLERK_TRANSACTION = 'clerk_transaction';
    const MSWDO_HEAD_TRANSACTION = 'mswdo_head_transaction';
    const MAYOR_TRANSACTION = 'mayor_transaction';
    const BUDGET_OFFICER_TRANSACTION = 'budget_officer_transaction';
    const ACCOUNTING_TRANSACTION = 'accounting_officer_transaction';
    const DISBURSING_TRANSACTION = 'disbursing_officer_transaction';
    const TREASURER_TRANSACTION = 'treasurer_transaction';
    const AMBULANCE_REQUEST = 'ambulance_request';
    const TECHNICAL_ISSUE = 'technical_issue';
    const NEW_PATROL = 'new_patrol';
    const IMPORT_SURVEY = 'import_survey';
    const APPROVED_REQUEST = 'approved_request';

    const STATUS_READ = 1;
    const STATUS_UNREAD = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%notifications}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'notification',
            'mainAttribute' => 'message',
            'paramName' => 'token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['user_id', 'status',], 'integer'],
            [['message', 'link'], 'string'],
            [['type', 'user_id'], 'required'],
            [['type'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'targetRelation' => 'user'],
            ['status', 'in', 'range' => [self::STATUS_READ, self::STATUS_UNREAD]],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'user_id' => 'User ID',
            'message' => 'Message',
            'link' => 'Link',
            'type' => 'Type',
            'status' => 'Status',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\NotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\NotificationQuery(get_called_class());
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
     
    public function gridColumns()
    {
        return [
            'message' => [
                'attribute' => 'message', 
                'format' => 'raw',
                'value' => function($model) {
                    return $model->label . '<br>' . Anchor::widget([
                        'title' => $model->message,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            'link' => [
                'attribute' => 'id', 
                'value' => 'statusHtml', 
                'label' => 'Status', 
                'format' => 'raw'
            ],
            // 'type' => ['attribute' => 'type', 'format' => 'raw'],
            // 'token' => ['attribute' => 'token', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'message:raw',
            'statusHtml' => [
                'label' => 'status',
                'attribute' => 'statusHtml',
                'format' => 'raw'
            ],
        ];
    }

    public function getFooterDetailColumns()
    {
        $col = parent::getFooterDetailColumns();
        unset($col['recordStatusHtml']);

        return $col;
    }

    public function getStatusData()
    {
        return App::params('notification_status')[$this->status];
    }

    public function getStatusHtml()
    {
        return Label::widget([
            'options' => $this->statusData
        ]);
    }

    public function getIsNew()
    {
        return $this->status == 1;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        
        $this->message = $this->message ?: App::setting('notification')->{$this->type};

        return true;
    }

    public function setToRead()
    {
        $this->status = self::STATUS_READ;
    }

    public function setToUnread()
    {
        $this->status = self::STATUS_UNREAD;
    }

    public function getBulkActions()
    {
        $bulkActions = parent::getBulkActions();

        $bulkActions['read'] = [
            'label' => 'Mark as Read',
            'process' => 'read',
            'icon' => 'read',
            'function' => function($id) {
                self::readAll(['id' => $id]);
            }
        ];
        $bulkActions['unread'] = [
            'label' => 'Mark as Un-Read',
            'process' => 'unread',
            'icon' => 'in_active',
            'function' => function($id) {
                self::unreadAll(['id' => $id]);
            }
        ];
        
        return $bulkActions;
    }


    public static function activeAll($condition = '')
    {
        $condition['user_id'] = $condition['user_id'] ?? App::identity('id');
        return parent::activeAll($condition);
    }

    public static function inactiveAll($condition = '')
    {
        $condition['user_id'] = $condition['user_id'] ?? App::identity('id');
        return parent::inactiveAll($condition);
    }

    public static function deleteAll($condition = null, $params = []) 
    {
        $condition['user_id'] = $condition['user_id'] ?? App::identity('id');
        return parent::deleteAll($condition, $params);
    }

    public static function readAll($condition='')
    {
        $condition['user_id'] = $condition['user_id'] ?? App::identity('id');
        return parent::updateAll(['status' => self::STATUS_READ], $condition);
    }

    public static function unreadAll($condition='')
    {
        $condition['user_id'] = $condition['user_id'] ?? App::identity('id');
        return parent::updateAll(['status' => self::STATUS_UNREAD], $condition);
    }

    public static function unread($user_id='')
    {
        $user_id = $user_id ?: App::identity('id');
        return self::find()
            ->where(['user_id' => $user_id])
            ->orderBy(['id' => SORT_DESC])
            ->unread()
            ->all();
    }

    public static function totalUnread($user_id='')
    {
        $user_id = $user_id ?: App::identity('id');
        return self::find()
            ->where(['user_id' => $user_id])
            ->orderBy(['id' => SORT_DESC])
            ->unread()
            ->count();
    }

    public function getLabel()
    {
        $data = App::keyMapParams('notification_types', 'type', 'label');
        return $data[$this->type];
    }

    public function getSecondaryLabel()
    {
        $data = App::keyMapParams('notification_types', 'type', 'secondaryLabel');
        return $data[$this->type];
    }

    public static function defaultData($user)
    {
        return [
            'user_id' => $user->id,
            'status' => self::STATUS_UNREAD,
            'token' => implode('', [App::randomString(5), $user->id, time()]),
            'record_status' => self::RECORD_ACTIVE,
            'created_by' => App::identity('id') ?: 0,
            'updated_by' => App::identity('id') ?: 0,
            'created_at' => new Expression('UTC_TIMESTAMP'),
            'updated_at' => new Expression('UTC_TIMESTAMP'),
        ];
    }

    public static function techIssue($techIssue)
    {
        $roles = [
            Role::DEVELOPER,
        ];

        $data = App::foreach(User::findAll(['role_id' => $roles]), function($user) use($techIssue) {
            if ($user->setting('new_tech_issue')) {
                $arr = self::defaultData($user);
                $arr['type'] = self::TECHNICAL_ISSUE;
                $arr['link'] = Url::toRoute(['/tech-issue/view', 'token' => $techIssue->token]);
                $arr['message'] = implode(' ', [
                    $techIssue->typeLabel,
                    StringHelper::truncate($techIssue->description, 50),
                ]);
                return $arr;
            }
        }, false);

        return self::batchInsert($data);
    }

    public static function patrol($patrol)
    {
        $roles = [
            Role::DEVELOPER,
            Role::ADMIN,
            Role::BIODIVERSITY_MANAGER,
        ];

        $data = App::foreach(User::findAll(['role_id' => $roles]), function($user) use($patrol) {
            if ($user->setting('new_patrol')) {
                $arr = self::defaultData($user);
                $arr['type'] = self::NEW_PATROL;
                $arr['link'] = Url::toRoute(['/patrol/view', 'id' => $patrol->id]);
                $arr['message'] = implode(' - ', [$patrol->createdByName, $patrol->watershed]);
                return $arr;
            }
        }, false);

        return self::batchInsert($data);
    }

    public static function request($request)
    {
        $roles = [
            Role::REQUEST_APPROVER,
            Role::DEVELOPER,
            Role::ADMIN,
        ];
        $data = App::foreach(User::findAll(['role_id' => $roles]), function($user) use($request) {
            if ($user->setting('new_request')) {
                $arr = self::defaultData($user);
                $arr['type'] = self::AMBULANCE_REQUEST;
                $arr['link'] = Url::toRoute(['/request/view', 'id' => $request->id]);
                $arr['message'] = implode(' ', [
                    $request->typeLabel,
                    $request->name,
                ]);
                
                return $arr;
            }
        }, false);

        return self::batchInsert($data);
    }

    public static function approvedRequestEmail($request)
    {
        if ($request->status == Request::STATUS_APPROVED) {
            $roles = [
                Role::DEVELOPER,
                // Role::SUPERADMIN,
                Role::ADMIN,
                Role::SIAD,
                Role::DRRM,
            ];

            $request->refresh();
            $users = User::findAll(['role_id' => $roles]);

            $data = App::foreach($users, function($user) use($request) {
                if ($user->setting('approved_request')) {
                    $arr = self::defaultData($user);
                    $arr['type'] = self::APPROVED_REQUEST;
                    $arr['link'] = Url::toRoute(['/request/view', 'id' => $request->id]);
                    $arr['message'] = implode(' ', [
                        $request->typeLabel,
                        $request->name,
                    ]);
                    
                    return $arr;
                }
            }, false);
            self::batchInsert($data);

            $messages = App::foreach($users, function($user) use($request) {
                if ($user->setting('email_approved_request')) {
                    $model = new CustomEmailForm([
                        'to' => $user->email,
                        // 'to' => 'roel.filweb@gmail.com',
                        'subject' => 'Approved Ambulance Request',
                        'template' => 'approved-ambulance-request',
                        'parameters' => [
                            'user' => $user,
                            'model' => $request
                        ],
                    ]);
                    return $model->send('multiple');
                }
            }, false);

            return Yii::$app->mailer->sendMultiple($messages);
        }
    }

    public static function changePassword($user)
    {
        if ($user->setting('system_change_password')) {
            $data = self::defaultData($user);
            $data['type'] = self::CHANGED_PASSWORD;
            $data['link'] = Url::toRoute(['/user/my-password']);
            $data['message'] = App::setting('notification')->notification_change_password;
            
            return self::batchInsert([$data]);
        }
    }

    public static function changePasswordEmail($user)
    {
        if ($user->setting('email_change_password')) {
            $mail = new CustomEmailForm([
                'subject' => 'Password Change',
                'template' => 'main',
                'parameters' => [
                    'content' => App::setting('email')->email_change_password,
                ],
                'to' => $user->email
            ]);
            return $mail->send();
        }
    }
}