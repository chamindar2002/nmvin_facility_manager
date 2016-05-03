<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reports
 *
 * @author Oracle
 */
class Reports {
    
     public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof ReportsModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('reports') instanceof ReportsModule)
			return Yii::app()->getModule('reports');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof ReportsModule)	
					return $parent;
		} 
	}
}

?>
