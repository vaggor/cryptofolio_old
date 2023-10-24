<?php

class InvoiceShell extends Shell {
       var $tasks = array('PushTransaction'); //found in /vendors/shells/tasks/sound.php
	function main() {
	    $this->PushTransaction->updateInvoiceStatus();
		//$this->Mail->sendMail();
   }
}
