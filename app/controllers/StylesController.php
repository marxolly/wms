<?php

/**
 * Styles controller
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class solarteamsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }

    public function loadStyleSheets()
    {
        $client_id = (isset($this->request->params['args']['client']))? $this->request->params['args']['client'] : 0;
        //render the page
        Config::setJsConfig('curPage', "shipto-reps");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/salesreps/", Config::get('VIEWS_PATH') . 'salesreps/shipToRep.php',
        [
            'page_title'    => 'Ship Consignment To Sales Rep',
            'client_id'     => $client_id
        ]);
    }

    public function isAuthorized()
    {
        return true;
    }
}
?>