<?php

/**
 * Application - The main class
 *
 */
Class Application extends db
{

/*
 * Class Constants & Properties
*/
    const APPLICATION_SALT = 'angular';
    public $access_table = '';
    public $ses_name = 'frontend_admin_logged_in';
    public $logged_session_id = 'frontend_logged_id';
    public $logged_session_username = 'frontend_username';
    public $logged_session_email = 'frontend_user_email';
 	public $logged_session_name ='frontend_name';
        
    private static $appInstance;

/*
 * Public Methods
 */
    /*
     * Constructor
     */
     public function __construct() {
        //parent::__construct('localhost', 'root', '');
        //$this->selectdb('fueg');
		parent::__construct('localhost', 'root', 'root');
        $this->selectdb('crud-angular');
    } 


    /*
     * Singleton Instance 
     */
	public function getInstance() {
	
		if(!self::$appInstance) {
			
			self::$appInstance = new Application();
		}
		
		return self::$appInstance;
	}
	
    /*
     * method to validate login
     */
     public function login() { 

        $_SESSION[$this->ses_name] = false;
        $_SESSION[$this->logged_session_id] = '';
        $_SESSION['msg'] = '';
        $return_array = array();

        if(func_num_args() > 1) {
            $args = func_get_args();
            $return_array = $this->authenticate($args[0], $args[1]);

            if(is_array($return_array)) {

                $_SESSION[$this->ses_name] = true;
                $_SESSION[$this->logged_session_id] = $return_array[0]['id'];
				$_SESSION[$this->logged_session_name] = $return_array[0]['first_name'] . ' ' . $return_array[0]['last_name'];
                $_SESSION[$this->logged_session_username] = $return_array[0]['username'];
                $_SESSION[$this->logged_session_email] = $return_array[0]['email'];
                return true;
            }
            return false;
        }
        return false;
    }

    /*
     * method for logout operation
     */

     public function logout() {

		if(count($_SESSION) > 0) {
			foreach($_SESSION as $key => $value) {
				if(preg_match("/frontend_/", $key)) {
					unset($_SESSION[$key]);
				}	
			}
		}	
		 
    }

    /*
     * method used to check whether the user logged in or not
     */

     public function is_logged_in() {
        if($_SESSION[$this->ses_name] === true) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * method used for SELECT query operations
     */

    public function find($select = array('*'), $params = array('conditions' => array(), 'sort' => '', 'limit' => '', 'group' => '')) {

        $where_condition = array();
        $sort_order = '';
        $limit = '';
        $group_by = '';
        $params['conditions'] = (count($params['conditions']) > 0) ? $params['conditions'] : array('1 = ' => '1');

        foreach ($params['conditions'] as $k => $v ) $where_condition[] = "$k '".$this->escape(trim($v))."'";

        if(!empty($params['sort'])) {
            $sort_order .= 'ORDER BY ' . $params['sort'];
        }

        if(!empty($params['limit'])) {
            $limit .= 'LIMIT ' . $params['limit'];
        }

        if(!empty($params['group'])) {
            $group_by .= 'GROUP BY ' . $params['group'];
        }
 


         $result_array = $this->getrows('SELECT '
                        .implode(', ', $select).'
                        FROM
                        '.$this->access_table.'
                        WHERE
                        '.implode(' AND ', $where_condition)
                        .' '.$sort_order
                        .' '.$limit
                        .' '.$group_by
                       );
        return $result_array;
    }

    /*
     * method used for COUNT() query operations
     */

   public function find_count($params = array('conditions' => array())) {

        $where_condition = array();
        $params['conditions'] = (count($params['conditions']) > 0) ? $params['conditions'] : array('1 = ' => '1');
        foreach ($params['conditions'] as $k => $v ) $where_condition[] = "$k '".$this->escape(trim($v))."'";

        $result_array = $this->getrows('SELECT COUNT(id) AS count FROM '
                        .$this->access_table.'
                        WHERE
                        '.implode(' AND ', $where_condition)
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
		$qry = "INSERT INTO
                        ".$this->access_table."
                        (`".implode('`, `', array_keys($data))."`)
                        VALUES (".implode(", ", $data).")";
        $this->execute($qry);
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
 

        $this->execute("UPDATE  ".$this->access_table." SET
                       ".implode(', ', $update_data)." WHERE
                                     ".implode(' AND ', $where_condition));

    }

    /*
     * method used to DELETE records from the database
     */

    public function delete($where) {
 
		foreach ($where as $k => $v )  $where_condition[] = "$k IN ('".$v."')";
		
		$this->execute("DELETE FROM ".$this->access_table." WHERE ".implode(' AND ', $where_condition)); 
		
    }

    public function __destruct() {
        parent::__destruct();
    }


/*
 * Private Methods
 */

    /*
     * method used to authenticate user login
     */
    private function authenticate($username, $password)
    {
        $user = $this->find(array('*'), $params = array('conditions' => array('username = ' => $username)));

        if(count($user) > 0)
        {
            $expected_password = $this->encrypt_password($password);

            if(strcmp($user[0]['password'], $expected_password) != 0)
            {
                $_SESSION['msg'] = 'Invalid Password!';
                return false;
            }
            else
            {
                if($user[0]['status'] != '1')
                {
                    $_SESSION['msg'] = 'Account Blocked!';
                    return false;
                }
                else
                {
                    return $user;
                }
            }
        }
        else
        {
            $_SESSION['msg'] = 'Invalid Email!';
            return false;
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
?>
