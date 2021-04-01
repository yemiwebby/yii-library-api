<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $author
 * @property int|null $release_year
 * @property int|null $is_available_for_loan
 *
 * @property Loan[] $loans
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['release_year', 'is_available_for_loan'], 'integer'],
            [['name', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author' => 'Author',
            'release_year' => 'Release Year',
            'is_available_for_loan' => 'Is Available For Loan',
        ];
    }

    /**
     * Gets query for [[Loans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['book_id' => 'id']);
    }

    public function markAsBorrowed() {

        $this->is_available_for_loan = (int)false;
        $this->save();
    }
}
