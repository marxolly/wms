
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){
                        $('button#report_error').click(function(e){
                            console.log('click');
                            $.ajax({
                                url: '/ajaxfunctions/report-error-page',
                                method: 'post',
                                data: {
                                    url: window.location.href,
                                    error_type: $('#error_type').val(),
                                    loaded: $('#loaded').val()
                                },
                                dataType: 'json',
                                beforeSend: function(){
                                    $.blockUI({ message: '<div style="height:160px; padding-top:40px;"><h1>Reporting error...</h1></div>' });
                                    $('div#feedback').slideUp();
                                },
                                success: function(d){
                                    $.unblockUI();
                                    if(d.error)
                                    {
                                        $('div#feedback')
                                            .removeClass()
                                            .addClass('errorbox')
                                            .html(d)
                                            .slideDown();
                                        $('button#report_error').prop("disabled",false);
                                    }
                                    else
                                    {
                                        $('div#feedback')
                                            .removeClass()
                                            .addClass('feedbackbox')
                                            .html(d.feedback)
                                            .slideDown();
                                        $('button#report_error').prop("disabled",true);
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                    //console.log(jqXHR);
                                    $.unblockUI();
                                    $('div#feedback')
                                        .removeClass()
                                        .addClass('errorbox')
                                        .html("<h2>"+jqXHR.status+"</h2><p>"+textStatus+"</p>")
                                        .slideDown();
                                }
                            });
                        })
                    }
                },
                'error-400': {
                    init: function(){

                    }
                },
                'error-401': {
                    init: function(){

                    }
                },
                'error-403': {
                    init: function(){

                    }
                },
                'error-404': {
                    init: function(){

                    }
                },
                'error-500': {
                    init: function(){

                    }
                },
                'errors':{
                    init:function(){

                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
            actions.common.init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>