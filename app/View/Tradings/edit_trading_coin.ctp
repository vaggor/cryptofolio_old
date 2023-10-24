
<style type="text/css">
    /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<h2 class="page-title">Robots Trading Coins <!--<small>Statistics and more</small>!--></h2>
        <div class="row">
         

        <center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
		<section class="widget widget-tabs">
                    <div class="body tab-content">
                    <div class="form-group">
                        <div style="margin-left: 10px; margin-bottom: 10px;">
						<?php echo $this->Form->create('RobotTradingCoin',array('url'=>'/tradings/edit_trading_coin','class'=>'form-horizontal form-label-left'));
                echo $this->Form->input('id',array('type'=>'hidden'));
             ?>						<div class="form-actions">
                          <?php echo $this->element('forms/robot_trading_coin_form'); ?>
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
                        <?php echo $this->element('robot_trading_coin'); ?>
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


             