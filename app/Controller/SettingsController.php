<?php

App::uses('CakeEmail', 'Network/Email');

ini_set('max_execution_time', 300); //300 seconds = 5 minutes

class SettingsController extends AppController {

	public $name = 'Settings';

	public $uses = array('User','Coin','Webservice','Exchange','TradingPair');

	public $components = array('Session', 'Email');

  



	public function coins(){

		$data = $this->Coin->getCoins();

		$total_coin = $this->Coin->find('count',array('condition'=>array('deleted'=>0)));

		//print_r($data);exit;



		$this->set(compact('data','total_coin'));

	}



	public function new_coin(){

		if(!empty($this->request->data)){

			$data=$this->request->data;

			//print_r($data);exit;

			$chk_coin = $this->Coin->getCoinBySymbol($data['Coin']['symbol']);

			if(empty($chk_coin)){

				$data['Coin']['date_added'] = date('Y-m-d H:i');

			

				//--------------------------------------- Start Processing Doc uploded ------------------------------------------------

				if($data['Coin']['image']['size']!=0) {

				

					$data['Coin']['image'] = $this->Coin->uploadDocument($data['Coin']['image'],$data['Coin']['image']['name']);

				}

				else{

					$data['Coin']['image'] = NULL;

				}

				//print_r($doc);exit;

				//--------------------------------------- End Processing Doc uploded -------------------------------------------------

				//print_r($data);exit;

				if($this->Coin->validates()){

					if($this->Coin->save($data)){

						$this->Session->setFlash('Saved successfully');

					}

				}

			}

			else{

				$this->Session->setFlash($data['Coin']['symbol'].' has already been added','default',array('class'=>'error1'));

			}

			$this->redirect('/settings/coins');

		

		}

 	}





 	public function edit_coin($id=null){	



		if(empty($this->data)){

			//print_r($id);exit;

			$data=$this->Coin->getCoinById($id);

			$this->data=$data[0];

		}	

		elseif (!empty($this->data)) {

			$data = $this->request->data;



			$data['Coin']['date_modified'] = date('Y-m-d H:i');

		 

			//--------------------------------------- Start Processing Doc uploded ------------------------------------------------

			if($data['Coin']['image']['size']!=0) {

				

					$data['Coin']['image'] = $this->Coin->uploadDocument($data['Coin']['image'],$data['Coin']['name']);

			}

			else{

					$docs=$this->Coin->getDocumentByID($data['Coin']['id']);

					$data['Coin']['image'] = $docs[0]['Coin']['image'];

				}

				//print_r($data);exit;

				//--------------------------------------- End Processing Excel uploded -------------------------------------------------

				

				//print_r($data);exit;

				if ($this->Coin->save($data)) {

			

					$this->Session->setFlash('Updated Successfully.');

					$this->redirect(array('action' => 'coins'));

				}

		}

	}





	public function delete($id) {

		if ($this->Coin->deleteCoin($id)) {

			$this->Session->setFlash('Deleted Succesfully.');

			$this->redirect($this->referer());

		}

	}





	public function synch_trading_pair($webservice_sectio_id,$exchange_id){

		$api = $this->Webservice->getWebservicesByWebserviceSectionAndExcnage($webservice_sectio_id,$exchange_id);

		$url = $api[0]['Webservice']['name'];

		$data = $this->Webservice->postToCurl($url);

		$resp = json_decode($data);
		//print_r($data);exit;
		if($exchange_id == 1){ //Cryptopia Exchange

			$resp = $this->TradingPair->addCryptopiaTradingPairs($exchange_id, $resp);

		}

		elseif($exchange_id == 2){ //Binance Exchange

			$resp = $this->TradingPair->addBinanceTradingPairs($exchange_id, $resp);

		}

		

		$this->Session->setFlash('Synch Completed');

		$this->redirect('/dashboard/index');



	}



  

}

?>