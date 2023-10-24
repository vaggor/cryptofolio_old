
<h2 class="page-title">Trades <small><?php echo $page; ?></small></h2>
        <div class="row">
         

        <section class="widget widget-tabs">
                    <div class="body tab-content">
                    <div class="form-group">
                        <div style="margin-left: 10px; margin-bottom: 10px;">
                         <?php //echo $this->Html->link('<button class="btn btn-lg btn-info">New Trade</button>',array('controller'=>'tradings','action'=>'buy'),array('escape'=>false)); ?>
                      </div>
                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>My Trades</h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        
                        </div>
                    </header>
                    <div class="widget-table-overflow">
                        <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Month</th>
                                <th>Trading Vol</th>
                                <th>Trading Amount</th>
                                <th>Profit (BTC)</th>
                                <th>Profit (USD)</th>
                                <th>% Profit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i = 1;
                            $tot_vol = 0;
                            $tot_amount = 0;
                            $tot_profit = 0;
                            $tot_usd = 0;
                            $tot_percentage = 0;
                            foreach($period as $dt){ 
                                $data = $this->requestAction('/reports/get_monthly_report_data/'.$dt);
                                $tot_vol = $tot_vol + $data[0][0]['volume'];
                                $tot_amount = $tot_amount + $data[0][0]['amount'];
                                $tot_profit = $tot_profit + $data[0][0]['profit'];
                                $tot_percentage = $tot_percentage + $data[0][0]['percentage'];
                                //print_r($data);exit;
                            ?>
                            <?php if(!empty($data[0][0]['profit'])){ 
                                $usd = $this->requestAction('/tradings/convertBTCToUSD/'.$data[0][0]['profit']);
                                $tot_usd = $tot_usd + $usd;
                                ?>
                            
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo date('M,Y',strtotime($dt)); ?></td>
                                <td><?php echo $data[0][0]['volume'];  ?></td>
                                <td><i class="fa fa-btc"></i> <?php echo round($data[0][0]['amount'],8);  ?></td>
                                <td><i class="fa fa-btc"></i> <?php echo round($data[0][0]['profit'],8);  ?></td>
                                <td>$<?php echo round($usd,2);  ?></td>
                               <td><?php echo round($data[0][0]['percentage'],2);  ?>%</td>
                            </tr>
                            <?php $i++;}} ?>
                            <tr>
                              <td colspan="2"><strong>Total</strong></td>
                              <td><strong><?php echo $tot_vol; ?></strong></td>
                              <td><strong><i class="fa fa-btc"></i> <?php echo round($tot_amount,8); ?></strong></td>
                              <td><strong><i class="fa fa-btc"></i> <?php echo round($tot_profit,8); ?></strong></td>
                              <td><strong>$<?php echo round($tot_usd,2); ?></strong></td>
                              <td><strong><?php echo round($tot_percentage,2); ?>%</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
                       
                       
                    </div>
              </section>


             