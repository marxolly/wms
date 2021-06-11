<?php

/**
 * Styles controller
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class stylesController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }

    public function clientStyling()
    {
        $user_role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $client_id = ($user_role == 'client' || $user_role == "client admin")? $this->user->getUserClientId( Session::getUserId() ) : 0;
        //$style_defaults = STYLE_DEFAULTS;
        $client_styles = $this->displaystyle->getClientStyles($client_id);
        $styles = Utility::createClientStyles($client_styles);

        //render the page
        $this->view->renderStyleSheet(Config::get('VIEWS_PATH') . "stylesheets/website-style.php",$styles);
    }

    public function isAuthorized()
    {
        return true;
    }
}
?>