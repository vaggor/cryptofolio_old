<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class RobotTrade extends AppModel{
    public $name = 'RobotTrade';
	public $primaryKey = 'id';
	public $useTable = 'robot_trades';


	public function getAllActiveTrades(){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'status'=>4),'order'=>array('id desc')));
	}

	public function countAllActiveTradeByUser($user_id){
		//print_r($symbol);exit;
		return $this->find('count', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'status'=>4)));
	}

	public function countAllClosedTradeByUser($user_id){
		//print_r($symbol);exit;
		return $this->find('count', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'status'=>5)));
	}

	public function countActiveTrade($user_id,$exchange_id,$symbol){
		//print_r($symbol);exit;
		return $this->find('count', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'symbol'=>$symbol,'status'=>4)));
	}

	public function countActiveTradeWithoutSymbol($user_id,$exchange_id){
		return $this->find('count', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'status'=>4)));
	}

	public function getTrades($user_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id),'order'=>array('RobotTrade.status asc','RobotTrade.id desc')));
	}

	public function getTradeById($user_id,$id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'id'=>$id),'order'=>array('id desc')));
	}

	public function getLastSoldPrice($user_id,$exchange_id,$symbol){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'symbol'=>$symbol),'fields'=>array('sell_price','sell_qty'),'order'=>array('id desc'),'limit'=>1));
		if(empty($data)){
			return 0;
		}
		else{
			return $data[0]['RobotTrade']['sell_price'] / $data[0]['RobotTrade']['sell_qty'];
		}
	}

	public function getLastBuyPrice($user_id,$exchange_id,$symbol){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'symbol'=>$symbol),'fields'=>array('buy_price','buy_qty'),'order'=>array('id desc'),'limit'=>1));
		if(empty($data)){
			return 0;
		}
		else{
			return $data[0]['RobotTrade']['buy_price'] / $data[0]['RobotTrade']['buy_qty'];
		}
	}

	public function getLastSellPrice($user_id,$exchange_id,$symbol){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id,'symbol'=>$symbol),'fields'=>array('sell_price','buy_qty'),'order'=>array('id desc'),'limit'=>1));
		if(empty($data)){
			return 0;
		}
		else{
			return $data[0]['RobotTrade']['sell_price'] / $data[0]['RobotTrade']['buy_qty'];
		}
	}

	public function getActiveTradesByUser($user_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'status'=>4),'order'=>array('id desc','status asc')));
	}

	public function getAClosedTradesByUser($user_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'status'=>5),'order'=>array('id desc')));
	}

	public function getProfitByUser($user_id,$robot_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'status'=>5,'robot_id'=>$robot_id),'fields'=>array('sum(RobotTrade.perc_profit) as tot_perc_profit','sum(RobotTrade.profit) as tot_profit')));
	}

	public function getProfitByUserWithoutRobot($user_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'status'=>5),'fields'=>array('sum(RobotTrade.perc_profit) as tot_perc_profit','sum(RobotTrade.profit) as tot_profit')));
	}

	public function updatePercentage($perc_profit,$percentage,$id,$current_price){
		return $this->updateAll(array('sell_perc_chg'=>"'".$percentage."'",'last_updated'=>"'".date('Y-m-d H:i')."'",'perc_profit'=>"'".$perc_profit."'",'sell_price'=>"'".$current_price."'"),array('id'=>$id));
	}

	public function getTodaysTotalProfitByUser($user_id,$date){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'status'=>5,'sell_time like'=>$date.'%'),'fields'=>array('sum(RobotTrade.perc_profit) as tot_perc_profit','sum(RobotTrade.profit) as tot_profit')));
		if(empty($data)){
			$data = 0;
		}
		return $data;
	}

	public function getTodaysCoinProfitByUser($user_id,$date,$symbol){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'symbol'=>$symbol,'status'=>5,'sell_time like'=>$date.'%'),'fields'=>array('sum(RobotTrade.perc_profit) as tot_perc_profit','sum(RobotTrade.profit) as tot_profit')));
		if(empty($data)){
			$data = 0;
		}
		return $data;
	}

	public function getCLosedTradesByMonth($date,$user_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'sell_time like'=>$date.'%','status'=>5,'user_id'=>$user_id),'fields'=>array('count(sell_qty) as volume', 'sum(sell_price) as amount','sum(profit) as profit','sum(perc_profit) as percentage')));
	}

	public function updateCoinStatus($id,$user_id,$status){
		return $this->updateAll(array('status'=>$status),array('id'=>$id,'user_id'=>$user_id));
	}

	
}
?>