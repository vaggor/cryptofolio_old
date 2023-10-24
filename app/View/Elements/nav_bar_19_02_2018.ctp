<?php
$sess_data = $this->Session->read();
$me = $sess_data['Auth']['User'];
//print_r( $me );
?>
<div class="navbar">
                <ul class="nav navbar-nav navbar-right pull-right">
                   
                    
                    
                    <li class="divider"></li>
                    
                    <li class="hidden-xs dropdown">
                        <a href="#" title="Account" id="account"
                           class="dropdown-toggle"
                           data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>                        </a>
                        <ul id="account-menu" class="dropdown-menu account" role="menu">
                            <li role="presentation" class="account-picture">
                                <img src="img/2.png" alt="">
                                <?php echo $me['name']; ?>                          </li>
                            <li role="presentation">
                                <a href="form_account.html" class="link">
                                    <i class="fa fa-user"></i>
                                    Profile                                </a>                            </li>
                           
                        </ul>
                    </li>
                    <li class="visible-xs">
                        <a href="#"
                           class="btn-navbar"
                           data-toggle="collapse"
                           data-target=".sidebar"
                           title="">
                            <i class="fa fa-bars"></i>                        </a>                    </li>
                    <li class="hidden-xs">
					<?php echo $this->Html->link('<i class="glyphicon glyphicon-off"></i>',array('controller'=>'users','action'=>'logout'),array('escape'=>false)); ?>
					</li>
                </ul>
               <!--<form id="search-form" class="navbar-form pull-right" role="search">
                    <input type="search" class="form-control search-query" placeholder="Search...">
                </form>!-->
                <div class="notifications pull-right">
                    <div class="alert pull-right">
                        <a href="#" class="close ml-xs" data-dismiss="alert">&times;</a>
                        <i class="fa fa-info-circle mr-xs"></i> Available Bal:  <strong><?php echo $me['balance']; ?> BTC</strong></div>
                </div>
            </div>