<?php
include "db.class.php";

Class Application extends Db{
	public $tablename;
	 const APPLICATION_SALT = 'fueg';
	
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
						
							if($row['role_id'] == '1'){
								if($row['password'] == $this->encrypt_password($password)){
									
									$_SESSION['user_id'] = $row['id'];
									$_SESSION['email'] = $row['email'];
									$_SESSION['username'] = $row['username'];
									$_SESSION['is_logged_in'] = 1;
								
									header('location: dashboard.php');
									//return true;
								}else{
									  $_SESSION['error'] = "Please enter correct password for ".$email.".";
								}
							}else{
								 $_SESSION['error'] = "You are not authorized to view the dashboard.";
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
	/*
	public function find($qry){	
		 $res = $this->get_results($qry);		
		 if(!empty($res)){
			return $res; 
		 }
	}
	*/
	  /*
     * method used for SELECT query operations
     */

    public function find($select = array('*'), $params = array('conditions' => array(), 'sort' => '', 'operator' => 'AND', 'start' => '0','limit' => '', 'group' => '')) {

        $where_condition = array();
        $sort_order = '';
        $limit = '';
        $group_by = '';
        $params['conditions'] = (count($params['conditions']) > 0) ? $params['conditions'] : array('1 = ' => '1');

        foreach ($params['conditions'] as $k => $v ) $where_condition[] = "$k '".$this->escape(trim($v))."'";

        if(!empty($params['sort'])) {
            $sort_order .= 'ORDER BY ' . $params['sort'];
        }

        if(!empty($params['operator'])) {
            $operator = $params['operator'];
        }

        if(!empty($params['limit'])) {
            $limit .= 'LIMIT ' . $params['start'] .', ' .$params['limit'];
        }

        if(!empty($params['group'])) {
            $group_by .= 'GROUP BY ' . $params['group'];
        }
        
 
         $result_array = $this->getrows('SELECT '
                        .implode(', ', $select).'
                        FROM
                        '.$this->tablename.'
                        WHERE
                        '.implode(' '.$operator.' ', $where_condition)
                        .' '.$sort_order
                        .' '.$limit
                        .' '.$group_by
         );
        return $result_array;
    }

    /*
     * method used for COUNT() query operations
     */

   public function find_count($params = array('conditions' => array(), 'operator'=>'AND')) {

        $where_condition = array();
        $params['conditions'] = (count($params['conditions']) > 0) ? $params['conditions'] : array('1 = ' => '1');
        foreach ($params['conditions'] as $k => $v ) $where_condition[] = "$k '".$this->escape(trim($v))."'";

        $result_array = $this->getrows('SELECT COUNT(id) AS count FROM '
                        .$this->tablename.'
                        WHERE
                        '.implode(' '.$operator.' ', $where_condition)
                       );
        return $result_array[0]['count'];
    } 
	   
	

    /*
     * method used to INSERT records into database
     */

    public function add($data) {


        foreach ($data as $k => $v ) {
            if(strpos($k, 'password') !== false) {
                $v = $this->encrypt_password(trim($v));
            }
            $data[$k] = "'".$this->escape(trim($v))."'";
        }
 
        return $this->execute("INSERT INTO
                        ".$this->tablename."
                        (`".implode('`, `', array_keys($data))."`)
                        VALUES (".implode(", ", $data).")");
                        
    }

    /*
     * method used to UPDATE records in the database
     */

     public function save($data, $where = array(1 => 1)) {
	
        foreach ($data as $k => $v ) {
            if(strpos($k, 'password') !== false) {
                $v = $this->encrypt_password(trim($v));
            }
            $update_data[] = "$k = '".$this->escape(trim($v))."'";
        }

        foreach ($where as $k => $v ) $where_condition[] = "$k '".$this->escape($v)."'";
 

       return  $this->execute("UPDATE  ".$this->tablename." SET
                       ".implode(', ', $update_data)." WHERE
                                     ".implode(' AND ', $where_condition));

    }

    /*
     * method used to DELETE records from the database
     */

    public function delete($where) {
 
		foreach ($where as $k => $v )  $where_condition[] = "$k IN (".$v.")";
		
		$this->execute("DELETE FROM ".$this->tablename." WHERE ".implode(' AND ', $where_condition)); 
		
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
    
     /*
     * method used to encrypt passwords
     */

     public function encrypt_password($password) { 
 
        return base64_encode($password . '-' . self::APPLICATION_SALT);
    }

    /*
     * method used to decrypt passwords
     */

    public function decrypt_password($password) {
        $decode_password = explode("-", base64_decode($password));
        return $decode_password[0];
    }
 

	
	
}
