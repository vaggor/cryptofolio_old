<?php
/*App::import('Component', 'Email');
App::uses('CakeEmail', 'Network/Email');*/
App::import('Model', 'Binance');
class PushTransactionTask extends Shell {

    var $uses = array('RobotTrade','Robot','User','Job','RobotTradingCoin','Invoice','Log');
	//var $uses = array('Staff','Template');
	
	public function postData(){
		$this->Job->updateLastRun(1); // 1 = job table id number 1
		$data = $this->RobotTrade->getAllActiveTrades();
		foreach($data as $data){
			$exchange_id = $data['RobotTrade']['exchange_id'];
			$trading_pair = $data['RobotTrade']['symbol'];
			$user_id = $data['RobotTrade']['user_id'];
			//print_r($user_id);exit;

			$current_price1 = $this->getCurrentPrice($trading_pair,$user_id,$exchange_id);
			//$current_price = '0.0011739';
			$current_price = $current_price1 * $data['RobotTrade']['buy_qty'];
			//$this->out(print_r($current_price));exit;

			$perc_chg = $this->get_perc_change($current_price,$data['RobotTrade']['buy_price']);
			//print_r($perc_chg);exit;
			$perc_profit = $perc_chg - $data['RobotTrade']['buy_perc_chg'];

			if(($perc_chg >= $data['RobotTrade']['threshold']) and ($perc_chg < $data['RobotTrade']['sell_perc_chg']) and ($current_price > $data['RobotTrade']['buy_price'])){
				$resp = $this->sell($data['RobotTrade']['id'],$exchange_id,$user_id,$perc_profit,$perc_chg);
				$this->RobotTradingCoin->updateRebuyPointByExchangeAndSymbol($exchange_id,$trading_pair,$user_id,$current_price1);

				$to = $this->User->getemailAddress($user_id);
				$this->RobotTrade->sendMessage($trading_pair,$to,round($perc_profit,2));
				$this->out($resp);
			}
			else{
				$this->RobotTrade->updatePercentage($perc_profit,$perc_chg,$data['RobotTrade']['id'],$current_price);
				$this->out('Percentage change has been updated');
			}
		}
		
	}


	public function auto_buy(){
		$this->Job->updateLastRun(2); // 2 = job table id number 2
		$data = $this->RobotTradingCoin->getActiveCoins();
		foreach ($data as $data) {
			$type = 'Buy';
			$user_id = $data['RobotTradingCoin']['user_id'];
			$exchange_id = $data['RobotTradingCoin']['exchange_id'];
			$symbol = $data['RobotTradingCoin']['symbol'];
			$trading_pair_id = $data['RobotTradingCoin']['trading_pair_id'];
			$rebuy_point = $data['RobotTradingCoin']['rebuy_point'];
			$app_balance = $this->User->getBalance($user_id);
			if($app_balance > 0){ // check if there is balance in application
				$chk_trade = $this->RobotTrade->countActiveTrade($user_id,$exchange_id,$symbol);
				if($chk_trade == 0){ // check if there is no active trade for symbol
					$exch_balance = $this->getBTCBalance($user_id,$exchange_id);
					if($exch_balance > 0){ // check if there is enough BTC in exchange
						if($data['RobotTradingCoin']['rebuy_point2'] == 0){
							$buy_price_limit = $this->calculateNewBuyPriceLimit($symbol,$user_id,$exchange_id);
						}
						else{
							$buy_price_limit = $data['RobotTradingCoin']['rebuy_point2'];
						}
						$current_price = $this->getCurrentPrice($symbol,$user_id,$exchange_id);
						if(($current_price <= $buy_price_limit and $current_price > $rebuy_point) or ($buy_price_limit == 0)){ // check if current price is less than previous sold price
							$quantity = $this->calculateTradingQuantity($user_id,$exchange_id,$symbol);
							$buy_resp = $this->buy($symbol,$trading_pair_id,$quantity,$exchange_id,$user_id,$current_price);
							if($buy_resp == 'FILLED'){
								$to = $this->User->getemailAddress($user_id);
								$this->RobotTrade->sendBuyMessage($symbol,$to);
								$this->out('Buy Order Succesfully FIlled');
							}
							else{
								$message = $buy_resp.'. Quantity = '.$quantity;
								$this->Log->saveLog($symbol,$user_id,$type,$message,$exchange_id);
								$this->out($buy_resp);
							}
						}
						else{
							$this->RobotTradingCoin->updateRebuyPoint($data['RobotTradingCoin']['id'],$user_id,$current_price);
							//$this->log('Symbol =>'.$symbol.', current_price =>'.$current_price.', buy_price_limit =>'.$buy_price_limit.', rebuy_point =>'.$rebuy_point);
							//$this->log('id =>'.$data['RobotTradingCoin']['id'].', current_price =>'.$current_price.', user_id =>'.$user_id);
							$message = 'Current price is greater than buy limit price';
							$this->Log->saveLog($symbol,$user_id,$type,$message,$exchange_id);
							$this->out('Current price is greater than buy limit price');
						}
					}
					else{
						//$this->log('Not enough balance in exchange =>'.$symbol);
						$message = 'Not enough balance in exchange';
						$this->Log->saveLog($symbol,$user_id,$type,$message,$exchange_id);
						$this->out('Not enough balance in exchange');
					}
				}
			}
			else{
				//$this->log('Not enough balance in application => '.$symbol);
				$message = 'Not enough balance in application';
				$this->Log->saveLog($symbol,$user_id,$type,$message,$exchange_id);
				$this->out('Not enough balance in application');
			}
		}
	}


