<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
  setInterval(function() {
    cache_clear()
  }, 300000);
});

function cache_clear() {
  window.location.reload(true);
  // window.location.reload(); use this if you do not remove cache
}
</script>
        <h2 class="page-title">Dashboard <small>Basic Stats</small></h2>

        <section class="widget">
                    <header>
                        <!--<h4>Visits<small>Based on a three months data</small></h4>!-->
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
                                        title: "Price Change (%)"
                                    },
                                    data: [{        
                                        type: "column",  
                                        showInLegend: true, 
                                        legendMarkerColor: "grey",
                                        //legendText: "MMbbl = one million barrels",
                                        dataPoints: [ 
                                            <?php $resp_btc = $this->requestAction('reports/graph_data/BTC'); ?>
                                            { y: <?php echo $resp_btc[0]->{'percent_change_24h'}; ?>, label: "<?php echo $resp_btc[0]->{'name'}; ?> (<?php echo $resp_btc[0]->{'symbol'}; ?>)" },
                                            <?php foreach($data as $data2){ 
                                                $trading_pair = $data2['RobotTradingCoin']['symbol'];
                                                $str_ln = strlen($trading_pair);
                                                $ticker_ln = $str_ln - 3;
                                                $symbol = substr( $trading_pair, 0,$ticker_ln);
                                                $resp1 = $this->requestAction('reports/graph_data/'.$symbol);
                                            ?>     
                                            { y: <?php echo $resp1[0]->{'percent_change_24h'}; ?>, label: "<?php echo $resp1[0]->{'name'}; ?> (<?php echo $resp1[0]->{'symbol'}; ?>)" },
                                            <?php } ?>
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
                            <div class="row" style="margin-left: 70px;">

                                <?php $btc = $this->requestAction('reports/graph_data/BTC'); ?>
                                <div class="col-sm-3 col-xs-6" style="width: 150px;">
                                    <div class="key"><i class="fa fa-users"></i> <?php echo $btc[0]->{'symbol'}; ?> Price</div>
                                    <div class="value">$<?php echo $btc[0]->{'price_usd'}; ?> <i class="<?php if($btc[0]->{'percent_change_24h'} >= 0){echo 'fa fa-caret-up color-green';}else{echo 'fa fa-caret-down color-red';} ?>"></i></div>
                                </div>

                                <?php foreach($data as $data3){ 
                                    $trading_pair = $data3['RobotTradingCoin']['symbol'];
                                    $str_ln = strlen($trading_pair);
                                    $ticker_ln = $str_ln - 3;
                                    $symbol = substr( $trading_pair, 0,$ticker_ln);

                                    $resp3 = $this->requestAction('reports/graph_data/'.$symbol);
                                ?>
                                <div class="col-sm-3 col-xs-6" style="width: 150px;">
                                    <div class="key"><i class="fa fa-users"></i> <?php echo $resp3[0]->{'symbol'}; ?> Price</div>
                                    <div class="value">$<?php echo $resp3[0]->{'price_usd'}; ?> <i class="<?php if($resp3[0]->{'percent_change_24h'} >= 0){echo 'fa fa-caret-up color-green';}else{echo 'fa fa-caret-down color-red';} ?>"></i></div>
                                </div>
                                <?php } ?>
                               
                            </div>
                        </div>
                    </div>
                </section>

        <div class="row">
            
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        <?php echo $total_trades; ?>
                    </div>
                    <div class="description">
                        <i class="fa fa-user"></i>
                        Total Trades
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        <?php echo $close_trades; ?>
                    </div>
                    <div class="description">
                        Closed trades
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        <?php echo $active_trades; ?>
                    </div>
                    <div class="description">
                        <i class="fa fa-comments"></i>
                        Active Trades
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        <?php echo $robots; ?>
                    </div>
                    <div class="description">
                        <i class="fa fa-comments"></i>
                        Robots
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        <?php echo round($profits[0][0]['tot_perc_profit'],2); ?>%
                    </div>
                    <div class="description">
                        <i class="fa fa-arrow-right"></i>
                        Percentage Profit
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
           
        <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        <?php echo round($profits[0][0]['tot_profit'],2); ?> BTC
                    </div>
                    <div class="description">
                        <i class="fa fa-arrow-right"></i>
                        Profit BTC
                    </div>
                </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        $<?php echo round($this->requestAction('/tradings/convertBTCToUSD/'.$profits[0][0]['tot_profit']),2); ?>
                    </div>
                    <div class="description">
                        <i class="fa fa-arrow-right"></i>
                        Profit USD
                    </div>
                </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="box">
                    <div class="big-text">
                        <?php echo $coins; ?>
                    </div>
                    <div class="description">
                        <i class="fa fa-comments"></i>
                        Trading Coins
                    </div>
                </div>
            </div>
       
        </div>

         <div style="clear: both;"></div>