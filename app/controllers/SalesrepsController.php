<?php

/**
 * Site Settings controller
 *

 * @author     Mark Solly <mark.solly@3plplus.com.au>
 */

class SalesRepsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'sales-reps-index');
        parent::displayIndex(get_class());
    }

    public function addSalesRep()
    {
        //render the page
        Config::setJsConfig('curPage', "add-sales-rep");
        Config::set('curPage', "add-sales-rep");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/salesreps/", Config::get('VIEWS_PATH') . 'salesreps/addRep.php',
        [
            'page_title'    =>  'Add New Sales Rep'
        ]);
    }

    public function editSalesRep()
    {
        $rep_id = $this->request->params['args']['rep'];
        $rep_info = $this->salesrep->getRepById($rep_id);
        //render the page
        Config::setJsConfig('curPage', "edit-sales-rep");
        Config::set('curPage', "edit-sales-rep");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/salesreps/", Config::get('VIEWS_PATH') . 'salesreps/editRep.php',
        [
            'page_title'    =>  'Edit Sales Rep details',
            'rep'           =>  $rep_info
        ]);
    }

    public function viewReps()
    {
        $active = 1;
        if(!empty($this->request->params['args']))
        {
            $active = (isset($this->request->params['args']['active']))? $this->request->params['args']['active'] : 1;
        }
        $reps = $this->salesrep->getAllReps($active);
        //render the page
        Config::setJsConfig('curPage', "view-reps");
        Config::set('curPage', "view-reps");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/salesreps/", Config::get('VIEWS_PATH') . 'salesreps/viewReps.php',
        [
            'page_title'    =>  'Manage Sales Reps',
            'reps'          =>  $reps,
            'active'        =>  $active
        ]);
    }

    public function isAuthorized(){
        $action = $this->request->param('action');
        //$role = Session::getUserRole();
        $role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $resource = "salesreps";

        //only for admin
        Permission::allow('production admin', $resource, "*");
        //production users
        Permission::allow('production', $resource, array(
            "index",
            "viewReps"
        ));

        return Permission::check($role, $resource, $action);
    }
}
?>