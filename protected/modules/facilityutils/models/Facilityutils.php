<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Facilityutils
 *
 * @author Oracle
 */
class Facilityutils {
    
    public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof FacilityutilsModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('facilityutils') instanceof FacilityutilsModule)
			return Yii::app()->getModule('facilityutils');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof FacilityutilsModule)	
					return $parent;
		} 
	}
        
}

?>
