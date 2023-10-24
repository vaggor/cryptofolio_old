<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Coin extends AppModel{
    public $name = 'Coin';
	public $primaryKey = 'id';
	public $useTable = 'coins';


	public function listCoins(){
		return $this->find('list', array('conditions'=>array('deleted'=>0),'fields'=>array('id','name')));
	}

	public function getCoins(){
		return $this->find('all', array('conditions'=>array('deleted'=>0),'order'=>'name asc'));
	}

	public function getCoinById($id){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'id'=>$id)));
	}

	public function getCoinBySymbol($symbol){
		return $this->find('all', array('conditions'=>array('deleted'=>0,'symbol'=>$symbol)));
	}

	public function getDocumentByID($id){
		return $items = $this->find('all',array('conditions'=>array('id'=>$id,'deleted'=>0)));
	}

	public function deleteCoin($id){
		return $this->updateAll(array('deleted'=>'1'),array('id'=>$id));
	}

	public function uploadDocument($data,$serial){
		//print_r($data);exit;
		//--------------------------------------- Start Processing Doc uploded ------------------------------------------------
		
			$file = new File($data['tmp_name']);
			$ext = $data['name'];
			$point = strrpos($ext,".");
				
			$ext = substr($ext,$point+1,(strlen($ext)-$point));
			$ext=strtolower($ext);
			$types = array('jpg','jpeg','png');
			if (!in_array($ext,$types)) {
				$path ='';
			} 
			else {
				ini_set('date.timezone', 'Europe/London');   
				//$now = $doc_type[$data['Document']['doc_typeid']].'_'.date('Y-m-d_H-i-s');
				$now = str_replace('.','_',$serial).'_'.date('H-i-s');
				$name= $now;
				$filename = $name.'.'.$ext;
				$data1 = $file->read();
				$file->close();
				
				$path=WWW_ROOT.'img/coins/'.$filename;
				$file = new File(WWW_ROOT.'img/coins/'.$filename,true);
				$file->write($data1);
				//echo "whoop";
				$path = $filename;
			}
			//--------------------------------------- End Processing Excel uploded -------------------------------------------------
			
			return $path;
	}

}
?>