	public function get_perc_change_from_api($exchange_id,$trading_pair,$user_id){
		
		$robot_data = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
		$api_key = $robot_data[0]['Robot']['api_key'];
		$api_secret = $robot_data[0]['Robot']['api_secret'];
		//print_r($trading_pair);exit;
		if($exchange_id == 2){
			$api = new Binance($api_key,$api_secret);
			$prevDay = $api->prevDay($trading_pair);
			//print_r($prevDay);exit;
			$data = $prevDay['priceChangePercent'];
		}
		return $data;
	}

	public function get_perc_change($current_price,$buy_price){
		
		$data = ((($current_price - $buy_price) / $buy_price) * 100);
		return $data;
	}

	public function sell($id,$exchange_id,$user_id,$perc_profit,$perc_chg){
  		$data = $this->RobotTrade->getTradeById($user_id,$id);
  		$user_id = $data[0]['RobotTrade']['user_id'];
  			//print_r($data);exit;
  		$cred = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
  		$api_key = $cred[0]['Robot']['api_key'];
  		$api_secret = $cred[0]['Robot']['api_secret'];

  		$trade_pair = $data[0]['RobotTrade']['symbol'];
  		$quantity = $data[0]['RobotTrade']['buy_qty'];
  		$exchange_id = $data[0]['RobotTrade']['exchange_id'];
  		$buy_price = $data[0]['RobotTrade']['buy_price'];


  		if($data[0]['RobotTrade']['exchange_id'] == 2){
  			if($this->updateData($api_key,$api_secret,$trade_pair,$quantity,$exchange_id,$id,$user_id,$perc_profit,$buy_price,$perc_chg)){
  				return 'Sell Order Succesfully FIlled';
  			}
  			else{
  				return 'Sell Order Failed';
  			}
  		}
  			
  	}

