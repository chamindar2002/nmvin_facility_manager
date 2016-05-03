<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<!--    <h1>Login</h1>

    <p>Please fill out the following form with your login credentials:</p>-->
    
    
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                    
            ),
    )); ?>
    <div class="form">
<!--        <p class="note">Fields with <span class="required">*</span> are required.</p>-->
        <?php echo $form->errorSummary($model); ?>
         <div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control input-lg', 'placeholder'=>'Email')); ?>
		<?php echo $form->error($model,'username'); ?>
            </div>
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control input-lg', 'placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
            </div>
	
         <?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	

	<div class="form-group">
		<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-primary btn-lg btn-block')); ?>
        </div>
    </div>
    
    <?php $this->endWidget(); ?>


