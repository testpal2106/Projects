<?php
include "db.class.php";

Class Application extends Db{
	public $table;
	
	public function __construct(){	
		parent::__construct('localhost', 'root', 'root', 'coreProj');
        
	}
	
	public function login(){		
		session_start();
		$email = isset($_POST['email']) ? $_POST['email']: ''; 
		$password = isset($_POST['password']) ? $_POST['password']: ''; 

		if(!empty($email) && !empty($password) ){
			
			$qry = "select * from users where email = '".$email."'";
			
			$res = $this->get_results($qry);
			
			if(count($res) > 0){
				foreach($res as $row){
					
					if($row['password'] == $password){
						
						$_SESSION['user_id'] = $row['id'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['is_logged_in'] = 1;
						return true;
					}	
				}
			 }else{
				 return false;
				 $_SESSION['error'] = "Please enter correct email address.";
			 }	
		}else{
			 return false;
			 $_SESSION['error'] = "Please fill the required fields.";
		}
	}
	
	public function find($qry){	
		 $res = $this->get_results($qry);		
		 if(!empty($res)){
			return $res; 
		 }
	}
	
	
     public function logout() {

		if(count($_SESSION) > 0) {
			foreach($_SESSION as $key => $value) {
				if(preg_match("/backend_/", $key)) {
					unset($_SESSION[$key]);
				}	
			}
		}	
		 
    }
	
	
}
