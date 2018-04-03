<!DOCTYPE html>
<html>

<!-- Mirrored from themesanytime.com/startui/demo/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Apr 2018 02:02:20 GMT -->
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>StartUI - Premium Bootstrap 4 Admin Dashboard Template</title>

    <link href="{{asset('Tasks/img/favicon.144x144.html')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{asset('Tasks/img/favicon.114x114.html')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{asset('Tasks/img/favicon.72x72.html')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{asset('Tasks/img/favicon.57x57.html')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{asset('Tasks/img/favicon.html')}}" rel="icon" type="image/png">
    <link href="{{asset('Tasks/img/favicon-2.html')}}" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{asset('Tasks/css/lib/lobipanel/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('Tasks/css/separate/vendor/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('Tasks/css/lib/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('Tasks/css/separate/pages/widgets.min.css')}}">
    <link rel="stylesheet" href="{{asset('Tasks/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('Tasks/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Tasks/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('Tasks/style.css')}}">
</head>
<body class="with-side-menu control-panel control-panel-compact">

<header class="site-header">
    <div class="container-fluid">
        <a href="#" class="site-logo">
            <img class="hidden-md-down" src="{{asset('Tasks/img/logo-2.png')}}" alt="">
            <img class="hidden-lg-down" src="{{asset('Tasks/img/logo-2-mob.png')}}" alt="">
        </a>


        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('Tasks/img/avatar-2-64.png')}}" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-cog"></span>Settings</a>
                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Help</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
                        </div>
                    </div>

                    <button type="button" class="burger-right">
                        <i class="font-icon-menu-addl"></i>
                    </button>
                </div><!--.site-header-shown-->


            </div><!--site-header-content-in-->
        </div><!--.site-header-content-->
    </div><!--.container-fluid-->
</header><!--.site-header-->

<div class="content">
    <div class="container-fluid">
        <h3>Bảng cá nhân</h3>
        <div class="row">
            <div class="col-sm-4 col-md-3 col-xl-2">
                <div class="statistic-box purple">
                    <div>
                        <div class="number">
                            Bảng 1
                        </div>
                        <div class="caption">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-xl-2">
                <div class="statistic-box purple">
                    <div>
                        <div class="number">
                            Bảng 1
                        </div>
                        <div class="caption">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-xl-2">
                <a href="">
                    <div class="statistic-box red">
                        <div>
                            <div class="number">
                                Bảng
                            </div>
                            <div class="caption">
                                Thêm bảng
                            </div>
                        </div>
                    </div>

                </a>
            </div>

        </div>

        <h3> Tạo bảng nhóm </h3>
        <div class="row">
            <div class="col-sm-4 col-md-3 col-xl-2">
                <div class="statistic-box green">
                    <div>
                        <div class="number">
                            Bảng 1
                        </div>
                        <div class="caption">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-xl-2">
                <div class="statistic-box green">
                    <div>
                        <div class="number">
                            Bảng 1
                        </div>
                        <div class="caption">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-sm-4 col-md-3 col-xl-2">
                <a href="">
                    <div class="statistic-box red">
                        <div>
                            <div class="number">
                                Bảng
                            </div>
                            <div class="caption">
                                Thêm bảng
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>



<script src="{{asset('Tasks/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('Tasks/js/lib/popper/popper.min.js')}}"></script>
<script src="{{asset('Tasks/js/lib/tether/tether.min.js')}}"></script>
<script src="{{asset('Tasks/js/lib/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('Tasks/js/plugins.js')}}"></script>

<script type="text/javascript" src="{{asset('Tasks/js/lib/jqueryui/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Tasks/js/lib/lobipanel/lobipanel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('Tasks/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.panel').each(function () {
            try {
                $(this).lobiPanel({
                    sortable: true
                }).on('dragged.lobiPanel', function(ev, lobiPanel){
                    $('.dahsboard-column').matchHeight();
                });
            } catch (err) {}
        });

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Day');
            dataTable.addColumn('number', 'Values');
            // A column for custom tooltip content
            dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
            dataTable.addRows([
                ['MON',  130, ' '],
                ['TUE',  130, '130'],
                ['WED',  180, '180'],
                ['THU',  175, '175'],
                ['FRI',  200, '200'],
                ['SAT',  170, '170'],
                ['SUN',  250, '250'],
                ['MON',  220, '220'],
                ['TUE',  220, ' ']
            ]);

            var options = {
                height: 314,
                legend: 'none',
                areaOpacity: 0.18,
                axisTitlesPosition: 'out',
                hAxis: {
                    title: '',
                    textStyle: {
                        color: '#fff',
                        fontName: 'Proxima Nova',
                        fontSize: 11,
                        bold: true,
                        italic: false
                    },
                    textPosition: 'out'
                },
                vAxis: {
                    minValue: 0,
                    textPosition: 'out',
                    textStyle: {
                        color: '#fff',
                        fontName: 'Proxima Nova',
                        fontSize: 11,
                        bold: true,
                        italic: false
                    },
                    baselineColor: '#16b4fc',
                    ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
                    gridlines: {
                        color: '#1ba0fc',
                        count: 15
                    }
                },
                lineWidth: 2,
                colors: ['#fff'],
                curveType: 'function',
                pointSize: 5,
                pointShapeType: 'circle',
                pointFillColor: '#f00',
                backgroundColor: {
                    fill: '#008ffb',
                    strokeWidth: 0,
                },
                chartArea:{
                    left:0,
                    top:0,
                    width:'100%',
                    height:'100%'
                },
                fontSize: 11,
                fontName: 'Proxima Nova',
                tooltip: {
                    trigger: 'selection',
                    isHtml: true
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(dataTable, options);
        }
        $(window).resize(function(){
            drawChart();
            setTimeout(function(){
            }, 1000);
        });
    });
</script>
<script src="{{asset('')}}Tasks/js/app.js"></script>
</body>

<!-- Mirrored from themesanytime.com/startui/demo/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Apr 2018 02:03:04 GMT -->
</html>