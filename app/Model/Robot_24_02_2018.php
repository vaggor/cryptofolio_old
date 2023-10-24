<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Robot extends AppModel{
    public $name = 'Robot';
	public $primaryKey = 'id';
	public $useTable = 'robots';


	public function getRobots(){
		return $this->find('all', array('conditions'=>array('deleted'=>0)));
	}

	public function countRobotsByUser($user_id){
		return $this->find('count', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id)));
	}

	public function getRobotByUserId($user_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id)));
	}

	public function getRobotById($user_id,$id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'id'=>$id)));
	}

	public function getRobotByUserIdAndExchange($user_id,$exchange_id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'exchange_id'=>$exchange_id)));
	}

	public function deleteRobot($id,$user_id){
		return $this->updateAll(array('deleted'=>'1'),array('id'=>$id,'user_id'=>$user_id));
	}

}
?>