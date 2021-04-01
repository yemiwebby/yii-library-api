<?php

namespace app\controllers;

use app\models\Book;
use app\models\Loan;
use app\models\Member;

class LoanController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    
    public function actionIndex()
    {
        $loans = Loan::find()->all();

        return $this->asJson($loans);
    }

    private function errorResponse($message)
    {
                
        // set response code to 400
        \Yii::$app->response->statusCode = 400;

        return $this->asJson(['error' => $message]);
    }

    public function actionBorrow()
    {
        $request = \Yii::$app->request;

        $bookId = $request->post('book_id');
        $book = Book::findOne($bookId);

        if (is_null($book)) {
            return $this->errorResponse('Could not find book with provided ID');
        }

        if (!$book->is_available_for_loan) {
            return $this->errorResponse('This book is not available for loan');
        }

        $borrowerId = $request->post('member_id');

        if (is_null(Member::findOne($borrowerId))) {
            return $this->errorResponse('Could not find member with provided ID');
        }

        $loan = new Loan();
        $returnDate = strtotime('+ 1 month');
        $loan->attributes =
            [
                'book_id'           => $bookId,
                'borrower_id'       => $borrowerId,
                'borrowed_on'       => date('Y-m-d H:i:s'),
                'to_be_returned_on' => date('Y-m-d H:i:s', $returnDate)
            ];

        $book->markAsBorrowed();
        $loan->save();

        return $this->asJson(
            $loan
        );
    }
}