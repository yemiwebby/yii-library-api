<?php

namespace app\controllers;

class MemberController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Member';

     public function actionIndex()
     {
         return $this->render('index');
     }
}