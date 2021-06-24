
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    },
                    'load-preview': function(data){
                        if(data === undefined) {
                            data = {};
                        }
                        data['client_id'] = $("#client_id").val();
                        $('#style_preview').load('/ajaxfunctions/loadStylePreview',data,
                            function(responseText, textStatus, XMLHttpRequest){
                                if(textStatus == 'error') {
                                    $(this).html('<div class=\'errorbox\'><h2>There has been an error</h2></div>');
                                }
                                else
                                {

                                }
                            }
                        );
                    }
                },
                'adjust-colours': {
                    init: function(){
                        actions.common['load-preview']();
                        $('.colour-picker').spectrum({
                            type: "component",
                            showPalette: false,
                            showInput: true,
                            showAlpha: false,
                            allowEmpty: false
                        });
                        $('div.sp-colorize-container.sp-add-on')
                            .css({
                                cursor: "pointer"
                            })
                            .off("click")
                            .click(function(ev){
                                $(this).next('input.colour-picker').spectrum("show");
                                return false;
                            });
                        $('button#preview_changes').click(function(e){
                            e.preventDefault();
                            var data = {};
                            if($('form#adjust-style-colours').valid())
                            {
                                $("input.colour-picker").each(function(ind, el){
                                    var section = $(this).attr('id');
                                    var value = $(this).val();
                                    data[section] = value;
                                })
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Generating the preview...</h2></div>' });
                                console.dir(data);
                                actions.common['load-preview'](data);
                                var $nav = $("nav.fixed-top");
                                var scrollSpot = $("h2#page_header").offset().top - $nav.height();
                                $('html, body').animate( {scrollTop: scrollSpot}, 1000, function(){
                                    $.unblockUI();
                                });
                            }
                        });
                        $('input.defaultbox').each(function(i,e){
                            $(this).change(function(ev){
                                var section = $(this).data('section');
                                var $input = $('input#'+section);
                                var default_val = $input.data('defaultvalue');
                                if($(this).prop('checked')){
                                    $input.val(default_val).spectrum("disable").prop("disabled", true).valid();
                                    $input.prev('div.sp-colorize-container.sp-add-on')
                                        .css({
                                            cursor: "auto"
                                        })
                                        .off('click');
                                }
                                else
                                {
                                    $input.val(default_val).spectrum("enable").prop("disabled", false).valid();
                                    $input.prev('div.sp-colorize-container.sp-add-on')
                                        .css({
                                            cursor: "pointer"
                                        })
                                        .off('click')
                                        .click(function(ev){
                                            $(this).next('input.colour-picker').spectrum("show");
                                            return false;
                                        });
                                }
                            });
                        });
                    }
                }
            }
            //console.log('current page: '+config.curPage);
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>