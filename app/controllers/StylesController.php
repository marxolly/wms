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
        if(!empty($client_styles))
        {
            $client_styles = array_filter($client_styles);
            $styles = array_merge(STYLE_DEFAULTS, $client_styles);
        }
        else
        {
            $styles = STYLE_DEFAULTS;
        }
        //calculate page background colour
        list($r, $g, $b) = sscanf($styles['card_header_background'], "#%02x%02x%02x");
        $styles['page_background_colour'] = "rgba($r,$g,$b,0.1)";
        //calculate button hover text colour
        $styles['fsg_button_hover_text_colour'] = Utility::getContrastColor($styles['fsg_button_colour_hover']);
        //adjust button border to suit
        $styles['fsg_button_hover_border_colour'] = ($styles['fsg_button_hover_text_colour'] == "#000000")? "#000000" : $styles['fsg_button_colour_hover'];

        //render the page
        $this->view->renderStyleSheet(Config::get('VIEWS_PATH') . "stylesheets/website-style.php",$styles);
    }

    public function isAuthorized()
    {
        return true;
    }
}
?>