<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utilsComponents
 *
 * @author Oracle
 */
class utilsComponents {
    //put your code here
    private static $pwdLength = 8;
    private static $randPwd = '';
    private static $alpha = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',
                           12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',
                           23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'a',28=>'b',29=>'c',30=>'d',31=>'e',32=>'f',33=>'g',34=>'h',
                           35=>'i',36=>'j',37=>'k',38=>'l',39=>'m',40=>'n',41=>'o',42=>'p',43=>'q',44=>'r',45=>'s',46=>'t',47=>'u',48=>'v',
                           49=>'w',50=>'x',51=>'y',52=>'z',53=>'1',54=>'2',55=>'3',56=>'4',57=>'5',58=>'6',59=>'7',60=>'8',61=>'9',62=>'0',
                           63=>'!',64=>'@',65=>'$',66=>'*',67=>'?',68=>'#',69=>"+",70=>'£'
                          );
    
    private static $stat = array(1=>'Y',0=>'N');
    
    public static function activeInactiveStatus(){
    
        return array(1=>'Active',0=>'Inactive');
    }
    
    public static function generateRandomPassword(){
        for($i=1;$i<=self::$pwdLength;$i++){
            $rand = rand(1,sizeof(self::$alpha));
            self::$randPwd .= self::$alpha[$rand];
        }
        
        return self::$randPwd;
    }
    
    public static function generateRandomToken(){
        return uniqid().'-'.strtotime(date('d-m-Y h:i:s')).'-'.self::generateRandomPassword();
    }
    
    public static function yesNoStatus($v){
               
        return self::$stat[$v];
    }
    
    public static function dateFormat($str){
            return date('d-M-Y',$str);
    }
    
    public static function getSiteConfigDateFormat(){
        return 'd-M-Y';
    }
    
    public static function getSiteConfigDateFormatForDatePicker(){
        return 'dd-mm-yy';
    }
    
    public static function getTodaysDate(){
        return date('d-m-Y');
    }
        
    public static function getYesNoStatus(){
        return self::$stat;
    }
    
    public static function formatCurrency($v){
        return number_format($v,2);
    }
    
    public static function renderStaticPageLinks(){
            $htm  = '<ul>';
            $htm .= '<li>'.CHtml::link('About us',array('/site/about')).'</li>';
            $htm .= '<li>'.CHtml::link('Countact us',array('/site/contact')).'</li>';
            $htm .= '<li>'.CHtml::link('FAQ\'s',array('/site/faq')).'</li>';
            $htm .= '<li>'.CHtml::link('Terms and conditions',array('/site/terms')).'</li>';
            $htm .= '<li>'.CHtml::link('Delivery & Payment Options',array('/site/delivery')).'</li>';
            $htm .= '<li>'.CHtml::link('Privacy Policy',array('/site/privacy')).'</li>';
            $htm .= '<li>'.CHtml::link('Return Policy',array('/site/return')).'</li>';
            $htm .= '</ul>';
            
            return $htm;
    }
    
    public function convert_number($number) 
    { 
            if (($number < 0) || ($number > 999999999)) 
            { 
            throw new Exception("Number is out of range");
            } 

            $Gn = floor($number / 1000000);  /* Millions (giga) */ 
            $number -= $Gn * 1000000; 
            $kn = floor($number / 1000);     /* Thousands (kilo) */ 
            $number -= $kn * 1000; 
            $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
            $number -= $Hn * 100; 
            $Dn = floor($number / 10);       /* Tens (deca) */ 
            $n = $number % 10;               /* Ones */ 

            $res = ""; 

            if ($Gn) 
            { 
                $res .= $this->convert_number($Gn) . " Million"; 
            } 

            if ($kn) 
            { 
                $res .= (empty($res) ? "" : " ") . 
                    $this->convert_number($kn) . " Thousand"; 
            } 

            if ($Hn) 
            { 
                $res .= (empty($res) ? "" : " ") . 
                    $this->convert_number($Hn) . " Hundred"; 
            } 

            $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
                "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
                "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
                "Nineteen"); 
            $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
                "Seventy", "Eigthy", "Ninety"); 

            if ($Dn || $n) 
            { 
                if (!empty($res)) 
                { 
                    $res .= " and "; 
                } 

                if ($Dn < 2) 
                { 
                    $res .= $ones[$Dn * 10 + $n]; 
                } 
                else 
                { 
                    $res .= $tens[$Dn]; 

                    if ($n) 
                    { 
                        $res .= "-" . $ones[$n]; 
                    } 
                } 
            } 

            if (empty($res)) 
            { 
                $res = "zero"; 
            } 

            return $res; 
        }

    public static function getCutomerTitles(){
        return array(
            'MR'=>'Mr.',
            'DR'=>'Dr.',
            'MRS'=>'Mrs',
            'MISS'=>'Miss',
            'Rev'=>'Rev',
            'M/S'=>'M/S',
            'OTHER'=>'Other'
        );
    }
}

?>
