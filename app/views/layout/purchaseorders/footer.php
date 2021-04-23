
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    },
                    createCKEditors: function(){
                        //.ckeditorInstance.destroy()
                        var allTextAreas = document.querySelectorAll('textarea.ckeditor');
                        for (var i = 0; i < allTextAreas.length; ++i)
                        {
                            elementId = document.getElementsByClassName('textarea.ckeditor')[i].id;
                            console.log("element id: " + elementId);
                            continue;
                            ClassicEditor
                                .create( allTextAreas[i] , {
                                    toolbar: {
                                        items: [
                                            'heading',
                                            '|',
                                            'bold',
                                            'italic',
                                            'strikethrough',
                                            'subscript',
                                            'superscript',
                                            'underline',
                                            '|',
                                            'fontColor',
                                            'highlight',
                                            '|',
                                            'outdent',
                                            'indent',
                                            'alignment',
                                            'insertTable',
                                            '|',
                                            'undo',
                                            'redo'
                                        ]
                                    },
                                    language: 'en',
                                    image: {
                                        toolbar: [
                                            'imageTextAlternative',
                                            'imageStyle:full',
                                            'imageStyle:side'
                                        ]
                                    },
                                    table: {
                                        contentToolbar: [
                                            'tableColumn',
                                            'tableRow',
                                            'mergeTableCells'
                                        ]
                                    }
                                })
                                .then( editor => {
                                    window.editor = editor
                                } )
                                .catch( error => {
                                    console.error( 'Oops, something went wrong!' );
                                    console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
                                    console.warn( 'Build id: x86d9y47fxh6-q4s9v3hwa0g6' );
                                    console.error( error );
                                } );
                        }
                    }
                },
                'add-purchase-order':{
                    init: function(){
                        $("a.add-poitem").click(function(e){
                            e.preventDefault();
                            var item_count = $("div#poitems_holder div.apoitem").length;
                            //console.log('packages: '+contact_count);
                            var data = {
                                i: item_count
                            }
                            $.post('/ajaxfunctions/addPOItem', data, function(d){
                                $('div#poitems_holder').append(d.html);
                                actions.common.createCKEditors();
                                $([document.documentElement, document.body]).animate({
                                    scrollTop: $("#poitem_" + item_count).offset().top
                                }, 1000);
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