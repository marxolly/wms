
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
                        $('.colour-picker').colorpicker({
                            extensions: [
                                {
                                    name: 'swatches', // extension name to load
                                    options: { // extension options
                                        colors: {
                                            'black': '#000000',
                                            'gray': '#888888',
                                            'white': '#ffffff',
                                            'red': 'red',
                                            'default': '#777777',
                                            'primary': '#337ab7',
                                            'success': '#5cb85c',
                                            'info': '#5bc0de',
                                            'warning': '#f0ad4e',
                                            'danger': '#d9534f'
                                        }
                                    }
                                }
                            ]
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