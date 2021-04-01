<?php

namespace app\controllers;

class BookController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Book';

    
    public function actionIndex()
    {
        return $this->render('index');
    }
}