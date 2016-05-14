<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $uid
 * @property integer $enabled
 * @property string $loginname
 * @property string $familyname
 * @property string $firstname
 * @property string $password
 * @property integer $deleted
 */
class User extends CActiveRecord
{
     public $repeat_password;
     public $repeat_email;
     
     public $old_password;
     public $new_password;
     
     public $login_email;
     
     //public $fullName;
     
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auth_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
                        array('old_password', 'findPasswords', 'on' => 'changePwd'),
                        array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd'),
                        
                        array('login_email', 'required', 'on' => 'resetPwd'),
                        array('login_email', 'findloginname', 'on' => 'resetPwd'),
                        //array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd'),
                    
                    
			array('enabled, loginname, familyname, firstname, password', 'required'),
			array('enabled, deleted', 'numerical', 'integerOnly'=>true),
			array('loginname, familyname, firstname, password', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, enabled, loginname, familyname, firstname, password, deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'enabled' => 'Enabled',
			'loginname' => 'Login name',
			'familyname' => 'Last name',
			'firstname' => 'First name',
			'password' => 'Password',
			'deleted' => 'Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('loginname',$this->loginname,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function encryptPassword($password){
            return md5($password);
        }
        
        public function userStates(){
            return array(1=>'Enabled',0=>'Disabled');
        }
        
        public function findPasswords($attribute, $params)
        {
            $user = User::model()->findByPk(Yii::app()->user->userId);
            if ($user->password != $this->encryptPassword($this->old_password))
                $this->addError($attribute, 'Old password is incorrect.');
        }
        
        public function findloginname($attribute,$params){
            $user = User::model()->findByAttributes(array('loginname'=>$this->login_email));
            //var_dump($user);exit;
            if(sizeof($user) != 1)
                   $this->addError($attribute,'Login email not found');
        }
        
        public function getFullName()
        {
                return $this->firstname . ' ' . $this->familyname;
        }
        
        public function listAllValidUsers(){
            $criteria = new CDbCriteria();
            $criteria->compare('deleted', 0);
            $criteria->compare('enabled', 1);
            $criteria->condition = "uid <> 1";
            
            return User::findAll($criteria);
        }
        
        public static function _can($roles, $continue=false){
            
            
            if(!empty($roles)){
                foreach($roles As $key=>$role){
                    //echo "$role <br>";
                            
                    if(Yii::app()->user->getState('roleName') == $role){
                        return true;
                    }
                }
            }

			if($continue){
				return false;
			}
            
            throw new CHttpException(404,'you are not authorized to perform this operation.');
            //throw new Exception('you are not authorized to perform this operation.'); 
        }
}
