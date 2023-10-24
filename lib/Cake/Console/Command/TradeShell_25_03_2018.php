<?php



class TradeShell extends Shell {

       var $tasks = array('PushTransaction'); //found in /vendors/shells/tasks/sound.php

	function main() {

	    $this->PushTransaction->postData();

		//$this->Mail->sendMail();

   }

}

