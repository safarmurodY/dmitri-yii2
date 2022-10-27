<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%shop_products}}`.
 */
class m221027_112207_add_status_column_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_products}}', 'status');
    }
}
