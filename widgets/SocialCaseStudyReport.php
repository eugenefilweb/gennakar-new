<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;

class SocialCaseStudyReport extends BaseWidget
{
    public $model;
    public $content;

    public $contentOnly = false;

    public function init()
    {
        parent::init();
        $template = App::setting('reportTemplate');
        $template->setData();

        $replace = [
            '[FULLNAME]'  => ucwords(strtolower($this->model->fullname)),
            '[AGE]' => $this->model->currentAge,
            '[OCCUPATION]' => ucwords(strtolower($this->model->occupation)) ?: '[OCCUPATION]',
            '[SEX]' => $this->model->genderName,
            '[DATE_OF_BIRTH]' => $this->model->birthDate,
            '[PLACE_OF_BIRTH]' => $this->model->birth_place ?: 'N/A',
            '[ADDRESS]' => $this->model->address,
            '[CIVIL_STATUS]' => $this->model->civilStatusName,
            '[OCCUPATION]' => $this->model->occupation ?: 'N/A',
            '[MONTHLY_INCOME]' => $this->model->monthlyIncome,
            '[CP_NO]' => $this->model->contact_no ?: 'N/A',
            '[FAMILY_COMPOSITION]' => $this->render('social-case-study-report/family-composition', [
                'model' => $this->model
            ]),
        ];

        if (App::isLogin()) {
            $profile = App::identity('profile');
            $replace['[PREPARED_BY]'] = $profile->fullname;
        }

        $this->content = str_replace(array_keys($replace), array_values($replace), $template->social_case_study_report);
    }


    public function run()
    {
        if ($this->contentOnly) {
            return  $this->content;
        }
        
        return $this->render('social-case-study-report/index', [
            'content' => $this->content,
            'model' => $this->model,
        ]);
    }
}
