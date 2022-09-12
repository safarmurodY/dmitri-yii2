<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_modifications}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_products}}`
 */
class m220912_111415_create_shop_modifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_modifications}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer(),
        ]);

        $this->createIndex('{{%idx-shop_modifications-code}}',
            '{{%shop_modifications}}',
            'code'
        );
        $this->createIndex('{{%idx-shop_modifications-product_id-code}}',
            '{{%shop_modifications}}',
            ['product_id', 'code'],
            true
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-shop_modifications-product_id}}',
            '{{%shop_modifications}}',
            'product_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_modifications-product_id}}',
            '{{%shop_modifications}}',
            'product_id',
            '{{%shop_products}}',
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
            '{{%fk-shop_modifications-product_id}}',
            '{{%shop_modifications}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-shop_modifications-product_id}}',
            '{{%shop_modifications}}'
        );

        $this->dropTable('{{%shop_modifications}}');
    }
}
