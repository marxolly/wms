
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_common.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/footer_scripts.php");?>

        <script>
            //the actions for each page
            var actions = {
                common: {
                    init: function(){
                        $('div#order_activity_chart').html("<p class='text-center'><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Fetching Chart Data</p>");
                        $('div#error_activity_chart').html("<p class='text-center'><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Fetching Chart Data</p>");
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawAdminCharts);
                        var params = {
                            from: $('#admin_from_value').val(),
                            to: $('#admin_to_value').val()
                        }

                        /************
                        Google chart redraw on window size change
                        ************/
                        //create trigger to resizeEnd event
                        $(window).resize(function() {
                            if(this.resizeTO) clearTimeout(this.resizeTO);
                            this.resizeTO = setTimeout(function() {
                                $(this).trigger('resizeEnd');
                            }, 500);
                        });



                        function drawAdminCharts()
                        {
                            $.ajax({
                    			url: "/ajaxfunctions/getAdminWeeklyClientActivity",
                    			dataType:"json",
                    			data: params,
                    			type: 'post',
                                success: function(jsonData)
                                {
                                    //var jData =  $.parseJSON(jsonData);
                            		var data = google.visualization.arrayToDataTable(jsonData);
                                    var num_orders = jsonData.length - 1;
                            		if(num_orders > 0)
                            		{
                                		var options = {
                                		    animation:{
                                		        "startup":true,
                                                duration: 1000,
                                                easing: 'out',
                                            },
                                			hAxis: {
                                				title: 'Week Beginning',
                                				showTextEvery: 1,
                                				slantedText:true,
                                				slantedTextAngle:-45
                                			},
                                			vAxes: {
                                				0: {
                                					title: 'Order Count',
                                					viewWindow: {
                                						min: 0
                                					}
                                				}
                                			},
                                			legend: {
                                				position: 'top'
                                			},
                                			height: 450,
                                			series: {
                                				0:{type: "bars", targetAxisIndex:0, color: "052f95"} ,
                                                1:{type: "line", targetAxisIndex:0}
                                			},
                                            title: "Weekly Orders: Totals/Averages Last Three Months",
                                            titleTextStyle: {
                            					fontSize: 20,
                            					color: '##5F5F5E;',
                            					bold: false,
                            					italic: false,
                            					marginBottom: 20
                                            },
                                		};

                                		var chart = new google.visualization.LineChart(document.getElementById('error_activity_chart'));
                                        var button = document.getElementById('chart_button_1');

                                        function drawChart(){
                                            // Disabling the button while the chart is drawing.
                                            button.disabled = true;
                                            google.visualization.events.addListener(chart, 'ready',
                                                    function() {
                                                        button.disabled = false;
                                                    });

                                            chart.draw(data, options);
                                        }
                                        drawChart();
                                        //redraw chart when window resize is completed
                                        $(window).on('resizeEnd', function() {
                                            drawChart();
                                        });
                                    }
                                    else
                                    {
                                        $('div#error_activity_chart').html("<div class='errorbox'><h2>No Orders Placed</h2><p>There have been no orders fulfilled in the last three months</p></div>");
                                    }
                                }
                            });

                            $.ajax({
                    			url: "/ajaxfunctions/getClientActivity",
                    			dataType:"json",
                    			data: params,
                    			type: 'post',
                                success: function(jsonData)
                                {
                                    var data = google.visualization.arrayToDataTable(jsonData);
                                    var options = {
                                        title :'Daily Orders by Client',
                                        titleTextStyle: {
                                            fontSize: 21,
                                            bold: false,
                                            fontColor: "#333"
                                        },
                                        hAxis: {
                                            title: 'Day',
                                            gridlines: {
                                                count: 10
                                            }
                                        },
                                        vAxis: {
                                            title: 'Total Orders',
                                            viewWindow: {
                                                min: 0
                                            }
                                        },
                                        legend: {
                                            position: 'top',
                                            maxLines: 3
                                        },
                                        height: 450,
                                        isStacked: true
                                    };

                                    var chart = new google.visualization.ColumnChart(document.getElementById('order_activity_chart'));
                                    chart.draw(data, options);

                                    var columns = [];
                                    var series = {};
                                    for (var i = 0; i < data.getNumberOfColumns(); i++) {
                                        columns.push(i);
                                        if (i > 0) {
                                            series[i - 1] = {};
                                        }
                                    }

                                    options.series = series;

                                    google.visualization.events.addListener(chart, 'select', function () {
                                        var sel = chart.getSelection();
                                        // if selection length is 0, we deselected an element
                                        if (sel.length > 0) {
                                            // if row is undefined, we clicked on the legend
                                            if (sel[0].row === null) {
                                                var col = sel[0].column;
                                                if (columns[col] == col) {
                                                    // hide the data series
                                                    columns[col] = {
                                                        label: data.getColumnLabel(col),
                                                        type: data.getColumnType(col),
                                                        calc: function () {
                                                            return null;
                                                        }
                                                    };

                                                    // grey out the legend entry
                                                    series[col - 1].color = '#CCCCCC';
                                                }
                                                else {
                                                    // show the data series
                                                    columns[col] = col;
                                                    series[col - 1].color = null;
                                                }
                                                var view = new google.visualization.DataView(data);
                                                view.setColumns(columns);
                                                chart.draw(view, options);
                                            }
                                        }
                                    });
                                }
                            });
                        }
                        $('a#toggle_orders, a#client_activity, a#toggle_inventory, a#toggle_pickups, a#toggle_storeorders, a#toggle_solarorders, a#toggle_solarinstalls, a#toggle_solarservice').click(function(e){
                            $(this).toggleClass('hiding');
                        });

                    }
                },
                admin: {
                    init: function(){
                        actions.common.init();
                        var maxHeight = 0;
                        $("div.order-panel").each(function(){
                            if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
                        });
                        $("div.order-panel").height(maxHeight);
                    }
                },
                client: {
                    init: function(){
                        $('div#products_chart').html("<p class='text-center'><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Fetching Chart Data</p>");
                        $('div#orders_chart').html("<p class='text-center'><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Fetching Chart Data</p>");
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawClientCharts);
                        var params = {
                            client_id: $('#client_id').val(),
                            from: $('#from_value').val(),
                            to: $('#to_value').val()
                        }

                        function drawClientCharts()
                    	{
                    		$.ajax({
                    			url: "/ajaxfunctions/getOrderTrends",
                    			dataType:"json",
                    			data: params,
                    			type: 'post',
                                success: function(jsonData)
                                {
                                    //var jData =  $.parseJSON(jsonData);
                            		var data = google.visualization.arrayToDataTable(jsonData);
                                    var num_orders = jsonData.length - 1;
                            		if(num_orders > 0)
                            		{
                                		var options = {
                                			hAxis: {
                                				title: 'Week Beginning',
                                				showTextEvery: 1,
                                				slantedText:true,
                                				slantedTextAngle:-45
                                			},
                                			vAxes: {
                                				0: {
                                					title: 'Order Count',
                                					viewWindow: {
                                						min: 0
                                					}
                                				}
                                			},
                                			legend: {
                                				position: 'top'
                                			},
                                			height: 450,
                                			series: {
                                				0:{type: "line", targetAxisIndex:0} ,
                                                1:{type: "line", targetAxisIndex:0}
                                			},
                                            title: "Weekly Orders: Totals/Averages Last Three Months",
                                            titleTextStyle: {
                            					fontSize: 20,
                            					color: '##5F5F5E;',
                            					bold: false,
                            					italic: false,
                            					marginBottom: 20
                                            },
                                		};

                                		var chart = new google.visualization.LineChart(document.getElementById('orders_chart'));
                                		chart.draw(data, options);
                                    }
                                    else
                                    {
                                        $('div#orders_chart').html("<div class='errorbox'><h2>No Orders Placed</h2><p>There have been no orders fulfilled in the last three months</p></div>");
                                    }
                                }
                    		});
                            $.ajax({
                    			url: "/ajaxfunctions/getTopProducts",
                    			dataType:"json",
                    			data: params,
                    			type: 'post',
                                success: function(jData2)
                                {
                                    var data2 = google.visualization.arrayToDataTable(jData2);
                                    var num_products = jData2.length - 1;
                            		if(num_products > 0)
                            		{
                                		var options2 = {
                                			hAxis: {
                                				title: 'Product',
                                				showTextEvery: 1,
                                				slantedText:true,
                                				slantedTextAngle:-45
                                			},
                                			vAxes: {
                                				0: {
                                					title: 'Total Ordered',
                                					viewWindow: {
                                						min: 0
                                					}
                                				}
                                			},
                                			legend: {
                                				position: 'top'
                                			},
                                			height: 450,
                                            title: "Top "+num_products+" Ordered Items: Last Three Months",
                                            titleTextStyle: {
                            					fontSize: 20,
                            					color: '##5F5F5E;',
                            					bold: false,
                            					italic: false,
                            					marginBottom: 20
                                            },
                                		};

                                		var chart2 = new google.visualization.ColumnChart(document.getElementById('products_chart'));
                                		chart2.draw(data2, options2);
                                    }
                                    else
                                    {
                                        $('div#products_chart').html("");
                                    }
                                }
                    		});
                    	}
                    }
                },
                warehouse: {
                    init: function(){
                        actions.common.init();
                        var maxHeight = 0;
                        $("div.inventory-panel").each(function(){
                            if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
                        });
                        $("div.inventory-panel").height(maxHeight);
                    }
                },
                'dashboard':{
                    init: function(){
                        actions['<?php echo $user_role;?>'].init();
                    }

                },
                'comingsoon':{
                    init: function(){
                        
                    }
                }
            }
            //run the script for the current page
            actions[config.curPage].init();
        </script>
        <?php Database::closeConnection(); ?>
    </body>
</html>