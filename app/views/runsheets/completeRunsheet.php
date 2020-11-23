<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php if($runsheet_id == 0):?>
            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/no_runsheet_id.php");?>
        <?php elseif($driver_id == 0):?>
            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/no_driver_id.php");?>
        <?php elseif(empty($tasks)):?>
            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/no_tasks_found.php");?>
        <?php else:?>
            <?php
            //$driver_id = (empty(Form::value('driver_id')))? $runsheet['driver_id'] : Form::value('driver_id');
            //$units = (empty(Form::value('units')))? ($runsheet['units'] > 0)?$runsheet['units']: "" : Form::value('units');
            //echo "<p>Form Values For 381: ".getFormValue()."</p>";
            //echo "<pre>",print_r($tasks),"</pre>";//die();
            ?>
            <div class="row">
                <div class="col-12">
                    <h2>Complete Tasks for Runsheet <?php echo date('D jS M', $tasks[0]['runsheet_day']);?> using <?php echo $tasks[0]['driver_name'];?></h2>
                </div>
            </div>
            <form id="complete_runsheet_tasks" method="post" action="/form/procCompletRunsheetTasks">
                <div class="row">
                    <label class="col-md-3 col-form-label">Tasks To Be Completed</label>
                    <div class="col-md-9 mb-3">
                        <?php foreach($tasks as $task):
                            $task_id = $task['id'];
                            if($task['job_id'] > 0)
                            {
                                $label_string = "<span class='font-weight-bold'>".$task['job_number']."</span> - ".$task['customer_name'];
                            }
                            else
                            {
                                $label_string = "<span class='font-weight-bold'>".$task['order_number']."</span> - ".$task['order_customer']."(".$task['order_client_name'].")";
                                $label_string .= (empty($task['client_order_id']))? "" : " - ".$task['client_order_id'];
                            }?>
                            <div class="col-12">
                                <label class="col-form-label" for="task_<?php echo $task_id;?>"></label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input task" data-taskid="<?php echo $task_id;?>" id="task_<?php echo $task_id;?>" name="tasks[]" value="<?php echo $task_id;?>" checked />
                                    <label class="custom-control-label" for="task_<?php echo $task['id'];?>"><span class="font-weight-bold"><?php echo $label_string;?></label>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" >
                <input type="hidden" name="runsheet_id" id="runsheet_id" value="<?php echo $runsheet_id;?>" >
                <input type="hidden" name="driver_id" id="driver_id" value="<?php echo $driver_id;?>" >
                <div class="form-group row">
                    <div class="col-md-5 offset-md-3">
                        <button type="submit" class="btn btn-outline-secondary" id="submitter">Complete Selected Tasks</button>
                    </div>
                </div>
            </form>
        <?php endif;?>
    </div>
</div>