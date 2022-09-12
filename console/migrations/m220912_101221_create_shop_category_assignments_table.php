<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_category_assignments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_products}}`
 * - `{{%shop_categories}}`
 */
class m220912_101221_create_shop_category_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_category_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey(
            '{{%pk-shop_category_assignments}}',
            '{{%shop_category_assignments}}',
            ['product_id', 'category_id']
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-shop_category_assignments-product_id}}',
            '{{%shop_category_assignments}}',
            'product_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_category_assignments-product_id}}',
            '{{%shop_category_assignments}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-shop_category_assignments-category_id}}',
            '{{%shop_category_assignments}}',
            'category_id'
        );

        // add foreign key for table `{{%shop_categories}}`
        $this->addForeignKey(
            '{{%fk-shop_category_assignments-category_id}}',
            '{{%shop_category_assignments}}',
            'category_id',
            '{{%shop_categories}}',
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
            '{{%fk-shop_category_assignments-product_id}}',
            '{{%shop_category_assignments}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-shop_category_assignments-product_id}}',
            '{{%shop_category_assignments}}'
        );

        // drops foreign key for table `{{%shop_categories}}`
        $this->dropForeignKey(
            '{{%fk-shop_category_assignments-category_id}}',
            '{{%shop_category_assignments}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-shop_category_assignments-category_id}}',
            '{{%shop_category_assignments}}'
        );

        $this->dropTable('{{%shop_category_assignments}}');
    }
}
