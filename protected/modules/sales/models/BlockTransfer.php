<?php

/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 6/4/16
 * Time: 7:41 AM
 * @property integer $projectcode
 * @property integer $swap_from_block
 */


class BlockTransfer extends ProjectDetails
{
    public $swap_from_block;
    public $swap_to_block;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('swap_from_block, swap_to_block, projectcode', 'required'),
            array('swap_from_block, swap_to_block, projectcode', 'numerical', 'integerOnly'=>true),
            //array('blocksize, blockprice', 'numerical'),
            //array('blocknumber', 'length', 'max'=>100),
            //array('addeddate, addedtime, lastmodifieddate, lastmodifiedtime, deleteddate, deletedtime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('swap_from_block, projectcode, swap_to_block', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'swap_from_block' => 'Swap From',
            'swap_to_block' => 'Swap To',
            'projectcode' => 'Project Code',

        );
    }

}