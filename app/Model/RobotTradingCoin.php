<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class RobotTradingCoin extends AppModel{
    public $name = 'RobotTradingCoin';
	public $primaryKey = 'id';
	public $useTable = 'robot_trading_coins';


	public function getCoins(){
		return $this->find('all', array('conditions'=>array('deleted'=>0),'order'=>'id desc'));
	}

	public function getActiveCoins(){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'status'=>4),'order'=>'id desc'));
	}

	public function countActiveCoinsByUser($user_id){
		return $this->find('count', array('conditions'=>array('deleted'=>0,'status'=>4,'user_id'=>$user_id),'order'=>'id desc'));
	}

	public function countcoins($user_id,$exchange_id){
		return $this->find('count', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id)));
	}

	public function getTradingLimit($user_id,$exchange_id,$symbol){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'symbol'=>$symbol),'fields'=>array('limit')));
		return $data[0]['RobotTradingCoin']['limit'];
	}

	public function getProfit($user_id,$exchange_id,$symbol){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'symbol'=>$symbol),'fields'=>array('profit')));
		return $data[0]['RobotTradingCoin']['profit'];
	}

	public function getAddProfit($user_id,$exchange_id,$symbol){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'symbol'=>$symbol),'fields'=>array('add_profit')));
		return $data[0]['RobotTradingCoin']['add_profit'];
	}

	public function getGetTradingPair($id){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'id'=>$id),'fields'=>array('symbol')));
		return $data[0]['RobotTradingCoin']['symbol'];
	}

	public function getCoinById($id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'id'=>$id)));
	}

	public function getCoinByIdNUser($id,$user_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'id'=>$id,'user_id'=>$user_id)));
	}

	public function getCoinBySymbol($symbol){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'symbol'=>$symbol)));
	}

	public function getCoinByUserId($user_id){
		return $items = $this->find('all',array('conditions'=>array('user_id'=>$user_id,'deleted'=>0)));
	}

	public function deleteCoin($id,$user_id){
		return $this->updateAll(array('deleted'=>'1'),array('id'=>$id,'user_id'=>$user_id));
	}

	public function updateCoinStatus($id,$user_id,$status){
		return $this->updateAll(array('status'=>$status),array('id'=>$id,'user_id'=>$user_id));
	}

	public function updateRebuyPoint($id,$user_id,$current_price){
		return $this->updateAll(array('rebuy_point'=>$current_price),array('id'=>$id,'user_id'=>$user_id));
	}

	public function updateRebuyPointByExchangeAndSymbol($exchange_id,$symbol,$user_id,$current_price){
		return $this->updateAll(array('rebuy_point'=>$current_price),array('exchange_id'=>$exchange_id,'symbol'=>$symbol,'user_id'=>$user_id));
	}

	public function add_profit_to_trading_amount($user_id,$exchange_id,$symbol,$profit){
		$trading_amount = $this->getTradingLimit($user_id,$exchange_id,$symbol);
		$new_trading_amount = $trading_amount + $profit;
		return $this->updateAll(array('limit'=>"'".$new_trading_amount."'"),array('exchange_id'=>$exchange_id,'user_id'=>$user_id,'symbol'=>$symbol));
	}

	public function update_profit($user_id,$exchange_id,$symbol,$profit){
		$old_profit = $this->getProfit($user_id,$exchange_id,$symbol);
		$new_profit = $old_profit + $profit;
		return $this->updateAll(array('profit'=>"'".$new_profit."'"),array('exchange_id'=>$exchange_id,'user_id'=>$user_id,'symbol'=>$symbol));
	}

	

}
?>