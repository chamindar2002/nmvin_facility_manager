<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sendText
 *
 * @author Chaminda
 */
class textHandler {
    //put your code here
    public static function fireSms($phone,$msg){
            $from = 'info@dm-lk.com';
            $name='=?UTF-8?B?'.base64_encode('Nimavin').'?=';
            $subject='=?UTF-8?B?'.base64_encode(self::trimSaleDetails($msg)).'?=';
            $body = self::trimCustomerName($msg).'|'.$msg['Amount Paid'].' '.$msg['payment_type'];
	    $headers="From: {$from} \r\n".
            "Reply-To: {$from}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

            $x = mail('sms@dm-lk.com',$subject,$body,$headers);
           //var_dump($x);
       return $x;
    }
    
    private static function trimSaleDetails($msg){
        //return substr($msg['Sale Details'], 0,30);
        return substr($msg['Sale Details'], 0,28); //reduced 2 chars from original 30 chars to support payment type
    }
    private static function trimCustomerName($msg){
        return substr($msg['Customer Name'], 0,18);
    }
    
}

/*
 * public static function fireSms($phone,$msg){
            $from = 'info@dm-lk.com';
            $name='=?UTF-8?B?'.base64_encode('Nimavin').'?=';
            $subject='=?UTF-8?B?'.base64_encode($msg['subject']).'?=';
            $body = $msg['body'];
	    $headers="From: {$from} \r\n".
            "Reply-To: {$from}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

            $x = mail('sms@dm-lk.com',$subject,$body,$headers);
           //var_dump($x);
       return $x;
    }
 */
?>
