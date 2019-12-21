<?php

use yii\db\Migration;

/**
 * Class m180717_140333_create_rbac_permissions
 */
class m180717_140333_create_rbac_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    /*public function safeUp()
    {
        
    }

    /**
     * {@inheritdoc}
     */
    /*public function safeDown()
    {
        
    }*/

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "$accessUser" permission
        $accessUser = $auth->createPermission('accessUser');
        $accessUser->description = 'Access to regular users';
        $auth->add($accessUser);
        
        
        // add "$gerirApp" permission
        $manageApp = $auth->createPermission('manageApp');
        $manageApp->description = 'Permission to basic app managers';
        $auth->add($manageApp);


        // add "$manageUsers" permission
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Manage Users';
        $auth->add($manageUsers);
        

        // add "$adminApp" permission
        $adminApp = $auth->createPermission('adminApp');
        $adminApp->description = 'Basis administration functions of the platform';
        $auth->add($adminApp);
        
        // add "$adminFullApp" permission
        $adminFullApp= $auth->createPermission('adminFullApp');
        $adminFullApp->description = 'Ful administration functions of the platform';
        $auth->add($adminFullApp);
        
        
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $accessUser);
        
        
        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $manageApp);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $adminApp);
        $auth->addChild($admin, $manager);

        $superAdmin = $auth->createRole('superAdmin');
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $adminFullApp);
        $auth->addChild($superAdmin, $admin);
        

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        //$auth->assign($author, 2);
        $auth->assign($superAdmin, 4);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
    
}
