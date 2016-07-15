<?php

Class Db{
	
	public $host;
	public $user;
	public $pass;
	public $db;
	public $dbname;
	
	public function __construct(){
		$num_args = func_num_args();
        if($num_args > 0){
            $args = func_get_args();
            $this->host = $args[0];
            $this->user = $args[1];
            $this->pass = $args[2];
            $this->dbname = $args[3];
            $this->connect_database($this->host, $this->user, $this->pass, $this->dbname);
        }
	}
	
	public function connect_database($host, $username, $password, $db){
		
		if(!empty($host) && !empty($username) && !empty($password) && !empty($db)){
			$this->db = mysqli_connect($host, $username,$password);
			
			if(!$this->db ){
				echo "There is an error in database connectivity.". mysqli_connect_error();
				die();
			}else{
				$db_selected = mysqli_select_db($this->db, $db);
				if (!$db_selected) {
					echo "There is an error in database selection.". mysqli_error();
					die();
				}else{
					//echo "connected selected";
				}
							
			}
		}		
	}
	
	
	public function p($data){
		return	print_r($data);
	}
	
	
	public function get_results($query){
			
		if ($result = $this->db->query($query)) {
				
			$returnarr = array();
			while ($row = $result->fetch_assoc()) {
				$returnarr[] = $row;
			}
			return $returnarr;
		}

	}
	
	public function execute($thequery){
			if (!$this->db->query ($thequery)){
				$exceptionstring = "Error performing query: $thequery: <br />";
				$exceptionstring .= $this->db->errno . ": " . $this->db->error;
				throw new exception ($exceptionstring);
			} else {
				return $this->db->insert_id;
				/*echo "Query performed correctly: " . $this->db->affected_rows . ".
				row(s) affected.<br />";*/
			}
	}
	
	 //Function to return a row set.
    public function getrows ($thequery){
		if ($result = $this->db->query ($thequery)){
			$returnarr = array ();
			while ($adata = $result->fetch_assoc ()){
				$returnarr[] = $adata;
			}
			if(count($returnarr) > 0) {
				return $returnarr;
			}
		} else {
			$exceptionstring = "Error performing query: $thequery: <br />";
			$exceptionstring .= $this->db->errno . ": " . $this->db->error;
			throw new exception ($exceptionstring);
		}
    }
    
     public function escape($str) {
       return addslashes($str);
    }



	
}

