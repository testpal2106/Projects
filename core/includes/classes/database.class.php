<?php

Class db{
	private $user;
	private $pass;
	private $host;
	private $db;
	
	public function __constuct(){
		$num_args = func_num_args();
		if($num_args > 0){
			$args = func_get_args();
			$this->host = $args[0];
			$this->user = $args[1];
			$this->pass = $args[2];
			$this->db = $args[3];
			$this->connect();
			
		}
		
	}
	
	public function mysqli_installed(){
		if(fucntion_exists('mysqli_connect'))
			return true;
		else
			return false;
		
	}
	
	//create database connection
	private function connect(){
		try {
			if($this->mysqli_installed()){
				if(!$this->db == mysqli_connect($this->host, $this->user, $this->pass) ){
					$exceptionstring = "Error in establishing connection to database: <br>";
					$exceptionstring .= mysqli_connect_errno() . ' : ' . mysqli_connect_error();
					throw new exception $exceptionstring;					
				}
			}else{				
				if(!$this->db == mysql_connect($this->host, $this->user, $this->pass) ){					
					$exceptionstring = "Error in establishing connection to database: <br>";
					$exceptionstring .= mysql_errno() . ' : ' . mysql_error();
					throw new exception $exceptionstring;					
				}				
			}			
		} catch( $exception e){
			$e->getmessage();
		}
	}
}
