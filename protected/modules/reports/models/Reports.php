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
        
        
        public static function disableFullGroupBy()
        {
            try{
                
                $sql = "set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';"
                        . "set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';";

                $cmd = Yii::app()->db->createCommand($sql);
                $res = $cmd->execute();

                return true;
            
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
            
        }
}

?>
