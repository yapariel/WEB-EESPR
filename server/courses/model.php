<?php
require_once '../../server/connection.php';
require_once('../../server/pagination.php');

class Courses {

	function __construct(){}

	public static function create($data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$coursecode = $mysqli->real_escape_string($data['coursecode']);
			$coursename = $mysqli->real_escape_string($data['coursename']);
			$passing_score = $mysqli->real_escape_string($data['passing_score']);
			if ($stmt = $mysqli->prepare('INSERT INTO courses(coursecode,coursename,passing_score) VALUES(?,?,?)')){
				$stmt->bind_param("sss", $coursecode,$coursename,$passing_score);
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
			$query1 ="SELECT * FROM courses c;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(['success' =>true,'courses' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public static function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM courses c WHERE id=$id LIMIT 1;";
			$mysqli->set_charset("utf8");
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'course' =>$row),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"No record found!"),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function update($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$coursecode = $mysqli->real_escape_string($data['coursecode']);
			$coursename = $mysqli->real_escape_string($data['coursename']);
			$passing_score = $mysqli->real_escape_string($data['passing_score']);

			if ($stmt = $mysqli->prepare('UPDATE courses SET coursecode=?, coursename=?,passing_score=? WHERE id=?')){
				$stmt->bind_param("ssss", $coursecode,$coursename,$passing_score,$id);
				$stmt->execute();
				print json_encode(array('success' =>true,'msg' =>'Record successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function delete($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare("DELETE FROM courses WHERE id =?")){
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->close();
			print json_encode(array('success' =>true,'msg' =>'Record successfully deleted'),JSON_PRETTY_PRINT);
		}else{
			print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
		}
	}

	public static function check($field,$value,$id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM courses c WHERE ((LCASE(REPLACE(c.$field,' ','')) LIKE '%$value%') AND c.id <> $id);";
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
