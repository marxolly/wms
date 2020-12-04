<?php
  $today = strtotime('today');
  //echo "<p>User Role: $user_role</p>";
?>
<table class="table-striped table-hover" id="production_jobs_table">
    <thead>
        <tr>
            <th class="no-sort">Job Number</th>
            <th>Priority</th>
            <th class="no-sort">Related Job</th>
            <th class="no-sort">Client</th>
            <th class="no-sort">Description</th>
            <th class="no-sort">Notes</th>
            <?php if($can_change_status):?>
                <th nowrap>Status<br /><select id="status_all" class="selectpicker" data-style="btn-outline-secondary btn-sm" data-width="fit"><option value="0">--Select One--</option><?php echo $this->controller->jobstatus->getSelectJobStatus(false, 1, true);?></select>&nbsp;<em><small>(all)</small></em></th>
            <?php else:?>
                <th>Status</th>
            <?php endif;?>
            <th>FSG Contact</th>
            <th class="no-sort">Finisher(s)</th>
            <th nowrap class="no-sort">
                Select
                <div class="checkbox checkbox-default">
                    <input id="select_all" class="styled" type="checkbox">
                    <label for="select_all"><em><small>(all)</small></em></label>
                </div>
            </th>
            <?php if($can_do_runsheets):?>
                <th>Runsheet Day</th>
            <?php endif;?>
            <th>Date Entered</th>
            <th>Due Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($jobs as $job):
            $add_to_runsheet = true;?>
            <tr id="tr_<?php echo $job['id'];?>">
                <td data-label="Job Number" class="number">
                    <?php if($user_role == "production_admin" ||  $user_role == "production"):?>
                        <a href="/jobs/update-job/job=<?php echo $job['id'];?>"><?php echo $job['job_id'];?></a>
                    <?php else:?>
                        <?php echo $job['job_id'];?>
                    <?php endif;?>
                </td>
                <td data-label="Priority" class="number">
                    <?php if($job['priority'] > 0)
                        echo $job['priority'];
                    ?>
                </td>
                <td data-label="Related Job" class="number"><?php echo $job['previous_job_id'];?></td>
                <td data-label="Client">
                    <span style="font-size: larger">
                        <?php if($user_role == "production_admin"):?>
                            <a href="/customers/edit-customer/customer=<?php echo $job['customer_id'];?>"><?php echo $job['customer_name'];?></a>
                        <?php else:?>
                            <?php echo $job['customer_name'];?>
                        <?php endif;?>
                    </span>
                </td>
                <td data-label="Description"><?php echo $job['description'];?></td>
                <td data-label="Notes"><?php echo $job['notes'];?></td>
                <td data-label="Status"
                <?php if(!empty($job['status_colour'])):?>
                    style="background-color:<?php echo $job['status_colour'];?>; color:<?php echo $job['status_text_colour'];?>"
                <?php endif;?>
                ><select class="selectpicker status" <?php if(!$can_change_status) echo "disabled"; ?> id="status_<?php echo $job['id'];?>" data-style="btn-outline-secondary btn-sm" data-width="fit"><option value="0">--Select One--</option><?php echo $this->controller->jobstatus->getSelectJobStatus($job['status_id']);?></select></td>
                <td data-label="FSG Contact"><?php echo ucwords($job['salesrep_name']);?></td>
                <td data-label="Finisher(s)">
                    <?php for($f = 1; $f <= 3; $f++):
                        $tf = ($f == 1)? "": $f;
                        if(!(empty($job['finisher'.$tf.'_name']))):?>
                            <p class="border-bottom border-secondary border-bottom-dashed mb-3">
                                <?php if($user_role == "production_admin"):?>
                                    <a href="/finishers/edit-finisher/finisher=<?php echo $job['finisher'.$tf.'_id'];?>"><?php echo ucwords($job['finisher'.$tf.'_name']);?></a>
                                <?php else:?>
                                    <?php echo ucwords($job['finisher'.$tf.'_name']);?>
                                <?php endif;?>
                            </p>
                        <?php endif;?>
                    <?php endfor;?>
                </td>
                <?php if($need_checkbox):?>
                    <td data-label="Select" class="chkbox">
                        <div class="checkbox checkbox-default">
                            <input type="checkbox" class="select styled" data-jobid='<?php echo $job['id'];?>' name="select_<?php echo $job['id'];?>" id="select_<?php echo $job['id'];?>" />
                            <label for="select_<?php echo $job['id'];?>"></label>
                        </div>
                    </td>
                <?php endif;?>
                <?php if($can_do_runsheets):?>
                    <td data-label="Runsheet Day">
                        <?php if($job['runsheet_id'] > 0):
                            $add_to_runsheet = false;?>
                            <p>This Job is on the runsheet for <strong><?php echo date('l jS \of F',$job['runsheet_day']);?></strong></p>
                            <?php if($job['runsheet_completed'] == 1):
                                $add_to_runsheet = true;?>
                                <p class="text-center">The runsheet has been completed</p>
                            <?php else:?>
                                <?php if($job['driver_id'] > 0):
                                    $print_text = ($job['printed'] == 0)? "Print Runsheeet" : "Reprint Runsheet";?>
                                    <p class="text-center"><button class="btn btn-outline-danger remove-from-runsheet" data-jobid="<?php echo $job['id'];?>" data-runsheetid="<?php echo $job['runsheet_id'];?>">Remove It</button></p>
                                    <p class="text-center"><button class='btn btn-sm btn-outline-success print-sheet' data-runsheetid='<?php echo $job['runsheet_id'];?>' data-driverid='<?php echo $job['driver_id'];?>'><?php echo $print_text;?></button></p>
                                    <?php if($job['printed'] > 0):?>
                                        <p><a class='btn btn-sm btn-outline-success' href='/runsheets/finalise-runsheet/runsheet=<?php echo $job['runsheet_id'];?>/driver=<?php echo $job['driver_id'];?>'>Finalise Runsheet</a></p>
                                    <?php endif;?>
                                <?php else:?>
                                    <p><a href='/runsheets/prepare-runsheet/runsheet=<?php echo $job['runsheet_id'];?>' class='btn btn-sm btn-outline-fsg'>Update Driver<br>and Tasks</a></p>
                                <?php endif;?>
                            <?php endif;?>
                        <?php endif;?>
                        <?php if($add_to_runsheet):
                            $date = strtotime("today");?>
                            <div class="input-group">
                                <input type="text" class="form-control runsheet_day" name="runsheet_daydate_<?php echo $job['id'];?>" id="runsheet_daydate_<?php echo $job['id'];?>" value="<?php echo date('d/m/Y',$date);?>" />
                                <input type="hidden" name="runsheet_daydate_value_<?php echo $job['id'];?>" id="runsheet_daydate_value_<?php echo $job['id'];?>" value="<?php echo $date;?>" />
                                <div class="input-group-append">
                                    <span id="runsheet_daydate_calendar_<?php echo $job['id'];?>" class="input-group-text runsheet_calendar"><i class="fad fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        <?php endif;?>
                    </td>
                <?php endif; ?>
                <td data-label="Date Entered"><?php echo date("d/m/Y", $job['created_date']);?></td>
                <td data-label="Due Date"
                <?php if($job['strict_dd'] > 0):?>
                    <?php if( ($job['due_date'] < $today) ):?>
                        style="background-color: #222; color:#FFF"
                    <?php elseif( ($job['due_date'] - $today) <= (24 * 60 * 60)):?>
                        style="background-color: #FF0000; color:#FFF"
                    <?php elseif( ($job['due_date'] - $today) <= (2 * 24 * 60 * 60)):?>
                        style="background-color: #cc3300; color:#FFF"
                    <?php elseif( ($job['due_date'] - $today) <= (5 * 24 * 60 * 60)):?>
                        style="background-color: #e6e600"
                    <?php else: ?>
                        style="background-color: #66ff66;"
                    <?php endif;?>
                <?php endif;?>
                ><?php if($job['due_date'] > 0) echo date("d/m/Y", $job['due_date']);?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>