<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Webservice extends AppModel{
    public $name = 'Webservice';
	public $primaryKey = 'id';
	public $useTable = 'webservices';


	public function listWebservices(){
			return $this->find('list', array('conditions'=>array('deleted'=>0),'fields'=>array('id','name')));
	}

	public function getWebservices(){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0)));
		return $data;
	}

	public function getWebservicesByExchange($exchange_id){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'exchange_id'=>$exchange_id)));
		return $data;
	}

	public function getWebservicesByWebserviceSection($webservice_sectio_id){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'webservice_sectio_id'=>$webservice_sectio_id)));
		return $data;
	}

	public function getWebservicesByWebserviceSectionAndExcnage($webservice_section_id,$exchange_id){
		$data = $this->find('all', array('conditions'=>array('deleted'=>0,'webservice_section_id'=>$webservice_section_id,'exchange_id'=>$exchange_id)));
		return $data;
	}

}
?>