<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m180915_113904_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'position' => $this->smallInteger()->notNull()->defaultValue(1)->comment("1 - main menu | 2 - above top menu | 3 - footer menu"),
            'parent_id' => $this->integer()->null()->defaultValue(null),
            'title' => $this->string(255)->notNull(),
            'lang' => $this->string(10)->defaultValue('en-US'),
            'url' => $this->string(255)->notNull(),
            'order' => $this->smallInteger()->defaultValue(0),
            'permission' => $this->string(64)->null()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        
        $this->createIndex('lang', 'menu', 'lang', false); 
        $this->createIndex('parent_id', 'menu', 'parent_id', false); 
        $this->createIndex('position', 'menu', 'position', false);
        $this->addForeignKey('fk_menu_parent_id', 'menu', 'parent_id', 'menu', 'id', 'CASCADE', 'RESTRICT');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_menu_parent_id', 'menu');
        $this->dropTable('menu');
    }
}
