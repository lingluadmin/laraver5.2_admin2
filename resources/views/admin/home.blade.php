@extends('layouts.admin-app')

@section('content')


    <link href="/templateDemo/css/style.default.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/templateDemo/js/html5shiv.js"></script>
    <script src="/templateDemo/js/respond.min.js"></script>
    <![endif]-->

    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="contentpanel">

        <div class="row">

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-success panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-user.png" alt="">
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">Visits Today</small>
                                    <h1>900k+</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Pages / Visit</small>
                                    <h4>7.80</h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label">% New Visits</small>
                                    <h4>76.43%</h4>
                                </div>
                            </div><!-- row -->
                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-danger panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-document.png" alt="">
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">% Unique Visitors</small>
                                    <h1>54.40%</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <small class="stat-label">Avg. Visit Duration</small>
                            <h4>01:80:22</h4>

                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-primary panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-document.png" alt="">
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">Page Views</small>
                                    <h1>300k+</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <small class="stat-label">% Bounce Rate</small>
                            <h4>34.23%</h4>

                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-dark panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-money.png" alt="">
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">Today's Earnings</small>
                                    <h1>$655</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4>$32,322</h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label">Last Month</small>
                                    <h4>$503,000</h4>
                                </div>
                            </div><!-- row -->

                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->
        </div><!-- row -->

        <div class="row">
            <div class="col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5 class="subtitle mb5">Network Performance</h5>
                                <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
                                <div id="basicflot" style="width: 100%; height: 300px; margin-bottom: 20px; padding: 0px; position: relative;"><canvas class="flot-base" width="783" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 783px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 29px; text-align: center;">0.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 90px; text-align: center;">0.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 151px; text-align: center;">1.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 212px; text-align: center;">1.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 274px; text-align: center;">2.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 335px; text-align: center;">2.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 396px; text-align: center;">3.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 457px; text-align: center;">3.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 519px; text-align: center;">4.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 580px; text-align: center;">4.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 641px; text-align: center;">5.0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 702px; text-align: center;">5.5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 60px; top: 278px; left: 764px; text-align: center;">6.0</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 258px; left: 9px; text-align: right;">0.0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 215px; left: 9px; text-align: right;">2.5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 172px; left: 9px; text-align: right;">5.0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 129px; left: 9px; text-align: right;">7.5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 86px; left: 1px; text-align: right;">10.0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 43px; left: 1px; text-align: right;">12.5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">15.0</div></div></div><canvas class="flot-overlay" width="783" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 783px; height: 300px;"></canvas><div class="legend"><div style="position: absolute; width: 79px; height: 42px; top: 16px; left: 43px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:16px;left:43px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #1CAF9A;overflow:hidden"></div></div></td><td class="legendLabel">Uploads</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #428BCA;overflow:hidden"></div></div></td><td class="legendLabel">Downloads</td></tr></tbody></table></div></div>
                            </div><!-- col-sm-8 -->
                            <div class="col-sm-4">
                                <h5 class="subtitle mb5">Server Status</h5>
                                <p class="mb15">Summary of the status of your server.</p>

                                <span class="sublabel">CPU Usage (40.05 - 32 cpus)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-primary"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Memory Usage (32.2%)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 32%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Disk Usage (82.2%)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 82%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Databases (63/100)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 63%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Domains (2/10)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Email Account (13/50)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 26%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->


                            </div><!-- col-sm-4 -->
                        </div><!-- row -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-9 -->

            <div class="col-sm-4 col-md-3">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5 class="subtitle mb5">Most Browser Used</h5>
                        <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
                        <div id="donut-chart2" class="ex-donut-chart"><svg height="298" version="1.1" width="355" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#d9534f" d="M177.5,241.66666666666669A92.66666666666667,92.66666666666667,0,0,0,266.37408880024736,122.76057449110473" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#d9534f" stroke="#ffffff" d="M177.5,244.66666666666669A95.66666666666667,95.66666666666667,0,0,0,269.2513075024136,121.91109668685993L310.811133200371,109.64086173665711A139,139,0,0,1,177.5,288Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#1caf9a" d="M266.37408880024736,122.76057449110473A92.66666666666667,92.66666666666667,0,0,0,180.01424746463798,56.36744810382436" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#1caf9a" stroke="#ffffff" d="M269.2513075024136,121.91109668685993A95.66666666666667,95.66666666666667,0,0,0,180.0956439652917,53.36855253884026L181.13571036253407,15.049331430710055A134,134,0,0,1,306.0157686967605,111.05665807706512Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#428bca" d="M180.01424746463798,56.36744810382436A92.66666666666667,92.66666666666667,0,0,0,90.18010207193754,117.97828926471227" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#428bca" stroke="#ffffff" d="M180.0956439652917,53.36855253884026A95.66666666666667,95.66666666666667,0,0,0,87.35319890160459,116.97398927687922L51.23165839179458,104.1412672101235A134,134,0,0,1,181.13571036253407,15.049331430710055Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#5bc0de" d="M90.18010207193754,117.97828926471227A92.66666666666667,92.66666666666667,0,0,0,121.00865194019462,222.4563728038421" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#5bc0de" stroke="#ffffff" d="M87.35319890160459,116.97398927687922A95.66666666666667,95.66666666666667,0,0,0,119.17979534833043,224.8344568154773L95.81107223006562,255.2210858530379A134,134,0,0,1,51.23165839179458,104.1412672101235Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#428bca" d="M121.00865194019462,222.4563728038421A92.66666666666667,92.66666666666667,0,0,0,177.4708879085557,241.66666209375" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#428bca" stroke="#ffffff" d="M119.17979534833043,224.8344568154773A95.66666666666667,95.66666666666667,0,0,0,177.46994543077514,244.66666194570593L177.4579026591345,282.9999933873651A134,134,0,0,1,95.81107223006562,255.2210858530379Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="177.5" y="139" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: 800; font-stretch: normal; font-size: 15px; line-height: normal; font-family: Arial;" font-size="15px" font-weight="800" transform="matrix(2.7255,0,0,2.7255,-306.261,-254.5098)" stroke-width="0.3669064748201439"><tspan dy="5.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Chrome</tspan></text><text x="177.5" y="159" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 14px; line-height: normal; font-family: Arial;" font-size="14px" transform="matrix(1.9306,0,0,1.9306,-165.1591,-140.5139)" stroke-width="0.5179856115107914"><tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30</tspan></text></svg></div>
                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-3 -->

        </div><!-- row -->

        <div class="row">

            <div class="col-sm-7">

                <div class="table-responsive">
                    <table class="table table-bordered mb30">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->

            </div><!-- col-sm-7 -->

            <div class="col-sm-5">

                <div class="panel panel-success">
                    <div class="panel-heading padding5">
                        <div id="line-chart" class="ex-line-chart" style="position: relative;"><svg height="248" version="1.1" width="662" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.328125px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="37.265625" y="206" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><text x="37.265625" y="160.75" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">17.5</tspan></text><text x="37.265625" y="115.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">35</tspan></text><text x="37.265625" y="70.25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">52.5</tspan></text><text x="37.265625" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">70</tspan></text><text x="637" y="218.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><text x="539.1722743610223" y="218.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="441.3445487220447" y="218.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><text x="343.5168230830671" y="218.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text><text x="245.42107627795525" y="218.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2008</tspan></text><text x="147.59335063897763" y="218.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007</tspan></text><text x="49.765625" y="218.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2006</tspan></text><path fill="none" stroke="#fdd2a4" d="M49.765625,206L147.59335063897763,141.35714285714283L245.42107627795525,128.42857142857144L343.5168230830671,154.28571428571428L441.3445487220447,115.5L539.1722743610223,76.7142857142857L637,63.78571428571428" stroke-width="2px" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#ffffff" d="M49.765625,76.7142857142857L147.59335063897763,50.85714285714286L245.42107627795525,89.64285714285714L343.5168230830671,102.57142857142857L441.3445487220447,76.7142857142857L539.1722743610223,50.85714285714286L637,37.928571428571416" stroke-width="2px" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="49.765625" cy="206" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="147.59335063897763" cy="141.35714285714283" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="245.42107627795525" cy="128.42857142857144" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="343.5168230830671" cy="154.28571428571428" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="441.3445487220447" cy="115.5" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="539.1722743610223" cy="76.7142857142857" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="637" cy="63.78571428571428" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="49.765625" cy="76.7142857142857" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="147.59335063897763" cy="50.85714285714286" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="245.42107627795525" cy="89.64285714285714" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="343.5168230830671" cy="102.57142857142857" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="441.3445487220447" cy="76.7142857142857" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="539.1722743610223" cy="50.85714285714286" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="637" cy="37.928571428571416" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg></div>
                    </div>
                    <div class="panel-body">
                        <div class="tinystat pull-left">
                            <div id="sparkline" class="chart mt5"><canvas width="59" height="30" style="display: inline-block; width: 59px; height: 30px; vertical-align: top;"></canvas></div>
                            <div class="datainfo">
                                <span class="text-muted">Average Sales</span>
                                <h4>$630,201</h4>
                            </div>
                        </div><!-- tinystat -->
                        <div class="tinystat pull-right">
                            <div id="sparkline2" class="chart mt5"><canvas width="59" height="30" style="display: inline-block; width: 59px; height: 30px; vertical-align: top;"></canvas></div>
                            <div class="datainfo">
                                <span class="text-muted">Total Sales</span>
                                <h4>$139,201</h4>
                            </div>
                        </div><!-- tinystat -->
                    </div>
                </div><!-- panel -->

            </div><!-- col-sm-6 -->
        </div><!-- row -->

        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default widget-photoday">
                    <div class="panel-body">
                        <a href="" class="photoday"><img src="/templateDemo/images/photos/photo1.png" alt=""></a>
                        <div class="photo-details">
                            <h4 class="photo-title">Strawhat In The Beach</h4>
                            <small class="text-muted"><i class="fa fa-map-marker"></i> San Franciso, California, USA</small>
                            <small>By: <a href="">ThemePixels</a></small>
                        </div><!-- photo-details -->
                        <ul class="photo-meta">
                            <li><span><i class="fa fa-eye"></i> 32,102</span></li>
                            <li><a href="#"><i class="fa fa-heart"></i> 1,003</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 52</a></li>
                        </ul>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default panel-alt widget-messaging">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-edit"><i class="fa fa-edit"></i></a>
                        </div><!-- panel-btns -->
                        <h3 class="panel-title">Messaging</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li>
                                <small class="pull-right">Dec 10</small>
                                <h4 class="sender">Jennier Lawrence</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 9</small>
                                <h4 class="sender">Marsha Mellow</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 9</small>
                                <h4 class="sender">Holly Golightly</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 10</small>
                                <h4 class="sender">Jennier Lawrence</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 9</small>
                                <h4 class="sender">Marsha Mellow</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                        </ul>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-4">
                <div class="panel panel-dark panel-alt widget-quick-status-post">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div><!-- panel-btns -->
                        <h3 class="panel-title">Quick Status Post</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#post-status" data-toggle="tab"><i class="fa fa-pencil"></i> <strong>Status</strong></a></li>
                            <li><a href="#post-photo" data-toggle="tab"><i class="fa fa-picture-o"></i> <strong>Photo</strong></a></li>
                            <li><a href="#post-checkin" data-toggle="tab"><i class="fa fa-map-marker"></i> <strong>Check-In</strong></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="post-status" class="tab-pane active">
                                <input type="text" class="form-control" placeholder="What's your status?">
                            </div>
                            <div id="post-photo" class="tab-pane">
                                <input type="text" class="form-control" placeholder="Choose photo">
                            </div>
                            <div id="post-checkin" class="tab-pane">
                                <input type="text" class="form-control" placeholder="Search location">
                            </div>
                            <button class="btn btn-primary btn-block mt10">Submit Post</button>
                        </div><!-- tab-content -->

                    </div><!-- panel-body -->
                </div><!-- panel -->

                <div class="mb20"></div>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-warning panel-alt widget-today">
                            <div class="panel-heading text-center">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <div class="panel-body text-center">
                                <h3 class="today">Fri, Dec 13</h3>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>

                    <div class="col-xs-6">
                        <div class="panel panel-danger panel-alt widget-time">
                            <div class="panel-heading text-center">
                                <i class="glyphicon glyphicon-time"></i>
                            </div>
                            <div class="panel-body text-center">
                                <h3 class="today">4:50AM PST</h3>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                </div>
            </div><!-- col-sm-6 -->

        </div>

    </div>


    <script src="/templateDemo/js/jquery-1.11.1.min.js"></script>
    <script src="/templateDemo/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/templateDemo/js/jquery-ui-1.10.3.min.js"></script>
    <script src="/templateDemo/js/bootstrap.min.js"></script>
    <script src="/templateDemo/js/modernizr.min.js"></script>
    <script src="/templateDemo/js/jquery.sparkline.min.js"></script>
    <script src="/templateDemo/js/toggles.min.js"></script>
    <script src="/templateDemo/js/retina.min.js"></script>
    <script src="/templateDemo/js/jquery.cookies.js"></script>

    <script src="/templateDemo/js/flot/jquery.flot.min.js"></script>
    <script src="/templateDemo/js/flot/jquery.flot.resize.min.js"></script>
    <script src="/templateDemo/js/flot/jquery.flot.spline.min.js"></script>
    <script src="/templateDemo/js/morris.min.js"></script>
    <script src="/templateDemo/js/raphael-2.1.0.min.js"></script>


    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-55586762-1', 'auto');
        ga('send', 'pageview');

    </script>

@endsection
