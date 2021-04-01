<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%loan}}`.
 */
class m210331_100711_create_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('loan', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'borrower_id' => $this->integer(),
            'borrowed_on' => $this->dateTime()->defaultValue(date('Y-m-d H:i:s')),
            'to_be_returned_on' => $this->dateTime()
        ]);

        // create index for column `book_id`
        $this->createIndex(
            'idx-loan-book_id',
            'loan',
            'book_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-loan-book_id',
            'loan',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        // create index for column `borrower_id`
        $this->createIndex(
            'idx-loan-borrower_id',
            'loan',
            'borrower_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-loan-borrower_id',
            'loan',
            'borrower_id',
            'member',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%loan}}');
    }
}