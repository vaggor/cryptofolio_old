        <h2 class="page-title">Dashboard <small>Basic Stats</small></h2>
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