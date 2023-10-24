<?php

class JobShell extends Shell {
       var $tasks = array('Job'); //found in /vendors/shells/tasks/sound.php
	function main() {
	    $this->Job->add_new_ticker();
		//$this->Mail->sendMail();
   }
}
