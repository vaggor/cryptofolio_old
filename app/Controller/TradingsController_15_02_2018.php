<?php
App::uses('CakeEmail', 'Network/Email');
App::import('Model', 'Binance');
  class TradingsController extends AppController {
  public $name = 'Tradings';
  public $uses = array('User','Binance','Robot','TradingPair','Exchange','User','RobotTrade','Status','RobotTradingCoin');
  public $components = array('Session', 'Email','Auth');
  	
  	/********************************************************* Robots **********************************************/

  	public function new_robot(){
  		$exch = $this->Exchange->listExchanges();
  		$this->set(compact('exch'));
  		if(!empty($this->data)){
  			$sess = $this->Auth->user();
  			$data = $this->request->data;
  			$data['Robot']['date_added'] = date('Y-m-d H:i');
  			$data['Robot']['user_id'] = $sess['id'];
  			if($this->Robot->save($data)){
  				$this->Session->setFlash('Saved successfully');
  				$this->redirect('robots');
  			}
  		}
  	}

  	public function edit_robot($id=null){	
  		$exch = $this->Exchange->listExchanges();
  		$this->set(compact('exch'));
		if(empty($this->data)){
			//print_r($id);exit;
			$sess = $this->Auth->user();
			$user_id = $sess['id'];
			$data=$this->Robot->getRobotById($user_id,$id);
			$this->data=$data[0];
		}	
		elseif (!empty($this->data)) {
			$data = $this->request->data;

			$data['Robot']['date_modified'] = date('Y-m-d H:i');
		 
				//print_r($data);exit;
			if ($this->Robot->save($data)) {
				$this->Session->setFlash('Updated Successfully.');
				$this->redirect(array('action' => 'robots'));
			}
		}
	}

	public function robots(){
		$sess = $this->Auth->user();
		$exch = $this->Exchange->listExchanges();
		$data = $this->Robot->getRobotByUserId($sess['id']);
		//print_r($data);exit;
		$this->set(compact('data','exch'));
	}

	public function delete_robot($id) {
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		if ($this->Robot->deleteRobot($id,$user_id)) {
			$this->Session->setFlash('Deleted Succesfully.');
			$this->redirect($this->referer());
		}
	}


	/****************************************  Trades **********************************************/

	public function active_trades(){
		$page = 'Active Trades';
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$lexch = $this->Exchange->listExchanges();
		$data = $this->RobotTrade->getActiveTradesByUser($user_id);
		$this->set(compact('data','lexch','page'));
	}

	public function closed_trades(){
		$page = 'Closed Trades';
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$lexch = $this->Exchange->listExchanges();
		$data = $this->RobotTrade->getAClosedTradesByUser($user_id);
		$this->set(compact('data','lexch','page'));
		$this->render('active_trades');
	}

	public function all_trades(){
		$page = 'All Trades';
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$lexch = $this->Exchange->listExchanges();
		$data = $this->RobotTrade->getTrades($user_id);
		$this->set(compact('data','lexch','page'));
		$this->render('active_trades');
	}

	public function buy(){
		$sess = $this->Auth->user();
		if($sess['balance'] <= 0){
			$this->Session->setFlash('You do not have enough balance in your CryptoFolio account. Please add fund below', array('class' => 'error1'));
  			$this->redirect('add_fund');
		}
  		$exch = $this->Exchange->listExchanges();
  		$this->set(compact('exch'));
  		if(!empty($this->data)){
  			$data = $this->request->data;
  			//print_r($data);exit;
  			$cred = $this->get_api_credentials($data['RobotTrade']['exchange_id']);
  			$api_key = $cred[0]['Robot']['api_key'];
  			$api_secret = $cred[0]['Robot']['api_secret'];
  			$robot_id = $cred[0]['Robot']['id'];
  			$trade_pair = $this->TradingPair->getTradingPairById($data['RobotTrade']['trading_pair_id']);
  			$quantity = $data['RobotTrade']['buy_qty'];
  			$exchange_id = $data['RobotTrade']['exchange_id'];
  			$trading_pair_id = $data['RobotTrade']['trading_pair_id'];
  			if($data['RobotTrade']['exchange_id'] == 2){
  				$trade_pair = str_replace('/', '', $trade_pair[0]['TradingPair']['pair']);
  				$order_resp = $this->saveBinanceData($api_key,$api_secret,$trade_pair,$trading_pair_id,$quantity,$exchange_id,$robot_id);
  				if($order_resp == 'FILLED'){

  					$this->Session->setFlash('Buy Order Succesfully FIlled');
  					$this->redirect('all_trades');
  				}
  				else{
  					$this->Session->setFlash($order_resp, array('class' => 'error1'));
  					$this->redirect('all_trades');
  				}
  			}
  			
  		}
  	}

  	public function sell($id){
  		$sess = $this->Auth->user();
  		$data = $this->RobotTrade->getTradeById($sess['id'],$id);
  			//print_r($data);exit;
  		$cred = $this->get_api_credentials($data[0]['RobotTrade']['exchange_id']);
  		$api_key = $cred[0]['Robot']['api_key'];
  		$api_secret = $cred[0]['Robot']['api_secret'];
  		$trade_pair = $data[0]['RobotTrade']['symbol'];
  		$quantity = $data[0]['RobotTrade']['buy_qty'];
  		$exchange_id = $data[0]['RobotTrade']['exchange_id'];
  		if($data[0]['RobotTrade']['exchange_id'] == 2){
  			$order_resp = $this->updateBinanceData($api_key,$api_secret,$trade_pair,$quantity,$exchange_id,$id);
  			if($order_resp == 'FILLED'){
  				$this->Session->setFlash('Sell Order Succesfully FIlled');
  				$this->redirect('active_trades');
  			}
  			else{
  				$this->Session->setFlash($order_resp, 'default', array('class' => 'error1'));
  				$this->redirect('all_trades');
  			}
  		}
  			
  	}


  	/************************************************* Save data ****************************************************/

  	public function saveBinanceData($api_key,$api_secret,$trade_pair,$trading_pair_id,$quantity,$exchange_id,$robot_id){
  		$sess = $this->Auth->user();
  		$api = new Binance($api_key,$api_secret);
  		$order = $api->marketBuy($trade_pair, $quantity);
  		//print_r($order);exit;
  		/*$order = array('symbol' => 'BNBBTC',
		    'orderId' => '7652393',
		    'clientOrderId' => 'aAE7BNUhITQj3eg04iG1sY',
		    'transactTime' => '1508564815865',
		    'price' => '0.00000000',
		    'origQty' => '1.00000000',
		    'executedQty' => '1.00000000',
		    'status' => 'FILLED',
		    'timeInForce' => 'GTC',
		    'type' => 'MARKET',
		    'side' => 'BUY');*/
  		
  		if(@$order['status'] == 'FILLED'){
  			$price = $this->get_binance_price($order['symbol'],$api_key,$api_secret,$quantity);
  			$data = array();
	  		$data['RobotTrade']['user_id'] = $sess['id'];
	  		$data['RobotTrade']['robot_id'] = $robot_id;
	  		$data['RobotTrade']['exchange_id'] = $exchange_id;
	  		$data['RobotTrade']['trading_pair_id'] = $trading_pair_id;
	  		$data['RobotTrade']['symbol'] = $order['symbol'];
	  		$data['RobotTrade']['buy_orderId'] = $order['orderId'];
	  		$data['RobotTrade']['buy_clientOrderId'] = $order['clientOrderId'];
	  		$data['RobotTrade']['buy_price'] = $data['RobotTrade']['sell_price'] = $price;
	  		$data['RobotTrade']['buy_qty'] = $order['executedQty'];
	  		$data['RobotTrade']['buy_perc_chg'] = $data['RobotTrade']['sell_perc_chg'] = $this->get_perc_change($exchange_id,$trade_pair);
	  		$data['RobotTrade']['buy_time'] = date('Y-m-d H:i');
	  		$data['RobotTrade']['threshold'] = $data['RobotTrade']['buy_perc_chg'] + 1;
	  		$data['RobotTrade']['status'] = 4;
	  		//print_r($data);exit;
	  		if($this->RobotTrade->save($data)){
	  			return 'FILLED';
	  		}
  		}
  		else{
  			return $order['msg'];
  		}

  	}

  	public function updateBinanceData($api_key,$api_secret,$trade_pair,$quantity,$exchange_id,$id){
  		$sess = $this->Auth->user();
  		$api = new Binance($api_key,$api_secret);
  		$order = $api->marketSell($trade_pair, $quantity);
  		/*$order = array('symbol' => 'BNBBTC',
		    'orderId' => '7652393',
		    'clientOrderId' => 'aAE7BNUhITQj3eg04iG1sY',
		    'transactTime' => '1508564815865',
		    'price' => '0.00000000',
		    'origQty' => '1.00000000',
		    'executedQty' => '1.00000000',
		    'status' => 'FILLED',
		    'timeInForce' => 'GTC',
		    'type' => 'MARKET',
		    'side' => 'BUY');*/
  		
  		if(@$order['status'] == 'FILLED'){
  			$price = $this->get_binance_price($trade_pair,$api_key,$api_secret,$quantity);
  			$data = array();
	  		$data['RobotTrade']['id'] = $id;
	  		$data['RobotTrade']['sell_orderId'] = $order['orderId'];
	  		$data['RobotTrade']['sell_clientOrderId'] = $order['clientOrderId'];
	  		$data['RobotTrade']['sell_price'] = $price;
	  		$data['RobotTrade']['sell_qty'] = $quantity;
	  		$data['RobotTrade']['sell_perc_chg'] = $this->get_perc_change($exchange_id,$trade_pair);
	  		$data['RobotTrade']['sell_time'] = date('Y-m-d H:i');
	  		$data['RobotTrade']['status'] = 5;
	  		//print_r($data);exit;
	  		if($this->RobotTrade->save($data)){
	  			return 'FILLED';
	  		}
  		}
  		else{
  			return $order['msg'];
  		}

  	}


  	public function get_perc_change($exchange_id,$trading_pair){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$robot_data = $this->get_api_credentials($exchange_id);
		$api_key = $robot_data[0]['Robot']['api_key'];
		$api_secret = $robot_data[0]['Robot']['api_secret'];

		if($exchange_id == 2){
			$api = new Binance($api_key,$api_secret);
			$prevDay = $api->prevDay($trading_pair);
			$data = $prevDay['priceChangePercent'];
		}
		return $data;
	}



	public function get_api_credentials($exchange_id){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$robot_data = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
		return $robot_data;
	}

	public function get_robot_profit($robot_id){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$robot_data = $this->RobotTrade->getProfitByUser($user_id,$robot_id);
		return $robot_data;
	}

	public function convertBTCToUSD($btc){
		$data = file_get_contents('https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=USD');
		$obj = json_decode($data);
		//print_r($obj[0]->price_usd);exit;
		$usd = $obj[0]->price_usd * $btc;
		return $usd;
	}


	public function get_trading_pairs() {
		//$inst_id = 1;
		$exchange_id = $this->request->data['RobotTrade']['exchange_id'];
		$data = $this->TradingPair->listTradingPairForBotByExchange($exchange_id);
		// print_r($data);exit;
		$this->set('data',$data);
		$this->layout = 'ajax';
	}

	public function get_trading_pairs2() {
		//$inst_id = 1;
		$exchange_id = $this->request->data['RobotTradingCoin']['exchange_id'];
		$data = $this->TradingPair->listTradingPairForBotByExchange($exchange_id);
		// print_r($data);exit;
		$this->set('data',$data);
		$this->layout = 'ajax';
	}


	public function get_binance_price($symbol,$api_key,$api_secret,$quantity){
		$api = new Binance($api_key,$api_secret);

		$history = $api->history($symbol);
		$arr_sive = count($history);
		$arr_index = $arr_sive - 1;
		$price = $history[$arr_index]['price'];
		return $price * $quantity;
	}


/****************************************************** Robot Trading Coins ***********************************************************************/

	public function robot_trading_coins(){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$data = $this->RobotTradingCoin->getCoinByUserId($user_id);
		$exch = $this->Exchange->listExchanges();
		$this->set(compact('data','exch'));
	}

	public function new_trading_coin(){
  		$exch = $this->Exchange->listExchanges();
  		$this->set(compact('exch'));
  		if(!empty($this->data)){
  			$sess = $this->Auth->user();
  			$data = $this->request->data;

  			$trade_pair = $this->TradingPair->getTradingPairById($data['RobotTradingCoin']['trading_pair_id']);
  			$trade_pair = str_replace('/', '', $trade_pair[0]['TradingPair']['pair']);

  			$data['RobotTradingCoin']['symbol'] = $trade_pair;
  			$data['RobotTradingCoin']['date_added'] = date('Y-m-d H:i');
  			$data['RobotTradingCoin']['user_id'] = $sess['id'];
  			if($this->RobotTradingCoin->save($data)){
  				$this->Session->setFlash('Saved successfully');
  				$this->redirect('robot_trading_coins');
  			}
  		}
  	}

  	public function delete_trading_coin($id) {
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		if ($this->RobotTradingCoin->deleteCoin($id,$user_id)) {
			$this->Session->setFlash('Deleted Succesfully.');
			$this->redirect($this->referer());
		}
	}

/************************************************************************************************************************************/

	public function test_operation(){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$exchange_id = 2;
		$robot_data = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
		$api_key = $robot_data[0]['Robot']['api_key'];
		$api_secret = $robot_data[0]['Robot']['api_secret'];
		$api = new Binance($api_key,$api_secret);

		$bookPrices = $api->bookPrices();
		//print_r($bookPrices);
		echo "Bid price of IOTA: ".$bookPrices['IOTABTC']['bid'];
		exit;
	}

	public function binance_of_positions(){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$exchange_id = 2;
		$robot_data = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
		$api_key = $robot_data[0]['Robot']['api_key'];
		$api_secret = $robot_data[0]['Robot']['api_secret'];
		$api = new Binance($api_key,$api_secret);

		$ticker = 'BTC';
		$balances = $api->balances($ticker);
		echo "BTC owned: ".$balances['BTC']['available'].PHP_EOL;
		//echo "ETH owned: ".$balances['ETH']['available'].PHP_EOL;
		//echo "Total Balance in BTC: ".$tot_bal_in_btc." BTC".PHP_EOL;
		//echo "Estimated Value: ".$api->btc_value." BTC".PHP_EOL;
		exit;
	}


	public function get_order_status(){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$exchange_id = 2;
		$robot_data = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
		//print_r($robot_data);exit;
		$api_key = $robot_data[0]['Robot']['api_key'];
		$api_secret = $robot_data[0]['Robot']['api_secret'];
		$api = new Binance($api_key,$api_secret);

		$history = $api->history("ADABTC");
		$arr_sive = count($history);
		print_r($history);
		
		exit;
	}

  
}
?>