<?php

class UrlParamEncoder{
    private $param;
    private $max_length = 30;
    private $min_length = 1;
    private $position = 7;
    private $param_size = 0;
    private $encoded_string;
    
    private $alpha = array(0=>'Z',1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I');
    public function encodeParam($param){
        $this->encoded_string = array();
        $rand = 0;
        $this->param = $param;
        $this->param_size = strlen((string)$this->param);
                
        
        for($i=$this->min_length;$i<($this->max_length-$this->param_size)+1;$i++){
          if($i == $this->position){
              $this->encoded_string[]= $this->param;
          }else{
              $rand = rand(0, 9);
              $this->encoded_string[]= $rand;
          }
         
        }
        $this->encoded_string []= '-'.$this->param_size;
        
       
        return implode('',$this->encoded_string);
        
    }
    
    public function decodeParam($param){
        
        $this->param = $param;
        $this->param_size = strlen((string)$this->param);
        
        //return $this->param_size;
        $first_segment = $this->position - 1;
        //return $first_segment;
        //$first_segment = $this->position;
        $last_segment = explode('-',$this->param);
        $this->encoded_string = substr($param, $first_segment);
        $this->encoded_string = substr($this->encoded_string, 0,$last_segment[1]);
        return (int)$this->encoded_string; 
        
        //return $this->encoded_string;
        //return $this->param_size;
    }
}
?>
