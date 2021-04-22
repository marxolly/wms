
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    },
                    createCKEditors: function(){
                        $( 'textarea.ckeditor' ).ckeditor();
                        $( 'textarea.ckeditor' ).each(function(){
                            CKEDITOR.replace( $(this).attr('id') );
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