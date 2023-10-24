<?php
/*App::import('Component', 'Email');
App::uses('CakeEmail', 'Network/Email');*/
//App::import('Model', 'Binance');
class JobTask extends Shell {

    var $uses = array('RobotTrade','Robot','User','Job','RobotTradingCoin','Invoice','Ticker','Log');
	//var $uses = array('Staff','Template');
	
	public function add_new_ticker(){
		$this->Job->updateLastRun(4); // 4 = job table id number 4
		$data = $this->Ticker->addCoin();
		
	}

	public function delete_logs(){
		$this->Job->updateLastRun(5); // 5 = job table id number 5
		$days_ago = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 2, date("Y")));
		//print_r($days_ago);exit;
		$data = $this->Log->deleteLogs($days_ago);
		$this->out($data);
	}


	

}
?> 
