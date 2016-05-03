<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of useradmin
 *
 * @author Oracle
 */
class UserAdmin {
   
    public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof UseradminModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('useradmin') instanceof UseradminModule)
			return Yii::app()->getModule('useradmin');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof UseradminModule)	
					return $parent;
		} 
	}
}

?>
