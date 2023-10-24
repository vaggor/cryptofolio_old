<?php
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  class DashboardController extends AppController {
  public $name = 'Dashboard';
  public $uses = array('User','Coin','Portfolio','Dashboard','Trade','TradeHistory','TradingPair');
  public $components = array('Session', 'Email','Auth');
  

	public function index(){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$data = $this->Portfolio->getPortfolioByUser($user_id);
		$coins = $this->Coin->listCoins();

		//print_r($resp[1]);exit;

		$this->set(compact('coin_name0','coin_name1','coin_name2','coin_name3','price_usd0','price_usd1','price_usd2','price_usd3','percent_change_24h0','percent_change_24h1','percent_change_24h2','percent_change_24h3','symbol0','symbol1','symbol2','symbol3','data','coins'));
	}


	public function graph_data($coin_id){
		//print_r($coin_id);exit;
		$coin = $this->Coin->getCoinById($coin_id);
		$url = 'https://api.coinmarketcap.com/v1/ticker/'.$coin[0]['Coin']['name'].'/';
		$response = $this->Dashboard->postToCurl($url);
		$resp = json_decode($response);

		return $resp;
	}


	public function get_portfolio_data($coin_id){
		$coin = $this->Coin->getCoinById($coin_id);
		$url = 'https://api.coinmarketcap.com/v1/ticker/'.$coin[0]['Coin']['name'].'/';
		$response = $this->Dashboard->postToCurl($url);
		$resp = json_decode($response);
		//print_r($resp);exit;
		//$this->set(compact('resp'));
		return $resp;
	}

	public function get_coin_image($coin_id){
		$coin = $this->Coin->getCoinById($coin_id);
		//print_r($resp);exit;
		return $coin;
	}

	public function delete($id) {
		if ($this->Portfolio->deletePortfolio($id)) {
			$this->Session->setFlash('Deleted Succesfully.');
			$this->redirect($this->referer());
		}
	}


	public function new_port(){
		if(!empty($this->request->data)){
			$data=$this->request->data;
			$chk_port = $this->Portfolio->getPortfolioByCoin($data['Portfolio']['coin_id']);
			$coin_name = $this->Coin->getCoinById($data['Portfolio']['coin_id']);
			if(empty($chk_port)){
				$sess = $this->Auth->user();
				//print_r($data);exit;
				$data['Portfolio']['date_added'] = date('Y-m-d H:i');
				$data['Portfolio']['user_id'] = $sess['id'];
				
				//print_r($data);exit;
				if($this->Portfolio->validates()){
					if($this->Portfolio->save($data)){
						$this->Session->setFlash($coin_name.'  has been added successfully');
					}
				}
			}
			else{
				$this->Session->setFlash($coin_name[0]['Coin']['name'].' has already been added','default',array('class'=>'error1'));
			}
			$this->redirect('index');
		
		}
 	}


 	public function new_trade(){
		if(!empty($this->request->data)){
			$data=$this->request->data;
			$sess = $this->Auth->user();
			$trading_pair = $this->TradingPair->getTradingPairById($data['Trade']['trading_pair_id']);
				//print_r($data);exit;
			$data['Trade']['trade_date'] = date('Y-m-d H:i');
			$data['Trade']['user_id'] = $sess['id'];
			$data['Trade']['base_coin_id'] = $trading_pair[0]['TradingPair']['Symbol'];
			$data['Trade']['quote_coin_id'] = $trading_pair[0]['TradingPair']['BaseSymbol'];

			if(isset($data['Trade']['add'])){
				$curr_quantity = $this->Trade->getQuantity($sess['id'],$data['Trade']['quote_coin_id']);
				$data['Trade']['quote_coin_id'] = $data['Trade']['quote_coin_id'] + $curr_quantity;
				$hist_data = array();
				$hist_data['TradeHistory']['type'] = 'Buy';
				$hist_data['TradeHistory']['price'] = 'Buy';

			}
			elseif(isset($data['Trade']['subtract'])){
				$curr_quantity = $this->Trade->getQuantity($sess['id'],$data['Trade']['quote_coin_id']);
				$data['Trade']['quote_coin_id'] = $curr_quantity - $data['Trade']['quote_coin_id'];
			}
				
				//print_r($data);exit;
			if($this->Trade->validates()){
				if($this->Trade->save($data)){

					$this->Session->setFlash('Saved successfully');
					$this->redirect('index');
				}
			}
		}
 	}

  
}
?>