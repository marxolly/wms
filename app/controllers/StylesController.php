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
        $style_defaults = array(
            'logo'                      => '<img width="130" src="/images/FSG_logo@130px.png" class="custom-logo" alt="FSG" style="display:none;" title="WMS Home" /><img width="130" src="/images/FSG_logo_white@130px.png" class="custom-logo-transparent" alt="FSG logo" title="WMS Home" />',
            'card_border_colour'        => '#545380',
            'card_header_colour'        => '#242359',
            'card_header_background'    => '#b4c3dc',
            'card_header_border_colour' => '#545380',
            'fsg_button_colour'         => '#4183c2',
            'fsg_button_colour_hover'   => '#242359',
            'page_header_colour'        => '#242359',
            'quicklinks_header_colour'  => '#17142c',
            'top_banner_background'     => 'linear-gradient(161deg, rgba(138,105,140,1) 0%, rgba(36,35,89,1) 25%, rgba(23,20,44,1) 40%, rgba(23,20,44,1) 70%, rgba(65,131,194,1) 90%, rgba(130,165,208,1) 100%)'
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