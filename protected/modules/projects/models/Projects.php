<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Projects
 *
 * @author Oracle
 */
class Projects {
    
    public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof ProjectsModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('projects') instanceof ProjectsModule)
			return Yii::app()->getModule('projects');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof ProjectsModule)	
					return $parent;
		} 
	}
}

?>
