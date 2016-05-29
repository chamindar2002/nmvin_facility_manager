<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author Oracle
 */
class Sales {

    public static function module()
    {
        if(isset(Yii::app()->controller)
            && isset(Yii::app()->controller->module)
            && Yii::app()->controller->module instanceof SalesModule)
            return Yii::app()->controller->module;
        elseif(Yii::app()->getModule('sales') instanceof SalesModule)
            return Yii::app()->getModule('sales');
        else
        {
            while (($parent=$this->getParentModule())!==null)
                if($parent instanceof SalesModule)
                    return $parent;
        }
    }
}

?>
