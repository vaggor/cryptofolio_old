<?php

class BuyShell extends Shell {
       var $tasks = array('PushTransaction'); //found in /vendors/shells/tasks/sound.php
	function main() {
		for ($i=0; $i <= 25; $i++) { // run for 15min
	    	$this->PushTransaction->auto_buy();
	    	sleep(15);
		}
		//$this->Mail->sendMail();
   }
}
