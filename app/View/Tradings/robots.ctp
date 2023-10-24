
<h2 class="page-title">Robots <!--<small>Statistics and more</small>!--></h2>
        <div class="row">
         

        <center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
		<section class="widget widget-tabs">
                    <div class="body tab-content">
                    <div class="form-group">
                        <div style="margin-left: 10px; margin-bottom: 10px;">
                         <?php echo $this->Html->link('<button class="btn btn-lg btn-info">Add New Robot</button>',array('controller'=>'tradings','action'=>'new_robot'),array('escape'=>false)); ?>
                         </div>
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
                                <th>Name</th>
                                <th>Exchange</th>
                                <th>API Key</th>
                                <th>Tot %</th>
                                <th>Tot Profit(BTC)</th>
                                <th>Tot Profit($)</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i = 1;
                            foreach($data as $data){ 
                                $key_ln = strlen($data['Robot']['api_key']) - 3;
                                $profits = $this->requestAction('/tradings/get_robot_profit/'.$data['Robot']['id']);
                                $usd = $this->requestAction('/tradings/convertBTCToUSD/'.$profits[0][0]['tot_profit']);
                                //print_r($usd);
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['Robot']['name'];  ?></td>
                                <td><?php echo $exch[$data['Robot']['exchange_id']];  ?></td>
                                <td><?php echo substr($data['Robot']['api_key'], 0,3).'*********'.substr($data['Robot']['api_key'], $key_ln,3); ?></td>
                                <td><strong class="<?php if($profits[0][0]['tot_perc_profit'] >= 0){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo round($profits[0][0]['tot_perc_profit'],2); ?> %</strong></td>
                                <td><strong class="<?php if($profits[0][0]['tot_profit'] >= 0){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo round($profits[0][0]['tot_profit'],8); ?> BTC</strong></td>
                                <td><strong class="<?php if($usd >= 0){echo 'color-green';}else{echo 'color-red';} ?>">$<?php echo round($usd,2); ?></strong></td>
                                <td><?php echo date('d M,Y',strtotime($data['Robot']['date_added'])) ?></td>
                                <td>
                                <div class="col-md-8 col-md-offset-2">
                                    <?php echo $this->Html->link('<i class="fa fa-edit"></i>',array('controller'=>'tradings','action'=>'edit_robot',$data['Robot']['id']),array('escape'=>false,'title'=>'Edit')); ?>

                                    <?php echo $this->Html->link('<i class="fa fa-trash"></i>',array('controller'=>'tradings','action'=>'delete_robot',$data['Robot']['id']),array('escape'=>false,'title'=>'Delete','confirm'=>'Are you sure you want to delete '.$data['Robot']['name'])); ?>

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


             