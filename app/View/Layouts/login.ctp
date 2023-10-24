<!-- light-blue - v4.0.0 - 2017-12-04 -->

<!DOCTYPE html>
<html>

<head>
    <title>Cryptofolio Login</title>

       <?php echo $this->Html->css(array('application')); ?>
       <?php echo $this->Html->script(array('https://www.google.com/recaptcha/api.js')); ?>
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
           chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
                      https://code.google.com/p/chromium/issues/detail?id=332189
        */
    </script>
</head>
<body>
        <div class="single-widget-container">
		<center style=" margin-top:50px;"><?php echo $this->Session->flash(); ?></center>
            <section class="widget login-widget">
                <header class="text-align-center">
                    <h4>Login to your account</h4>
                </header>
                <div class="body">
                    <!--<form class="no-margin" action="http://demo.flatlogic.com/4.0.0/dark/index.html" method="get">!-->
					<?php echo $this->Form->create('User',array('url'=>'/users/login','class'=>'no-margin')); ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="email" >Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <!--<input id="email" type="email" class="form-control input-lg input-transparent" placeholder="Your Email">!-->
									<?php echo $this->Form->input('email',array('type'=>'text','label'=>false,'class'=>'form-control input-lg input-transparent','div'=>false,'placeholder'=>'Your Email')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" >Password</label>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <!--<input id="password" type="password" class="form-control input-lg input-transparent" placeholder="Your Password">!-->
									<?php echo $this->Form->input('password',array('type'=>'password','label'=>false,'class'=>'form-control input-lg input-transparent','div'=>false,'placeholder'=>'Password')); ?>
                                </div>
                            </div>

                            <div class="g-recaptcha" data-sitekey="6LcP3EsUAAAAAMWennriGnwgCgbg2qdI52xC_JBN"></div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-block btn-lg btn-danger">
                                <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                                <small>Sign In</small>
                            </button>
                            <!--<a class="forgot" href="#">Forgot Password?</a>!-->
							<?php echo $this->Html->link('Forgot Password?',array('controller'=>'users','action'=>'reset_password'),array('class'=>'forgot')); ?>
                        </div>
                    </form>
                </div>
                <footer>
                    <div class="facebook-login">
                        <!--<a href="index-2.html"><span><i class="fa fa-user fa-lg"></i> Sign up</span></a>!-->
						<?php echo $this->Html->link('<span><i class="fa fa-user fa-lg"></i> Sign up',array('controller'=>'users','action'=>'signup'),array('class'=>'forgot','escape'=>false)); ?>
                    </div>
                </footer>
            </section>
        </div>
<!-- common libraries. required for every page-->
<?php echo $this->Html->script(array('lib/jquery/dist/jquery.min','lib/jquery-pjax/jquery.pjax','lib/bootstrap-sass/assets/javascripts/bootstrap.min','lib/widgster/widgster','lib/underscore/underscore')); ?>

<!-- common application js -->
<?php echo $this->Html->script(array('app','settings')); ?>

<!-- common templates -->
<script type="text/template" id="settings-template">
    <div class="setting clearfix">
        <div>Sidebar on the</div>
        <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% onRight = sidebar == 'right'%>
            <button type="button" data-value="left" class="btn btn-sm btn-default <%= onRight? '' : 'active' %>">Left</button>
            <button type="button" data-value="right" class="btn btn-sm btn-default <%= onRight? 'active' : '' %>">Right</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar</div>
        <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% display = displaySidebar%>
            <button type="button" data-value="true" class="btn btn-sm btn-default <%= display? 'active' : '' %>">Show</button>
            <button type="button" data-value="false" class="btn btn-sm btn-default <%= display? '' : 'active' %>">Hide</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Light Version</div>
        <div>
            <a href="../light/index.html" class="btn btn-sm btn-default">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
    <div class="setting clearfix">
        <div>White Version</div>
        <div>
            <a href="../white/index.html" class="btn btn-sm btn-default">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</script>

<script type="text/template" id="sidebar-settings-template">
    <% auto = sidebarState == 'auto'%>
    <% if (auto) {%>
    <button type="button"
            data-value="icons"
            class="btn-icons btn btn-transparent btn-sm">Icons</button>
    <button type="button"
            data-value="auto"
            class="btn-auto btn btn-transparent btn-sm">Auto</button>
    <%} else {%>
    <button type="button"
            data-value="auto"
            class="btn btn-transparent btn-sm">Auto</button>
    <% } %>
</script>

    <!-- page specific scripts -->


</body>

</html>