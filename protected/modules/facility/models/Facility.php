<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Facility
 *
 * @author Oracle
 */

class Facility {
    
     public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof FacilityModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('facility') instanceof FacilityModule)
			return Yii::app()->getModule('facility');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof FacilityModule)	
					return $parent;
		} 
	}
        
}

?>
