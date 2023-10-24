<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
  setInterval(function() {
    cache_clear()
  }, 300000);
});

function cache_clear() {
  window.location.reload(true);
  // window.location.reload(); use this if you do not remove cache
}
</script>
<h2 class="page-title">Dashboard <small>Statistics and more</small></h2>
        <div class="row">
          <div class="col-lg-8">
                <section class="widget">
                    <header>
                        <h4>
                            Visits
                            <small>
                                Based on a three months data                            </small>                        </h4>
                        <div class="widget-controls">
                            <a title="Options" href="#"><i class="glyphicon glyphicon-cog"></i></a>
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>                        </div>
                    </header>
                    <div class="body no-margin">
                        <div id="visits-chart" class="chart visits-chart">
                            <script>
                                window.onload = function () {

                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                                    title:{
                                        text: "Coin vrs Price Change(24h)"
                                    },
                                    axisY: {
                                        title: "Price Change (%)"
                                    },
                                    data: [{        
                                        type: "column",  
                                        showInLegend: true, 
                                        legendMarkerColor: "grey",
                                        //legendText: "MMbbl = one million barrels",
                                        dataPoints: [ 
                                            <?php foreach($data as $data2){ 
                                                $resp1 = $this->requestAction('dashboard/graph_data/'.$data2['Portfolio']['coin_id']);
                                            ?>     
                                            { y: <?php echo $resp1[0]->{'percent_change_24h'}; ?>, label: "<?php echo $resp1[0]->{'name'}; ?> (<?php echo $resp1[0]->{'symbol'}; ?>)" },
                                            <?php } ?>
                                        ]
                                    }]
                                });
                                chart.render();

                                }
                            </script>


                           <div id="chartContainer" style="height: 220px; max-width: 920px; margin: 0px auto;"></div>
                            <?php echo $this->Html->script(array('canvasjs.min')); ?>
                        </div>
                        <div class="visits-info well well-sm">
                            <div class="row">

                                <?php foreach($data as $data3){ 
                                    $resp3 = $this->requestAction('dashboard/graph_data/'.$data3['Portfolio']['coin_id']);
                                ?>
                                <div class="col-sm-3 col-xs-6" style="width: 150px;">
                                    <div class="key"><i class="fa fa-users"></i> <?php echo $resp3[0]->{'symbol'}; ?> Price</div>
                                    <div class="value">$<?php echo $resp3[0]->{'price_usd'}; ?> <i class="<?php if($resp3[0]->{'percent_change_24h'} >= 0){echo 'fa fa-caret-up color-green';}else{echo 'fa fa-caret-down color-red';} ?>"></i></div>
                                </div>
                                <?php } ?>
                               
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>
            <div class="col-lg-4">
              <section class="widget widget-tabs">
                    
                    <div class="body tab-content">
                        
                        <div id="dropdown1" class="tab-pane active clearfix">
                            <h5 class="tab-header"><i class="fa fa-comments"></i> Top Commenters</h5>
                            <ul class="news-list">
                                <li>
                                    <img src="img/13.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Frans Garey</a></div>
                                        <div class="comment">
                                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                                            sed quia                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <img src="img/1.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Finees Lund</a></div>
                                        <div class="comment">
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                            eu fugiat.                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <img src="img/14.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Jessica Johnsson</a></div>
                                        <div class="comment">
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt.                                        </div>
                                    </div>
                                </li>
								<li>
                                    <img src="img/14.png" alt="" class="pull-left img-circle"/>
                                    <div class="news-item-info">
                                        <div class="name"><a href="#">Jessica Johnsson</a></div>
                                        <div class="comment">
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt.                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
              </section>
            </div>
		
			
        </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
        <style type="text/css">
            input{
                color: #000000;
            }
        </style>
		
        <center style=" margin-bottom:10px;"><?php echo $this->Session->flash(); ?></center>
		<section class="widget widget-tabs">
                    <div class="body tab-content">
                    <?php echo $this->Form->create('Portfolio',array('url'=>'/dashboard/new_port','class'=>'form-horizontal form-label-left','type'=>'file')); ?>
                    <div class="form-group">
                                <table width="423" border="0" style="margin-left:15px;">
                                  <tr>
                                    <td><div style="width:320px;margin-left:10px auto;margin-top:5px;">
                                 
                                  <?php echo $this->Form->input('coin_id', array('label'=>'','class'=>'chosen','style'=>'width:300px;color:#000000;','options' => array(''=>'Select Coin',$coins))); ?>
                                </div></td>
                                    <td><div style="width: 100px;">
                                    <?php echo $this->Html->link('<button class="btn btn-lg btn-info">Add Portfolio</button>',array('controller'=>'dashboard','action'=>'new_port'),array('escape'=>false)); ?>
                                </div></td>
                                  </tr>
                                </table>
                                   

                                <script type="text/javascript">
                                      $(".chosen").chosen();
                                </script>
                                </div>

                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>My Coins</h4>
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
                                <th>Symbol</th>
                                <th>Market Cap</th>
                                <th>Price</th>
                                <th>Circulating Supply</th>
                                <th>Volume (24h)</th>
                                <th>% 24h</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i = 1;
                            foreach($data as $data){ 
                            $resp = $this->requestAction('dashboard/get_portfolio_data/'.$data['Portfolio']['coin_id']);
                            $image = $this->requestAction('dashboard/get_coin_image/'.$data['Portfolio']['coin_id']);
                            //print_r($resp[0]);
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td align="left"><div align="left"><?php echo $this->Html->image('coins/'.$image[0]['Coin']['image'],array('width'=>20,'height'=>20)).' '.$resp[0]->name;  ?></div></td>
                                <td><?php echo $resp[0]->symbol;  ?></td>
                                <td>$<?php echo number_format($resp[0]->market_cap_usd);  ?></td>
                                <td><strong>$<?php if($resp[0]->price_usd < 1000){echo round($resp[0]->price_usd,6);}else{echo number_format($resp[0]->price_usd);} ?></strong></td>
                                <td><?php echo number_format($resp[0]->available_supply).' '.$resp[0]->symbol; ?></td>
                                <td>$<?php echo number_format($resp[0]->{'24h_volume_usd'}); ?></td>
                                <td><strong class="<?php if($resp[0]->percent_change_24h > 0){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo $resp[0]->percent_change_24h; ?></strong></td>
                                <td>
                                <div class="col-md-8 col-md-offset-2">
                                    <?php echo $this->Html->link('<i class="fa fa-trash"></i>',array('controller'=>'dashboard','action'=>'delete',$data['Portfolio']['id']),array('escape'=>false,'title'=>'Delete','confirm'=>'Are you sure you want to delete '.$image[0]['Coin']['name'])); ?>
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


              <section class="widget widget-tabs">
                    <div class="body tab-content">
                    <?php echo $this->Form->create('Portfolio',array('url'=>'/dashboard/new_port','class'=>'form-horizontal form-label-left','type'=>'file')); ?>
                    <div class="form-group">
                                <table width="423" border="0" style="margin-left:15px;">
                                  <tr>
                                    <td><div style="width:320px;margin-left:10px auto;margin-top:5px;">
                                 
                                  <?php echo $this->Form->input('coin_id', array('label'=>'','class'=>'chosen','style'=>'width:300px;color:#000000;','options' => array(''=>'Select Coin',$coins))); ?>
                                </div></td>
                                    <td><div style="width: 100px;">
                                    <?php echo $this->Html->link('<button class="btn btn-lg btn-info">Add Portfolio</button>',array('controller'=>'dashboard','action'=>'new_port'),array('escape'=>false)); ?>
                                </div></td>
                                  </tr>
                                </table>
                                   

                                <script type="text/javascript">
                                      $(".chosen").chosen();
                                </script>
                                </div>

                        <div id="buy" class="tab-pane active clearfix">
                            <section class="widget">
                    <header>
                        <h4>My Holdings</h4>
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
                                <th>Coin</th>
                                <th>Holding</th>
                                <th>Market value</th>
                                <th>Net Cost</th>
                                <th>Profit/Loss</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i = 1;
                            foreach($data as $data){ 
                            $resp = $this->requestAction('dashboard/get_portfolio_data/'.$data['Portfolio']['coin_id']);
                            $image = $this->requestAction('dashboard/get_coin_image/'.$data['Portfolio']['coin_id']);
                            //print_r($resp[0]);
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td align="left"><div align="left"><?php echo $this->Html->image('coins/'.$image[0]['Coin']['image'],array('width'=>20,'height'=>20)).' '.$resp[0]->name;  ?></div></td>
                                <td><?php echo $resp[0]->symbol;  ?></td>
                                <td>$<?php echo number_format($resp[0]->market_cap_usd);  ?></td>
                                <td><strong>$<?php if($resp[0]->price_usd < 1000){echo round($resp[0]->price_usd,6);}else{echo number_format($resp[0]->price_usd);} ?></strong></td>
                                <td><strong class="<?php if($resp[0]->percent_change_24h > 0){echo 'color-green';}else{echo 'color-red';} ?>"><?php echo $resp[0]->percent_change_24h; ?></strong></td>
                                <td>
                                <div class="col-md-8 col-md-offset-2">
                                    <?php echo $this->Html->link('<i class="fa fa-trash"></i>',array('controller'=>'dashboard','action'=>'delete',$data['Portfolio']['id']),array('escape'=>false,'title'=>'Delete','confirm'=>'Are you sure you want to delete '.$image[0]['Coin']['name'])); ?>
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