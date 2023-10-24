
<h2 class="page-title">Robots Trading Coins <!--<small>Statistics and more</small>!--></h2>
        <div class="row">
         

        <center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
		<section class="widget widget-tabs">
                    <div class="body tab-content">
                    <div class="form-group">
                        <div style="margin-left: 10px; margin-bottom: 10px;">
						<?php echo $this->Form->create('RobotTradingCoin',array('url'=>'/tradings/new_trading_coin','class'=>'form-horizontal form-label-left')); ?>						<div class="form-actions">
                          <table width="50%" border="0">
                            <tr>
                              <td>
                              <div class="form-group" style=" margin-right:50px;margin-top:-18px;"><?php echo $this->Form->input('exchange_id', array('label'=>'','class'=>'form-control','div'=>false,'options' => array(''=>'Select Exchange',$exch))); ?></div>
							  </td>
                              <td>
							  <div class="form-group">
                                    <?php  echo $this->Form->input('trading_pair_id',array('label'=>false,'class'=>'form-control input-transparent','div'=>false)); ?>
                                    </div>
                                </div>
							  </td>
                              <td>
							  
                                <div class="row" style=" margin-right:50px;margin-top:-18px;">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            
							  </td>
                            </tr>
                          </table>
						  </div>
						  </form>
						  
                         <?php //echo $this->Html->link('<button class="btn btn-lg btn-info">Add New Robot</button>',array('controller'=>'tradings','action'=>'new_robot'),array('escape'=>false)); ?>                         </div>
                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>My Robots</h4>
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
                                <th>Symbol</th>
                                <th>Exchange</th>
                                <th>Date Added</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i = 1;
                            foreach($data as $data){ ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['RobotTradingCoin']['symbol'];  ?></td>
                                <td><?php echo $exch[$data['RobotTradingCoin']['exchange_id']];  ?></td>
                                <td><?php echo date('d M,Y',strtotime($data['RobotTradingCoin']['date_added'])) ?></td>
                                <td>
                                <div class="col-md-8 col-md-offset-2">
                                   
                                    <?php echo $this->Html->link('<i class="fa fa-trash"></i>',array('controller'=>'tradings','action'=>'delete_trading_coin',$data['RobotTradingCoin']['id']),array('escape'=>false,'title'=>'Delete','confirm'=>'Are you sure you want to delete '.$data['RobotTradingCoin']['symbol'])); ?>

                                </div>
                            </td>
                            </tr>
                            <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
                       
                       
                    </div>
              </section>
			  
<?php
$this->Js->get('#RobotTradingCoinExchangeId')->event('change', 
$this->Js->request(array(
'controller'=>'tradings',
'action'=>'get_trading_pairs2'
), array(
'update'=>'#RobotTradingCoinTradingPairId',
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


             