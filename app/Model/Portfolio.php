<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Portfolio extends AppModel{
    public $name = 'Portfolio';
	public $primaryKey = 'id';
	public $useTable = 'portfollios';

	public function getPortfolioByUser($user_id){
		$data = $this->find('all',array('conditions'=>array('user_id'=>$user_id,'deleted'=>0)));
		return $data;
	}

	public function getPortfolioByCoin($coin){
		$data = $this->find('all',array('conditions'=>array('coin_id'=>$coin,'deleted'=>0)));
		return $data;
	}

	public function getPortfolioById($id){
		$data = $this->find('all',array('conditions'=>array('id'=>$id,'deleted'=>0)));
		return $data;
	}

	public function getTransactions(){
		$data = $this->find('all',array('conditions'=>array('deleted'=>0)));
		return $data;
	}

	public function deletePortfolio($id){
		return $this->updateAll(array('deleted'=>'1'),array('id'=>$id));
	}

}
?>