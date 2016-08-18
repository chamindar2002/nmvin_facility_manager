<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailSender
 *
 * @author Oracle
 */
class EmailsenderCommand extends CConsoleCommand{
    
    public function run($args) {
     
        print("attempting to send email... \n");
        
        $from = 'nimavinsms@gmail.com';
        $name='=?UTF-8?B?'.base64_encode('Nimavin').'?=';
        $subject='=?UTF-8?B?'.'test-subject'.'?=';
        $body = 'Chaminda'.'|'.'45000.00'.' '.'CASH';
	$headers="From: {$from} \r\n".
            "Reply-To: {$from}\r\n".
			"MIME-Version: 1.0\r\n".
			"Content-type: text/plain; charset=UTF-8";
        $x = mail('773784828@dialog.lk',$subject,$body,$headers);
           //var_dump($x);
       var_dump($x);
        
    }
    
    
    
    public function  actionTest(){
        echo "running";
    }
}

?>
