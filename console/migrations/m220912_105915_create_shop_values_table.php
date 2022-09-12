<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_values}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_products}}`
 * - `{{%shop_characteristics}}`
 */
class m220912_105915_create_shop_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_values}}', [
            'product_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ]);

        $this->addPrimaryKey(
            '{{%pk-shop_values}}',
            '{{%shop_values}}',
            ['product_id', 'characteristic_id']
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-shop_values-product_id}}',
            '{{%shop_values}}',
            'product_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_values-product_id}}',
            '{{%shop_values}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        // creates index for column `characteristic_id`
        $this->createIndex(
            '{{%idx-shop_values-characteristic_id}}',
            '{{%shop_values}}',
            'characteristic_id'
        );

        // add foreign key for table `{{%shop_characteristics}}`
        $this->addForeignKey(
            '{{%fk-shop_values-characteristic_id}}',
            '{{%shop_values}}',
            'characteristic_id',
            '{{%shop_characteristics}}',
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
            '{{%fk-shop_values-product_id}}',
            '{{%shop_values}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-shop_values-product_id}}',
            '{{%shop_values}}'
        );

        // drops foreign key for table `{{%shop_characteristics}}`
        $this->dropForeignKey(
            '{{%fk-shop_values-characteristic_id}}',
            '{{%shop_values}}'
        );

        // drops index for column `characteristic_id`
        $this->dropIndex(
            '{{%idx-shop_values-characteristic_id}}',
            '{{%shop_values}}'
        );

        $this->dropTable('{{%shop_values}}');
    }
}
