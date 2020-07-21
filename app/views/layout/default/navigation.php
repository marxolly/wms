<?php
$icons = Config::get("MENU_ICONS");
if(Session::getIsLoggedIn()):
    //echo "<pre>",print_r($_SESSION),"</pre>";
    $user_role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
    if(empty($user_role))
        //return $this->controller->redirector->login();
        return;
    $user_role = str_replace(" ","_", $user_role);
    //echo strtoupper($user_role."_PAGES");
    $pages = Config::get(strtoupper($user_role."_PAGES"));
    $user_info = $this->controller->user->getProfileInfo(Session::getUserId());
    $image = $user_info['image'];
else:
    $pages = array();
    $image = "/images/profile_pictures/default.png";
endif;
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: transparent; height:80px;">
    <a class="navbar-brand" href="#">
    <a href="/" class="navbar-brand" rel="home" itemprop="url">
        <img width="131" height="39" src="/images/FSG-logo-131x39px.png" class="custom-logo" alt="FSG" itemprop="logo" style="display:none;" />
        <img width="131" height="39" src="/images/FSG-logo-131x39px-wh.png" class="custom-logo-transparent" alt="FSG logo" itemprop="logo" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php if(count($pages)):?>
                <?php foreach($pages as $section => $spages):
                    if( (isset($pages[$section]['super_admin_only']) && $pages[$section]['super_admin_only'] == true) )
                    {
                        if(Session::getUserRole() != "super admin")
                            continue;
                    }
                    $Section = ucwords(str_replace("-", " ", $section));?>
                    <li id="<?php echo $section;?>" class="nav-item">
                        <a href="<?php echo "/$section/";?>" class="nav-link"><?php echo $Section;?></a>
                    </li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
        <ul class="navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello,<strong> <?php echo Session::getUsersName(); ?></strong> <img class="img-user" src="<?php echo $image;?>" />  <i class="fa fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navigation -->
<!-- Common Page Header -->
<div id="page_header" class="row">
    <div class="col-lg-12">
        <h1>Film Shot Graphics Warehouse Management System</h1>
    </div>
</div>
