<?php

class Payments {
   
     public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof PaymentsModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('payments') instanceof PaymentsModule)
			return Yii::app()->getModule('payments');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof PaymentsModule)	
					return $parent;
		} 
	}
        
}

?>
