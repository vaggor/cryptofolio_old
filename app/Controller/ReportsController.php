<?php
App::uses('CakePdf', 'CakePdf.Pdf');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
class ReportsController extends AppController {

	public $name = 'Reports';
	public $components = array('Auth','Session','Email','RequestHandler');
	public $uses=array('User','Binance','Robot','TradingPair','Exchange','User','RobotTrade','Status','RobotTradingCoin','Invoice','Ticker');
	public $helpers = array('Form', 'Html', 'Text','Time', 'Number', 'Session', 'Paginator', 'Js', 'Cache');
   	
	public function index() {
		$exch = $this->Exchange->listExchanges();
		$status = $this->Status->listStatuses();
		//$trad_pair = $this->TradingPair->listTradingPairs();
		$robot = $this->Robot->listRobots();
		
		$this->set(compact('exch','status','trad_pair','robot'));	
		$sess = $this->Auth->user();
		if(!empty($this->data)){
		$data = $this->request->data;
		//print_r($data);exit;

		$date_from = $data['RobotTrade']['date_from'];
		$date_to = $data['RobotTrade']['date_to'];
		$user_id = $sess['id'];

		$extention_id = @$data['RobotTrade']['extention_id'];
		$trading_pair_id = @$data['RobotTrade']['trading_pair_id'];
		$robot_id = @$data['RobotTrade']['robot_id'];
		
		/*if($date_from == '--'){
		$date_from = '';
		}
		if($date_to == '--'){
		$date_to = '';
		}*/
		
		$condition =array();
		if($date_from and !$date_to) $condition[]="last_updated >= '$date_from' ";	
		if($date_to and !$date_from) $condition[]="last_updated <= '$date_to' ";	
		//if($date_to and $date_from) $condition[]="last_updated  between  '$date_from' and '$date_to' ";	
		if($date_to and $date_from){ 
			$date_from = $date_from.' 00:00';
			$date_to = $date_to.' 23:59';
			$condition[]="last_updated >= '$date_from' and last_updated <='$date_to' ";
		}	
		
		if($extention_id) $condition[]="extention_id = '$extention_id' ";	
		if($trading_pair_id) $condition[]="trading_pair_id = '$trading_pair_id' ";
		if($robot_id) $condition[]="robot_id = '$robot_id' ";
		$condition = implode ( ' and ' , $condition );
		$table = 'robot_trades';
		$sql="select * from $table where $condition and deleted = 0 and status = 5 and user_id = '".$sess['id']."' order by sell_time";
		//print_r($sql);exit;
		$rs=$this->RobotTrade->query($sql);
		//print_r($rs);exit;
		$this->set('data',$rs);
		/*if(empty($date_from)){
		$date_from = 0;
		}
		if(empty($date_to)){
		$date_to = 0;
		}
		if(empty($invoice_no)){
		$invoice_no = 0;
		}
		if(empty($receipt_no)){
		$receipt_no = 0;
		}
		if(empty($teller_name)){
		$teller_name = 0;
		}
		if(empty($department)){
		$department = 0;
		}*/
		
		//$this->set(compact('date_from','date_to','extention_id','status','trading_pair_id','robot_id'));
		}
	
	}
	
	
	public function daily_report(){
		$page = 'Daily Report';
		if(!empty($this->data)){
			$data = $this->request->data;
			//print_r($data);exit;

			$date_from = $data['RobotTrade']['date_from'];
			$date_to = $data['RobotTrade']['date_to'];
			if(empty($date_to)){
				$date_to = date('Y-m-d');
			}
			//print_r($date_to);exit;
			$sdate = $date_from;
			$start    = new DateTime($sdate);
			//$start->modify('first day of this month');
			$end      = new DateTime($date_to);
			//$end->modify('first day of next month');
			$interval = DateInterval::createFromDateString('1 day');
			$period1  = new DatePeriod($start, $interval, $end);
			$period = array();
			$i=0;
			foreach ($period1 as $dt) {
			    $period[$i] = $dt->format("Y-m-d");
			    $i++;
			}
			//$period = array_reverse($period, true);;
			//print_r($period);exit;
		}
		$this->set(compact('period','page'));
		
	}

	public function monthly_report(){
		$page = 'Monthly Report';
		$sdate = (date('Y')-3).'-01-01';
		$start    = new DateTime($sdate);
		$start->modify('first day of this month');
		$end      = new DateTime(date('Y-m-d'));
		$end->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period1  = new DatePeriod($start, $interval, $end);
		
		$period = array();
		$i=0;
		foreach ($period1 as $dt) {
		    $period[$i] = $dt->format("Y-m");
		    $i++;
		}
		$period = array_reverse($period, true);;
		//print_r($period);exit;
		$this->set(compact('period','page'));
	}

	public function yearly_report(){
		$page = 'Yearly Report';
		$sdate = (date('Y')-3).'-01-01';
		$start    = new DateTime($sdate);
		$start->modify('first day of this month');
		$end      = new DateTime(date('Y-m-d'));
		$end->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 year');
		$period1  = new DatePeriod($start, $interval, $end);
		
		$period = array();
		$i=0;
		foreach ($period1 as $dt) {
		    $period[$i] = $dt->format("Y");
		    $i++;
		}
		$period = array_reverse($period, true);;
		//print_r($period);exit;
		$this->set(compact('period','page'));
	}

	public function get_monthly_report_data($date){
		//print_r($date);exit;
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$data = $this->RobotTrade->getCLosedTradesByMonth($date,$user_id);
		return $data;
	}
	
	public function get_trading_pairs2() {
		//$inst_id = 1;
		$exchange_id = $this->request->data['RobotTrade']['exchange_id'];
		$data = $this->TradingPair->listTradingPairForBotByExchange($exchange_id);
		// print_r($data);exit;
		$this->set('data',$data);
		$this->layout = 'ajax';
	}

	public function graph_data($symbol){
		//print_r($coin_id);exit;
		$coin = $this->Ticker->getCoinBySymbol($symbol);
		$url = 'https://api.coinmarketcap.com/v1/ticker/'.$coin[0]['Ticker']['name'].'/';
		$resp = json_decode(file_get_contents($url,true));

		return $resp;
	}
	
	
}
?>
