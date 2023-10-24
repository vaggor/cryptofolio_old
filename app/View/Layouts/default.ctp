<!-- light-blue - v4.0.0 - 2017-12-04 -->

<!DOCTYPE html>
<html>
<head>
    <title>Cryptofolio</title>

        <!--<link href="css/application.css" rel="stylesheet">!-->
		<?php echo $this->Html->css(array('application')); ?>
        <?php if($this->params['controller'] == 'reports'){
            echo $this->Html->css(array('datepicker/bootstrap.min','datepicker/bootstrap-datetimepicker.min'));
            } ?>
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
    <div class="logo">
        <h4><strong>Cryptofolio</strong></h4>
    </div>
        <?php 
		if($this->params['action'] != 'signup'){
		echo $this->element('menu');
		}
		?>    
        <div class="wrap">
        <header class="page-header">
            <?php echo $this->element('nav_bar');?>
        </header>        
        <div class="content container">
        <?php echo $this->fetch('content'); ?>
		
		
            <?php echo $this->element('footer');?>
        </div>
        <div class="loader-wrap hiding hide">
            <i class="fa fa-circle-o-notch fa-spin"></i>        </div>
    </div>
<!-- common libraries. required for every page-->
<!--<script src="js/lib/jquery/dist/jquery.min.js"></script>
<script src="js/lib/jquery-pjax/jquery.pjax.js"></script>
<script src="js/lib/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
<script src="js/lib/widgster/widgster.js"></script>
<script src="js/lib/underscore/underscore.js"></script>!-->

<?php 
if($this->params['controller'] == 'dashboard'){
	echo $this->Html->script(array('lib/jquery/dist/jquery.min','lib/jquery-pjax/jquery.pjax1','lib/bootstrap-sass/assets/javascripts/bootstrap.min','lib/widgster/widgster','lib/underscore/underscore'));
}
else{
	echo $this->Html->script(array('lib/jquery/dist/jquery.min','lib/jquery-pjax/jquery.pjax','lib/bootstrap-sass/assets/javascripts/bootstrap.min','lib/widgster/widgster','lib/underscore/underscore'));
}
?>

<!-- common application js -->
<!--<script src="js/app.js"></script>
<script src="js/settings.js"></script>!-->

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
        <!-- page libs -->
        <!--<script src="js/lib/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="js/lib/jquery.sparkline/index.js"></script>

        <script src="js/lib/backbone/backbone.js"></script>
        <script src="js/lib/backbone.localStorage/backbone.localStorage-min.js"></script>

        <script src="js/lib/d3/d3.min.js"></script>
        <script src="js/lib/nvd3/build/nv.d3.min.js"></script>!-->
		
		<?php echo $this->Html->script(array('lib/slimScroll/jquery.slimscroll.min','lib/jquery.sparkline/index','lib/backbone/backbone','lib/backbone.localStorage/backbone.localStorage-min','lib/d3/d3.min','lib/nvd3/build/nv.d3.min')); ?>

        <!-- page application js -->
        <!--<script src="js/index.js"></script>
        <script src="js/chat.js"></script>!-->
		
		<?php echo $this->Html->script(array('index','chat')); ?>

        <!-- page template -->
        <script type="text/template" id="message-template">
            <div class="sender pull-left">
                <div class="icon">
                    <img src="img/2.png" class="img-circle" alt="">
                </div>
                <div class="time">
                    just now
                </div>
            </div>
            <div class="chat-message-body">
                <span class="arrow"></span>
                <div class="sender"><a href="#">Tikhon Laninga</a></div>
                <div class="text">
                    <%- text %>
                </div>
            </div>
        </script>
		
		<?php echo $this->Html->script(array('lib/bootstrap-select/dist/js/bootstrap-select.min','lib/underscore/underscore','lib/backbone/backbone','lib/backbone.paginator/lib/backbone.paginator.min','lib/backgrid/lib/backgrid.min','lib/backgrid-paginator/backgrid-paginator','lib/datatables/media/js/jquery.dataTables.min','tables-dynamic')); ?>

        <?php if($this->params['controller'] == 'reports'){
            echo $this->Html->script(array('datepicker/jquery-1.8.3.min','datepicker/bootstrap-datetimepicker')); ?>
            <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>

         <?php  } ?>

        <?php
    if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
    // Writes cached scripts
    ?>
</body>

</html>