<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Ticker extends AppModel{
    public $name = 'Ticker';
	public $primaryKey = 'id';
	public $useTable = 'tickers';


	public function listCoins(){
		return $this->find('list', array('conditions'=>array('deleted'=>0),'fields'=>array('id','name')));
	}

	public function getCoins(){
		return $this->find('all', array('conditions'=>array('deleted'=>0),'order'=>'name asc'));
	}

	public function getCoinById($id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'id'=>$id)));
	}

	public function getCoinBySymbol($symbol){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'symbol'=>$symbol)));
	}

	public function getDocumentByID($id){
		return $items = $this->find('all',array('conditions'=>array('id'=>$id,'deleted'=>0)));
	}

	public function deleteCoin($id){
		return $this->updateAll(array('deleted'=>'1'),array('id'=>$id));
	}

	public function addCoin(){
		$ticker_data = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=0',true));
		//print_r($ticker_data);exit;
		foreach ($ticker_data as $ticker_data) {
			$symbol = $ticker_data->symbol;
			$chk_symbol = $this->getCoinBySymbol($symbol);
			if(empty($chk_symbol)){
				$name = $ticker_data->name;
				$data = array();
				$data['Ticker']['name'] = $name;
				$data['Ticker']['symbol'] = $symbol;
				//print_r($pair_data);exit;
				$this->saveAll($data);
				echo 'New Ticker saved';
			}
			else{
				echo 'Ticker already exist';
			}
		}
		return true;
	}

}
?>