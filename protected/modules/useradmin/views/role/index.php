<?php
/* @var $this RoleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Roles',
);

$this->menu=array(
	array('label'=>'Add', 'url'=>array('create')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<?php

$this->widget('zii.widgets.grid.CGridView', array(

    'dataProvider' => $dataProvider,
    'columns' => array(
        'rid',
        array(

            'name' => 'name',

            'type' => 'raw',

             'value' => 'CHtml::link($data->name, Yii::app()->createUrl("useradmin/securitydata/ListPermissions?id=".$data->rid))',

        ),
        'description',
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
