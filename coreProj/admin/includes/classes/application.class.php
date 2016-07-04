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
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  $_SESSION['error'] = "Please enter valid email.";
				}else{
					$qry = "select * from users where email = '".$email."'";
					
					$res = $this->get_results($qry);
					
					if(count($res) > 0){
						foreach($res as $row){							
							if($row['password'] == $password){
								
								$_SESSION['user_id'] = $row['id'];
								$_SESSION['email'] = $row['email'];
								$_SESSION['username'] = $row['username'];
								$_SESSION['is_logged_in'] = 1;
							
								header('location: dashboard.php');
								//return true;
							}else{
								  $_SESSION['error'] = "Please enter correct password for ".$email.".";
							}	
						}
					 }else{
						
						 $_SESSION['error'] = "Please enter correct email address and password.";
						  return false;
					 }	
					
				}
		}else{
			
			 if (empty($email)) {
				  $_SESSION['error'] = "Please enter your email.";
			 } else {
				  $_SESSION['error'] = "Please enter your password.";
			 }
			 return false;
		}
	}
	
	public function find($qry){	
		 $res = $this->get_results($qry);		
		 if(!empty($res)){
			return $res; 
		 }
	}
	
	public function get_countries(){	
		 $res = $this->find('select * from countries');		
		 if(!empty($res)){
			return $res; 
		 }
	}
	
	public function get_roles(){	
		 $roles = $this->find('select * from roles');		
		 if(!empty($roles)){
			return $roles; 
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
