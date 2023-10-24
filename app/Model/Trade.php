<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Trade extends AppModel{
    public $name = 'Trade';
	public $primaryKey = 'id';
	public $useTable = 'trade';


	public function getTrades(){
			return $this->find('all', array('conditions'=>array('deleted'=>0)));
	}

	public function getTradesByUser($user_id){
			return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id)));
	}

	public function getQuantity($user_id,$quote_coin_id){
			$data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'quote_coin_id'=>$quote_coin_id),'fields'=>array('quantity')));
			return $data[0]['Trade']['quantity'];
	}

}
?>