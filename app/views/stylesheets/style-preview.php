<?php
 //echo "<pre>",print_r($data),"</pre>";
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
    box-shadow: -5px 0 5px -5px rgb(50 50 50 / 30%), 5px 0 5px -5px rgb(50 50 50 / 30%);
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

.homepagedeck-preview {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    margin: 1rem 0;
}

.homepagecard-preview{
    margin: 5px auto !important;
    border: thin solid <?php echo $card_border_colour;?>;
    flex: 65% !important;
    max-width: 65% !important;
}

.homepagecard-previw .card-header,
.homepagecard-preview .card-body{
    color: <?php echo $card_header_colour;?>;
}

.homepagecard-preview .card-header{
    background-color: <?php echo $card_header_background;?>;
    border-bottom: 1px solid <?php echo $card_header_border_colour;?>;
}

.homepagecard-preview .card-header,
.homepagecard-preview .card-body{
    color: <?php echo $card_header_colour;?>;
}

.btn-outline-fsg-preview {
    color: <?php echo $fsg_button_colour;?>;
    border-color: <?php echo $fsg_button_colour;?>;
}

.btn-outline-fsg-preview:hover {
    color: <?php echo $fsg_button_hover_text_colour;?> !important;
    background-color: <?php echo $fsg_button_colour_hover;?>;
    border-color: <?php echo $fsg_button_hover_border_colour;?>;
}

ol.breadcrumb-preview{
    font-size: 0.9em;
}

</style>
<div id="page_header_preview">
    <div class="col-lg-12">
        <h1>Site Title Colour</h1>
        <p class="text-center">The background is the Top Banner Background</p>
    </div>
</div>
<div id="page-wrapper_preview">
    <div id="page_container_preview" class="container">
        <div class="mr-auto">
            <ol class="breadcrumb breadcrumb-preview">
                <li class="breadcrumb-item"><i class="fad fa-home"></i></li>
                <li class="breadcrumb-item">Section Name</li>
                <li class="breadcrumb-item">Page Name</li>
                <li class="breadcrumb-item">Page Name</li>
                <li class="breadcrumb-item">Page Name</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header_preview">page title colour</h2>
            </div>
        </div>
        <div class="card-deck homepagedeck-preview">
            <div class="card homepagecard-preview">
                <div class="card-header">
                    <h4>Card Header</h4>
                    <p>Text colour and background colour is editable</p>
                </div>
                <div class="card-body text-center">
                    <a class="btn btn-lg btn-outline-fsg-preview" href="">
                        <i class="fab fa-jedi-order fa-3x"></i>
                    </a><br>
                    This behaves like a button button. Colours and backgrounds are editable for normal and hover states.<br>
                    All buttons have a white background in the normal state<br>
                    <button class="btn btn-outline-fsg-preview">Test Other Button Colours Here</button></br>
                    This text colour is the same as the card header text colour.
                </div>
            </div>
        </div>
    </div>
</div>
<?php ?>