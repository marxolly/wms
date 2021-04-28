
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
                        var currentCKEditors = document.querySelectorAll('.ck-editor__editable');
                        for( var j = 0; j < currentCKEditors.length; ++j)
                        {
                            currentCKEditors[j].ckeditorInstance.destroy();
                        }
                        for (var i = 0; i < allTextAreas.length; ++i)
                        {
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
                                } )
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
                        $('[id^=poitem_description_]').each(function(e) {
                            $(this).rules('add', {
                                required: function(){
                                    //var currentCKEditors = document.querySelectorAll('.ck-editor__editable');
                                    //for( var j = 0; j < currentCKEditors.length; ++j)
                                    //{
                                        //currentCKEditors[j].ckeditorInstance.updateSourceElement();
                                        //CKEDITOR.instances.currentCKEditors[j].updateSourceElement();
                                    //}
                                    return true;
                                },
                                messages:{
                                    required: "Type A farkin message"
                                }

                            });
                        });
                    },
                    removeCKEditor: function(){
                        $("a.remove-poitem").off('click').click(function(e){
                            e.preventDefault();
                            var $this = $(this);
                            var this_item = $this.data('poitem');
                            $("div#poitem_"+this_item).remove();
                            //redo indexing of items
                            $("div#poitems_holder div.apoitem").each(function(i,e){
                                $(this).attr("id", "poitem_"+i);
                                var plusi = i + 1;
                                var new_num = toWords(plusi);
                                var uc_new_num = new_num.charAt(0).toUpperCase() + new_num.slice(1)
                                $(this).find("h4.poitem_title").text("Item "+uc_new_num+"'s Details");
                                $(this).find("a.remove-poitem").data("poitem", i);
                                $(this).find("input.poitem_qty").attr("name", "poitems["+i+"][qty]");
                                $(this).find("input.poitem_description").attr("name", "poitems["+i+"][description]");
                                $(this).find("input.poitem_id").attr("name", "poitems["+i+"][item_id]");
                            });
                        });
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
                            $('div#poitems_holder').block();
                            $.post('/ajaxfunctions/addPOItem', data, function(d){
                                $('div#poitems_holder').append(d.html);
                                actions.common.createCKEditors();
                                actions.common.removeCKEditor();
                                $('div#poitems_holder').unblock();
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