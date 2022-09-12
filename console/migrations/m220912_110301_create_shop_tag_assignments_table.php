<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_tag_assignments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%shop_products}}`
 * - `{{%shop_tags}}`
 */
class m220912_110301_create_shop_tag_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_tag_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('{{%pk-shop_tag_assignments}}', '{{%shop_tag_assignments}}', ['product_id', 'tag_id']);
        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-shop_tag_assignments-product_id}}',
            '{{%shop_tag_assignments}}',
            'product_id'
        );

        // add foreign key for table `{{%shop_products}}`
        $this->addForeignKey(
            '{{%fk-shop_tag_assignments-product_id}}',
            '{{%shop_tag_assignments}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            '{{%idx-shop_tag_assignments-tag_id}}',
            '{{%shop_tag_assignments}}',
            'tag_id'
        );

        // add foreign key for table `{{%shop_tags}}`
        $this->addForeignKey(
            '{{%fk-shop_tag_assignments-tag_id}}',
            '{{%shop_tag_assignments}}',
            'tag_id',
            '{{%shop_tags}}',
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
            '{{%fk-shop_tag_assignments-product_id}}',
            '{{%shop_tag_assignments}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-shop_tag_assignments-product_id}}',
            '{{%shop_tag_assignments}}'
        );

        // drops foreign key for table `{{%shop_tags}}`
        $this->dropForeignKey(
            '{{%fk-shop_tag_assignments-tag_id}}',
            '{{%shop_tag_assignments}}'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            '{{%idx-shop_tag_assignments-tag_id}}',
            '{{%shop_tag_assignments}}'
        );

        $this->dropTable('{{%shop_tag_assignments}}');
    }
}
