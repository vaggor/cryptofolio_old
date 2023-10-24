<?php

class InvoiceShell extends Shell {
       var $tasks = array('PushTransaction'); //found in /vendors/shells/tasks/sound.php
	function main() {
		for ($i=0; $i <= 30; $i++) { // run for 15min
	    	$this->PushTransaction->updateInvoiceStatus();
	    	sleep(15);
		}
		//$this->Mail->sendMail();
   }
}
