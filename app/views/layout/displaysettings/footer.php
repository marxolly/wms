
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    }
                },
                'adjust-colours': {
                    init: function(){
                        /* */
                        $('#style_preview').load('/ajaxfunctions/loadStylePreview',{client_id: $("#client_id").val()},
                            function(responseText, textStatus, XMLHttpRequest){
                                if(textStatus == 'error') {
                                    $(this).html('<div class=\'errorbox\'><h2>There has been an error</h2></div>');
                                }
                                else
                                {

                                }
                            }
                        );
                        var cpicker = $('.colour-picker')
                            .colorpicker({
                                autoInputFallback: false,
                                //format: 'rgba',
                                extensions: [
                                    {
                                        name: 'swatches', // extension name to load
                                        options: { // extension options
                                            colors: {
                                                'black': '#000000',
                                                'gray': '#888888',
                                                'white': '#ffffff',
                                                'red': '#ff0000',
                                                'default': '#777777',
                                                'primary': '#337ab7',
                                                'success': '#5cb85c',
                                                'info': '#5bc0de',
                                                'warning': '#f0ad4e',
                                                'danger': '#d9534f',
                                                'fsg blue': '#4183c2'
                                            }
                                        }
                                    }
                                ]
                            })
                            .on('colorpickerChange', function(e){
                                console.dir(e);
                                $(e.currentTarget).valid();
                            });

                        $('button.preview').click(function(e){
                            e.preventDefault();
                            var $form = $(this).closest('form');
                            if($form.valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Adding Job Status...</h2></div>' });
                            }
                            else
                            {
                                return false;
                            }
                        })
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