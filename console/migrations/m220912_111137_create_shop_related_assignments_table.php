<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_related_assignments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_products}}`
 * - `{{%shop_products}}`
 */
class m220912_111137_create_shop_related_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_related_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey(
            '{{%pk-shop_related_assignments}}', 
            '{{%shop_related_assignments}}', 
            ['product_id', 'related_id']
        );
        
        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-shop_related_assignments-product_id}}',
            '{{%shop_related_assignments}}',
            'product_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_related_assignments-product_id}}',
            '{{%shop_related_assignments}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        // creates index for column `related_id`
        $this->createIndex(
            '{{%idx-shop_related_assignments-related_id}}',
            '{{%shop_related_assignments}}',
            'related_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_related_assignments-related_id}}',
            '{{%shop_related_assignments}}',
            'related_id',
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
            '{{%fk-shop_related_assignments-product_id}}',
            '{{%shop_related_assignments}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-shop_related_assignments-product_id}}',
            '{{%shop_related_assignments}}'
        );

        // drops foreign key for table `{{%shop_products}}`
        $this->dropForeignKey(
            '{{%fk-shop_related_assignments-related_id}}',
            '{{%shop_related_assignments}}'
        );

        // drops index for column `related_id`
        $this->dropIndex(
            '{{%idx-shop_related_assignments-related_id}}',
            '{{%shop_related_assignments}}'
        );

        $this->dropTable('{{%shop_related_assignments}}');
    }
}
