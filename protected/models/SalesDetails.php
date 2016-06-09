<?php

/**
 * This is the model class for table "sales".
 *
 * The followings are the available columns in table 'sales':
 * @property integer $refno
 * @property integer $customercode
 * @property integer $locationcode
 * @property integer $projectcode
 * @property integer $blockrefnumber
 * @property integer $payplanrefno
 * @property integer $nofinstallments
 * @property string $description
 * @property double $installamount
 * @property double $totalpayable
 * @property integer $paymentduedate
 * @property string $agrementstartdate
 * @property string $agrementfinishdate
 * @property integer $saletype
 * @property double $salerightoff_amt
 * @property integer $salerightoff_status
 * @property string $salerightoff_comment
 * @property integer $deleted
 * @property integer $addedby
 * @property string $addeddate
 * @property string $addedtime
 * @property integer $lastmodifiedby
 * @property string $lastmodifieddate
 * @property string $lastmodifiedtime
 * @property integer $deletedby
 * @property string $deleteddate
 * @property string $deletedtime
 */
class SalesDetails extends NmwndbActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sales';
	}
        
        public function getDbConnection()
        {
        return self::getNimavinMasterDbConnection();
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customercode, locationcode, projectcode, blockrefnumber, payplanrefno, nofinstallments, description, installamount, totalpayable', 'required'),
			array('customercode, locationcode, projectcode, blockrefnumber, payplanrefno, nofinstallments, paymentduedate, saletype, salerightoff_status, deleted, addedby, lastmodifiedby, deletedby', 'numerical', 'integerOnly'=>true),
			array('installamount, totalpayable, salerightoff_amt', 'numerical'),
			array('description', 'length', 'max'=>150),
			array('agrementstartdate, agrementfinishdate, salerightoff_comment, addeddate, addedtime, lastmodifieddate, lastmodifiedtime, deleteddate, deletedtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('refno, customercode, locationcode, projectcode, blockrefnumber, payplanrefno, nofinstallments, description, installamount, totalpayable, paymentduedate, agrementstartdate, agrementfinishdate, saletype, salerightoff_amt, salerightoff_status, salerightoff_comment, deleted, addedby, addeddate, addedtime, lastmodifiedby, lastmodifieddate, lastmodifiedtime, deletedby, deleteddate, deletedtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'blockDetails' => array(self::BELONGS_TO, 'ProjectDetails', 'blockrefnumber'),
                    'projectMaster' => array(self::BELONGS_TO, 'ProjectMaster', 'projectcode'),
                    'location' => array(self::BELONGS_TO,'LocationMaster','locationcode'),
					'customer' => array(self::BELONGS_TO,'Customerdetails', 'customercode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'refno' => 'Refno',
			'customercode' => 'Customer',
			'locationcode' => 'Location Code',
			'projectcode' => 'Project Code',
			'blockrefnumber' => 'Block Number',
			'payplanrefno' => 'Payplanrefno',
			'nofinstallments' => 'Nofinstallments',
			'description' => 'Description',
			'installamount' => 'Installamount',
			'totalpayable' => 'Totalpayable',
			'paymentduedate' => 'Paymentduedate',
			'agrementstartdate' => 'Agrementstartdate',
			'agrementfinishdate' => 'Agrementfinishdate',
			'saletype' => 'Saletype',
			'salerightoff_amt' => 'Salerightoff Amt',
			'salerightoff_status' => 'Salerightoff Status',
			'salerightoff_comment' => 'Salerightoff Comment',
			'deleted' => 'Deleted',
			'addedby' => 'Addedby',
			'addeddate' => 'Addeddate',
			'addedtime' => 'Addedtime',
			'lastmodifiedby' => 'Lastmodifiedby',
			'lastmodifieddate' => 'Lastmodifieddate',
			'lastmodifiedtime' => 'Lastmodifiedtime',
			'deletedby' => 'Deletedby',
			'deleteddate' => 'Deleteddate',
			'deletedtime' => 'Deletedtime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('refno',$this->refno);
		$criteria->compare('customercode',$this->customercode);
		$criteria->compare('locationcode',$this->locationcode);
		$criteria->compare('projectcode',$this->projectcode);
		$criteria->compare('blockrefnumber',$this->blockrefnumber);
		$criteria->compare('payplanrefno',$this->payplanrefno);
		$criteria->compare('nofinstallments',$this->nofinstallments);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('installamount',$this->installamount);
		$criteria->compare('totalpayable',$this->totalpayable);
		$criteria->compare('paymentduedate',$this->paymentduedate);
		$criteria->compare('agrementstartdate',$this->agrementstartdate,true);
		$criteria->compare('agrementfinishdate',$this->agrementfinishdate,true);
		$criteria->compare('saletype',$this->saletype);
		$criteria->compare('salerightoff_amt',$this->salerightoff_amt);
		$criteria->compare('salerightoff_status',$this->salerightoff_status);
		$criteria->compare('salerightoff_comment',$this->salerightoff_comment,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('addedby',$this->addedby);
		$criteria->compare('addeddate',$this->addeddate,true);
		$criteria->compare('addedtime',$this->addedtime,true);
		$criteria->compare('lastmodifiedby',$this->lastmodifiedby);
		$criteria->compare('lastmodifieddate',$this->lastmodifieddate,true);
		$criteria->compare('lastmodifiedtime',$this->lastmodifiedtime,true);
		$criteria->compare('deletedby',$this->deletedby);
		$criteria->compare('deleteddate',$this->deleteddate,true);
		$criteria->compare('deletedtime',$this->deletedtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SalesDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function facilityExists($sale_refno){
		$criteria = new CDbCriteria();
		$criteria->compare('sales_ref_no', $sale_refno);
		$criteria->compare('deleted', 0);
		return FacilityMaster::model()->find($criteria);
	}
        
       
}
