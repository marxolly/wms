
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){

                    },
                    jobAutoComplete: function(){
                        autoCompleter.productionJobAutocomplete($('input#fsg_job_no'), selectJobCallback, changeJobCallback);
                        function selectJobCallback(event, ui)
                        {
                            $('input#fsg_job_id').val(ui.item.job_id);
                            return false;
                        }
                        function changeJobCallback(event, ui)
                        {
                            if (!ui.item)
                	        {
                                $('input#fsg_job_id').val(0);
                            }
                            return false;
                        }
                    },
                    doPODates: function(){
                        $("span#date_calendar").css('cursor', 'pointer').click(function(e){
                            $('#date').focus();
                        })
                        if( !$('#date').hasClass("hasDatepicker") )
                        {
                            $('#date').datepicker({
                                changeMonth: true,
                                changeYear: true,
                                dateFormat: "dd/mm/yy",
                                onClose: function(selectedDate){
                                    var patt = new RegExp(/\d{2}[-/]\d{2}[-/]\d{4}/);
                                    if( !patt.test(selectedDate) )
                                    {
                                        $('input#date_value').val('');
                                        $('input#date').val('');
                                    }
                                    else
                                    {
                                        var d = new Date( selectedDate.replace( /(\d{2})[-/](\d{2})[-/](\d{4})/, "$2\/$1\/$3") );
                                        s = d.valueOf()/1000;
                                        $('input#date_value').val(s);
                                    }
                                }
                            });
                        }
                        $("span#required_date_calendar").css('cursor', 'pointer').click(function(e){
                            $('#required_date').focus();
                        })
                        if( !$('#required_date').hasClass("hasDatepicker") )
                        {
                            $('#required_date').datepicker({
                                changeMonth: true,
                                changeYear: true,
                                dateFormat: "dd/mm/yy",
                                onClose: function(selectedDate){
                                    //console.log('selecteddate: '+ selectedDate);
                                    var patt = new RegExp(/\d{2}[-/]\d{2}[-/]\d{4}/);
                                    if( patt.test(selectedDate) )
                                    {
                                        //console.log("true");
                                        var d = new Date( selectedDate.replace( /(\d{2})[-/](\d{2})[-/](\d{4})/, "$2\/$1\/$3") );
                                        s = d.valueOf()/1000;
                                        $('input#required_date_value').val(s);
                                    }
                                    else
                                    {
                                        //console.log("false");
                                        $('input#required_date_value').val('');
                                        $('input#required_date').val('');
                                    }
                                }
                            });
                        }
                        $('#required_date, #date').change(function(e){
                            $(this).valid();
                        });
                        $('#asap').change(function(ev){
                            if(this.checked)
                            {
                                $('div#required_date_holder').slideUp();
                                $('#required_date')
                                    .removeClass('required')
                                    .val('');
                                $('input#required_date_value').val('');
                            }
                            else
                            {
                                $('div#required_date_holder').slideDown();
                                $('#required_date').addClass('required');
                            }
                        });
                    },
                    finisherAutocomplete: function(){
                        autoCompleter.productionJobFinisherAutoComplete( $('#finisher_name'), selectFinisherCallback, changeFinisherCallback);
                        function selectFinisherCallback(event, ui)
                        {
                            $('input#finisher_id').val(ui.item.finisher_id);
                            $('div#podetails_holder').slideDown();
                            //Create DatePickers
                            actions.common.doPODates();
                            var data = {
                                finisher_id : ui.item.finisher_id
                            }
                            $.post('/ajaxfunctions/makePOFinisherContactSelect', data, function(d){
                                $('div#contact_selector').html(d.html);
                                $('.selectpicker').selectpicker();
                            });
                            return false;
                        }
                        function changeFinisherCallback(event, ui)
                        {
                            if (!ui.item)
                	        {
                                var $target = $(event.target);
                                $target.val("");
                                $('input#finisher_id').val("0");
                                $('div#podetails_holder').hide();
                                $('input#date_value').val("0");
                                $('input#required_date').val("");
                                return false;
                            }
                        }
                    },
                    validateTextField: function(textfield_id)
                    {
                        //console.log(textfield_id);
                        $('[id^=poitem_description_]').each(function(e) {
                            var thisid = $(this).attr('id');
                            //console.log("thisid: " + thisid);
                            $("#"+thisid).rules('remove');
                            $("#"+thisid).rules('add', {
                                required: true,
                                messages:{
                                    required: "Please give the item a description"
                                }
                            });
                        });
                        $(textfield_id).valid();
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
                            var this_id = allTextAreas[i].id;
                            console.log("this_id: "+this_id);
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
                                    if(window.editor)
                                    {
                                        window.editor[this_id] = editor;
                                    }
                                    else
                                    {
                                        window.editor = {};
                                        window.editor[this_id] = editor;
                                    }
                                    editor.model.document.on( 'change', () => {
                                        //console.log( 'The Document has changed!' );
                                        editor.updateSourceElement();
                                        actions.common.validateTextField(editor.sourceElement);
                                    } );
                                } )
                                .catch( error => {
                                    console.error( 'Oops, something went wrong!' );
                                    console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
                                    console.warn( 'Build id: x86d9y47fxh6-q4s9v3hwa0g6' );
                                    console.error( error );
                                } );
                        }
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
                            $("button#submitter").prop("disabled", $("div#poitems_holder div.apoitem").length == 0);
                        });
                    }
                },
                'add-purchase-order':{
                    init: function(){
                        $("button#submitter").prop("disabled", $("div#poitems_holder div.apoitem").length == 0);
                        actions.common.finisherAutocomplete();
                        actions.common.jobAutoComplete();
                        actions.common.doPODates();
                        $("a.add-poitem").click(function(e){
                            e.preventDefault();
                            var item_count = $("div#poitems_holder div.apoitem").length;
                            //console.log('packages: '+contact_count);
                            var data = {
                                i: item_count
                            }
                            //$.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Contacted Couriers and Getting Prices...</h2></div>' });
                            $('div#poitems_holder').css('min-height','250px').block({
                                message: '<h2>Hang on...getting a coffee</h2>',
                                css: {
                                    padding:        '20px',
                                    margin:         0,
                                    width:          '80%',
                                    top:            '40%',
                                    left:           '35%',
                                    textAlign:      'center',
                                    color:          '#000',
                                    border:         '3px solid #aaa',
                                    backgroundColor:'#fff',
                                    cursor:         'wait'
                                },
                            });
                            $.post('/ajaxfunctions/addPOItem', data, function(d){
                                $('div#poitems_holder').append(d.html);
                                actions.common.createCKEditors();
                                actions.common.removeCKEditor();
                                $('div#poitems_holder').unblock();
                                $([document.documentElement, document.body]).animate({
                                    scrollTop: $("#poitem_" + item_count).offset().top
                                }, 1000);
                                $("button#submitter").prop("disabled", $("div#poitems_holder div.apoitem").length == 0);
                            });
                        });
                        actions.common.createCKEditors();
                        actions.common.removeCKEditor();
                        $("form#add_purchase_order").submit(function(e){
                            if($(this).valid())
                            {
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Adding the Purchase Order...</h2></div>' });
                            }
                        });
                    }
                },
                'view-update-purchase-order':{
                    init: function(){

                    }
                },
                'view-purchase-orders':{
                    init: function(){

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