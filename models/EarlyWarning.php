<?php

namespace app\models;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\widgets\Anchor;

/**
 * This is the model class for table "{{%early_warnings}}".
 *
 * @property int $id
 * @property string $subject
 * @property string|null $meteorological_conditions
 * @property string|null $impact_of_winds
 * @property string|null $precautionary_measures
 * @property string|null $bulletin_no
 * @property int|null $signal_no
 * @property string|null $category
 * @property string|null $windspeed
 * @property string|null $mayor_firstname
 * @property string|null $mayor_middlename
 * @property string|null $mayor_lastname
 * @property string|null $message
 * @property string|null $entry_text
 * @property string|null $attachment_text
 * @property string|null $other_text
 * @property string|null $attachments
 * @property string|null $token
 * @property int $record_status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class EarlyWarning extends ActiveRecord
{
    const VIEW_TABS = [
        1 => [
            'id' => 1,
            'slug' => 'detail',
            'title' => 'General Information',
            'description' => 'General Information',
            'icon' => '<i class="fa fa-edit"></i>'
        ],
        2 => [
            'id' => 2,
            'slug' => 'weather-report',
            'title' => 'Generated Printed Report',
            'description' => 'Generated Printed Report',
            'icon' => '<i class="fa fa-print"></i>'
        ],
    ];

    const ENTRY_TEXT = 'I am writing to submit the Severe Weather Bulletin prepared by the Section for Early Warning of the Municipal Disaster Risk Reduction and Management Office (MDRRMO). The bulletin includes vital information regarding an impending weather event that could significantly impact our municipality. It is crucial that we take necessary precautionary measures to ensure the safety and well-being of our residents.';

    const ATTACHMENT_TEXT = 'The attached report provides a comprehensive overview of the weather event, its potential impacts, and recommended actions. I urge you to review the information and coordinate with relevant departments and agencies to take prompt action in preparing for and responding to this severe weather event.';

    const OTHER_TEXT = 'Should you have any questions or need further assistance, please do not hesitate to contact me or the MDRRMO\'s Section for Early Warning. We are committed to working closely with your office to ensure the safety and resilience of our community during this challenging time.';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%early_warnings}}';
    }

    public function config()
    {
        return [
            'controllerID' => 'early-warning',
            'mainAttribute' => 'subject',
            'paramName' => 'token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return $this->setRules([
            [['subject'], 'required'],
            [['attachments'], 'safe'],
            [['meteorological_conditions', 'impact_of_winds', 'precautionary_measures', 'message', 'entry_text', 'attachment_text', 'other_text'], 'string'],
            [['signal_no'], 'integer'],
            [['subject', 'bulletin_no', 'category', 'windspeed', 'mayor_firstname', 'mayor_middlename', 'mayor_lastname'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return $this->setAttributeLabels([
            'id' => 'ID',
            'subject' => 'Subject',
            'meteorological_conditions' => 'Meteorological Conditions',
            'impact_of_winds' => 'Impact Of Winds',
            'precautionary_measures' => 'Precautionary Measures',
            'bulletin_no' => 'Bulletin No',
            'signal_no' => 'Signal No',
            'category' => 'Category',
            'windspeed' => 'Windspeed',
            'mayor_firstname' => 'Mayor Firstname',
            'mayor_middlename' => 'Mayor Middlename',
            'mayor_lastname' => 'Mayor Lastname',
            'message' => 'Message',
            'entry_text' => 'Entry Text',
            'attachment_text' => 'Attachment Text',
            'other_text' => 'Other Text',
            'attachments' => 'Attachments',
            'attachmentsDetailPreview' => 'Attachments',
        ]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\EarlyWarningQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\EarlyWarningQuery(get_called_class());
    }
     
    public function gridColumns()
    {
        return [
            'subject' => [
                'attribute' => 'subject', 
                'format' => 'raw',
                'value' => function($model) {
                    return Anchor::widget([
                        'title' => $model->subject,
                        'link' => $model->viewUrl,
                        'text' => true
                    ]);
                }
            ],
            // 'meteorological_conditions' => ['attribute' => 'meteorological_conditions', 'format' => 'raw'],
            // 'impact_of_winds' => ['attribute' => 'impact_of_winds', 'format' => 'raw'],
            // 'precautionary_measures' => ['attribute' => 'precautionary_measures', 'format' => 'raw'],
            'bulletin_no' => ['attribute' => 'bulletin_no', 'format' => 'raw'],
            'signal_no' => ['attribute' => 'signal_no', 'format' => 'raw'],
            'category' => ['attribute' => 'category', 'format' => 'raw'],
            'windspeed' => ['attribute' => 'windspeed', 'format' => 'raw'],
            // 'mayor_firstname' => ['attribute' => 'mayor_firstname', 'format' => 'raw'],
            // 'mayor_middlename' => ['attribute' => 'mayor_middlename', 'format' => 'raw'],
            // 'mayor_lastname' => ['attribute' => 'mayor_lastname', 'format' => 'raw'],
            // 'message' => ['attribute' => 'message', 'format' => 'raw'],
            // 'entry_text' => ['attribute' => 'entry_text', 'format' => 'raw'],
            // 'attachment_text' => ['attribute' => 'attachment_text', 'format' => 'raw'],
            // 'other_text' => ['attribute' => 'other_text', 'format' => 'raw'],
            // 'attachments' => ['attribute' => 'attachments', 'format' => 'raw'],
        ];
    }

    public function detailColumns()
    {
        return [
            'subject:raw',
            'bulletin_no:raw',
            'signal_no:raw',
            'category:raw',
            'windspeed:raw',
            'meteorological_conditions:raw',
            'impact_of_winds:raw',
            'precautionary_measures:raw',
            'entry_text:raw',
            'attachment_text:raw',
            'attachmentsDetailPreview:raw',
            // 'other_text:raw',
            // 'mayor_firstname:raw',
            // 'mayor_middlename:raw',
            // 'mayor_lastname:raw',
            // 'message:raw',
            
            // 'attachments:raw',
        ];
    }

    public function getAttachmentsDetailPreview()
    {
        if (($files = $this->attachmentFiles) != null) {
            return App::foreach($files, fn ($file) => Html::image($file, ['w' => 200], ['class' => 'img-fluid symbol']));
        }
    }

    public function setDefaultValues()
    {
        $personnel = App::setting('personnel');
        $this->mayor_firstname = $personnel->mayor_firstname;
        $this->mayor_middlename = $personnel->mayor_middlename;
        $this->mayor_lastname = $personnel->mayor_lastname;

        $this->entry_text = EarlyWarning::ENTRY_TEXT;
        $this->attachment_text = EarlyWarning::ATTACHMENT_TEXT;
        $this->other_text = EarlyWarning::OTHER_TEXT;

        $this->subject = 'Severe Weather Bulletin Submission';

        return $this;
    }

    public static function withDefaultValues()
    {
        return (new self())->setDefaultValues();
    }

    public function getMayorMiddleInitial()
    {
        return $this->mayor_middlename[0] ?? null;
    }

    public function getMayorName()
    {
        return implode(' ', array_filter([
            $this->mayor_firstname,
            (($this->mayorMiddleInitial) ? $this->mayorMiddleInitial . '.': null),
            $this->mayor_lastname,
        ]));
    }

    public function getAttachmentFiles()
    {
        return File::findAll(['token' => $this->attachments]);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['JsonBehavior']['fields'] = [
            'attachments', 
        ];

        return $behaviors;
    }
}