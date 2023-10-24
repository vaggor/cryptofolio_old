<?php

class DeleteLogShell extends Shell {
       var $tasks = array('Job'); //found in /vendors/shells/tasks/sound.php
	function main() {
	    $this->Job->delete_logs();
		//$this->Mail->sendMail();
   }
}
