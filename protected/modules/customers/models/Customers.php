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

class Customers {
    
     public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof CustomersModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('customers') instanceof CustomersModule)
			return Yii::app()->getModule('customers');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof CustomersModule)	
					return $parent;
		} 
	}
        
}

?>
