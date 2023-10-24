<?php
App::uses('CakeEmail', 'Network/Email');
  class TransactionsController extends AppController {
  public $name = 'Transactions';
  public $uses = array('User','Coin','Transaction','TransactionType','Status','Usergroup');
  public $components = array('Session', 'Email');
  

public function index(){
	$buy_txns = $this->Transaction->getTransactionsByTxnType(1); //Buy transaction
	$sell_txns = $this->Transaction->getTransactionsByTxnType(2); //Buy transaction
	//print_r($resp[1]);exit;
	$this->set(compact('buy_txns','sell_txns'));
}

public function trx_by_coin($coin){
	$buy_txns = $this->Transaction->getTransactionsByCoinType($coin,1); //Buy transaction
	$sell_txns = $this->Transaction->getTransactionsByCoinType($coin,2); //Buy transaction
	//print_r($resp[1]);exit;
	$this->set(compact('buy_txns','sell_txns'));
	$this->render('index');
}

  
  }
?>