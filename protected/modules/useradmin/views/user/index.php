<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>


<?php



$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider'=>$dataProvider,

    'columns'=>array(
        'uid',          // display the 'title' attribute
        'loginname',
        'familyname',
        'firstname',
        array(  

            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),

         

    ),

));

?>
<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>
