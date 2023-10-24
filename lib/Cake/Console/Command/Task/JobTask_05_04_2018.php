<?php
/*App::import('Component', 'Email');
App::uses('CakeEmail', 'Network/Email');*/
//App::import('Model', 'Binance');
class JobTask extends Shell {

    var $uses = array('RobotTrade','Robot','User','Job','RobotTradingCoin','Invoice','Ticker');
	//var $uses = array('Staff','Template');
	
	public function add_new_ticker(){
		$this->Job->updateLastRun(4); // 1 = job table id number 1
		$data = $this->Ticker->addCoin();
		
	}


	

}
?> 
