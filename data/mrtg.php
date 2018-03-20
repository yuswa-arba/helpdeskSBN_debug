<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){

global $conn_voip;

            
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Realtime MRTG</h3>
                                    <div class="box-tools pull-right">
                                        Real time
                                        <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                            <button type="button" class="btn btn-default btn-xs" data-toggle="on">On</button>
                                            <button type="button" class="btn btn-default btn-xs active" data-toggle="off">Off</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div id="interactive" style="height: 300px;"></div>
                                </div><!-- /.box-body-->
                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '<script src="'.URL.'js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="'.URL.'js/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="'.URL.'js/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="'.URL.'js/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

        <!-- Page script -->
        <script type="text/javascript">

            $(function() {

                /*
                 * Flot Interactive Chart
                 * -----------------------
                 */
                // We use an inline data source in the example, usually data would
                // be fetched from a server
                var data = [], totalPoints = 100;
                function getRandomData() {

                    if (data.length > 0)
                        data = data.slice(1);

                    // Do a random walk
                    while (data.length < totalPoints) {

                        var prev = data.length > 0 ? data[data.length - 1] : 50,
                                y = prev + Math.random() * 10 - 5;

                        if (y < 0) {
                            y = 0;
                        } else if (y > 100) {
                            y = 100;
                        }

                        data.push(y);
                    }

                    // Zip the generated y values with the x values
                    var res = [];
                    for (var i = 0; i < data.length; ++i) {
                        res.push([i, data[i]]);
                    }

                    return res;
                }

                var interactive_plot = $.plot("#interactive", [getRandomData()], {
                    grid: {
                        borderColor: "#f3f3f3",
                        borderWidth: 1,
                        tickColor: "#f3f3f3"
                    },
                    series: {
                        shadowSize: 0, // Drawing is faster without shadows
                        color: "#3c8dbc"
                    },
                    lines: {
                        fill: true, //Converts the line chart to area chart
                        color: "#3c8dbc"
                    },
                    yaxis: {
                        min: 0,
                        max: 100,
                        show: true
                    },
                    xaxis: {
                        show: true
                    }
                });

                var updateInterval = 500; //Fetch data ever x milliseconds
                var realtime = "off"; //If == to on then fetch data every x seconds. else stop fetching
                function update() {

                    interactive_plot.setData([getRandomData()]);

                    // Since the axes dont change, we dont need to call plot.setupGrid()
                    interactive_plot.draw();
                    if (realtime === "on")
                        setTimeout(update, updateInterval);
                }

                //INITIALIZE REALTIME DATA FETCHING
                if (realtime === "on") {
                    update();
                }
                //REALTIME TOGGLE
                $("#realtime .btn").click(function() {
                    if ($(this).data("toggle") === "on") {
                        realtime = "on";
                    }
                    else {
                        realtime = "off";
                    }
                    update();
                });
                /*
                 * END INTERACTIVE CHART
                 */
            });

           
        </script>

    ';

    $title	= 'MRTG Internet';
    $submenu	= "inet_mrtg";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group,"green");
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>