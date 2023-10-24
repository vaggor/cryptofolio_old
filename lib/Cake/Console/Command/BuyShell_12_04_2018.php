<?php

class BuyShell extends Shell {
       var $tasks = array('PushTransaction'); //found in /vendors/shells/tasks/sound.php
	function main() {
	    $this->PushTransaction->auto_buy();
		//$this->Mail->sendMail();
   }
}
