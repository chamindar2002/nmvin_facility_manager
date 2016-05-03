<?php
/* @var $this UserRoleRefController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Role Refs',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'pager'=>array(
            'class'=>'CLinkPager',
            'header'=>'',//remove 'go to page' text
        ),
    'columns'=>array(
        'uid',
         
        'users.firstname',
        'users.familyname',
        'roles.name',

        array(  
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),
       )

    )

);

?>


<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>
