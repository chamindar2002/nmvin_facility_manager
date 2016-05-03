<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
                    <?php
                    //echo CHtml::encode(Yii::app()->name); 
                    echo CHtml::encode(UserAdmin::module()->module_name);
                    ?>
                </div>
	</div><!-- header -->

	<div id="main_menu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array( 
                    'items'=>array( 
                        array('label'=>'Users', 'url'=>array('/useradmin/user/index')), 
                        array('label'=>'User Roles', 'url'=>array('/useradmin/role/index')), 
                        array('label'=>'User Role References', 'url'=>array('/useradmin/userroleref/index')), 
                        
                        array('label'=>'Issues', 'url'=>array('#'), 
                          'items'=>array( 
                            array('label'=>'List Issues (All)','url'=>array('/issues/admin'),
                              'items'=>array( 
                                array('label'=>'Pending', 'url'=>array('/issues/admin?issuestat=1')), 
                                array('label'=>'Done', 'url'=>array('/issues/admin?issuestat=2')), 
                                array('label'=>'Closed', 'url'=>array('/issues/admin?issuestat=3')), 
                              ), 

                          ), 
                        ),
                        ),
                        
                        array('label'=>'Modules','url'=>array('#'),
                                'items'=>array(
                                    array('label'=>'Site','url'=>array('/mall/default/index')),
                                    array('label'=>'User Management','url'=>array('/useradmin/default/index')),
                                    array('label'=>'Store Management','url'=>array('/shopadmin/default/index')),
                                    array('label'=>'Shipping Management','url'=>array('/shipping/default/index')),
                                ),
                            ),

                       

                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ), 
            )); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php
            $controller = Yii::app()->controller->id;
            $action = Yii::app()->controller->action->id;
            $action_permission_id = 0;
              
            $actionPermission = AuthActionPermission::model()->findByAttributes(array('module'=>$controller,'action'=>$action));
            if(sizeof($actionPermission) != 0)
                $action_permission_id = $actionPermission->id;
            
                $checkPermission = AuthRoleActionPermission::model()->authenticateUser($controller,$action_permission_id,Yii::app()->user->getState('roleId'));

                if($checkPermission){
                    echo $content;
                }else{
                    throw new CHttpException('Please login with appropriate login credentials to view this page.');
                }
        ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
