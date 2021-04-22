
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    },
                    createCKEditors: function(){
                        $( 'textarea.wysiwyg_editor' ).each(function(){
                            console.log("gonna do textarea[name] "+$(this).attr('name'));
                            if (CKEDITOR.instances[$(this).attr('name')])
                            {
                                console.log("gonna destoy textarea[name] "+$(this).attr('name'));
                               CKEDITOR.instances[$(this).attr('name')].destroy();
                            }
                            CKEDITOR.replace( $(this).attr('name') );
                            console.log("done textarea[name] "+$(this).attr('name'));
                        });
                    }
                },
                'add-purchase-order':{
                    init: function(){
                        actions.common.createCKEditors();
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