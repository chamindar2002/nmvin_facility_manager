<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mobile/css/main.css" media="screen, projection" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/mall_functions.js"></script>
        
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
                    <h3>
                    <?php echo CHtml::encode(Yii::app()->name); ?>
                    </h3>
<!--                    <img src="<?php //echo Yii::app()->request->baseUrl; ?>/css/shop/img/logo.gif" height="40px" width="200px"></img>-->
                </div>
            
                <div id="cart_content">
                <?php if(Yii::app()->params['show_cart']){ ?>

                        <?php
                         if (Yii::app()->session['cart']) {
                             $cart = Yii::app()->session['cart'];
                             
                             Mall::module()->renderViewCartLink($cart);
                             
                         }
                        ?>

                <?php } ?>
                </div>
            
            <div class="clear"></div>
	</div><!-- header -->
        <!-- mainmenu -->
	<div id="mainmenu">
            <div id="mainmenu_items">
		<?php
                    Mall::module()->renderMainMenu();
                    //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    $url = Yii::app()->user->name == 'Guest'?'/members/':'/site/logout';
                    $action = Yii::app()->user->name == 'Guest'?'Login':'Logout';
                    echo CHtml::link(Yii::app()->user->name." $action",array($url));
                ?>               
            </div>            
	</div>
        <!-- breadcrumbs -->
	<?php /*if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif */?>
        <div id="content_placeholder">
            <?php  echo $content; ?>
            <div class="clear"></div>
        </div>
	

        <div id="footer">
            <?php echo utilsComponents::renderStaticPageLinks(); ?>
            <p>
            Copyright &copy; <?php echo date('Y'); ?> <?php echo Yii::app()->name; ?>.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
            </p>
                
        </div><!-- footer -->
	

</div><!-- page -->

</body>
</html>
