
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    }
                },
                'repalletising-shrinkwrapping': {
                    init: function(){
                        datePicker.fromDate();
                        $('form#repalletising_shrinkwrapping').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Recording data...</h2></div>' });
                            }
                        });
                    }
                },
                'container-unloading': {
                    init: function(){
                        datePicker.fromDate();
                        $('select#client_id, select#container_size, select#load_type').change(function(e){
                            $(this).valid();
                        });
                        $('select#load_type').change(function(e){
                            if($(this).val() == "Loose")
                            {
                                $("input#item_count").prop('disabled', false);
                            }
                            else
                            {
                                $("input#item_count").prop('disabled', true);
                            }
                        });
                        $('form#container_unloading').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:140px; padding-top:20px;"><h2>Recording data...</h2></div>' });
                            }
                        });
                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>