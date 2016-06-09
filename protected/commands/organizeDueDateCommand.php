<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 6/6/16
 * Time: 10:05 AM
 */

/*
 * this command was used to set the <payment_due_date> column of repayment_schema table.
 *
 */

//http://www.yiiframework.com/doc/guide/1.1/en/topics.console#creating-commands

//to execute this command run: [php yiic.php organizeduedate index] inside /protected folder

class organizeDueDateCommand extends CConsoleCommand{

    public function run($args) {
        $c = new CDbCriteria();
        $c->group = 'facility_master_id';
       //$rpm_schema = RepaymentSchema::model()->findAll($c);

       $facility = FacilityMaster::model()->findAllByAttributes(array('deleted'=>0));
       $connection=Yii::app()->db;

       print('found facilities '. sizeof($facility)." records \n");
        $i = 1;
       foreach($facility As $fac){
           print "[$i]".$fac->id."\n";
           $rpm_schema = RepaymentSchema::model()->findAllByAttributes(
               array(
                   'facility_master_id'=>$fac->id,
                   'is_istallment' => 1,
                   'due_date_updated' => 0,

               ));

           //print("------------------------------ \n");

           print("installments :".sizeof($rpm_schema)."\n" );

           foreach($rpm_schema As $schema){
               $created_date = date('Y-m-d', strtotime($schema->created_at));
               $n =  $schema->installment_number;
               $id = $schema->id;
               $due_date = date("Y-m-d", strtotime("+$n month", strtotime($schema->created_at)));
               //print($schema->id."->created on :".$created_date."\n" );
               print($schema->id.'-'.$schema->installment_number." installment due on ".$due_date."\n");


               $sql = "UPDATE `repayment_schema` SET `payment_due_date` = '$due_date', `due_date_updated` = 1 WHERE `repayment_schema`.`id` = $id;";
               $command = $connection->createCommand($sql);
               $command->execute();

               print("success \n");

           }


           print("------------------------------ \n");
           $i++;
       }

       print("\n");
    }

    public function  actionIndex(){
        echo "running";
    }

}