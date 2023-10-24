<div class="row">
  <div class="col-md-7">
  				<center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
                <section class="widget">
                    <header>
                        <h4><i class="fa fa-user"></i> Buy <small>Make new market order</small></h4>
                    </header>
                    <div class="body">
                       <!-- <form id="user-form" class="form-horizontal form-label-left" novalidate="novalidate" method="post" data-parsley-priority-enabled="false" data-parsley-excluded="input[name=gender]">!-->
					   <?php echo $this->Form->create('RobotTrade',array('url'=>'/tradings/buy','class'=>'form-horizontal form-label-left')); ?>
                          <?php echo $this->element('forms/buy_form'); ?>
                           
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
  </div>
            </div>

<?php
$this->Js->get('#RobotTradeExchangeId')->event('change', 
$this->Js->request(array(
'controller'=>'tradings',
'action'=>'get_trading_pairs'
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