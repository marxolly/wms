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
        $client_id = ($user_role == 'client')? $this->user->getUserClientId( Session::getUserId() ) : 0;
        $style_defaults = array(
            'logo'                      => '<img width="130" src="/images/FSG_logo@130px.png" class="custom-logo" alt="FSG" style="display:none;" title="WMS Home" /><img width="130" src="/images/FSG_logo_white@130px.png" class="custom-logo-transparent" alt="FSG logo" title="WMS Home" />',
            'card_border_colour'        => '#545380',
            'card_header_colour'        => '#242359',
            'card_header_background'    => '#b4c3dc',
            'card_header_border_colour' => '#545380',
            'quicklinks_header_colour'  => '#17142c'
        );
        $client_styles = $this->displaystyle->getClientStyles($client_id);
        if(!empty($client_styles))
        {
            $client_styles = array_filter($client_styles);
            $styles = array_merge($style_defaults, $client_styles);
        }
        else
        {
            $styles = $style_defaults;
        }
        //$styles = (empty($client_styles))? $style_defaults: array_merge($style_defaults, $client_styles);
        //render the page
        Config::setJsConfig('curPage', "shipto-reps");
        $this->view->renderStyleSheet(Config::get('VIEWS_PATH') . "stylesheets/website-style.php",$styles);
    }

    public function isAuthorized()
    {
        return true;
    }
}
?>