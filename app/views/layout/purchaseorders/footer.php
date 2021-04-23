
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    },
                    createCKEditors: function(){
                        $( 'textarea.ckeditor' ).each(function(){
                            console.log("gonna do textarea[name] "+$(this).attr('id'));
                            ClassicEditor
                                .create( document.querySelector( $(this).attr('id') ) )
                                .then( editor => {
                                    console.log( editor );
                                } )
                                .catch( error => {
                                    console.error( error );
                                } );
                            console.log("done textarea[name] "+$(this).attr('id'));
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