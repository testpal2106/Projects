<?php

class Validator {

	public static function validate_data($class) {

		$args = func_get_args();
		if(func_num_args() == 1) {
			$data = ( isset( $_POST['pval'] ) ) ? $_POST['pval'] : $_GET['pval'];
		} else {
			$data = $args[1];
		}
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}


	public static function validate_data_ival ($class) {

		$data = ( isset( $_POST['ival'] ) ) ? $_POST['ival'] : $_GET['ival'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}
public static function validate_data_name ($class) {

		$data = ( isset( $aval) ) ? $aval : $aval;
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}


public static function validate_data_rval ($class) {

		$data = ( isset( $_POST['rval'] ) ) ? $_POST['rval'] : $_GET['rval'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}



public static function validate_data_rope ($class) {

		$data = ( isset( $_POST['sval'] ) ) ? $_POST['sval'] : $_GET['sval'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}

public static function validate_data_twine ($class) {

		$data = ( isset( $_POST['bval'] ) ) ? $_POST['bval'] : $_GET['bval'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}

public static function validate_data_tval ($class) {

		$data = ( isset( $_POST['tval'] ) ) ? $_POST['tval'] : $_GET['tval'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}

public static function validate_data_lines ($class) {

		$data = ( isset( $_POST['cval'] ) ) ? $_POST['cval'] : $_GET['cval'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}
public static function validate_data_lval ($class) {

		$data = ( isset( $_POST['lval'] ) ) ? $_POST['lval'] : $_GET['lval'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}



public static function validate_data_aval ($class) {

		$data = ( isset( $_POST['aval'] ) ) ? $_POST['aval'] : $_GET['aval'];
		$vars  = get_class_vars($class);
		
		if (count( $vars) > 0 ) {
			foreach ($vars as $key => $value) {
				if( strpos( $key, '_text' ) === false ) {
					$missing_vals = self::$key($data, $value);

					if (count( $missing_vals ) > 0) {
						return '#'.implode(', #', $missing_vals) . '@@@' . $key . '_text';
					}
				}
			}
		}
	}


	public static function check_required (&$data, $fields) {

		$missing_vals = array();

		foreach ($fields as $field) {

			$data[$field] = trim($data[$field]);

			if (empty( $data[$field] )) {

				$missing_vals[$field] = 'required';

			}  else if (strpos( $field, 'name' ) !== false) {

				/*if (!preg_match( "/^[a-zA-Z0-9-_|&'\"\. ]+$/", $data[$field] )) {
					$missing_vals[$field] = 'invalid';
				}*/
			}
		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

		return;
	}

	public static function check_file_uploaded (&$data, $fields) {
		$missing_vals = array();
		if(count($fields) > 0) {
			foreach($fields as $field) {
				$file_size = $_FILES[$field]['size'];

				if($file_size <= 0) {
					$missing_vals[$field] = 'required';
				}
			}
		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

	}

	public static function check_image_max_dimensions (&$data, $args) {
		$missing_vals = array();

		foreach($args as $key => $value) {
			$dimensions = getimagesize($_FILES[$key]['tmp_name']);

			if($dimensions[0] > $value[0] || $dimensions[1] > $value[1]) {
				$missing_vals[$field] = 'invalid';
			}

		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

	}

	public static function check_image_min_dimensions (&$data, $args) {
		$missing_vals = array();

		foreach($args as $key => $value) {
			$dimensions = getimagesize($_FILES[$key]['tmp_name']);

			if($dimensions[0] < $value[0] || $dimensions[1] < $value[1]) {
				$missing_vals[$field] = 'invalid';
			}

		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

	}

	public static function check_min_length ($data, $args) {

		$missing_vals = array();

		foreach ($args[0] as $field) {

			if (strlen ($data[$field]) < $args[1]) {
				$missing_vals[$field] = 'invalid';
			}
		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

		return;

	}


	public static function check_max_length ($data, $args) {

		$missing_vals = array();

		foreach ($args[0] as $field) {

			if (strlen ($data[$field]) > $args[1]) {
				$missing_vals[$field] = 'invalid';
			}
		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

		return;

	}

	public static function check_duplication($data, $fields) {

		$missing_vals = array();
		$select_fields = array( 'id' );
		$app = $GLOBALS['app'];
		$uval = $GLOBALS['uval'];	
		
		foreach ($fields as $field) {

			$where['conditions'] = array( "$field LIKE " => $data[$field] );

			if ($uval['id']) {
				$where['conditions'] = array("$field LIKE " => $data[$field], 'id != ' => $uval['id']);
			}

			$result = $app->find($select_fields, $where);
			//print_r($result);

			if (count( $result ) > 0) {
				$missing_vals[$field] = 'duplicate';
				return array_keys($missing_vals);
			}

		}

		return;

	}
	 
	

	public static function is_url_valid(&$data, $fields) {

		$missing_vals = array();
		foreach ($fields as $field) {
			if(!preg_match('|^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $data[$field])) {
				$missing_vals[$field] = 'invalid';
			}
		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

	}

		public static function check_valid_email (&$data, $fields) {

		//print_r($data);exit;

		$missing_vals = array();

		foreach ($fields as $field) {
				$data[$field] = trim(strtolower($data[$field]));
				if($data[$field]!="")
				{
 				if (!preg_match( "/^[A-Z0-9._%+-]+@(?:[A-Z0-9-]+\.)+[A-Z]{2,4}$/i", $data[$field] )) {
						$missing_vals[$field] = 'invalid';
					}
				}
			}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}

		return;
	}

	 

 public static function compare_strings ($data, $args) {

		$missing_vals = array();

		if(count($args) == 2) {
			if (strcmp($data[$args[0]], $data[$args[1]]) <> 0) {
				$missing_vals[$args[1]] = INVALID;
			}
		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}
		return;

	}
 public static function compare_strings_two ($data, $args) {

		$missing_vals = array();

		if(count($args) == 2) {
			if (strcmp($data[$args[0]], $data[$args[1]]) <> 0) {
				$missing_vals[$args[1]] = INVALID;
			}
		}

		if (count( $missing_vals ) > 0) {
			return array_keys($missing_vals);
		}
		return;

	}

}

?>