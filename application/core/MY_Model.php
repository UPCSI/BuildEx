<?php

class MY_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function query_row_conversion($query){
		/*if you're expecting a single element from your query, use this
		* and it will return your object [instead of array of objects]
		*/

		if($query->num_rows == 1){
			$data = $query->row();
			$query->free_result();
			return $data;
		}

		return null;
	}

	public function query_conversion($query){
		/* this is a more generic parser of query,
		* this will return an array of objects corresponding to each row
		*/
		if($query->num_rows()>0){
			foreach ($query->result() as $row){
				$data[] = $row;
			}
			$query->free_result();
			return $data;
		}
		return null;
	}

	public function my_hash($password){
		/* password encryptor, returns the hashed string */
		$salt = '$6$rounds=10000$iNt3ll3Q$@al!N@mGaKup$s=$';
		$hash = crypt($password,$salt);
		return $hash;
	}

	public function is_rows_affected(){
		/* return true if the database affected tables' elements base on
		* its last query 
		*/
		return $this->db->affected_rows()!=0;
	}

}