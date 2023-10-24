<?php

/**

* Branch Model

* The Branch model connects to the tb_branches table in the website database.

 * @package    Website-CMS

 * @author     Victor Sena Aggor

 * @version    Version1.0

*/



class TradingPair extends AppModel{

    public $name = 'TradingPair';

	public $primaryKey = 'id';

	public $useTable = 'trading_pairs';





	public function getTradingPair(){

		$data = $this->find('all', array('conditions'=>array('deleted'=>0)));

		return $data;

	}



	public function getTradingPairById($id){

		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'id'=>$id)));

		return $data;

	}



	public function getTradingPairByExchange($exchange_id){

		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'exchange_id'=>$exchange_id)));

		return $data;

	}



	public function listTradingPairForBotByExchange($exchange_id){

		$data = $this->find('list', array('conditions'=>array('deleted'=>0,'exchange_id'=>$exchange_id,'BaseSymbol'=>'BTC'),'fields'=>array('id','pair')));

		return $data;

	}



	public function getTradingPairByExchangeAndPair($exchange_id,$pair){

		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'exchange_id'=>$exchange_id,'pair'=>$pair)));

		//print_r($data);exit;

		return $data;

	}



	public function addCryptopiaTradingPairs($exchange_id, $resp){

		$data = $resp->Data;

		$count = count($data);

		//print_r(count($data));exit;

		for( $i=0; $i < $count; $i++ ){

			$pair = $data[$i]->Label;

			$chk_trading_pair = $this->getTradingPairByExchangeAndPair($exchange_id,$pair);

			if(empty($chk_trading_pair)){

				$pair_data = array();

				$pair_data['TradingPair']['pair'] = $data[$i]->Label;

				$pair_data['TradingPair']['pair2'] = str_replace('/', '_', $data[$i]->Label);

				$pair_data['TradingPair']['Currency'] = $data[$i]->Currency;

				$pair_data['TradingPair']['Symbol'] = $data[$i]->Symbol;

				$pair_data['TradingPair']['BaseCurrency'] = $data[$i]->BaseCurrency;

				$pair_data['TradingPair']['BaseSymbol'] = $data[$i]->BaseSymbol;

				$pair_data['TradingPair']['exchange_id'] = $exchange_id;

				//print_r($pair_data);exit;

				$this->saveAll($pair_data['TradingPair']);

			}

		}

		return true;

	}



	public function addBinanceTradingPairs($exchange_id, $resp){

		$data = $resp->symbols;

		$count = count($data);

		//print_r($data);exit;

		for( $i=0; $i < $count; $i++ ){

			$Symbol = $data[$i]->baseAsset;

			$BaseSymbol = $data[$i]->quoteAsset;

			$pair = $Symbol.'/'.$BaseSymbol;

			$chk_trading_pair = $this->getTradingPairByExchangeAndPair($exchange_id,$pair);

			if(empty($chk_trading_pair)){

				$pair_data = array();

				$pair_data['TradingPair']['pair'] = $pair;

				$pair_data['TradingPair']['pair2'] = $Symbol.'_'.$BaseSymbol;

				$pair_data['TradingPair']['Symbol'] = $Symbol;

				$pair_data['TradingPair']['BaseSymbol'] = $BaseSymbol;

				$pair_data['TradingPair']['exchange_id'] = $exchange_id;

				//print_r($pair_data);exit;

				$this->saveAll($pair_data['TradingPair']);

			}

		}

		return true;

	}





}

?>