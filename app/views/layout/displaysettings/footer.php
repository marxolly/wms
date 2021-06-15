
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
                    $('.colour-picker')
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
                                $(e.currentTarget).children('input').valid();
                            });
                        $('button.preview').click(function(e){
                            e.preventDefault();
                            var $form = $(this).closest('form');
                            var section = $(this).data("section");
                            var value = $("input[name='"+section+"']").val();
                            console.log("the chosen colour for "+section+" is "+value);
                            if($form.valid())
                            {
                                //$.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Generating the preview...</h2></div>' });
                                var data = { [section] : value };
                                actions.common['load-preview'](data);
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