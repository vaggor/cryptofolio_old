<h2 class="page-title">User Management <small></small></h2>
		
		<div class="row margin-bottom" style=" margin-left:-80px; text-align:left;width:400px;">
                                <div class="col-md-8 col-md-offset-2">
									<?php echo $this->Html->link('<button class="btn btn-lg btn-success btn-block">New Admin Account</button>',array('controller'=>'users','action'=>'new_user'),array('escape'=>false)); ?>
                                </div>
                            </div>
        <section class="widget widget-tabs">
                    <header>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#verified" data-toggle="tab">Verified Users</a></li>
                            <li><a href="#unverified" data-toggle="tab">Unverified Users</a></li>
							<li><a href="#disabled" data-toggle="tab">Disabled Users</a></li>
							<li><a href="#all" data-toggle="tab">All Users</a></li>
                        </ul>
                    </header>
                    <div class="verified tab-content">
                        <div id="verified" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>
                            Verified Users <small></small>                        </h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="widget-table-overflow">
                        <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
								<th>Id</th>
                                <th class="source-col-header">Status</th>
                                <th>Full Name</th>
                                <th class="hidden-xs">Email Address</th>
                                <th>Usergroup</th>
                                <th class="chart-col-header hidden-xs">Date Added</th>
								<th></th>
                            </tr>
                            </thead>
                            <tbody>
							<?php 
							$i = 1;
							foreach($verified as $verified){ 
							if($verified['User']['status_id']==1){$class='label-success';}else{$class='label-important';}
							?>
                            <tr>
								<td><?php echo $i; ?></td>
                                <td><span class="label <?php echo $class; ?>"><?php echo $statuses[$verified['User']['status_id']]; ?></span></td>
                                <td><?php echo $verified['User']['name']; ?></td>
                                <td class="hidden-xs"><?php echo $verified['User']['email']; ?></td>
                                <td><?php echo $ugs[$verified['User']['usergroup_id']]; ?></td>
                                <td class="chart-cell hidden-xs"><?php if(!empty($verified['User']['date_added'])){ echo date('d M,Y',strtotime($verified['User']['date_added']));} ?></td>
								<td></td>
                            </tr>
                            <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
                        <div id="unverified" class="tab-pane">
                            <section class="widget">
                    <header>
                        <h4>
                            Unverified Users <small>                            </small>                        </h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="widget-table-overflow">
                        <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
								<th>Id</th>
                                <th class="source-col-header">Status</th>
                                <th>Full Name</th>
                                <th class="hidden-xs">Email Address</th>
                                <th>Usergroup</th>
                                <th class="chart-col-header hidden-xs">Date Added</th>
								<th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
							$i = 1;
							foreach($unverified as $unverified){ 
							if($unverified['User']['status_id']==1){$class='label-success';}else{$class='label-important';}
							?>
                            <tr>
								<td><?php echo $i; ?></td>
                                <td><span class="label <?php echo $class; ?>"><?php echo $statuses[$unverified['User']['status_id']]; ?></span></td>
                                <td><?php echo $unverified['User']['name']; ?></td>
                                <td class="hidden-xs"><?php echo $unverified['User']['email']; ?></td>
                                <td><?php echo $ugs[$unverified['User']['usergroup_id']]; ?></td>
                                <td class="chart-cell hidden-xs"><?php if(!empty($unverified['User']['date_added'])){ echo date('d M,Y',strtotime($unverified['User']['date_added']));} ?></td>
								<th></th>
                            </tr>
                            <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
						
						<div id="disabled" class="tab-pane">
                            <section class="widget">
                    <header>
                        <h4>
                            Disabled Users <small>                            </small>                        </h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="widget-table-overflow">
                        <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
								<th>Id</th>
                                <th class="source-col-header">Status</th>
                                <th>Full Name</th>
                                <th class="hidden-xs">Email Address</th>
                                <th>Usergroup</th>
                                <th class="chart-col-header hidden-xs">Date Added</th>
								<th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
							$i = 1;
							foreach($disabled as $disabled){ 
							if($disabled['User']['status_id']==1){$class='label-success';}else{$class='label-important';}
							?>
                            <tr>
								<td><?php echo $i; ?></td>
                                <td><span class="label <?php echo $class; ?>"><?php echo $statuses[$disabled['User']['status_id']]; ?></span></td>
                                <td><?php echo $disabled['User']['name']; ?></td>
                                <td class="hidden-xs"><?php echo $disabled['User']['email']; ?></td>
                                <td><?php echo $ugs[$disabled['User']['usergroup_id']]; ?></td>
                                <td class="chart-cell hidden-xs"><?php if(!empty($disabled['User']['date_added'])){ echo date('d M,Y',strtotime($disabled['User']['date_added']));} ?></td>
								<th></th>
                            </tr>
                            <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
						
						
						<div id="all" class="tab-pane">
                            <section class="widget">
                    <header>
                        <h4>
                            All Users <small>                            </small>                        </h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-minus"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="widget-table-overflow">
                        <table class="table table-striped table-lg mt-sm mb-0 sources-table">
                            <thead>
                            <tr>
								<th>Id</th>
                                <th class="source-col-header">Status</th>
                                <th>Full Name</th>
                                <th class="hidden-xs">Email Address</th>
                                <th>Usergroup</th>
                                <th class="chart-col-header hidden-xs">Date Added</th>
								<th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
							$i = 1;
							foreach($all_users as $all_users){ 
							if($all_users['User']['status_id']==1){$class='label-success';}else{$class='label-important';}
							?>
                            <tr>
								<td><?php echo $i; ?></td>
                                <td><span class="label <?php echo $class; ?>"><?php echo $statuses[$all_users['User']['status_id']]; ?></span></td>
                                <td><?php echo $all_users['User']['name']; ?></td>
                                <td class="hidden-xs"><?php echo $all_users['User']['email']; ?></td>
                                <td><?php echo $ugs[$all_users['User']['usergroup_id']]; ?></td>
                                <td class="chart-cell hidden-xs"><?php if(!empty($all_users['User']['date_added'])){ echo date('d M,Y',strtotime($all_users['User']['date_added']));} ?></td>
								<th></th>
                            </tr>
                            <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                        </div>
                       
                    </div>
              </section>