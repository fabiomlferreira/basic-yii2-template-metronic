<?php
namespace app\models\user;

use Da\User\Model\User as BaseUser;
use app\models\Team;
use app\models\TeamUser;
/*
    @property Deputy[] $deputy
 * @property TeamUser[] $teamUsers
 * @property Team[] $teams
 * @property Team $team
 * 
 */
class User extends BaseUser
{
    
    /**
     * Return the name os the user or if not set the username
     * @return type
     */
    public function getCompleteName(){
        if(!empty($this->profile->name)){
            return $this->profile->name;
        }else{
            return $this->username;
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getDeputy()
    {
        return $this->hasOne(Deputy::className(), ['user_id' => 'id']);
    }*/
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamUsers()
    {
        return $this->hasMany(TeamUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['id' => 'team_id'])->viaTable('team_user', ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id'])->viaTable('team_user', ['user_id' => 'id']);
    }
    
}