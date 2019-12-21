<?php

use yii\db\Migration;

/**
 * Handles the creation of table `config`.
 */
class m180727_153222_create_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'type' => $this->smallInteger()->notNull()->defaultValue(1)->comment("1 - textfield | 2 - textarea | 3 - checkbox | 4 - select | 5 - integer | 6 - decimal | 7 - currency | 8 - percentage | 9 - color | 10 - range | 11 - json_array"),
            'group' => $this->string(255)->defaultValue(null),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'options' => $this->text(),
            'value' => $this->text(),
            'order' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('slug', 'config', 'slug', false);
        
        /** Trace user actions **/
        $this->createTable('trace', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null()->defaultValue(null),
            'type' => $this->string(255),
            'object_id' => $this->integer()->null()->defaultValue(NULL),
            'message' => $this->string(512),
            'content' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey('fk_trace_user_id', 'trace', 'user_id', 'user', 'id', 'SET NULL', 'RESTRICT');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Trace user actions **/
        $this->dropForeignKey('fk_trace_user_id', 'trace');
        $this->dropTable('trace');
        
        $this->dropTable('config');
    }
}
