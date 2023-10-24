<h2 class="page-title">Dashboard <small>Statistics and more</small></h2>
        <div class="row">
          <div class="col-lg-8">
                <section class="widget">
                    <header>
                        <h4>
                            Visits
                            <small>
                                Based on a three months data                            </small>                        </h4>
                        <div class="widget-controls">
                            <a title="Options" href="#"><i class="glyphicon glyphicon-cog"></i></a>
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="body no-margin">
                        <div id="visits-chart" class="chart visits-chart">
                            <script>
                                window.onload = function () {

                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                                    title:{
                                        text: "Coin vrs Price Change(24h)"
                                    },
                                    axisY: {
                                        title: "Price Change(%)"
                                    },
                                    data: [{        
                                        type: "column",  
                                        showInLegend: true, 
                                        legendMarkerColor: "grey",
                                        //legendText: "MMbbl = one million barrels",
                                        dataPoints: [      
                                            { y: <?php echo $percent_change_24h0; ?>, label: "<?php echo $coin_name0; ?> (<?php echo $symbol0; ?>)" },
                                            { y: <?php echo $percent_change_24h1; ?>,  label: "<?php echo $coin_name1; ?> (<?php echo $symbol1; ?>)" },
                                            { y: <?php echo $percent_change_24h2; ?>,  label: "<?php echo $coin_name2; ?> (<?php echo $symbol2; ?>)" },
                                            { y: <?php echo $percent_change_24h3; ?>,  label: "<?php echo $coin_name3; ?> (<?php echo $symbol3; ?>)" }
                                        ]
                                    }]
                                });
                                chart.render();

                                }
                            </script>

                           <div id="chartContainer" style="height: 220px; max-width: 920px; margin: 0px auto;"></div>
                            <?php echo $this->Html->script(array('canvasjs.min')); ?>
                        </div>
                        <div class="visits-info well well-sm">
                            <div class="row">
                                <div class="col-sm-3 col-xs-6">
                                    <div class="key"><i class="fa fa-users"></i> <?php echo $symbol0; ?> Price</div>
                                    <div class="value">$<?php echo $price_usd0; ?> <i class="<?php if($percent_change_24h0 >= 0){echo 'fa fa-caret-up color-green';}else{echo 'fa fa-caret-down color-red';} ?>"></i></div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="key"><i class="fa fa-bolt"></i> <?php echo $symbol1; ?> Price</div>
                                    <div class="value">$<?php echo $price_usd1; ?> <i class="<?php if($percent_change_24h1 >= 0){echo 'fa fa-caret-up color-green';}else{echo 'fa fa-caret-down color-red';} ?>"></i></div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="key"><i class="fa fa-plus-square"></i> <?php echo $symbol2; ?> Price</div>
                                    <div class="value">$<?php echo $price_usd2; ?> <i class="<?php if($percent_change_24h2 >= 0){echo 'fa fa-caret-up color-green';}else{echo 'fa fa-caret-down color-red';} ?>"></i></div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="key"><i class="fa fa-user"></i> <?php echo $symbol3; ?> Price</div>
                                    <div class="value">$<?php echo $price_usd3; ?> <i class="<?php if($percent_change_24h3 >= 0){echo 'fa fa-caret-up color-green';}else{echo 'fa fa-caret-down color-red';} ?>"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>
            <div class="col-lg-4">
              <section class="widget widget-tabs">
                    
                    <div class="body tab-content">
                        
                        <div id="dropdown1" class="tab-pane active clearfix">
                            <h5 class="tab-header"><i class="fa fa-comments"></i> Top Commenters</h5>
                            <ul class="news-list">
                                <li>
                                    <img src="img/13.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Frans Garey</a></div>
                                        <div class="comment">
                                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                                            sed quia                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <img src="img/1.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Finees Lund</a></div>
                                        <div class="comment">
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                            eu fugiat.                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <img src="img/14.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Jessica Johnsson</a></div>
                                        <div class="comment">
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt.                                        </div>
                                    </div>
                                </li>
								<li>
                                    <img src="img/14.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Jessica Johnsson</a></div>
                                        <div class="comment">
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt.                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
              </section>
            </div>
		
			
        </div>
		
		<section class="widget widget-tabs">
                    <header>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#buy" data-toggle="tab">Buying</a>                            </li>
                            <li>
                                <a href="#sell" data-toggle="tab">Selling</a>                            </li>
                        </ul>
                    </header>
                    <div class="body tab-content">
                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>
                            Traffic Sources
                            <small>
                                One month tracking                            </small>                        </h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="widget-table-overflow">
                        <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
                                <th class="source-col-header">Source</th>
                                <th>Amount</th>
                                <th>Change</th>
                                <th class="hidden-xs">Percent.,%</th>
                                <th>Target</th>
                                <th class="chart-col-header hidden-xs">Trend</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span class="label label-important">Direct</span></td>
                                <td>713</td>
                                <td><strong class="color-green">+53</strong></td>
                                <td class="hidden-xs">+12</td>
                                <td>900</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="direct-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-warning">Refer</span></td>
                                <td>562</td>
                                <td><strong>+84</strong></td>
                                <td class="hidden-xs">+64</td>
                                <td>500</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="refer-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-success">Social</span></td>
                                <td>148</td>
                                <td><strong class="color-red">-12</strong></td>
                                <td class="hidden-xs">+3</td>
                                <td>180</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="social-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-info">Search</span></td>
                                <td>653</td>
                                <td><strong class="color-green">+23</strong></td>
                                <td class="hidden-xs">+43</td>
                                <td>876</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="search-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-inverse">Internal</span></td>
                                <td>976</td>
                                <td><strong>+101</strong></td>
                                <td class="hidden-xs">-7</td>
                                <td>844</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="internal-trend"></div>                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
                        <div id="sell" class="tab-pane">
                            <section class="widget">
                    <header>
                        <h4>
                            Traffic Sources
                            <small>
                                One month tracking                            </small>                        </h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="widget-table-overflow">
                        <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
                                <th class="source-col-header">Source</th>
                                <th>Amount</th>
                                <th>Change</th>
                                <th class="hidden-xs">Percent.,%</th>
                                <th>Target</th>
                                <th class="chart-col-header hidden-xs">Trend</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span class="label label-important">Direct</span></td>
                                <td>713</td>
                                <td><strong class="color-green">+53</strong></td>
                                <td class="hidden-xs">+12</td>
                                <td>900</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="direct-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-warning">Refer</span></td>
                                <td>562</td>
                                <td><strong>+84</strong></td>
                                <td class="hidden-xs">+64</td>
                                <td>500</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="refer-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-success">Social</span></td>
                                <td>148</td>
                                <td><strong class="color-red">-12</strong></td>
                                <td class="hidden-xs">+3</td>
                                <td>180</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="social-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-info">Search</span></td>
                                <td>653</td>
                                <td><strong class="color-green">+23</strong></td>
                                <td class="hidden-xs">+43</td>
                                <td>876</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="search-trend"></div>                                </td>
                            </tr>
                            <tr>
                                <td><span class="label label-inverse">Internal</span></td>
                                <td>976</td>
                                <td><strong>+101</strong></td>
                                <td class="hidden-xs">-7</td>
                                <td>844</td>
                                <td class="chart-cell hidden-xs">
                                    <div id="internal-trend"></div>                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
                       
                    </div>
              </section>