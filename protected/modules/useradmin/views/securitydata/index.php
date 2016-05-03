<?php
/* @var $this SecuritydataController */

$this->breadcrumbs=array(
    'Securitydata',
);
?>

<?php
foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<h1>
<?php
$heading = (isset($translations['User Roles'])?$translations['User Roles']:'User Roles');
echo $heading;
?>
</h1>

<div id="submenu">
    <!--
    <p>
    <ul>
        <?php
        foreach($records As $record) {
        //echo $record->name.'<br>';
            $rid = $record->rid;
            $rdes = $record->name;

            echo '<li>'.CHtml::link(CHtml::encode($record->name), array('Securitydata/ListPermissions', 'id'=>$record->rid)).'</li>';


        }
        ?>
    </ul>
</p>
    -->
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        'rid',
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name,"ListPermissions/".$data->rid)'
        ),
        
    ),
));
?>


</div>