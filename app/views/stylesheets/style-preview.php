<?php

?>
<style>
div#page-wrapper_preview{
    padding: 5px 10px;
    background-color: <?php echo $page_background_colour;?>
}
div#page_container_preview{
    background-color: #fdfdfd;
    padding-top: 1rem;
    max-width: 80%;
}
div#page_header_preview{
    background: <?php echo $top_banner_background;?>;
    color: <?php echo $site_title_colour;?>;
    text-align:center;
    box-shadow: 0 5px 10px 0 rgb(50 50 50 / 30%);
    border: thin solid rgba(0,0,0,0);
}
div#page_header_preview h1{
}
h2.page-header_preview {
    font-size: 40px;
    letter-spacing: 3.5px;
    font-weight: 800;
    text-transform: uppercase;
    text-align: center;
    margin-top: 25px;
    color: <?php echo $page_title_colour;?>;
}

</style>
<div id="page_header_preview">
    <div class="col-lg-12">
        <h1>Site Title Colour</h1>
        <p class="text-center">The background is the Top Banner Background</p>
    </div>
</div>
<div id="page-wrapper_preview">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header_preview">page title colour</h2>
        </div>
    </div>
    <div id="page_container_preview" class="container">
        <div class="card-deck homepagedeck">
            <div class="card homepagecard-preview">
                <div class="card-header">
                    <h4>Card Header</h4>
                </div>
                <div class="card-body text-center">
                    <a class="btn btn-lg btn-outline-fsg" href="">
                        <i class="fab fa-jedi-order fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
