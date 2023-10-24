

<h2 class="page-title">Report <!--<small>Statistics and more</small>!--></h2>
        <div class="row">
         

    <section class="widget widget-tabs">
                    <div class="body tab-content">
                    <div class="form-group">
                        <div style="margin-left: 10px; margin-bottom: 10px;">
                          <?php echo $this->Form->create('RobotTrade',array('url'=>'/reports/index','class'=>'form-horizontal form-label-left')); ?>            
                        <div class="form-actions">

                          <table width="90%" border="0">
                            <tr>

                              <td>
                                <div class="form-group" style="margin-right: 50px;margin-top: 15px;">
                                  <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <!--<input class="form-control" size="16" type="text" value="" placeholder="From" readonly>!-->
                                    <?php  echo $this->Form->input('date_from',array('label'=>false,'class'=>'form-control','placeholder'=>'Form','size'=>1,'div'=>false,'readonly')); ?>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                                  </div>
                                    <input type="hidden" id="dtp_input2" value="" /><br/>
                                </div>                              </td>

                              <td>
                                <div class="form-group" style="margin-right: 50px;margin-top: 15px;">
                                  <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
                                    <!--<input class="form-control" size="16" type="text" value="" placeholder="From" readonly>!-->
                                    <?php  echo $this->Form->input('date_to',array('label'=>false,'class'=>'form-control','placeholder'=>'To','size'=>1,'div'=>false,'readonly')); ?>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                                  </div>
                                    <input type="hidden" id="dtp_input2" value="" /><br/>
                                </div>                              </td>

                <td>
                              <div class="form-group" style=" margin-right:0px;margin-top:-18px;width: 160px">
                              <?php echo $this->Form->input('robot_id', array('label'=>'','class'=>'form-control','div'=>false,'options' => array(''=>'Select Robot',$robot))); ?>
                              </div>                
                              </td>
                </tr>
                            <tr>
                              <td>
                              <div class="form-group" style=" margin-right:-50px;margin-top:-18px;width: 190px">
                              <?php echo $this->Form->input('exchange_id', array('label'=>'','class'=>'form-control','div'=>false,'options' => array(''=>'Select Exchange',$exch))); ?>
                              </div>
                              </td>
                              <td><div class="form-group" style=" margin-right:-50px;margin-top:0px;width: 190px">
                                <?php  echo $this->Form->input('trading_pair_id',array('label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                              </div></td>
                              <td><div class="row" style=" margin-left:-120px;margin-top:-18px;">
                                <div class="col-sm-8 col-sm-offset-4">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </div></td>
                            </tr>
                          </table>
              </div>
              </form>
              
                         <?php //echo $this->Html->link('<button class="btn btn-lg btn-info">Add New Robot</button>',array('controller'=>'tradings','action'=>'new_robot'),array('escape'=>false)); ?>                         </div>

                         <?php if(!empty($data)){ ?>
                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>My Daily Report</h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="widget-table-overflow">
                       <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Exchange</th>
                                <th>Robot</th>
                                <th>Symbol</th>
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
                            foreach($data as $data){ 
                                //$get_monthly_report_data_url = '/reports/get_monthly_report_data/'.date('Y-m-d',strtotime($data['robot_trades']['sell_time']));
                                //print_r($data);exit;
                                //$stats = $this->requestAction($get_monthly_report_data_url);
                                $tot_vol = $tot_vol + $data['robot_trades']['sell_qty'];
                                $tot_amount = $tot_amount + $data['robot_trades']['sell_price'];
                                $tot_profit = $tot_profit + $data['robot_trades']['profit'];
                                $tot_percentage = $tot_percentage + $data['robot_trades']['perc_profit'];
                                //print_r($data);exit;
                            ?>
                            <?php if(!empty($data['robot_trades']['profit'])){ 
                                $usd = $this->requestAction('/tradings/convertBTCToUSD/'.$data['robot_trades']['profit']);
                                $tot_usd = $tot_usd + $usd;
                                ?>
                            
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo date('d M,Y',strtotime($data['robot_trades']['last_updated'])); ?></td>
                                <td><?php echo $exch[$data['robot_trades']['exchange_id']];  ?></td>
                                <td><?php echo $robot[$data['robot_trades']['robot_id']];  ?></td>
                                <td><?php echo $data['robot_trades']['symbol'];  ?></td>
                                <td><?php echo $data['robot_trades']['sell_qty'];  ?></td>
                                <td><i class="fa fa-btc"></i> <?php echo round($data['robot_trades']['sell_price'],8);  ?></td>
                                <td><i class="fa fa-btc"></i> <?php echo round($data['robot_trades']['profit'],8);  ?></td>
                                <td>$<?php echo round($usd,2);  ?></td>
                               <td><?php echo round($data['robot_trades']['perc_profit'],2);  ?>%</td>
                            </tr>
                            <?php $i++;}} ?>
                            <tr>
                              <td colspan="5"><strong>Total</strong></td>
                              <td><strong><?php echo $tot_vol; ?></strong></td>
                              <td><strong><i class="fa fa-btc"> </i> <?php echo $tot_amount; ?></strong></td>
                              <td><strong><i class="fa fa-btc"> </i> <?php echo round($tot_profit,8); ?></strong></td>
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
              <?php } ?>
        
<?php
$this->Js->get('#RobotTradeExchangeId')->event('change', 
$this->Js->request(array(
'controller'=>'reports',
'action'=>'get_trading_pairs2'
), array(
'update'=>'#RobotTradeTradingPairId',
'async' => true,
'method' => 'post',
'dataExpression'=>true,
'data'=> $this->Js->serializeForm(array(
'isForm' => true,
'inline' => true
))
))
);
?>


             