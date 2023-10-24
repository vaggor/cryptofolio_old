<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/
App::import('Model', 'Robot');
class Binance extends AppModel{
    public $name = 'Binance';
	public $primaryKey = 'id';
	public $useTable = false;

	//protected $base = "https://api.binance.com/api/", $wapi = "https://api.binance.com/wapi/", $this->$api_key, $this->$api_secret;
	protected $base = "https://api.binance.com/api/";
	protected $wapi = "https://api.binance.com/wapi/";
	protected $depthCache = array();
	protected $depthQueue = array();
	protected $chartQueue = array();
	protected $charts = array();
	protected $info = array("timeOffset"=>0);
	public $balances = array();
	public $btc_value = 0.00; // value of available assets
	public $btc_total = 0.00; // value of available + onOrder assets
	public function __construct($api_key = '', $api_secret = '', $options = array("useServerTime"=>true)) {
		//print_r($api_key);exit;
		$this->api_key = $api_key;
		$this->api_secret = $api_secret;
		if ( isset($options['useServerTime']) && $options['useServerTime'] ) {
			$this->useServerTime();
		}
	}
	public function buy($symbol, $quantity, $price, $type = "LIMIT", $flags = array()) {
		return $this->order("BUY", $symbol, $quantity, $price, $type, $flags);
	}
	public function sell($symbol, $quantity, $price, $type = "LIMIT", $flags = array()) {
		return $this->order("SELL", $symbol, $quantity, $price, $type, $flags);
	}
	public function marketBuy($symbol, $quantity) {
		return $this->order("BUY", $symbol, $quantity, 0, "MARKET", $flags = array());
	}
	public function marketSell($symbol, $quantity) {
		return $this->order("SELL", $symbol, $quantity, 0, "MARKET", $flags = array());
	}
	public function cancel($symbol, $orderid) {
		//return $this->signedRequest("v3/order", ["symbol"=>$symbol, "orderId"=>$orderid], "DELETE");
		return $this->signedRequest("v3/order", array("symbol"=>$symbol, "orderId"=>$orderid), "DELETE");
	}
	public function orderStatus($symbol, $orderid) {
		return $this->signedRequest("v3/order", array("symbol"=>$symbol, "orderId"=>$orderid));
	}
	public function openOrders($symbol) {
		return $this->signedRequest("v3/openOrders",array("symbol"=>$symbol));
	}
	public function orders($symbol, $limit = 500) {
		return $this->signedRequest("v3/allOrders", array("symbol"=>$symbol, "limit"=>$limit));
	}
	public function history($symbol, $limit = 500) {
		return $this->signedRequest("v3/myTrades", array("symbol"=>$symbol, "limit"=>$limit));
	}
	public function useServerTime() {
		//$serverTime = $this->apiRequest("v1/time")['serverTime'];
		$serverTime = $this->apiRequest("v1/time");
		$this->info['timeOffset'] = $serverTime['serverTime'] - (microtime(true)*1000);
	}
	public function time() {
		return $this->apiRequest("v1/time");
	}
	public function exchangeInfo() {
		return $this->request("v1/exchangeInfo");
	}
	public function withdraw($asset, $address, $amount, $addressTag = false, $memo = false, $name = false) {
		//$options = ["asset"=>$asset, "address"=>$address, "amount"=>$amount, "memo"=>$memo, "name"=>$name, "wapi"=>true];
		$options = array("asset"=>$asset, "address"=>$address, "amount"=>$amount, "memo"=>$memo, "name"=>$name, "wapi"=>true);
		if ( $addressTag ) $options['addressTag'] = $addressTag;
		return $this->signedRequest("v3/withdraw.html", $options, "POST");
	}
	public function depositAddress($asset) {
		//$params = ["wapi"=>true, "asset"=>$asset];
		$params = array("wapi"=>true, "asset"=>$asset);
		return $this->signedRequest("v3/depositAddress.html", $params, "GET");
	}
	public function depositHistory($asset = false) {
		//$params = ["wapi"=>true];
		$params = array("wapi"=>true);
		if ( $asset ) $params['asset'] = $asset;
		return $this->signedRequest("v3/depositHistory.html", $params, "GET");
	}
	public function withdrawHistory($asset = false) {
		//$params = ["wapi"=>true];
		$params = array("wapi"=>true);
		if ( $asset ) $params['asset'] = $asset;
		return $this->signedRequest("v3/withdrawHistory.html", $params, "GET");
	}
	public function prices() {
		return $this->priceData($this->request("v3/ticker/price"));
	}
	public function bookPrices() {
		return $this->bookPriceData($this->request("v3/ticker/bookTicker"));
	}
	public function account() {
		return $this->signedRequest("v3/account");
	}
	public function prevDay($symbol) {
		return $this->request("v1/ticker/24hr", array("symbol"=>$symbol));
	}
	public function aggTrades($symbol) {
		return $this->tradesData($this->request("v1/aggTrades", array("symbol"=>$symbol)));
	}
	public function depth($symbol) {
		$json = $this->request("v1/depth",array("symbol"=>$symbol));
		if ( !isset($this->info[$symbol]) ) $this->info[$symbol] = array();
		$this->info[$symbol]['firstUpdate'] = $json['lastUpdateId'];
		return $this->depthData($symbol, $json);
	}
	public function balances($priceData = false) {
		return $this->balanceData($this->signedRequest("v3/account"),$priceData);
	}
	private function request($url, $params = array(), $method = "GET") {
		$opt = array(
			"http" => array(
				"method" => $method,
				"ignore_errors" => true,
				"header" => "User-Agent: Mozilla/4.0 (compatible; PHP Binance API)\r\n"
			)
		);
		$context = stream_context_create($opt);
		$query = http_build_query($params, '', '&');
		try {
			$data = file_get_contents($this->base.$url.'?'.$query, false, $context);
		} catch ( Exception $e ) {
			return array("error"=>$e->getMessage());
		}
		return json_decode($data, true);
	}
	private function signedRequest($url, $params = array(), $method = "GET") {
		//print_r($this->api_secret);exit;
		if ( empty($this->api_key) ) die("signedRequest error: API Key not set!");
		if ( empty($this->api_secret) ) die("signedRequest error: API Secret not set!");
		$base = $this->base;
		$opt = array(
			"http" => array(
				"method" => $method,
				"ignore_errors" => true,
				"header" => "User-Agent: Mozilla/4.0 (compatible; PHP Binance API)\r\nX-MBX-APIKEY: {$this->api_key}\r\n"
			)
		);
		$context = stream_context_create($opt);
		$ts = (microtime(true)*1000) + $this->info['timeOffset'];
		$params['timestamp'] = number_format($ts,0,'.','');
		if ( isset($params['wapi']) ) {
			unset($params['wapi']);
			$base = $this->wapi;
		}
		$query = http_build_query($params, '', '&');
		$signature = hash_hmac('sha256', $query, $this->api_secret);
		$endpoint = $base.$url.'?'.$query.'&signature='.$signature;
		try {
			$data = file_get_contents($endpoint, false, $context);
		} catch ( Exception $e ) {
			return array("error"=>$e->getMessage());
		}
		$json = json_decode($data, true);
		if ( isset($json['msg']) ) {
			echo "signedRequest error: {$data}".PHP_EOL;
		}
		return $json;
	}
	private function apiRequest($url, $method = "GET") {
		if ( empty($this->api_key) ) die("apiRequest error: API Key not set!");
		$opt = array(
			"http" => array(
				"method" => $method,
				"ignore_errors" => true,
				"header" => "User-Agent: Mozilla/4.0 (compatible; PHP Binance API)\r\nX-MBX-APIKEY: {$this->api_key}\r\n"
			)
		);
		$context = stream_context_create($opt);
		try {
			$data = file_get_contents($this->base.$url, false, $context);
		} catch ( Exception $e ) {
			return array("error"=>$e->getMessage());
		}
		return json_decode($data, true);
	}
	public function order($side, $symbol, $quantity, $price, $type = "LIMIT", $flags = array()) {
		$opt = array(
			"symbol" => $symbol,
			"side" => $side,
			"type" => $type,
			"quantity" => $quantity,
			"recvWindow" => 60000
		);
		if ( $type === "LIMIT" || $type === "STOP_LOSS_LIMIT" || $type === "TAKE_PROFIT_LIMIT" ) {
			$opt["price"] = $price;
			$opt["timeInForce"] = "GTC";
		}
		if ( isset($flags['stopPrice']) ) $opt['stopPrice'] = $flags['stopPrice'];
		if ( isset($flags['icebergQty']) ) $opt['icebergQty'] = $flags['icebergQty'];
		return $this->signedRequest("v3/order", $opt, "POST");
	}
	//1m,3m,5m,15m,30m,1h,2h,4h,6h,8h,12h,1d,3d,1w,1M
	public function candlesticks($symbol, $interval = "5m", $limit = null, $startTime= null, $endTime = null) {
		if ( !isset($this->charts[$symbol]) ) $this->charts[$symbol] = array();
		$opt = array(
		    "symbol" => $symbol,
		    "interval" => $interval
		);
		if ($limit) $opt["limit"] = $limit;
		if ($startTime) $opt["startTime"] = $startTime;
		if ($endTime) $opt["endTime"] = $endTime;
		
		$response = $this->request("v1/klines", $opt);
		$ticks = $this->chartData($symbol, $interval, $response);
		$this->charts[$symbol][$interval] = $ticks;
		return $ticks;
	}
	// Converts all your balances into a nice array
	// If priceData is passed from $api->prices() it will add btcValue & btcTotal to each symbol
	// This function sets $btc_value which is your estimated BTC value of all assets combined and $btc_total which includes amount on order
	private function balanceData($array, $priceData = false) {
		if ( $priceData ) $btc_value = $btc_total = 0.00;
		$balances = array();
		if ( empty($array) || empty($array['balances']) ) {
			echo "balanceData error: Please make sure your system time is synchronized, or pass the useServerTime option.".PHP_EOL;
			return array();
		}
		foreach ( $array['balances'] as $obj ) {
			$asset = $obj['asset'];
			//$balances[$asset] = ["available"=>$obj['free'], "onOrder"=>$obj['locked'], "btcValue"=>0.00000000, "btcTotal"=>0.00000000];
			$balances[$asset] = array("available"=>$obj['free'], "onOrder"=>$obj['locked'], "btcValue"=>0.00000000, "btcTotal"=>0.00000000);
			if ( $priceData ) {
				if ( $obj['free'] + $obj['locked'] < 0.00000001 ) continue;
				if ( $asset == 'BTC' ) {
					$balances[$asset]['btcValue'] = $obj['free'];
					$balances[$asset]['btcTotal'] = $obj['free'] + $obj['locked'];
					$btc_value+= $obj['free'];
					$btc_total+= $obj['free'] + $obj['locked'];
					continue;
				}
				$symbol = $asset.'BTC';
				if ( $symbol == 'USDTBTC' ) {
					$btcValue = number_format($obj['free'] / $priceData['BTCUSDT'],8,'.','');
					$btcTotal = number_format(($obj['free'] + $obj['locked']) / $priceData['BTCUSDT'],8,'.','');
				} elseif ( !isset($priceData[$symbol]) ) {
					$btcValue = $btcTotal = 0;
				} else {
					$btcValue = number_format($obj['free'] * $priceData[$symbol],8,'.','');
					$btcTotal = number_format(($obj['free'] + $obj['locked']) * $priceData[$symbol],8,'.','');
				}
				$balances[$asset]['btcValue'] = $btcValue;
				$balances[$asset]['btcTotal'] = $btcTotal;
				$btc_value+= $btcValue;
				$btc_total+= $btcTotal;
			}
		}
		if ( $priceData ) {
			uasort($balances, function($a, $b) { return $a['btcValue'] < $b['btcValue']; });
			$this->btc_value = $btc_value;
			$this->btc_total = $btc_total;
		}
		return $balances;
	}
	// Convert balance WebSocket data into array
	private function balanceHandler($json) {
		$balances = array();
		foreach ( $json as $item ) {
			$asset = $item->a;
			$available = $item->f;
			$onOrder = $item->l;
			$balances[$asset] = array("available"=>$available, "onOrder"=>$onOrder);
		}
		return $balances;
	}
	
