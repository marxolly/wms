<?php

/**
 * Jobs controller
 *

 Manages Production Jobs

 * @author     Mark Solly <mark.solly@3plplus.com.au>
 */

class JobsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'jobs-index');
        parent::displayIndex(get_class());
    }

    public function addJob()
    {
        //render the page
        Config::setJsConfig('curPage', "add-job");
        Config::set('curPage', "add-job");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/jobs/", Config::get('VIEWS_PATH') . 'jobs/addJob.php', [
            'page_title'    =>  "Add Job for Production",
            'pht'           =>  ": Add Production Job"
        ]);
    }

    public function jobSearch()
    {
        $form = $this->view->render( Config::get('VIEWS_PATH') . "forms/jobsearch.php",[
            'term'              =>  "",
            'customer_id'       =>  0,
            'supplier_id'       =>  0,
            'date_from_value'   =>  0,
            'date_to_value'     =>  0
        ]);
        //render the page
        Config::setJsConfig('curPage', "job-search");
        Config::set('curPage', "job-search");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/jobs/", Config::get('VIEWS_PATH') . 'jobs/jobSearch.php', [
            'page_title'    =>  "Search production Jobs",
            'pht'           =>  ": Production Job Search",
            'form'          =>  $form
        ]);
    }

    public function jobSearchResults()
    {
        if(!$this->Security->CsrfToken())
        {
            return $this->error(400);
        }
        $customer_id = $this->request->query['customer_id'];
        $supplier_id = $this->request->query['supplier_id'];
        $date_from_value = $this->request->query['date_from_value'];
        $date_to_value = $this->request->query['date_to_value'];
        //echo "<pre>",print_r($this->request),"</pre>"; die();
        $args = array(
            'term'              =>  $this->request->query['term'],
            'customer_id'       =>  $customer_id,
            'supplier_id'       =>  $supplier_id,
            'date_from_value'   =>  $date_from_value,
            'date_to_value'     =>  $date_to_value
        );
        $jobs = $this->order->getSearchResults($args);
        $count = count($jobs);
        $s = ($count == 1)? "": "s";
        $form = $this->view->render( Config::get('VIEWS_PATH') . "forms/jobsearch.php",$args);
        //render the page
        Config::setJsConfig('curPage', "order-search-results");
        Config::set('curPage', "order-search-results");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/jobs/", Config::get('VIEWS_PATH') . 'jobs/jobSearchResults.php', [
            'page_title'    =>  "Search Results",
            'pht'           =>  ": Job Search Results",
            'form'          =>  $form,
            'count'         =>  $count,
            's'             =>  $s,
            'term'          =>  $this->request->query['term'],
            'jobs'          =>  $jobs
        ]);
    }

    public function viewJobs()
    {
        $completed = (isset($this->request->params['args']['completed']))? true : false;
        $cancelled = (isset($this->request->params['args']['cancelled']))? true : false;
        $jobs = $this->productionjob->getJobsForDisplay($completed, $cancelled);
        //render the page
        Config::setJsConfig('curPage', "view-jobs");
        Config::set('curPage', "view-jobs");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/jobs/", Config::get('VIEWS_PATH') . 'jobs/viewJobs.php', [
            'page_title'    =>  "View Production Jobs",
            'pht'           =>  ": Production Jobs",
            'jobs'          =>  $jobs
        ]);
    }

    public function updateJob()
    {
        if(!isset($this->request->params['args']['job']))
        {
            //no job id to update
            return (new ErrorsController())->error(400)->send();
        }
        $job_id = $this->request->params['args']['job'];
        $job_info = $this->productionjob->getJobById($job_id);
        if(empty($job_info))
        {
            //no job data found
            return (new ErrorsController())->error(404)->send();
        }
        $customer_info = $this->productioncustomer->getCustomerById($job_info['customer_id']);
        $supplier_info = ($job_info['supplier_id'] > 0)? $this->productionsupplier->getSupplierById($job_info['supplier_id']) : array();
        //render the page
        Config::setJsConfig('curPage', "update-job");
        Config::set('curPage', "update-job");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/jobs/", Config::get('VIEWS_PATH') . 'jobs/updateJob.php', [
            'page_title'    =>  "Update Production Job Details",
            'pht'           =>  ": Update Production Job",
            'job'           =>  $job_info,
            'customer'      =>  $customer_info,
            'supplier'      =>  $supplier_info
        ]);
    }

    public function isAuthorized()
    {
        $action = $this->request->param('action');
        //$role = Session::getUserRole();
        $role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $resource = "jobs";

        //only for admin
        Permission::allow('production admin', $resource, "*");
        //production users
        Permission::allow('production', $resource, array(
            "index",
            "viewJobs"
        ));

        return Permission::check($role, $resource, $action);
    }
}