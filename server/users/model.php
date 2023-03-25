<?php
require_once '../../server/connection.php';

class Users {

	function __construct(){
    }

    public static function currentUser(){
		session_start();
		
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$id = $_SESSION['entrance']['id'];
			$query1 ="SELECT id,username,email,mobileno,fname,lname,level FROM userdata WHERE id = '$id' LIMIT 1;";
	        $result = $mysqli->query($query1);
	        if($result){
	            if($row = $result->fetch_assoc()){
	                $_SESSION['entrance'] = $row;
	                return print_r(json_encode($_SESSION['entrance']));
	            }
	        }
	    }
	}


	public function create($data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$username = $mysqli->real_escape_string($data['username']);
			$password = $mysqli->real_escape_string($data['password']);
			$fname = $mysqli->real_escape_string($data['fname']);
			$lname = $mysqli->real_escape_string($data['lname']);
			$email = $mysqli->real_escape_string($data['email']);
			$mobileno = $mysqli->real_escape_string($data['mobileno']);
			$level = $mysqli->real_escape_string($data['level']);

			if ($stmt = $mysqli->prepare('INSERT INTO userdata(username,password,str_password,fname,lname,email,mobileno,level) VALUES(?,?,?,?,?,?,?,?)')){
				$stmt->bind_param("ssssssss", $username,sha1($password),$password,$fname,$lname,$email,$mobileno,$level);
				$stmt->execute();
				print json_encode(array('success' =>true,'msg' =>'Record successfully saved'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
			}
		}        
	}

	public function read(){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{

			$query1 ="SELECT id,username,email,mobileno,fname,lname,level FROM userdata c WHERE c.level <> 'Student' LIMIT 1,30000000;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(['success' =>true,'users' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM userdata c WHERE id=$id LIMIT 1;";
			$mysqli->set_charset("utf8");
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'user' =>$row),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"No record found!"),JSON_PRETTY_PRINT);
			}
		}
	}

	public function update($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$username = $mysqli->real_escape_string($data['username']);
			$password = $mysqli->real_escape_string($data['password']);
			$fname = $mysqli->real_escape_string($data['fname']);
			$lname = $mysqli->real_escape_string($data['lname']);
			$email = $mysqli->real_escape_string($data['email']);
			$mobileno = $mysqli->real_escape_string($data['mobileno']);
			$level = $mysqli->real_escape_string($data['level']);

			if ($stmt = $mysqli->prepare('UPDATE userdata SET username=?,password=?,str_password=?,fname=?,lname=?,email=?,mobileno=?,level=? WHERE id=?')){
				$stmt->bind_param("sssssssss", $username,sha1($password),$password,$fname,$lname,$email,$mobileno,$level,$id);
				$stmt->execute();
				print json_encode(array('success' =>true,'msg' =>'Record successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public function delete($id){
		$config= new Config();		
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare("DELETE FROM userdata WHERE id =?")){
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->close();
			print json_encode(array('success' =>true,'msg' =>'Record successfully deleted'),JSON_PRETTY_PRINT);
		}else{
			print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
		}
	}

	public static function updateAccount($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$username = $mysqli->real_escape_string($data['username']);
			$password = $mysqli->real_escape_string($data['password']);

			if ($stmt = $mysqli->prepare('UPDATE userdata SET username=?,password=?,str_password=? WHERE id=?')){
				$stmt->bind_param('ssss',$username,sha1($password),$password,$id);
				$stmt->execute();

				print json_encode(array('success' =>true,'status'=>200,'msg' =>'User Account successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'status'=>200,'msg' =>'Error message: %s\n', $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function updateProfile($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$fname = $mysqli->real_escape_string($data['fname']);
			$lname = $mysqli->real_escape_string($data['lname']);
			$email = $mysqli->real_escape_string($data['email']);
			$mobileno = $mysqli->real_escape_string($data['mobileno']);

			if ($stmt = $mysqli->prepare('UPDATE userdata SET fname=?,lname=?,email=?,mobileno=? WHERE id=?')){
				$stmt->bind_param('sssss', $fname,$lname,$email,$mobileno,$id);
				$stmt->execute();
				print json_encode(array('success' =>true,'status'=>200,'msg' =>'User Profile successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'status'=>200,'msg' =>'Error message: %s\n', $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function check($field,$value){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM userdata c WHERE LCASE(REPLACE(c.$field,' ','')) LIKE '%$value%';";
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'msg' =>'Warning: Data already existed!!!'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'No record found!'),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function checkName($lastname,$firstname){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM userdata c WHERE ((LCASE(REPLACE(c.lname,' ','')) LIKE '%$lastname%') AND (LCASE(REPLACE(c.fname,' ','')) LIKE '%$firstname%'));";
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'msg' =>'Warning: User Account already existed!!!'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'No record found!'),JSON_PRETTY_PRINT);
			}
		}
	}
}
?>
