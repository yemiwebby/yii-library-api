<?php

use yii\db\Migration;

/**
 * Class m210331_101100_seed_book_table
 */
class m210331_101100_seed_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeBooks();
    }

    private function insertFakeBooks()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $this->insert(
                'book',
                [
                    'name'         => $faker->catchPhrase,
                    'author'       => $faker->name,
                    'release_year' => (int)$faker->year,
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210331_101100_seed_book_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210331_101100_seed_book_table cannot be reverted.\n";

        return false;
    }
    */
}