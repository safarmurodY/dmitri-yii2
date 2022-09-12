<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_reviews}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_products}}`
 * - `{{%user}}`
 */
class m220912_122236_create_shop_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_reviews}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'vote' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-shop_reviews-product_id}}',
            '{{%shop_reviews}}',
            'product_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_reviews-product_id}}',
            '{{%shop_reviews}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-shop_reviews-user_id}}',
            '{{%shop_reviews}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-shop_reviews-user_id}}',
            '{{%shop_reviews}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%shop_products}}`
        $this->dropForeignKey(
            '{{%fk-shop_reviews-product_id}}',
            '{{%shop_reviews}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-shop_reviews-product_id}}',
            '{{%shop_reviews}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-shop_reviews-user_id}}',
            '{{%shop_reviews}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-shop_reviews-user_id}}',
            '{{%shop_reviews}}'
        );

        $this->dropTable('{{%shop_reviews}}');
    }
}
