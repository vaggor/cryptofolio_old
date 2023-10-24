<?php
$sess_data = $this->Session->read();
$me = $sess_data['Auth']['User'];
//print_r( $user['use_group'] );
?>
<nav id="sidebar" class="sidebar nav-collapse collapse">
            <ul id="side-nav" class="side-nav">
                <li class="active">
                    <?php echo $this->Html->link('<i class="fa fa-home"></i> <span class="name">Dashboard</span>',array('controller'=>'tradings','action'=>'dashboard'),array('escape'=>false)); ?>             
                </li>
                <?php if($me['usergroup_id'] == 1){ ?>
                <li class="">
                    <?php echo $this->Html->link('<i class="fa fa-user"></i> <span class="name">User Management</span>',array('controller'=>'users','action'=>'index'),array('escape'=>false)); ?>             
                </li>

                 <li class="">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#menu-levels-collapse"><i class="fa fa-folder-open"></i> <span class="name">Settings</span></a>
                    <ul id="menu-levels-collapse" class="panel-collapse collapse">
                        <li><?php echo $this->Html->link('Coins',array('controller'=>'settings','action'=>'coins')); ?></li>
                    </ul>
                </li>
                <?php } ?>

                <li class="panel">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#menu-levels-collapse"><i class="fa fa-folder-open"></i> <span class="name">Trads</span></a>
                    <ul id="menu-levels-collapse" class="panel-collapse collapse">
                        <li><?php echo $this->Html->link('Robots',array('controller'=>'tradings','action'=>'robots')); ?></li>
                        <li><?php echo $this->Html->link('Trading Coins',array('controller'=>'tradings','action'=>'robot_trading_coins')); ?></li>
                        <li><?php echo $this->Html->link('All Trades',array('controller'=>'tradings','action'=>'all_trades')); ?></li>
                        <li><?php echo $this->Html->link('Active Trades',array('controller'=>'tradings','action'=>'active_trades')); ?></li>
                        <li><?php echo $this->Html->link('Closed Trades',array('controller'=>'tradings','action'=>'closed_trades')); ?></li>
                        <li><?php echo $this->Html->link('Add Fund',array('controller'=>'tradings','action'=>'invoice')); ?></li>
                    </ul>
                </li>

                <!--
                <li class="panel">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#menu-levels-collapse"><i class="fa fa-folder-open"></i> <span class="name">Transactions</span></a>
                    <ul id="menu-levels-collapse" class="panel-collapse collapse">
                        <li><?php echo $this->Html->link('All Coins Txn',array('controller'=>'transactions','action'=>'index')); ?></li>
                        <li class="panel">
                            <a class="accordion-toggle collapsed" data-toggle="collapse"
                               data-parent="#menu-levels-collapse" href="#sub-menu-1-collapse">Coin Txn</a>
                            <ul id="sub-menu-1-collapse" class="panel-collapse collapse">
                            <?php foreach($gcoins as $gcoins){ ?>
                                <li><?php echo $this->Html->link($gcoins['Coin']['name'].' ('.$gcoins['Coin']['symble'].')',array('controller'=>'transactions','action'=>'trx_by_coin',$gcoins['Coin']['id'])); ?></li>
                            <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="package.html"><i class="fa fa-database"></i> <span class="name">LB Package <sup class="text-warning fw-bold">4.0</sup></span></a>                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#forms-collapse"><i class="fa fa-pencil"></i> <span class="name">Forms</span></a>
                    <ul id="forms-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="form_account.html">Account</a></li>
                        <li class=""><a href="form_article.html">Article</a></li>
                        <li class=""><a href="form_elements.html">Elements</a></li>
                        <li class=""><a href="form_validation.html">Validation</a></li>
                        <li class=""><a href="form_wizard.html">Wizard</a></li>
                    </ul>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#stats-collapse"><i class="fa fa-area-chart"></i> <span class="name">Statistics</span></a>
                    <ul id="stats-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="stat_statistics.html">Stats</a></li>
                        <li class=""><a href="stat_charts.html">Charts</a></li>
                        <li class=""><a href="stat_realtime.html">Realtime</a></li>
                    </ul>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#ui-collapse"><i class="fa fa-magic"></i> <span class="name">User Interface</span></a>
                    <ul id="ui-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="ui_buttons.html">Buttons</a></li>
                        <li class=""><a href="ui_dialogs.html">Dialogs</a></li>
                        <li class=""><a href="ui_notifications.html">Notifications</a></li>
                        <li class=""><a href="ui_icons.html">Icons</a></li>
                        <li class=""><a href="ui_tabs.html">Tabs</a></li>
                        <li class=""><a href="ui_accordion.html">Accordion</a></li>
                    </ul>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#components-collapse"><i class="fa fa-tree"></i> <span class="name">Components</span></a>
                    <ul id="components-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="component_calendar.html">Calendar</a></li>
                        <li class=""><a href="component_maps.html" data-no-pjax>Maps</a></li>
                        <li class=""><a href="component_gallery.html">Gallery</a></li>
                        <li class=""><a href="component_fileupload.html" data-no-pjax>Fileupload</a></li>
                        <li class=""><a href="component_bootstrap.html">Bootstrap</a></li>
                        <li class=""><a href="component_list_groups.html">List Groups</a></li>
                    </ul>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#tables-collapse"><i class="fa fa-cog"></i> <span class="name">Tables</span></a>
                    <ul id="tables-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="tables_static.html">Static <sup class="text-danger fw-bold">upd</sup></a></li>
                        <li class=""><a href="tables_dynamic.html">Dynamic</a></li>
                    </ul>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#grid-collapse"><i class="fa fa-th"></i> <span class="name">Widgets</span></a>
                    <ul id="grid-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="grid_basic.html">Basic</a></li>
                        <li class=""><a href="grid_live.html">Live</a></li>
                    </ul>
                </li>
                <li class="panel ">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#special-collapse"><i class="fa fa-leaf"></i> <span class="name">Special</span></a>
                    <ul id="special-collapse" class="panel-collapse collapse ">
                        <li class=""><a href="special_search.html">Search <sup class="text-warning fw-bold">new</sup></a></li>
                        <li class=""><a href="special_invoice.html">Invoice</a></li>
                        <li class=""><a href="special_inbox.html">Inbox &nbsp; <span class="label label-important">3</span></a></li>
                        <li><a target="_blank" href="login.html">Login</a></li>
                        <li><a target="_blank" href="error.html">Error Page</a></li>
                        <li><a href="landing.html" data-no-pjax>Landing</a></li>
                        <li><a href="http://demo.flatlogic.com/4.0.0/light/index.html" data-no-pjax title="Light Blue Transparent Light version">Light <sup class="text-warning fw-bold">new</sup></a></li>
                        <li><a href="http://demo.flatlogic.com/4.0.0/white/index.html" data-no-pjax title="Light Blue Transparent White version">White <sup class="text-warning fw-bold">new</sup></a></li>
                    </ul>
                </li>
                <li class="panel">
                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                       data-parent="#side-nav" href="#menu-levels-collapse"><i class="fa fa-folder-open"></i> <span class="name">Menu Levels</span></a>
                    <ul id="menu-levels-collapse" class="panel-collapse collapse">
                        <li><a href="#">Item 1.1</a></li>
                        <li><a href="#">Item 1.2</a></li>
                        <li class="panel">
                            <a class="accordion-toggle collapsed" data-toggle="collapse"
                               data-parent="#menu-levels-collapse" href="#sub-menu-1-collapse">Item 1.3</a>
                            <ul id="sub-menu-1-collapse" class="panel-collapse collapse">
                                <li class="panel">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                                       data-parent="#sub-menu-1-collapse" href="#sub-menu-3-collapse">Item 2.1</a>
                                    <ul id="sub-menu-3-collapse" class="panel-collapse collapse">
                                        <li><a href="#">Item 3.1</a></li>
                                        <li><a href="#">Item 3.2</a></li>
                                        <li><a href="#">Item 3.3</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Item 2.2</a></li>
                                <li class="panel">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                                       data-parent="#sub-menu-1-collapse" href="#sub-menu-2-collapse">Item 2.3</a>
                                    <ul id="sub-menu-2-collapse" class="panel-collapse collapse">
                                        <li><a href="#">Item 3.4</a></li>
                                        <li><a href="#">Item 3.5</a></li>
                                        <li><a href="#">Item 3.6</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="visible-xs">
                    <a href="login.html"><i class="fa fa-sign-out"></i> <span class="name">Sign Out</span></a>                </li>
            </ul>!-->
        
           
        </nav>