<?php
App::uses('CakeEmail', 'Network/Email');
  class PortfoliosController extends AppController {
  public $name = 'Portfolios';
  public $uses = array('User','Coin','Portfolio','Dashboard');
  public $components = array('Session', 'Email','Auth');
  

	public function index(){
		$sess = $this->Auth->user();
		$data = $this->Portfolio->getPortfolioByUser($sess['id']);
		//print_r($data);exit;

		$this->set(compact('data'));
	}

	public function new_port(){
		if(!empty($this->request->data)){
			$data=$this->request->data;
			//print_r($data);exit;
			$data['Portfolio']['date_added'] = date('Y-m-d H:i');
			
			//print_r($data);exit;
			if($this->Portfolio->validates()){
				if($this->Portfolio->save($data)){
			
					$this->Session->setFlash('Saved successfully');
					$this->redirect('index');
				}
			}
		
		}
 	}


 	public function edit_coin($id=null){	

		if(empty($this->data)){
			//print_r($id);exit;
			$data=$this->Portfolio->getCoinById($id);
			$this->data=$data[0];
		}	
		elseif (!empty($this->data)) {
			$data = $this->request->data;

			$data['Portfolio']['date_modified'] = date('Y-m-d H:i');
		 
				//print_r($data);exit;
			if ($this->Portfolio->save($data)) {
				$this->Session->setFlash('Updated Successfully.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}


	public function delete($id) {
		if ($this->Portfolio->deletePortfolio($id)) {
			$this->Session->setFlash('Deleted Succesfully.');
			$this->redirect($this->referer());
		}
	}

  
}
?>