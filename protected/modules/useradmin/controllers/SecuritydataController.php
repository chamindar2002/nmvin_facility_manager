<?php

class SecuritydataController extends Controller
{
    public function beforeAction($action) {
            //echo Address::model()->tableName();
                $this->layout = UserAdmin::module()->layout;
		return parent::beforeAction($action);
	}
        
	public function actionIndex()
	{
            $allRecords = Role::model()->findAll();
           
            //---------------------
            $dataProvider=new CActiveDataProvider('Role');
            //---------------------

            $this->render('index',array('dataProvider'=>$dataProvider,'records'=>$allRecords,));
	}
        
        public function actionListPermissions(){
           $id = Yii::app()->user->getState('roleId');

           $action_permission_records = AuthActionPermission::model()->findAll();
           $actn_prctmsn_role_ref_rcds = AuthRoleActionPermission::model()->findAllByAttributes(array('rid'=>$id));

           $all_data = Array(
                            'action_permission_records'=>$action_permission_records,
                            'action_permission_role_ref_records'=>$actn_prctmsn_role_ref_rcds
                         );

           $this->render('permissions',
                          array('action_permissions_list'=>$all_data,));
        }


        public function actionUpdateRoles(){
            //print_r($_POST['Ap']);
        if(isset($_POST['Ap'])){

            $Ap = $_POST['Ap'];
            $rid = $_POST['txt_hdn_rid'];

            //$this->load->model('securitydata_model');
            //$action_permission_refs = $this->securitydata_model->_listActionPermisions();
            $action_permission_refs = AuthActionPermission::model()->findAll();


            $arr_selected_permissions = array();

            foreach($Ap As $a) {
                $arr_selected_permissions[$a] = true;
            }

            
            foreach($action_permission_refs As $apr) {
                //echo $apr->id.'<br>';
                //$exists = $this->securitydata_model->isRoleActionPermissionExist($rid,$apr->id);
                $exists = AuthRoleActionPermission::model()->findAllByAttributes(array('rid'=>$rid,'aid'=>$apr->id));
                //echo sizeof($exists).'<br>';
                if(!isset($arr_selected_permissions[$apr->id])) {

                    //echo $apr->id.'delete'.sizeof($exists).'<br>';

                    if(sizeof($exists) == 1) {
                        //$this->securitydata_model->deleteActionPermissionRoleRef($rid,$apr->id);
                        AuthRoleActionPermission::model()->deleteAllByAttributes(array('rid'=>$rid,'aid'=>$apr->id));
                    }
                    
                }else {
                    //echo $apr->id.'add to file'.sizeof($exists).'<br>';
                    
                    if(sizeof($exists) == 0) {
                        //$this->securitydata_model->addActionPermissionRoleRef($rid,$apr->id);
                        $role_action_perm_ref = new AuthRoleActionPermission();
                        $role_action_perm_ref->rid = $rid;
                        $role_action_perm_ref->aid = $apr->id;
                        $role_action_perm_ref->save();
                        $role_action_perm_ref->getErrors();
                       

                    }
                }

            }
            //-------------------------------------------------------
            
            $msg = 'Data saved!';
            //-------------------------------------------------------

            Yii::app()->user->setFlash('success', $msg);
            $this->actionIndex();
        }else{
            $this->actionIndex();
        }
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}