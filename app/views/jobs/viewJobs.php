<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php if(count($jobs)):?>
            <div id="waiting" class="row">
                <div class="col-lg-12 text-center">
                    <h2>Drawing Table..</h2>
                    <p>May take a few moments</p>
                    <img class='loading' src='/images/preloader.gif' alt='loading...' />
                </div>
            </div>
            <div class="row" id="table_holder" style="display:none">
                <div class="col-md-4 mb-md-3"><a class="btn btn-outline-fsg" href="/jobs/view-jobs/completed=1">View Only Completed Jobs</a></div>
                <div class="col-md-4 mb-md-3"></div>
                <div class="col-md-4 mb-md-3"></div>
                <div class="col-12">
                    <table class="table-striped table-hover" id="production_jobs_table">
                        <thead>
                            <tr>
                                <th>Job Number</th>
                                <th>Related Job</th>
                                <th>Client</th>
                                <th>Description</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th>Sales Rep</th>
                                <th>Supplier</th>
                                <th>Date Entered</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($jobs as $job):?>
                                <tr>
                                    <td data-label="Job Number" class="number"><?php echo $job['job_id'];?></td>
                                    <td data-label="Related Job" class="number"><?php echo $job['previous_job_id'];?></td>
                                    <td data-label="Client"><?php echo $job['name'];?></td>
                                    <td data-label="Description"><?php echo $job['description'];?></td>
                                    <td data-label="Notes"><?php echo $job['notes'];?></td>
                                    <td data-label="Status"><?php echo ucwords($job['status']);?></td>
                                    <td data-label="Sales Rep"><?php echo ucwords($job['salesrep_name']);?></td>
                                    <td data-label="Supplier"><?php echo ucwords($job['supplier_name']);?></td>
                                    <td data-label="Date Entered"><?php echo date("d/m/Y", $job['created_date']);?></td>
                                    <td data-label="Due Date"><?php echo date("d/m/Y", $job['due_date']);?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>

            </div>
        <?php else:?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="errorbox">
                            <h2><i class="fas fa-exclamation-triangle"></i> No Jobs Listed</h2>
                        </div>
                    </div>
                </div>
        <?php endif;?>
    </div>
</div>