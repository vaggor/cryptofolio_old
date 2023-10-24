<?php
class User extends AppModel {

	public $name = 'User';
	public $primaryKey = 'id';
	public $useTable = 'users';
	

	public $validate = array(
			'email' => array( 
            	'notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'The Email field cannot be left blank'
 				),
             	'unique' => array( 
                	'rule' => array('checkUnique', 'email'), 
                	'message' => 'Email alread in use. Please Use another.' 
            	) 
          	),
			
			'username' => array( 
            	'notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Username field cannot be left blank'
 				),
             	'unique' => array( 
                	'rule' => array('checkUnique', 'username'), 
                	'message' => 'Your screen name has already been taken' 
            	) 
          	),
			
          	'name'=>array('notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Please provide your Full Name'
 				)),
 				'cpass'=>array('notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Please Confirm your password'
 				)),
			'opass'=>array('notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Please enter old password'
 				)),
				'usergroup'=>array('notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Please select a user group'
 				)),
			'password'=> array( 
				 'notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Password cannot be left blank'
 				))
			 
			
		); 
	
	
	/*function checkPasswords($data){ 
          if($this->request->data['User']['password'] == $this->request->data['User']['cpass']){ 
             return true; }
          else{return false;}
      }*/
      
	function checkUnique($data, $fieldName) { 
            $valid = false; 
            if(isset($fieldName) && $this->hasField($fieldName)) { 
             $valid = $this->isUnique(array($fieldName => $data)); 
            } 
            return $valid; 
  	}
  	
  	public function getUserById($id){
		return $this->find('all', array('conditions'=>array('id'=>$id)));
	}

	public function getemailAddress($id){
		$data = $this->find('all', array('conditions'=>array('id'=>$id),'fields'=>array('email')));
		return $data[0]['User']['email'];
	}

	public function getUsersByStatus($status){

		if($status == 100){
			return $this->find('all');
		}
		else{
			return $this->find('all', array('conditions'=>array('status_id'=>$status,'deleted'=>0)));
		}
		
	}

	public function getDisabledUsers(){

		return $this->find('all', array('conditions'=>array('deleted'=>1)));
		
	}

	public function generatePassword(){
		$chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789';
		$shuffle = str_shuffle($chars);
		$default_pwd = substr($shuffle,0,8);
		return $default_pwd;
	}

	public function changeUserStatus($id,$status){
		$resp = $this->updateAll(array('User.deleted' => $status),array('User.id' => $id));
		return $resp;
	}

	public function getBalance($id){
		$data = $this->find('all', array('conditions'=>array('id'=>$id),'fields'=>array('balance')));
		return $data[0]['User']['balance'];
	}

	public function updateBalanceAfterSell($id,$profit){
		$prev_bal = $this->getBalance($id);
		if($profit > 0){
			$prof_perc = 0.1 * $profit; // 0.1 = 10% charge
		}
		else{
			$prof_perc = 0;
		}
		$balance = $prev_bal - $prof_perc;
		$resp = $this->updateBalance($id,$balance);
		return $resp;
	}

	public function updateBalance($id,$balance){
		$resp = $this->updateAll(array('User.balance' => $balance),array('User.id' => $id));
		return $resp;
	}
  	
  	
	
}
?>