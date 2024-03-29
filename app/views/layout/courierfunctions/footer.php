
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){
                        $('button.ship_quote').click(function(e)
                        {
                            e.preventDefault();
                            shippingQuote.getQuotes($(this).data('orderid'), $(this).data('destination'));
                        });
                    }
                },
                'get-quotes': {
                    init: function(){
                        shippingEstimates();
                    }
                },
                'view-bookings': {
                    init: function(){
                        dataTable.init($('table#view_bookings_table'), {
                            "columnDefs": [
                                { "searchable": false, "targets": [0,4,5,6,7,8] },
                                { "orderable": false, "targets": [8] },
                                { className: "nowrap text-right", "targets": [2]},
                                { className: "text-right", "targets": [4,5,6,7]}
                            ],
                            "order": [[0, 'desc']],
                            "processing": true,
                            "mark": true,
                            "language": {
                                processing: 'Fetching results and updating the display.....'
                            },
                            "serverSide": true,
                            "ajax": {
                                "url": "/ajaxfunctions/dataTablesViewDFBookings"
                            },
                            "drawCallback": function( settings ) {
                                $('button.track_booking').click(function(e) {
                                    e.preventDefault();
                                    var consignment_id = $(this).data('consignmentid');
                                    //make the form window
                                    $('<div id="tracking_pop" title="Track Delivery">').appendTo($('body'));
                                    $("#tracking_pop")
                                        .html("<p class='text-center'><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Getting Details...</p>")
                                        .load('/ajaxfunctions/trackDFBooking',{consignment_id: consignment_id},
                                            function(responseText, textStatus, XMLHttpRequest){
                                                if(textStatus == 'error') {
                                                    $(this).html('<div class=\'errorbox\'><h2>There has been an error</h2><p>The tracking page failed to load</p><p>Please try again</p><p>If the error persists, use the <a href="/contact/contact_us">Contact Form</a> to let us know</p></div>');
                                                }
                                            }
                                        )
                                    $("#tracking_pop").dialog({
                                        draggable: false,
                                        modal: true,
                                        show: true,
                                        hide: true,
                                        autoOpen: false,
                                        height: 520,
                                        width: 620,
                                        close: function(){
                                            $("#tracking_pop").remove();
                                        },
                                        open: function(){
                                            $('.ui-widget-overlay').bind('click',function(){
                                                $('#tracking_pop').dialog('close');
                                            });

                                        }
                                    });
                                    $("#tracking_pop").dialog('open');
                                });
                            }
                        });
                    }
                },
                'book-direct-freight': {
                    init: function(){
                        autoCompleter.addressAutoComplete($('#address'));
                        autoCompleter.suburbAutoComplete($('#suburb'));
                        /*  */
                        $('select#state, #postcode, #suburb, #address').change(function(e){
                            $(this).valid();
                        });

                        $("form#direct_freight_booker").submit(function(e){
                            if($(this).valid())
                                $.blockUI({ message: '<div style="height:160px; padding-top:20px;"><h2>Booking Direct Freight...</h2></div>' });
                            else
                                return false;
                        });

                        $("a.add-package").click(function(e){
                            e.preventDefault();
                            var package_count = $("div#packages_holder div.apackage").length;
                            console.log('packages: '+package_count);
                            var data = {
                                i: package_count
                            }
                            $.post('/ajaxfunctions/addQuotePackage', data, function(d){
                                $('div#packages_holder').append(d.html);
                            });
                        });
                        $("a#remove-all-packages").click(function(e){
                            e.preventDefault();
                            $('div#packages_holder div.apackage').not(':first').remove();
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