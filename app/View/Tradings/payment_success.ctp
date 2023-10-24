        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript"> 
        var auto_refresh = setInterval( function() { 
        	$('#status').load('http://clickmegh.com/cryptofolio/tradings/load/<?php echo $address; ?>').fadeIn("slow"); 
        	}, 15000); // refreshing after every 15000 milliseconds 
        </script>

        <h2 class="page-title">Invoice - <span class="fw-semi-bold">Payment Success</span>
            <!--<small>More than 2000 man-hours already invested!</small>!-->
        </h2>
        <center style="margin-bottom: 15px;">
        <div id='status'></div>
        </center>
        <section class="widget">
        <p class="lead">Payment of <strong><?php echo $amount; ?> BTC</strong> to the address <strong><?php echo $address; ?></strong> has been saved. Your balance will be updated once your payment is confirmed.</p>
        </section>

        <!--<script>
			$( "#status" ).load( "http://localhost/coin_folio/app/tradings/load/<?php echo $address; ?>" );
		</script>!-->
        