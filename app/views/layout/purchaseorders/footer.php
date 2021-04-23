
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    },
                    createCKEditors: function(){
                        var allEditors = document.querySelectorAll('textarea.ckeditor');
                        for (var i = 0; i < allEditors.length; ++i)
                        {
                            ClassicEditor
                                .create( allEditors[i],{
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
                                            '-',
                                            'fontSize',
                                            'fontColor',
                                            'fontBackgroundColor',
                                            'highlight',
                                            '-',
                                            'outdent',
                                            'indent',
                                            'alignment',
                                            'insertTable',
                                            '-',
                                            'undo',
                                            'redo'
                                        ],
                                        shouldNotGroupWhenFull: true
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
                                    },
                                    licenseKey: ''
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