	// Convert WebSocket ticker data into array
	private function tickerStreamHandler($json) {
		return array(
			"eventType" => $json->e,
			"eventTime" => $json->E,
			"symbol" => $json->s,
			"priceChange" => $json->p,
			"percentChange" => $json->P,
			"averagePrice" => $json->w,
			"prevClose" => $json->x,
			"close" => $json->c,
			"closeQty" => $json->Q,
			"bestBid" => $json->b,
			"bestBidQty" => $json->B,
			"bestAsk" => $json->a,
			"bestaskQty" => $json->A,
			"open" => $json->o,
			"high" => $json->h,
			"low" => $json->l,
			"volume" => $json->v,
			"quoteVolume" => $json->q,
			"openTime" => $json->O,
			"closeTime" => $json->C,
			"firstTradeId" => $json->F,
			"lastTradeId" => $json->L,
			"numTrades" => $json->n
		);
	}
	// Convert WebSocket trade execution into array
	private function executionHandler($json) {
		return array(
			"symbol" => $json->s,
			"side" => $json->S,
			"orderType" => $json->o,
			"quantity" => $json->q,
			"price" => $json->p,
			"executionType" => $json->x,
			"orderStatus" => $json->X,
			"rejectReason" => $json->r,
			"orderId" => $json->i,
			"clientOrderId" => $json->c,
			"orderTime" => $json->T,
			"eventTime" => $json->E
		);
	}
	// Convert kline data into object
	private function chartData($symbol, $interval, $ticks) {
		if ( !isset($this->info[$symbol]) ) $this->info[$symbol] = array();
		if ( !isset($this->info[$symbol][$interval]) ) $this->info[$symbol][$interval] = array();
		$output = array();
		foreach ( $ticks as $tick ) {
			list($openTime, $open, $high, $low, $close, $assetVolume, $closeTime, $baseVolume, $trades, $assetBuyVolume, $takerBuyVolume, $ignored) = $tick;
			$output[$openTime] = array(
				"open" => $open,
				"high" => $high,
				"low" => $low,
				"close" => $close,
				"volume" => $baseVolume,
				"openTime" =>$openTime,
				"closeTime" =>$closeTime
			);
		}
		$this->info[$symbol][$interval]['firstOpen'] = $openTime;
		return $output;
	}
	// Convert aggTrades data into easier format
	private function tradesData($trades) {
		$output = array();
		foreach ( $trades as $trade ) {
			$price = $trade['p'];
			$quantity = $trade['q'];
			$timestamp = $trade['T'];
			$maker = $trade['m'] ? 'true' : 'false';
			$output = array("price"=>$price, "quantity"=> $quantity, "timestamp"=>$timestamp, "maker"=>$maker);
		}
		return $output;
	}
	// Consolidates Book Prices into an easy to use object
	private function bookPriceData($array) {
		$bookprices = array();
		foreach ( $array as $obj ) {
			$bookprices[$obj['symbol']] = array(
				"bid"=>$obj['bidPrice'],
				"bids"=>$obj['bidQty'],
				"ask"=>$obj['askPrice'],
				"asks"=>$obj['askQty']
			);
		}
		return $bookprices;
	}
	// Converts Price Data into an easy key/value array
	private function priceData($array) {
		$prices = array();
		foreach ( $array as $obj ) {
			$prices[$obj['symbol']] = $obj['price'];
		}
		return $prices;
	}
	// Converts depth cache into a cumulative array
	public function cumulative($depth) {
		$bids = array(); $asks = array();
		$cumulative = 0;
		foreach ( $depth['bids'] as $price => $quantity ) {
			$cumulative+= $quantity;
			$bids = array($price, $cumulative);
		}
		$cumulative = 0;
		foreach ( $depth['asks'] as $price => $quantity ) {
			$cumulative+= $quantity;
			$asks = array($price, $cumulative);
		}
		return array("bids"=>$bids, "asks"=>array_reverse($asks));
	}
	// Converts Chart Data into array for highstock & kline charts
	public function highstock($chart, $include_volume = false) {
		$array = array();
		foreach ( $chart as $timestamp => $obj ) {
			$line = array(
				$timestamp,
				floatval($obj['open']),
				floatval($obj['high']),
				floatval($obj['low']),
				floatval($obj['close'])
			);
			if ( $include_volume ) $line = floatval($obj['volume']);
			$array = $line;
		}
		return $array;
	}
	// For WebSocket Depth Cache
	private function depthHandler($json) {
		$symbol = $json['s'];
		if ( $json['u'] <= $this->info[$symbol]['firstUpdate'] ) return;
		foreach ( $json['b'] as $bid ) {
			$this->depthCache[$symbol]['bids'][$bid[0]] = $bid[1];
			if ( $bid[1] == "0.00000000" ) unset($this->depthCache[$symbol]['bids'][$bid[0]]);
		}
		foreach ( $json['a'] as $ask ) {
			$this->depthCache[$symbol]['asks'][$ask[0]] = $ask[1];
			if ( $ask[1] == "0.00000000" ) unset($this->depthCache[$symbol]['asks'][$ask[0]]);
		}
	}
	// For WebSocket Chart Cache
	private function chartHandler($symbol, $interval, $json) {
		if ( !$this->info[$symbol][$interval]['firstOpen'] ) { // Wait for /kline to finish loading
			$this->chartQueue[$symbol][$interval] = $json;
			return;
		}
		$chart = $json->k;
		$symbol = $json->s;
		$interval = $chart->i;
		$tick = $chart->t;
		if ( $tick < $this->info[$symbol][$interval]['firstOpen'] ) return; // Filter out of sync data
		$open = $chart->o;
		$high = $chart->h;
		$low = $chart->l;
		$close = $chart->c;
		$volume = $chart->q; //+trades buyVolume assetVolume makerVolume
		$this->charts[$symbol][$interval][$tick] = array("open"=>$open, "high"=>$high, "low"=>$low, "close"=>$close, "volume"=>$volume);
	}
	// Gets first key of an array
	public function first($array) {
		//return array_keys($array)[0];
		return array_keys($array);
	}
	// Gets last key of an array
	public function last($array) {
		//return array_keys(array_slice($array, -1))[0];
		return array_keys(array_slice($array, -1));
	}
	// Formats nicely for console output
	public function displayDepth($array) {
		$output = '';
		foreach ( array('asks', 'bids') as $type ) {
			$entries = $array[$type];
			if ( $type == 'asks' ) $entries = array_reverse($entries);
			$output.= "{$type}:".PHP_EOL;
			foreach ( $entries as $price => $quantity ) {
				$total = number_format($price * $quantity,8,'.','');
				$quantity = str_pad(str_pad(number_format(rtrim($quantity,'.0')),10,' ',STR_PAD_LEFT),15);
				$output.= "{$price} {$quantity} {$total}".PHP_EOL;
			}
			//echo str_repeat('-', 32).PHP_EOL;
		}
		return $output;
	}
	// Sorts depth data for display & getting highest bid and lowest ask
	public function sortDepth($symbol, $limit = 11) {
		$bids = $this->depthCache[$symbol]['bids'];
		$asks = $this->depthCache[$symbol]['asks'];
		krsort($bids);
		ksort($asks);
		return array("asks"=> array_slice($asks, 0, $limit, true), "bids"=> array_slice($bids, 0, $limit, true));
	}
	// Formats depth data for nice display
	private function depthData($symbol, $json) {
		$bids = $asks = array();
		foreach ( $json['bids'] as $obj ) {
			$bids[$obj[0]] = $obj[1];
		}
		foreach ( $json['asks'] as $obj ) {
			$asks[$obj[0]] = $obj[1];
		}
		return $this->depthCache[$symbol] = array("bids"=>$bids, "asks"=>$asks);
	}
	////////////////////////////////////
	// WebSockets
	////////////////////////////////////
	// Pulls /depth data and subscribes to @depth WebSocket endpoint
	// Maintains a local Depth Cache in sync via lastUpdateId. See depth() and depthHandler()
	public function depthCache($symbols, $callback) {
		if ( !is_array($symbols) ) $symbols = array($symbols);
		$loop = \React\EventLoop\Factory::create();
		$react = new \React\Socket\Connector($loop);
		$connector = new \Ratchet\Client\Connector($loop, $react);
		foreach ( $symbols as $symbol ) {
			if ( !isset($this->info[$symbol]) ) $this->info[$symbol] = array();
			if ( !isset($this->depthQueue[$symbol]) ) $this->depthQueue[$symbol] = array();
			if ( !isset($this->depthCache[$symbol]) ) $this->depthCache[$symbol] = array("bids" => array(), "asks" => array());
			$this->info[$symbol]['firstUpdate'] = 0;
			$connector('wss://stream.binance.com:9443/ws/'.strtolower($symbol).'@depth')->then(function($ws) use($callback) {
				$ws->on('message', function($data) use($ws, $callback) {
					$json = json_decode($data, true);
					$symbol = $json['s'];
					if ( $this->info[$symbol]['firstUpdate'] == 0 ) {
						$this->depthQueue[$symbol][] = $json;
						return;
					}
					$this->depthHandler($json);
					call_user_func($callback, $this, $symbol, $this->depthCache[$symbol]);
				});
				$ws->on('close', function($code = null, $reason = null) {
					echo "depthCache({$symbol}) WebSocket Connection closed! ({$code} - {$reason})".PHP_EOL;
				});
			}, function($e) use($loop) {
				echo "depthCache({$symbol})) Could not connect: {$e->getMessage()}".PHP_EOL;
				$loop->stop();
			});
			$this->depth($symbol);
			foreach ( $this->depthQueue[$symbol] as $data ) {
				$this->depthHandler($json);
			}
			$this->depthQueue[$symbol] = array();
			call_user_func($callback, $this, $symbol, $this->depthCache[$symbol]);
		}
		$loop->run();
	}
	// Trades WebSocket Endpoint
	public function trades($symbols, $callback) {
		if ( !is_array($symbols) ) $symbols = array($symbols);
		$loop = \React\EventLoop\Factory::create();
		$react = new \React\Socket\Connector($loop);
		$connector = new \Ratchet\Client\Connector($loop, $react);
		foreach ( $symbols as $symbol ) {
			if ( !isset($this->info[$symbol]) ) $this->info[$symbol] = array();
			//$this->info[$symbol]['tradesCallback'] = $callback;
			$connector('wss://stream.binance.com:9443/ws/'.strtolower($symbol).'@aggTrade')->then(function($ws) use($callback) {
				$ws->on('message', function($data) use($ws, $callback) {
					$json = json_decode($data, true);
					$symbol = $json['s'];
					$price = $json['p'];
					$quantity = $json['q'];
					$timestamp = $json['T'];
					$maker = $json['m'] ? 'true' : 'false';
					$trades = array("price"=>$price, "quantity"=>$quantity, "timestamp"=>$timestamp, "maker"=>$maker);
					//$this->info[$symbol]['tradesCallback']($this, $symbol, $trades);
					call_user_func($callback, $this, $symbol, $trades);
				});
				$ws->on('close', function($code = null, $reason = null) {
					echo "trades({$symbol}) WebSocket Connection closed! ({$code} - {$reason})".PHP_EOL;
				});
			}, function($e) use($loop) {
				echo "trades({$symbol}) Could not connect: {$e->getMessage()}".PHP_EOL;
				$loop->stop();
			});
		}
		$loop->run();
	}
	// Pulls 24h price change statistics via WebSocket
	public function ticker($symbol, $callback) {
		$endpoint = $symbol ? strtolower($symbol).'@ticker' : '!ticker@arr';
		\Ratchet\Client\connect('wss://stream.binance.com:9443/ws/'.$endpoint)->then(function($ws) use($callback, $symbol) {
			$ws->on('message', function($data) use($ws, $callback, $symbol) {
				$json = json_decode($data);
				if ( $symbol ) {
					call_user_func($callback, $this, $symbol, $this->tickerStreamHandler($json));
				} else {
					foreach ( $json as $obj ) {
						$return = $this->tickerStreamHandler($obj);
						$symbol = $return['symbol'];
						call_user_func($callback, $this, $symbol, $return);
					}
				}
			});
			$ws->on('close', function($code = null, $reason = null) {
				echo "ticker: WebSocket Connection closed! ({$code} - {$reason})".PHP_EOL;
			});
		}, function($e) {
			echo "ticker: Could not connect: {$e->getMessage()}".PHP_EOL;
		});
	}
	// Pulls /kline data and subscribes to @klines WebSocket endpoint
	public function chart($symbols, $interval = "30m", $callback) {
		if ( !is_array($symbols) ) $symbols = array($symbols);
		$loop = \React\EventLoop\Factory::create();
		$react = new \React\Socket\Connector($loop);
		$connector = new \Ratchet\Client\Connector($loop, $react);
		foreach ( $symbols as $symbol ) {
			if ( !isset($this->charts[$symbol]) ) $this->charts[$symbol] = array();
			$this->charts[$symbol][$interval] = array();
			if ( !isset($this->info[$symbol]) ) $this->info[$symbol] = array();
			if ( !isset($this->info[$symbol][$interval]) ) $this->info[$symbol][$interval] = array();
			if ( !isset($this->chartQueue[$symbol]) ) $this->chartQueue[$symbol] = array();
			$this->chartQueue[$symbol][$interval] = array();
			$this->info[$symbol][$interval]['firstOpen'] = 0;
			//$this->info[$symbol]['chartCallback'.$interval] = $callback;
			$connector('wss://stream.binance.com:9443/ws/'.strtolower($symbol).'@kline_'.$interval)->then(function($ws) use($callback) {
				$ws->on('message', function($data) use($ws, $callback) {
					$json = json_decode($data);
					$chart = $json->k;
					$symbol = $json->s;
					$interval = $chart->i;
					$this->chartHandler($symbol, $interval, $json);
					//$this->info[$symbol]['chartCallback'.$interval]($this, $symbol, $this->charts[$symbol][$interval]);
					call_user_func($callback, $this, $symbol, $this->charts[$symbol][$interval]);
				});
				$ws->on('close', function($code = null, $reason = null) {
					echo "chart({$symbol},{$interval}) WebSocket Connection closed! ({$code} - {$reason})".PHP_EOL;
				});
			}, function($e) use($loop) {
				echo "chart({$symbol},{$interval})) Could not connect: {$e->getMessage()}".PHP_EOL;
				$loop->stop();
			});
			$this->candlesticks($symbol, $interval);
			foreach ( $this->chartQueue[$symbol][$interval] as $json ) {
				$this->chartHandler($symbol, $interval, $json);
			}
			$this->chartQueue[$symbol][$interval] = array();
			//$this->info[$symbol]['chartCallback'.$interval]($this, $symbol, $this->charts[$symbol][$interval]);
			call_user_func($callback, $this, $symbol, $this->charts[$symbol][$interval]);
		}
		$loop->run();
	}
	// Keep-alive function for userDataStream
	public function keepAlive() {
		$loop = \React\EventLoop\Factory::create();
		$loop->addPeriodicTimer(30, function() {
			$listenKey = $this->options['listenKey'];
			$this->apiRequest("v1/userDataStream?listenKey={$listenKey}", "PUT");
		});
		$loop->run();
	}
	// Issues userDataStream token and keepalive, subscribes to userData WebSocket
	public function userData(&$balance_callback, &$execution_callback = false) {
		$response = $this->apiRequest("v1/userDataStream", "POST");
		$listenKey = $this->options['listenKey'] = $response['listenKey'];
		$this->info['balanceCallback'] = $balance_callback;
		$this->info['executionCallback'] = $execution_callback;
		\Ratchet\Client\connect('wss://stream.binance.com:9443/ws/'.$listenKey)->then(function($ws) {
			$ws->on('message', function($data) use($ws) {
				$json = json_decode($data);
				$type = $json->e;
				if ( $type == "outboundAccountInfo") {
					$balances = $this->balanceHandler($json->B);
					$this->info['balanceCallback']($this, $balances);
				} elseif ( $type == "executionReport" ) {
					$report = $this->executionHandler($json);
					if ( $this->info['executionCallback'] ) {
						$this->info['executionCallback']($this, $report);
					}
				}
			});
			$ws->on('close', function($code = null, $reason = null) {
				echo "userData: WebSocket Connection closed! ({$code} - {$reason})".PHP_EOL;
			});
		}, function($e) {
			echo "userData: Could not connect: {$e->getMessage()}".PHP_EOL;
		});
	}


}
?>