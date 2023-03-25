<?php
require_once '../../server/connection.php';
require_once('../../server/pagination.php');

class Category {

	function __construct(){}

	public static function create($data){
		$config= new Config();

		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$category_name = $mysqli->real_escape_string($data['category_name']);
			$time = $data['time'];
			if ($stmt = $mysqli->prepare('INSERT INTO category(name,time) VALUES(?,?)')){
				$stmt->bind_param('ss', $category_name,$time);
				$stmt->execute();
				print json_encode(array('success' =>true,'msg' =>'Record successfully saved'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'Error message: %s\n'. $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function read(){
		$config= new Config();
		$func = new Functions();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query1 ="SELECT * FROM category c;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'category' =>$data),JSON_PRETTY_PRINT);
		}
	}

	public static function readCategoryQuiz(){
		$config= new Config();
		$func = new Functions();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$studid = $_SESSION['entrance_student']['studid'];
			$query1 ="SELECT c.*, (SELECT r.score FROM result r WHERE r.category_id=c.id AND r.stud_id='$studid' LIMIT 1) AS score FROM category c;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'category' =>$data),JSON_PRETTY_PRINT);
		}
	}

	public static function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM category c WHERE c.id=$id;";
			$mysqli->set_charset('utf8');
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'category' =>$row),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'No record found!'),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function update($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$category_name = $mysqli->real_escape_string($data['category_name']);
			$time = $data['time'];
			
			if ($stmt = $mysqli->prepare('UPDATE category SET `name`=?,time=? WHERE id=?')){
				$stmt->bind_param('ssi', $category_name,$time,$id);
				$stmt->execute();
				print json_encode(array('success' =>true,'msg' =>'Record successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'Error message: %s\n'. $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function delete($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare('DELETE FROM category WHERE id =?')){
			$stmt->bind_param('s', $id);
			$stmt->execute();
			$stmt->close();
			print json_encode(array('success' =>true,'msg' =>'Record successfully deleted'),JSON_PRETTY_PRINT);
		}else{
			print json_encode(array('success' =>false,'msg' =>'Error message: %s\n'. $mysqli->error),JSON_PRETTY_PRINT);
		}
	}

	public static function check($field,$value){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM category c WHERE LCASE(REPLACE(c.$field,' ','')) LIKE '%$value%';";
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'msg' =>'Warning: Data already existed!!!'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'No record found!'),JSON_PRETTY_PRINT);
			}
		}
	}
}
?>