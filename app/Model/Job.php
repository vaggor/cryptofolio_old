<?php

class Job extends AppModel{

    var $name = 'Job';

	var $primaryKey = 'id';

	var $useTable = 'jobs';

		

	public function updateLastRun($id)

	{
		$date = date('Y-m-d').' '.date('h:i:sa');

		$this->updateAll(array('Job.last_run'=>"'".$date."'"),array('Job.id'=>$id));

		return true;

	}



}

?>