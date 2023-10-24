<?php

class Job extends AppModel{

    var $name = 'Job';

	var $primaryKey = 'id';

	var $useTable = 'jobs';

		

	public function updateLastRun()

	{
		$date = date('Y-m-d').' '.date('h:ia');

		$this->updateAll(array('Job.last_run'=>"'".$date."'"),array('Job.id'=>1));

		return true;

	}



}

?>