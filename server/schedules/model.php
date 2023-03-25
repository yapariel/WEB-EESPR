<?php
require_once '../../server/connection.php';
require_once('../../server/pagination.php');

class Schedules {

	function __construct(){}

	public static function create($data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$description = $mysqli->real_escape_string($data['description']);
			$start_date = $mysqli->real_escape_string($data['start_date']);
			$end_date = $mysqli->real_escape_string($data['end_date']);
			$start_time = $mysqli->real_escape_string($data['start_time']);
			$end_time = $mysqli->real_escape_string($data['end_time']);

			if ($stmt = $mysqli->prepare('INSERT INTO exam_sched(description,start_date,end_date,start_time,end_time) VALUES(?,?,?,?,?)')){
				$stmt->bind_param('sssss', $description,$start_date,$end_date,$start_time,$end_time);
				$stmt->execute();
				print json_encode(array('success' =>true,'msg' =>'Record successfully saved'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'Error message: %s\n'. $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function read(){
		$limit = 10;
		$adjacent = 3;
		$config= new Config();
		$func = new Functions();

		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query1 ="SELECT * FROM exam_sched c;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(array('success' =>true,'exam_sched' =>$data),JSON_PRETTY_PRINT);
		}
	}

	public static function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM exam_sched c WHERE c.id=$id;";
			$mysqli->set_charset('utf8');
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'exam_sched' =>$row),JSON_PRETTY_PRINT);
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
			$description = $mysqli->real_escape_string($data['description']);
			$start_date = $mysqli->real_escape_string($data['start_date']);
			$end_date = $mysqli->real_escape_string($data['end_date']);
			$start_time = $mysqli->real_escape_string($data['start_time']);
			$end_time = $mysqli->real_escape_string($data['end_time']);
			
			if ($stmt = $mysqli->prepare('UPDATE exam_sched SET `description`=?,start_date=?,end_date=?,start_time=?,end_time=? WHERE id=?')){
				$stmt->bind_param('sssssi', $description,$start_date,$end_date,$start_time,$end_time,$id);
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
		if($stmt = $mysqli->prepare('DELETE FROM exam_sched WHERE id =?')){
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
			$query ="SELECT * FROM exam_sched c WHERE LCASE(REPLACE(c.$field,' ','')) LIKE '%$value%';";
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
