<center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>

<h2 class="page-title">Settings <small>Coin Management</small></h2>
        <section class="widget widget-tabs">
                    
					<div class="row margin-bottom" style=" margin-left:-80px; text-align:left;width:400px;">
                                <div class="col-md-8 col-md-offset-2">
									<?php echo $this->Html->link('<button class="btn btn-lg btn-success btn-block">New Coin</button>',array('controller'=>'settings','action'=>'new_coin'),array('escape'=>false)); ?>
                                </div>
                     </div>
					
                    <div class="body tab-content">
                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>Available Coins: <?php echo $total_coin; ?></h4>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Symbol</th>
                                <th>Date Added</th>
                                <th>Date Modified</th>
								<th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php 
                            $i = 1;
                            foreach($data as $data){ ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $this->Html->image('coins/'.$data['Coin']['image'],array('width'=>20,'height'=>20)); ?></td>
                                <td><?php echo $data['Coin']['name']; ?></td>
                                <td><strong class="color-green"><?php echo $data['Coin']['symbol']; ?></strong></td>
                                <td class="hidden-xs"><?php if(!empty($data['Coin']['date_added'])){ echo date('d M Y',strtotime($data['Coin']['date_added']));} ?></td>
                                <td><?php if(!empty($data['Coin']['date_modified'])){ echo date('d M Y',strtotime($data['Coin']['date_modified']));} ?></td>
								<td>
								<div class="col-xs-4">
                                    
									<?php echo $this->Html->link('<button class="btn btn-info">Edit</button>',array('controller'=>'settings','action'=>'edit_coin',$data['Coin']['id']),array('escape'=>false)); ?>
                                </div>
								</td>
                            </tr>
                            <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                Total Coins: <?php echo $total_coin; ?>
                        </div>
          </div>
        </section>