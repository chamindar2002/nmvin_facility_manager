<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaymentModelInstallment
 *
 * @author Oracle
 */
class PaymentModelInstallment extends PaymentModel{
    
    public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_plan_master_id, payment_plan_item_id, total_payable, installment_amount, no_of_installments', 'required'),
			array('payment_plan_master_id, payment_plan_item_id, is_installment_definer, payment_sequence, no_of_installments, deleted', 'numerical', 'integerOnly'=>true),
			array('installment_amount, interest, tax, total_payable', 'numerical'),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_plan_master_id, payment_plan_item_id, is_installment_definer, no_of_installments, installment_amount, interest, tax, total_payable, payment_sequence, created_at, updated_at, deleted', 'safe', 'on'=>'search'),
		);
	}
    
    public function getModelName()
    {
            return __CLASS__;
    }
}

?>
