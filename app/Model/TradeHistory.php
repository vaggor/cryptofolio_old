<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class TradeHistory extends AppModel{
    public $name = 'TradeHistory';
	public $primaryKey = 'id';
	public $useTable = 'trade_history';


	public function getTradeHistory(){
			return $this->find('all', array('conditions'=>array('deleted'=>0)));
	}

	public function getTradeHistoryByUser($user_id){
			return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id)));
	}

	public function getTradeHistoryByCoin($coin_id){
			return $this->find('all', array('conditions'=>array('deleted'=>0,'coin_id'=>$coin_id)));
	}

	public function getTradeHistoryByUserAndCoin($user_id,$coin_id){
			return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'coin_id'=>$coin_id)));
	}

}
?>