<?php
class UserIdentity extends CUserIdentity
{
    public $userType = 'Front';

    public function authenticate()
    {
        
            // check if login details exists in database
            $record=User::model()->findByAttributes(array('loginname'=>$this->username,'enabled'=>true));

            if($record===null)
            {
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
            //else if($record->password!== md5(($this->password)))            // here I compare db password with password field
            else if($record->password != User::model()->encryptPassword($this->password))
            {
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {
                $this->setState('userId',$record->uid);
                $this->setState('name', $record->firstname.' '.$record->familyname);
                                
                //get user role
                $urrf = UserRoleRef::model()->findByAttributes(array('uid'=>$record->uid));
                
                if($urrf !== null){
                    $this->setState('roleId',$urrf->rid);
                    $this->setState('roleName', $urrf->roles->name);
                    
                }else{
                    $this->setState('roleId',0);
                }

                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
     
        
    }
}






//<?php
//
///**
// * UserIdentity represents the data needed to identity a user.
// * It contains the authentication method that checks if the provided
// * data can identity the user.
// */
//class UserIdentity extends CUserIdentity
//{
//	/**
//	 * Authenticates a user.
//	 * The example implementation makes sure if the username and password
//	 * are both 'demo'.
//	 * In practical applications, this should be changed to authenticate
//	 * against some persistent user identity storage (e.g. database).
//	 * @return boolean whether authentication succeeds.
//	 */
//	public function authenticate()
//	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//
//
//
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
//	}
//}