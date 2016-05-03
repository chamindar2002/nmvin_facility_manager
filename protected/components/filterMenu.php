<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of filterMenu
 *
 * @author Oracle
 */
class filterMenu {
    //put your code here
    public static function renderFilterMenu_Models(){
        
        $mks_criteria = new CDbCriteria();
        $mks_criteria->join = 'join products_master pm ON pm.make_id = t.id';
        $mks_criteria->compare('pm.is_active',1);
        $mks_criteria->addCondition('pm.quantity > 0');
        $makes = Makes::model()->findAll($mks_criteria);
        $makesArray = array();
        foreach($makes As $mk){
            $makesArray[$mk->id] = $mk->name;
        }
                
        $selectedMake = '';
        
        if(isset($_GET['make']))
            $selectedMake = self::decodeMakeParam($_GET['make']);
        
        $htm = '<strong>Model</strong><br><ul>';
        if($selectedMake == ''){
            foreach($makesArray As $key=>$value){
                $htm .= '<li>';
                //$htm .= ($selectedMake == $value)?CHtml::checkBox('Makes',true, array('value'=>$value)):CHtml::checkBox('Makes',false, array('value'=>$value));
                if($selectedMake == $value){
                    $htm .= CHtml::radioButton('makes',true, array('value'=>$value));
                }else{
                    $htm .= CHtml::radioButton('makes',false, array('value'=>$value));
                }
                //$htm .= CHtml::checkBox('Makes',false, array('value'=>$value));
                $htm .= '<span class="filter_menu_itm">'.$value.'</span>';
                $htm .= '</li>';
            } 
        }else{
            $htm .= '<li>';
                $htm .= CHtml::checkbox('remove_make',true, array('value'=>'make','class'=>'remove_params')).$selectedMake;
            $htm .= '</li>';
        }
        $htm .= '</ul>';
        
        //$htm .= 'Model :'.$selectedMake;
        
        return $htm;
    }
    
    
    public static function renderFilterMenu_Scale(){
        
        $scls_criteria = new CDbCriteria();
        $scls_criteria->join = 'join products_master pm ON pm.scale_id = t.id';
        $scls_criteria->compare('pm.is_active',1);
        $scls_criteria->addCondition('pm.quantity > 0');
        $scales = Scale::model()->findAll($scls_criteria);
        $scalesArray = array();
        foreach($scales As $sc){
            $scalesArray[$sc->id] = $sc->name;
        }
                
        $selectedScale = '';
        
        if(isset($_GET['scale']))
            $selectedScale = self::decodeScaleParam($_GET['scale']);
        
        $htm = '<strong>Scale</strong><br><ul>';
        if($selectedScale == ''){
            foreach($scalesArray As $key=>$value){
                $htm .= '<li>';
                //$htm .= ($selectedScale == $value)?CHtml::checkBox('Makes',true, array('value'=>$value)):CHtml::checkBox('Makes',false, array('value'=>$value));
                if($selectedScale == $value){
                    $htm .= CHtml::radioButton('scales',true, array('value'=>$value));
                }else{
                    $htm .= CHtml::radioButton('scales',false, array('value'=>$value));
                }
                //$htm .= CHtml::checkBox('Makes',false, array('value'=>$value));
                $htm .= '<span class="filter_menu_itm">'.$value.'</span>';
                $htm .= '</li>';
            } 
        }else{
            $htm .= '<li>';
                $htm .= CHtml::checkbox('remove_scale',true, array('value'=>'scale','class'=>'remove_params')).$selectedScale;
            $htm .= '</li>';
        }
        $htm .= '</ul>';
        
        //$htm .= 'Scale :'.$selectedScale;
        
        return $htm;
    }
    
    
    public static function renderFilterMenu_Brand(){
        
        $scls_criteria = new CDbCriteria();
        $scls_criteria->join = 'join products_master pm ON pm.brand_id = t.id';
        $scls_criteria->compare('pm.is_active',1);
        $scls_criteria->addCondition('pm.quantity > 0');
        $scales = Brands::model()->findAll($scls_criteria);
        $brandsArray = array();
        foreach($scales As $sc){
            $brandsArray[$sc->id] = $sc->name;
        }
                
        $selectedBrand = '';
        
        if(isset($_GET['brand']))
            $selectedBrand = self::decodeMakeParam($_GET['brand']);
        
        
        //$htm .= 'Brand :'.$selectedBrand;
        $htm = '<strong>Brand</strong><br><ul>';
        
        if($selectedBrand == ''){
           
            foreach($brandsArray As $key=>$value){
                $htm .= '<li>';
                //$htm .= ($selectedScale == $value)?CHtml::checkBox('Makes',true, array('value'=>$value)):CHtml::checkBox('Makes',false, array('value'=>$value));
                if($selectedBrand == $value){
                    $htm .= CHtml::radioButton('brands',true, array('value'=>$value));
                }else{
                    $htm .= CHtml::radioButton('brands',false, array('value'=>$value));
                }
                //$htm .= CHtml::checkBox('Makes',false, array('value'=>$value));
                $htm .= '<span class="filter_menu_itm">'.$value.'</span>';
                $htm .= '</li>';
            } 
           
        }else{
            $htm .= '<li>';
                $htm .= CHtml::checkbox('remove_brand',true, array('value'=>'brand','class'=>'remove_params')).$selectedBrand;
            $htm .= '</li>';
        }
         $htm .= '</ul>';
        
        return $htm;
    }
    
    public static function decodeMakeParam($param){
        return str_replace('+',' ',urlencode($param));
    }
    
    public static function decodeScaleParam($param){
        return str_replace('%3A',':',urlencode($param));
    }
}

?>
