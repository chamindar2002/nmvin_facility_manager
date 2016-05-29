<!DOCTYPE html>
<html lang="en">
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo Yii::app()->name; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/main.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                    <!--SB Admin-->
                    <div id="logo_place_holder"><img src="<?php echo Yii::app()->request->baseUrl.'/themes/images/nimavin-logo2.gif'; ?>"></div>
                </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>-->
<!--                    <ul class="dropdown-menu message-dropdown">-->
<!--                        <li class="message-preview">-->
<!--                            <a href="#">-->
<!--                                <div class="media">-->
<!--                                    <span class="pull-left">-->
<!--                                        <img class="media-object" src="http://placehold.it/50x50" alt="">-->
<!--                                    </span>-->
<!--                                    <div class="media-body">-->
<!--                                        <h5 class="media-heading"><strong>John Smith</strong>-->
<!--                                        </h5>-->
<!--                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>-->
<!--                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="message-preview">-->
<!--                            <a href="#">-->
<!--                                <div class="media">-->
<!--                                    <span class="pull-left">-->
<!--                                        <img class="media-object" src="http://placehold.it/50x50" alt="">-->
<!--                                    </span>-->
<!--                                    <div class="media-body">-->
<!--                                        <h5 class="media-heading"><strong>John Smith</strong>-->
<!--                                        </h5>-->
<!--                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>-->
<!--                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="message-preview">-->
<!--                            <a href="#">-->
<!--                                <div class="media">-->
<!--                                    <span class="pull-left">-->
<!--                                        <img class="media-object" src="http://placehold.it/50x50" alt="">-->
<!--                                    </span>-->
<!--                                    <div class="media-body">-->
<!--                                        <h5 class="media-heading"><strong>John Smith</strong>-->
<!--                                        </h5>-->
<!--                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>-->
<!--                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="message-footer">-->
<!--                            <a href="#">Read All New Messages</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">No Alerts<span  class="label label-primary"></span></a>
                        </li>
<!--                        <li>-->
<!--                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a href="#">View All</a>-->
<!--                        </li>-->
                    </ul>
                </li>
                <li class="dropdown">
                    <?php
                     $url = Yii::app()->user->name == 'Guest'?'/members/':'/site/logout';
                     //$action = Yii::app()->user->name == 'Guest'?'Login':'Logout';
                     echo CHtml::link(Yii::app()->user->name,array($url),array('class'=>'dropdown-toggle','data-toggle'=>'dropdown'));
                    ?>
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith 2<b class="caret"></b></a>-->
                    <ul class="dropdown-menu">
                        
                            <a href="<?php  echo Yii::app()->createUrl('/site/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
<!--                    <li class="active">
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>-->
                    
                    
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('/payments/paymentReceiptsMaster/create')?>"><i class="fa fa-fw fa-edit"></i>New Receipt</a>
                    </li>
                                        
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo3"><i class="fa fa-fw fa-money"></i> Payment Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo3" class="collapse">
                            
                            <li>
                                <?php echo CHtml::link('Receipts',array('//payments/paymentReceiptsMaster/index')); ?>
                            </li>
                            
                                
<!--                            <li>
                                <?php echo CHtml::link('Payment Models',array('/facility/paymentModel/index')); ?>
                            </li>-->
                            
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-briefcase"></i> Facility Management<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo1" class="collapse">
                            
                            <li>
                                <?php echo CHtml::link('Facility',array('/facility/facilityMaster/index')); ?>
                            </li>
                            
                            

                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-cog"></i> Facility Utilities <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <?php echo CHtml::link('Payment Items',array('/facilityutils/paymentPlanItems/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Payment Plans',array('/facilityutils/paymentPlanMaster/index')); ?>
                            </li>
                                
<!--                            <li>
                                <?php echo CHtml::link('Payment Models',array('/facility/paymentModel/index')); ?>
                            </li>-->
                            
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> User Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <?php echo CHtml::link('Users',array('/useradmin/user/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Roles',array('/useradmin/role/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('User Role Assignment',array('/useradmin/UserRoleRef/index')); ?>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo4"><i class="fa fa-fw fa-credit-card"></i> Customer Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo4" class="collapse">
                            <li>
                                <?php echo CHtml::link('Customers',array('/customers/Customerdetails/index')); ?>
                            </li>

                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo5"><i class="fa fa-building-o"></i> Projects Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo5" class="collapse">
                            <li>
                                <?php echo CHtml::link('Locations',array('/projects/LocationMaster/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Projects',array('/projects/ProjectMaster/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Block Listing',array('/projects/blockListing/index')); ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo6"><i class="fa fa-fw fa-line-chart"></i> Sales Management<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo6" class="collapse">
                            <li>
                                <?php echo CHtml::link('Sales',array('/sales/SalesMaster/index')); ?>
                            </li>


                        </ul>
                    </li>
                    
                     <li>
                        
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo_rpts"><i class="fa fa-fw fa-bar-chart-o"></i> Reports <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo_rpts" class="collapse">
                            <li>
                                <?php echo CHtml::link('Payments',array('/reports/payments/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Collection',array('/reports/Collection/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Dues',array('/reports/Dues/index')); ?>
                            </li>
                            
                           
                        </ul>
                    </li>
<!--                    <li>
                        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>-->
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
<!--                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>-->
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>
                                 <?php if(isset($this->breadcrumbs)):?>
                                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                                    'links'=>$this->breadcrumbs,
                                    )); ?><!-- breadcrumbs -->
                                <?php endif?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               
               
                
                
                    

                        <?php
                        $controller = Yii::app()->controller->id;
                        $action = Yii::app()->controller->action->id;
                        $action_permission_id = 0;

                        $actionPermission = AuthActionPermission::model()->findByAttributes(array('module' => $controller, 'action' => $action));
                        if (sizeof($actionPermission) != 0)
                            $action_permission_id = $actionPermission->id;

                        $checkPermission = AuthRoleActionPermission::model()->authenticateUser($controller, $action_permission_id, Yii::app()->user->getState('roleId'));

                        if ($checkPermission) {
                            echo $content;
                        } else {
                            throw new CHttpException('Please login with appropriate login credentials to view this page.');
                        }
                        ?>
                    
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/bootstrap.min.js"></script>
    
<!--    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/1a60b40a/jquery.ba-bbq.js"></script>-->


    <!-- Morris Charts JavaScript -->
<!--    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/plugins/morris/raphael.min.js"></script>-->
<!--    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/plugins/morris/morris.min.js"></script>-->
<!--    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/plugins/morris/morris-data.js"></script>-->

<!--    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/plugins/morris/morris-data.js"></script>-->
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/my_functions.js"></script>
</body>

</html>

