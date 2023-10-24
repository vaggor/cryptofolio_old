<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Status extends AppModel{
    public $name = 'Status';
	public $primaryKey = 'id';
	public $useTable = 'status';


	public function listStatuses(){
			return $this->find('list', array('conditions'=>array('deleted'=>0),'fields'=>array('id','name')));
	}

}
?>