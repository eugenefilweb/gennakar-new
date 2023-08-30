<?php

namespace app\controllers;

class DisasterPreparednessController extends Controller 
{
    public function actionPagasa()
    {
        return $this->render('pagasa');
    }

    public function actionPhivolcs()
    {
        return $this->render('phivolcs');
    }

    public function actionNdrrmc()
    {
        return $this->render('ndrrmc');
    }

    public function actionExecutives()
    {
        return $this->render('executives');
    }

    public function actionFacebook()
    {
        return $this->render('facebook');
    }
} 