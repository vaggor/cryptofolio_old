<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Log extends AppModel{
    public $name = 'Log';
	public $primaryKey = 'id';
	public $useTable = 'logs';


	public function getLogs(){
			return $this->find('all', array('conditions'=>array('deleted'=>0)));
	}

	public function saveLog($symbol,$user_id,$type,$message,$exchange_id){
		$data = array();
		$data['Log']['symbol'] = $symbol;
		$data['Log']['user_id'] = $user_id;
		$data['Log']['type'] = $type;
		$data['Log']['exchange_id'] = $exchange_id;
		$data['Log']['message'] = $message;
		$data['Log']['date'] = date('Y-m-d H:i');
		if(!empty($data)){
			$this->saveAll($data);
		}
	}

}
?>