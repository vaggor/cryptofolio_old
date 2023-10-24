<?php

class TradeShell extends Shell {
       var $tasks = array('PushTransaction'); //found in /vendors/shells/tasks/sound.php
	function main() {
		for ($i=0; $i <= 35; $i++) { // run for 15min
	    	$this->PushTransaction->postData();
	    	sleep(15);
		}
		//$this->Mail->sendMail();
   }
}
