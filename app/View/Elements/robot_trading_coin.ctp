<table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Symbol</th>
                                <th>Exchange</th>
                                <th>Trading Amount</th>
                                <th>Add profit</th>
                                <th>Profit BTC</th>
                                <th>Profit $</th>
                                <th>Status</th>
                                <th>Rebuy Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i = 1;
                            foreach($data as $data){ 
                                $usd = $this->requestAction('/tradings/convertBTCToUSD/'.$data['RobotTradingCoin']['profit']);
                                ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['RobotTradingCoin']['symbol'];  ?></td>
                                <td><?php echo $exch[$data['RobotTradingCoin']['exchange_id']];  ?></td>
                                <td><?php echo $data['RobotTradingCoin']['limit'];  ?> BTC</td>
                                <td><?php if($data['RobotTradingCoin']['add_profit'] == 1){echo 'YES';}else{echo 'NO';}  ?></td>
                                <td><strong class="<?php if($data['RobotTradingCoin']['profit'] >= 0){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo round($data['RobotTradingCoin']['profit'],8); ?> BTC</strong></td>
                                <td><strong class="<?php if($usd >= 0){echo 'color-green';}else{echo 'color-red';} ?>">$<?php echo round($usd,2); ?></strong></td>
                                <td><strong class="<?php if($data['RobotTradingCoin']['status'] == 4){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo $status[$data['RobotTradingCoin']['status']]; ?></strong></td>
                                <td><?php echo $data['RobotTradingCoin']['rebuy_point2']; ?></td>
                                <td>
                              
                                <div class="btn-group">
                                        <button class="btn btn-info btn-sm">Action</button>
                                        <button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?php echo $this->Html->link('<i class="fa fa-edit"></i> Edit',array('controller'=>'tradings','action'=>'edit_trading_coin',$data['RobotTradingCoin']['id']),array('escape'=>false,'title'=>'Edit')); ?></li>
                                            <?php if($data['RobotTradingCoin']['status'] == 4){ ?>
                                            <li><?php echo $this->Html->link('<i class="fa fa-thumbs-down"></i> Pause Buy',array('controller'=>'tradings','action'=>'update_trading_coin_status',$data['RobotTradingCoin']['id'],6),array('escape'=>false,'title'=>'Pause Buy','confirm'=>'Are you sure you want to pause buy for '.$data['RobotTradingCoin']['symbol'])); ?></li>
                                            <?php }else{ ?>
                                            <li><?php echo $this->Html->link('<i class="fa fa-thumbs-up"></i> Resume Buy',array('controller'=>'tradings','action'=>'update_trading_coin_status',$data['RobotTradingCoin']['id'],4),array('escape'=>false,'title'=>'Resume Buy','confirm'=>'Are you sure you want to resume buy '.$data['RobotTradingCoin']['symbol'])); ?></li>
                                            <?php } ?>
                                           <li> <?php echo $this->Html->link('<i class="fa fa-trash"></i> Delete',array('controller'=>'tradings','action'=>'delete_trading_coin',$data['RobotTradingCoin']['id']),array('escape'=>false,'title'=>'Delete','confirm'=>'Are you sure you want to delete '.$data['RobotTradingCoin']['symbol'])); ?></li>

                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            <?php $i++;} ?>
                            </tbody>
                        </table>