  	public function buy($symbol,$trading_pair_id,$quantity,$exchange_id,$user_id,$buy_price){
  		if($exchange_id == 2){ // Binance Exchange
  			$robot_data = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
			$api_key = $robot_data[0]['Robot']['api_key'];
			$api_secret = $robot_data[0]['Robot']['api_secret'];

			//$quantity = round($quantity);
			$buy_price = $buy_price * $quantity;

			$api = new Binance($api_key,$api_secret);
	  		$order = $api->marketBuy($symbol, $quantity);
	  		
	  		/*$order = array('symbol' => 'ADABTC',
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
	  			$data = array();
		  		$data['RobotTrade']['user_id'] = $user_id;
		  		$data['RobotTrade']['robot_id'] = $robot_data[0]['Robot']['id'];
		  		$data['RobotTrade']['exchange_id'] = $exchange_id;
		  		$data['RobotTrade']['trading_pair_id'] = $trading_pair_id;
		  		$data['RobotTrade']['symbol'] = $order['symbol'];
		  		$data['RobotTrade']['buy_orderId'] = $order['orderId'];
		  		$data['RobotTrade']['buy_clientOrderId'] = $order['clientOrderId'];
		  		$data['RobotTrade']['buy_price'] = $data['RobotTrade']['sell_price'] = $buy_price;
		  		$data['RobotTrade']['buy_qty'] = $quantity;
		  		$data['RobotTrade']['buy_perc_chg'] = $data['RobotTrade']['sell_perc_chg'] = 0;
		  		$data['RobotTrade']['buy_time'] = date('Y-m-d H:i');
		  		$data['RobotTrade']['threshold'] = $data['RobotTrade']['buy_perc_chg'] + 1;
		  		$data['RobotTrade']['status'] = 4;
		  		//print_r($data);exit;
		  		if($this->RobotTrade->saveAll($data)){
		  			return 'FILLED';
		  		}
	  		}
	  		else{
	  			return $order['msg'];
	  		}
  		}
  		

  	}


  	public function updateData($api_key,$api_secret,$trade_pair,$quantity,$exchange_id,$id,$user_id,$perc_profit,$buy_price,$perc_chg){
  		if($exchange_id == 2){
  			$api = new Binance($api_key,$api_secret);
	  		$order = $api->marketSell($trade_pair, $quantity);

	  		/*$order = array('symbol' => 'ADABTC',
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
	  		
	  		if($order['status'] == 'FILLED'){
	  			$price = $this->get_binance_price($trade_pair,$api_key,$api_secret,$quantity);
	  			$data = array();
		  		$data['RobotTrade']['id'] = $id;
		  		$data['RobotTrade']['sell_orderId'] = $order['orderId'];
		  		$data['RobotTrade']['sell_clientOrderId'] = $order['clientOrderId'];
		  		$data['RobotTrade']['perc_profit'] = $this->get_perc_change($price,$buy_price);;
		  		$data['RobotTrade']['profit'] = $price - $buy_price;
		  		$data['RobotTrade']['sell_price'] = $price;
		  		$data['RobotTrade']['sell_qty'] = $quantity;
		  		$data['RobotTrade']['sell_perc_chg'] = $perc_chg;
		  		$data['RobotTrade']['sell_time'] = date('Y-m-d H:i');
		  		$data['RobotTrade']['status'] = 5;
		  		//print_r($data);exit;
		  		if($this->RobotTrade->save($data)){
		  			$this->User->updateBalanceAfterSell($user_id,$data['RobotTrade']['profit']);
		  			$chk_add_profit = $this->RobotTradingCoin->getAddProfit($user_id,$exchange_id,$trade_pair);
		  			if($chk_add_profit == 1){
		  				$this->RobotTradingCoin->add_profit_to_trading_amount($user_id,$exchange_id,$trade_pair,$data['RobotTrade']['profit']);
		  			}
		  			$this->RobotTradingCoin->update_profit($user_id,$exchange_id,$trade_pair,$data['RobotTrade']['profit']);
		  			
		  			return $data['RobotTrade']['perc_profit'];
		  		}
	  		}
	  		else{
	  			return 0;
	  		}
  		}
  		
  	}

  	public function get_binance_price($symbol,$api_key,$api_secret,$quantity){
		$api = new Binance($api_key,$api_secret);

		$history = $api->history($symbol);
		$arr_sive = count($history);
		$arr_index = $arr_sive - 1;
		$price = $history[$arr_index]['price'];
		return $price * $quantity;
	}

	public function getCurrentPrice($symbol,$user_id,$exchange_id){
  			//print_r($data);exit;
		if($exchange_id == 2){
			$cred = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
	  		$api_key = $cred[0]['Robot']['api_key'];
	  		$api_secret = $cred[0]['Robot']['api_secret'];
			$api = new Binance($api_key,$api_secret);

			$bookPrices = $api->bookPrices();
			$result = $bookPrices[$symbol]['bid'];
		}
		//print_r($bookPrices);
		return $result;
	}

	public function getBTCBalance($user_id,$exchange_id){
		if($exchange_id == 2){
			$robot_data = $this->Robot->getRobotByUserIdAndExchange($user_id,$exchange_id);
			$api_key = $robot_data[0]['Robot']['api_key'];
			$api_secret = $robot_data[0]['Robot']['api_secret'];
			$api = new Binance($api_key,$api_secret);

			$ticker = 'BTC';
			$balances = $api->balances($ticker);
			$result = $balances['BTC']['available'];
		}
		return $result;
	}

	/*public function calculateTradingQuantity($user_id,$exchange_id,$symbol){
		$no_robot_trading_coin = $this->RobotTradingCoin->countcoins($user_id,$exchange_id);
		$no_active_trades = $this->RobotTrade->countActiveTradeWithoutSymbol($user_id,$exchange_id);
		$no_coins = $no_robot_trading_coin - $no_active_trades;
		if($no_coins > 0){
			$bal = $this->getBTCBalance($user_id,$exchange_id);
			$tradeing_amount = $bal / $no_coins;
			$current_price = $this->getCurrentPrice($symbol,$user_id,$exchange_id);
			$quantity = $tradeing_amount / $current_price;
		}
		else{
			$quantity = 0;
		}
		return $quantity;
	}*/

	public function calculateTradingQuantity($user_id,$exchange_id,$symbol){
		$tradeing_amount = $this->RobotTradingCoin->getTradingLimit($user_id,$exchange_id,$symbol);
		if(!empty($tradeing_amount)){
			$current_price = $this->getCurrentPrice($symbol,$user_id,$exchange_id);
			$quantity = round(($tradeing_amount / $current_price),2);
		}
		else{
			$quantity = 0;
		}
		//print_r($quantity);exit;
		return $quantity;
	}

	public function calculateNewBuyPriceLimit($symbol,$user_id,$exchange_id){
		$previous_buy_price = $this->RobotTrade->getLastBuyPrice($user_id,$exchange_id,$symbol);
		$previous_sell_price = $this->RobotTrade->getLastSellPrice($user_id,$exchange_id,$symbol);
		if($previous_buy_price == 0 and $previous_sell_price == 0){
			$new_buy_price_limit = 0;
		}
		else{
			//$current_price = $this->getCurrentPrice($symbol,$user_id,$exchange_id);
			$new_buy_price_margin = (($previous_sell_price - $previous_buy_price) / 2);
			$new_buy_price_limit = $previous_buy_price + $new_buy_price_margin;
		}
		return $new_buy_price_limit;

	}

	/********************************************** Invoice *******************************************************************/

	public function updateInvoiceStatus(){
		$this->Job->updateLastRun(3); // 3 = job table id number 3
		$data = $this->Invoice->getAllPendingInvoices();
		foreach($data as $data){
			$url = 'https://api.blockcypher.com/v1/btc/main/addrs/'.$data['Invoice']['address'];
			$json_obj = json_decode(file_get_contents($url),true);
			//print_r($json_obj);exit;
			if($json_obj['n_tx'] == 1){
				$txn_data = $json_obj['txrefs'][0];
				if($txn_data['confirmations'] >= 5){
					$id = $data['Invoice']['id'];
					$status = 8;
					if($this->Invoice->updateInvoiceStatus($id,$status)){
						$user_id = $data['Invoice']['user_id'];
						$old_bal = $this->User->getBalance($user_id);
						$balance = $old_bal + $data['Invoice']['amount'];
						$this->User->updateBalance($user_id,$balance);
						$this->out('Uodate successful');
					}
					else{
						$this->out('Uodate failed');
					}
				}
				else{
					$this->out('Confirmation is less than 5');
				}
			}
			else{
				$this->out('There is no transaction on the blockchain');
			}
		}
		
	}

}
?> 
