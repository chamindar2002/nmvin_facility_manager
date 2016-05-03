

<?php
$this->breadcrumbs = array(
    'Permissions',
);
?>


<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'permissions-form',
    'action' => Yii::app()->createUrl('/' . $this->module->id . '/Securitydata/UpdateRoles/'),
    'enableAjaxValidation' => false,
        ));
?>


<style>
    #permissions-holder{
        border:1px solid #ccc;
        background: #f1f1f1;
        height:500px;
        width:500px;
        overflow-y: auto;
        padding:10px;
    }
    
    #checkall{
        margin-left: 11px;
        margin-bottom: 5px;
        
    }
</style>




<div id="cspec_top">
   
    <input type="checkbox" class="checkall" id="checkall"> Check all
         
    <div id="permissions-holder">
        <table border='0' id="tbl_action_prm">
            
            <?php
                    $arr_action_perm_role_ref = array();

                    $action_permission_role_ref_records = $action_permissions_list['action_permission_role_ref_records'];
                    if (sizeof($action_permission_role_ref_records) > 0) {
                        foreach ($action_permission_role_ref_records As $aprr) {
                            $arr_action_perm_role_ref[$aprr->aid] = true;
                            //echo $aprr->aid.'<br>';
                        }
                    }


                    $records = $action_permissions_list['action_permission_records'];

                    $count = 1;
                    foreach ($records As $rr) :


                        $id = $rr->id;
                        $module = $rr->module;
                        $method = $rr->action;

                        $cssClass = ($count % 2 == 0) ? "class_even" : "class_odd";
                        ?>
                        <tr class="<?php echo $cssClass; ?>">
                            <td>
                                <?php
                                if (isset($arr_action_perm_role_ref[$id])) {
                                    ?>
                                    <input type="checkbox" name="Ap[]" value="<?php echo $id; ?>" checked>
                                    <?php
                                } else {
                                    ?>
                                    <input type="checkbox" name="Ap[]" value="<?php echo $id; ?>">
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
            <?php echo "<b> $module/$method </b>[controller id : $id]"; ?>
                            </td>
                        </tr>

            <?php
            $count++;
        endforeach;
        ?>



        </table>
    </div>

    <table>
        
        <tr>
            <td align="right">
                <?php
                $button_text = (isset($translations['Submit']) ? $translations['Submit'] : 'Submit');
                ?>
                                <input type="button" value="<?php echo $button_text; ?>" onclick="submitme()">

                                <input type="hidden" name="txt_hdn_rid" id="txt_hdn_rid" value="<?php echo Yii::app()->user->getState('roleId'); ?>">

                <?php
                // echo CHtml::link('update', array('/'.$this->module->id.'/role/update?id='.Yii::app()->getRequest()->getQuery('id')), array('style' => 'color:#feecd9;text-decoration:none;', 'class' => 'btn_list'));
                ?>
            </td>

        </tr>
    </table>

    <br>
    <strong>
<?php echo "$count records found"; ?> 
    </strong>

</div>




<?php $this->endWidget(); ?>



<script type="text/javascript">
                            function submitme() {
                                document.getElementById('permissions-form').submit();
                            }

                            $(function() {
                                $('.checkall').on('click', function() {
                                    $(this).closest('div').find(':checkbox').prop('checked', this.checked);
                                });
                            });
</script>

