
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    }
                },
                'finisher-categories':{
                    init: function(){
                        $("form#add-finisher-category").submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Adding Category...</h2></div>' });
                            }
                            else
                            {
                                return false;
                            }
                        });
                        $("form.edit-category").each(function(i,e){
                            $(this).submit(function(e){
                                if($(this).valid())
                                {
                                    $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Editing Category...</h2></div>' });
                                }
                                else
                                {
                                    return false;
                                }
                            });
                        })
                    }
                },
                'edit-job-status':{
                    init: function(){
                        $("form#add-job-status").submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Adding Job Status...</h2></div>' });
                            }
                            else
                            {
                                return false;
                            }
                        });
                        $("form.edit-job-status").submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Editing Job Status...</h2></div>' });
                            }
                            else
                            {
                                return false;
                            }
                        });
                        $('input.default_checkbox').click(function() {
                            $('input.default_checkbox').not(this).prop("checked", false);
                        });
                        $('.colour-picker').colorpicker({
                            format: 'rgba',
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
                        .on('colorpickerChange colorpickerCreate', function (e) {
                            if (e.color.isDark())
                            {
                                $(this).closest('form').find('input.text_colour').val("rgb(239,239,239)");
                            }
                            else
                            {
                                $(this).closest('form').find('input.text_colour').val("rgb(33,37,41)");
                            }
                        });
                        $( "#sortable" ).sortable({
                            axis: "y",
                            cursor: "move",
                            update: function(event, ui){
                                var data = $(this).sortable('serialize');
                                //console.log('data: '+data);
                                $.post('/ajaxfunctions/update-jobstatus-order', data);
                            }
                        });
                    }
                },
                'job-csv-import':{
                    init: function(){
                        $('form#bulk_production_add').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Uploading and Processing Jobs...</h2></div>' });
                            }
                        });
                    }
                },
                'customer-csv-import':{
                    init: function(){
                        $('form#bulk_customer_add').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Uploading and Processing Customers...</h2></div>' });
                            }
                        });
                    }
                },
                'supplier-csv-import':{
                    init: function(){
                        $('form#bulk_supplier_add').submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Uploading and Processing Suppliers...</h2></div>' });
                            }
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