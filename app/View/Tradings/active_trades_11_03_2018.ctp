        <style type="text/css">
		.sorting_1{
			margin-right:-0px;
		}
		</style>
		<?php $usd = $this->requestAction('/tradings/convertBTCToUSD/'.$pnl[0][0]['tot_profit']); ?>
		<h2 class="page-title">Trades <small><?php echo $page; ?></small></h2>
        <section class="widget">
            <div class="body">			
			<table width="100%" border="0">
			  <tr>
				<td width="850"> <div style="margin-left: 10px; margin-bottom: 10px;">
                         <?php echo $this->Html->link('<button class="btn btn-lg btn-info">New Trade</button>',array('controller'=>'tradings','action'=>'buy'),array('escape'=>false)); ?>
                         </div></td>
				<td><span class="fw-semi-bold">Today's Profit:</span></td>
				<td><span class="label <?php if($pnl[0][0]['tot_profit']>0){echo 'label-success';}else{echo 'label-danger';} ?>"><strong><?php echo round($pnl[0][0]['tot_profit'],8); ?> BTC <br> $<?php echo round($usd,2); ?> <br> <?php echo round($pnl[0][0]['tot_perc_profit'],2); ?>%</strong></span></td>
			  </tr>
			</table>

            </div>
        </section>
		<center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
        <section class="widget">
            <header>
                <!--<h4>Table <span class="fw-semi-bold">Styles</span></h4>
                <div class="widget-controls">
                    <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                    <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                </div>
            </header>
            <div class="body">
                <p>
                    Column sorting, live search, pagination. Built with
                    <a href="http://www.datatables.net/" target="_blank">jQuery DataTables</a>
                </p>!-->
                <div class="mt">
                    <table id="datatable-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Exchange</th>
							<th>Symbol</th>
                            <th class="no-sort hidden-xs">Price(BTC)</th>
							<th class="hidden-xs">Quantity</th>
                            <th class="hidden-xs">Date</th>
							<th class="hidden-xs">% Profit</th>
							<th class="hidden-xs">Profit</th>
							<th class="hidden-xs">Status</th>
							<th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 1;
                            foreach($data as $data){ 
                            ?>
                            <tr>
                            <td width='10'><?php echo $i; ?></td>
                            <td><span class="fw-semi-bold"><?php echo $lexch[$data['RobotTrade']['exchange_id']];  ?></span></td>
							<td><span class="fw-semi-bold"><?php echo $data['RobotTrade']['symbol'];  ?></span></td>
                            <td class="hidden-xs">
                                <small>
                                    <span class="fw-semi-bold">Buy:</span>
                                    &nbsp; <?php echo $data['RobotTrade']['buy_price'];  ?>
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Sell:</span>
                                    &nbsp; <?php echo $data['RobotTrade']['sell_price']  ?>
                                </small>
                            </td>
                            <td class="hidden-xs"><a href="#"><?php echo $data['RobotTrade']['buy_qty'];  ?></a></td>
                            <td class="hidden-xs">
							<small>
                                    <span class="fw-semi-bold">Buy:</span>
                                    &nbsp; <?php echo date('d M,Y H:i',strtotime($data['RobotTrade']['buy_time'])) ?>
                                </small>
                                <br>
                                <small>
                                    <span class="fw-semi-bold">Sell:</span>
                                    &nbsp; <?php if($data['RobotTrade']['status'] == 5){echo date('d M,Y H:i',strtotime($data['RobotTrade']['sell_time']));} ?>
                                </small>
							</td>
							<td><strong class="<?php if($data['RobotTrade']['perc_profit'] >= 0){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo round($data['RobotTrade']['perc_profit'],2);  ?>%</strong></td>
							
							<td><strong class="<?php if($data['RobotTrade']['profit'] >= 0){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo $data['RobotTrade']['profit'];  ?></strong></td>
							
                                <td><span class="label <?php if($data['RobotTrade']['status'] == 5){echo 'label-success';}else{echo 'label-warning';} ?>"><?php echo $status[$data['RobotTrade']['status']]; ?></span></td>
                            
							<td>
                                <?php if($data['RobotTrade']['status'] == 4 or $data['RobotTrade']['status'] == 6){ ?>

                                <div class="btn-group">
                                        <button class="btn btn-info btn-sm">Action</button>
                                        <button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?php echo $this->Html->link('<i class="fa fa-usd"></i> Sell',array('controller'=>'tradings','action'=>'sell',$data['RobotTrade']['id']),array('escape'=>false,'title'=>'Sell')); ?></li>
                                            <?php if($data['RobotTrade']['status'] == 4){ ?>
                                            <li><?php echo $this->Html->link('<i class="fa fa-thumbs-down"></i> Pause Trade',array('controller'=>'tradings','action'=>'update_trading_status',$data['RobotTrade']['id'],6),array('escape'=>false,'title'=>'Pause Buy','confirm'=>'Are you sure you want to pause buy for '.$data['RobotTrade']['symbol'])); ?></li>
                                            <?php }else{ ?>
                                            <li><?php echo $this->Html->link('<i class="fa fa-thumbs-up"></i> Resume Trade',array('controller'=>'tradings','action'=>'update_trading_status',$data['RobotTrade']['id'],4),array('escape'=>false,'title'=>'Resume Buy','confirm'=>'Are you sure you want to resume buy '.$data['RobotTrade']['symbol'])); ?></li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                            <?php $i++;} ?>
                       
                        </tbody>
                    </table>
                </div>
            