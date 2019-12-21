<?php

use yii\db\Migration;

/**
 * Class m180719_151011_update_profile_fields
 */
class m180719_151011_update_profile_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('profile', 'image_id', $this->integer()->null()->after('name'));
        
        $this->addForeignKey('fk_profile_image_id', 'profile', 'image_id', 'filemanager_mediafile', 'id', 'SET NULL', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_profile_image_id', 'profile');
        $this->dropColumn('profile', 'image_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180719_151011_update_profile_fields cannot be reverted.\n";

        return false;
    }
    */
}
