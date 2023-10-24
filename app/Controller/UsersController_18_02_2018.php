<?php
App::uses('CakeEmail', 'Network/Email');
  class UsersController extends AppController {
  public $name = 'Users';
  public $uses = array('User','Usergroup','Status');
  public $components = array('Session', 'Email', 'Auth' => array(
		        'authenticate' => array(
		            'Form' => array(
		                'userModel' => 'User',
						 'scope' => array('deleted'=>0,'status_id'=>1),
		                'fields' => array(
		                    'username' => 'email',
		                    'password' => 'password'
		                )
		            )
		        ),
		        'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
		        'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
		        'loginAction' => array('controller' => 'users', 'action' => 'login')
	    	)
		);
 
   // Not necessary if declared in your app controller
  
    /**
   * The AuthComponent provides the needed functionality
  * for login, so you can leave this function blank.
   */
 //--------------------------------------------------LOGIN START-------------------------------------------------------
public function beforeFilter() {
	$this->Auth->allow('reset_password','signup','activate');
	$this->Auth->deny('*');
	//parent::beforeFilter();
  }
  
  

public function login(){
		$this->set('page_title','Login');
		$this->layout = 'login';
	 if (!empty($this->request->data)) {
        if ($this->Auth->login()) {
            //$this->redirect($this->Auth->redirect());
			$this->Session->setFlash('You are logged In');
			$this->redirect('/dashboard/index');
        } else {
            $this->Session->setFlash('Your email or password is incorrect.','default',array('class'=>'error1'));
        }
    }
}


public function logout() {
   $this->redirect($this->Auth->logout());
}

//-------------------------------------------------LOGIN END-----------------------------------------------------------

public function index() {
	//print_r($ug);exit;
	$this->set('page_title','User Management');
	$this->set('page_title2','Active Users');

	$verified = $this->User->getUsersByStatus(1);
	$unverified = $this->User->getUsersByStatus(2);
	$disabled = $this->User->getDisabledUsers();
	$all_users = $this->User->getUsersByStatus(100);
	//print_r($all_users);exit;

	$ugs = $this->Usergroup->listUsergroups();
	$statuses = $this->Status->listStatuses();
	//print_r($statuses);exit;
	$this->set(compact('lcompanies','ugs','verified','unverified','all_users','disabled','statuses'));
}
  
public function new_user(){
	$this->set('page_title','User Management');
	$this->set('page_title2','New Users');
	$sess = $this->Auth->user();
	$ugs = $this->Usergroup->listUsergroups();
	$this->set(compact('lcompanies','ugs'));
	if(!empty($this->request->data)){
		$data=$this->request->data;
		
		$pass_plain = $this->User->generatePassword();

		$pass = $this->Auth->password($pass_plain);
		$data['User']['date_added'] = date('Y-m-d H:i');
		$data['User']['add_by'] = $sess['id'];

	//print_r($cpass);exit;
		$data['User']['status_id'] = 1;
		$data['User']['usergroup_id'] = 1;
		$data['User']['password'] = $pass;
		//print_r($data);exit;
		if($this->User->validates()){
			if($this->User->save($data)){
		
				$to = $data['User']['email'];
				$subject = 'Account activation';
				$message = '
				Your account has been created.

				Your default password is: '.$pass_plain.'

				Please login and change your password.
				
				Kind regards,
				
			
				';
				//CakeLog::write('info', $pass_plain);
				//$this->User->SendMailText($to,$subject,$message);
		
				$this->Session->setFlash('User has been successfully created');
				$this->redirect('/users/index');
			}
		}
	
	}
 }


 public function edit_user($id=null){
	$this->set('page_title','User Management');
	$this->set('page_title2','New Users');
	$sess = $this->Auth->user();
	$lcompanies = $this->Company->listCompanies();
	$ugs = $this->Usergroup->listUsergroups();
	$this->set(compact('lcompanies','ugs'));

	if(empty($this->request->data)){
		$data = $this->User->getUserById($id);
		$this->request->data = $data[0];
	}
	else{
		$data=$this->request->data;
		
		$pass_plain = $this->User->generatePassword();

		$pass = $this->Auth->password($pass_plain);
		$data['User']['date_modified'] = date('Y-m-d H:i');
		$data['User']['modified_by'] = $sess['id'];

		//print_r($data);exit;
		if($this->User->validates()){
			if($this->User->save($data)){
		
				$to = $data['User']['email'];
				$subject = 'Your account has been modified';
				$message = '
				Your account has been modified. Please notify us if this action was not taken by you.
				
				Kind regards,
				
			
				';
				//$this->User->SendMailText($to,$subject,$message);
		
				$this->Session->setFlash('Account has been successfully modified');
				$this->redirect('/users/index');
			}
		}
	
	}
 }


public function signup(){
	$this->set('page_title','User Management');
	$this->set('page_title2','New Users');
	//$this->layout = 'register';
	if(!empty($this->request->data)){
		$data=$this->request->data;
		
		$hash = md5(rand(0, 1000));
		$data['User']['hash'] = $hash;
		
		$pass = $this->Auth->password($data['User']['password']);
		$cpass = $this->Auth->password($data['User']['cpass']);
	//print_r($cpass);exit;
		$data['User']['date_added'] = date('Y-m-d H:i');
		$data['User']['add_by'] = 0;
		$data['User']['usergroup_id'] = 2;
		$data['User']['status_id'] = 2;

	if($pass == $cpass){
	//$data['User']['password'] = $this->Auth->password($data['User']['password']); 
		$data['User']['password'] = $pass;
		//print_r($data);exit;
			if($this->User->validates()){
				if($this->User->save($data)){
				
					$hash_url = 'http://localhost/coin_folio/app/users/activate/'.$hash;
					$to = $data['User']['email'];
					$subject = 'Account activation';
					$message = '
					Thank you for requesting an account at Enquire.

					To activate your account, we need to verify your E-mail address.
					If you ('.$to.') have requested the creation of this account,
					please activate your account by clicking the link below.

					'.$hash_url.
						
					'
						
					Kind regards,
					Enquire Team
					
					';
					//$this->User->SendMailText($to,$subject,$message);
					CakeLog::write('info', $hash_url);
					$this->Session->setFlash('Click on the activation link that has been sent to your inbox');
					$this->redirect('/users/signup');
				}
			}
		}else{
			$this->Session->setFlash('Password does not match','default',array('class'=>'error'));
			$this->render('signup');
		}
	}
}
  
 public function success(){
	
  }
  
 public function activate($hash=null){

 $search_user = $this->User->find('count', array('conditions'=>array('status_id'=>2,'deleted'=>0,'hash'=>$hash)));
 //print_r($search_user);exit;
if($search_user > 0){
$this->User->updateAll(array('status_id'=>'1'),array('hash'=>$hash,'deleted'=>0));
 $this->Session->setFlash('Your account has been successfully activated');
	$this->redirect('/users/login');
}
else{
 $data = $this->User->find('all', array('conditions'=>array('hash'=>$hash,'deleted'=>0)));
 @$status = $data[0]['User']['status_id'];
 if(empty($data)){
 $this->Session->setFlash('Your account does not exist, please sign up.');
	$this->redirect('/users/signup');
 }
 elseif($status == 1){
  $this->Session->setFlash('Your account has already been activated');
	$this->redirect('/users/login');
 }
  elseif($status == 3){
  $this->Session->setFlash('Your account has been disabled');
	$this->redirect('/users/login');
 }
}
  }
  
public function profile(){
	$sess = $this->Session->read();
	$sess = $sess['Auth']['User'];
	$data = $this->User->find('all', array('conditions'=>array('id'=>$sess['id'])));
	$this->set('data', $data);
}
  
public function edit_profile($id=null){		
 	$this->set('page_title','Profile');
	$this->set('page_title2','Edit Profile');
	if(empty($this->request->data)){
		if(empty($id)){
		$sess = $this->Session->read();
		$sess = $sess['Auth']['User'];
		$user_id = $sess['id'];
		}
		else{
			$user_id = $id;
		}
		$data=$this->User->find('all',array('deleted'=>0,'conditions'=>array('id'=>$user_id)));
		$this->request->data=$data[0];
	}	
	elseif(!empty($this->request->data)){
		$data=$this->request->data;
		//print_r($data);exit;					
		if($this->User->save($data)){	
			$this->Session->setFlash('Your profile has been successfully updated');
			$this->redirect('/users/list_enabled');
		}
	}
}
	
public function change_password(){
	$this->set('page_title','Users');
	$this->set('page_title2','Change Password');
	if(!empty($this->request->data)){
	 	$sess = $this->Session->read();
		$sess = $sess['Auth']['User'];
		
		$data = $this->request->data;
		$pass = $this->Auth->password($data['User']['password']);
		$cpass = $this->Auth->password($data['User']['cpass']);
		$opass = $this->Auth->password($data['User']['opass']);
		if($pass == $cpass){
		  	$find_user = $this->User->find('all',array('conditions'=>array('id'=>$sess['id'],'password'=>$opass)));
			if(!empty($find_user)){
				$this->User->updateAll(array('password'=>"'".$pass."'"),array('id'=>$sess['id']));
				$this->Session->setFlash('Your password has been successfully changed');
				$this->redirect('change_password');
			}
			else{
				$this->Session->setFlash('Your old password is wrong','default',array('class'=>'error'));
				$this->redirect('change_password');		}
		  	}
		else{
			$this->Session->setFlash('Password does not match','default',array('class'=>'error'));
			$this->redirect('change_password');
		}
	}
}
 
public  function reset_password($id=null){
	$this->set('page_title','Users');
	$this->set('page_title2','Reset Password');
		//$this->layout = 'reset_password';
	  /*if(!empty($this->request->data)){
	  $data = $this->request->data;*/
	  
	$default_pwd = $this->User->generatePassword();
	$pw = '"'.$this->Auth->password($default_pwd).'"';
	
	$search_user = $this->User->find('count', array('conditions'=>array('deleted'=>0,'id'=>$id)));

	  		if($search_user > 0){
			if($this->User->updateAll(array('password'=>$pw),array('id'=>$id))){
			 /*$from = 'noreply@accraairtravelcentre.com';
    		$to = $data['User']['email'];
    		$message = ' 
Dear user,

Your password has been reset and your temporal password is '.$default_pwd.'

Please change your password when you first login. 

			
  ';
  			$subject = 'Password reset';*/
			//$this->User->SendMailText($to,$subject,$message);
			$this->Session->setFlash('Your password has been reset to '.$default_pwd);
				}
			}
			else{
			$this->Session->setFlash('User does not exist. Kindly check the email and try again','default',array('class'=>'error'));
			}
	  //}
  }
  
 public function search($searched = null){
	  $pg_title = $page = 'Active Users';
	  $ug=$this->Usergroup->find('list',array('conditions'=>array('deleted'=>0),'fields'=>array('id','name')));
	$this->set('page_title',$pg_title);
	$this->set('ug2',$ug);
	   if(!empty($this->data)){
	   	$data = $this->data;
		//print_r($data);exit;
		$searched = '%'.$data['User']['keyword'].'%';
		$condition = array('name like'=>$searched);
		$this->paginate = array(
		'conditions' => $condition,
        'limit' => 20,
        'order' => array(
		//'status'=>'asc',
        'name' => 'asc'
        )
    	);
		$data = $this->paginate('User');
		$this->set('listitems', $data);	
	  $this->render('list_enabled');
	   } 
	  }	
  
public function disable($id) {
  	$status = 1;
	$resp = $this->User->changeUserStatus($id,$status);
	if($resp){
		$this->Session->setFlash('User Disabled Successfully.');
	}
	else{
		$this->Session->setFlash('Failed to disable.');
	}
	$this->redirect(array('action' => 'index'));
}
		
public function enable($id) {
  	$status = 0;
	$resp = $this->User->changeUserStatus($id,$status);
	if($resp){
		$this->Session->setFlash('User Enabled Successfully.');
	}
	else{
		$this->Session->setFlash('Failed to enable.');
	}
	$this->redirect(array('action' => 'index'));
}
		
	public function change_usergroup($id=null){
		$page_title = 'Change Usergroup';
		$this->set(compact('id','page_title'));
		 //$userg = $this->Usergroup ->find('list',array('conditions'=>array('deleted'=>0),'fields'=>array('id','name'),'order'=>'name asc'));
		   // $statuses = $this->Status ->find('list',array('conditions'=>array('deleted'=>0),'fields'=>array('id','name')));
			
		if(!empty($this->data)){
			$data = $this->request->data;
			//print_r($data);exit;
			if ($this->User->save($data)) {
		
		$this->Session->setFlash('Usergroup successfuly updated.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
  
  }
?>