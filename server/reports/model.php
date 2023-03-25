<?php
require_once '../../server/connection.php';
include('../../server/pagination.php');

class Results {

	function __construct(){
    }

    public function getPassers($year){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$data = array();
			$query ="SELECT S.* ,(SELECT IFNULL(SUM(score),0) FROM result WHERE stud_id=S.studid) AS TotalScore FROM student S;";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$studid = $row['studid'];

				$query1 ="SELECT S.studid,C.id as course_id,C.coursecode FROM student S, courses C 
					WHERE (SELECT SUM(score) FROM result WHERE stud_id=S.studid) >= C.passing_score 
					AND S.studid=(SELECT DISTINCT r.stud_id FROM result r WHERE YEAR(r.date) = '$year' AND r.stud_id = '$studid');";
					
				$result1 = $mysqli->query($query1);
				$data1 = array();
				while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
					array_push($data1,$row1);
				}
				$row['suggest_course'] = $data1;
				array_push($data,$row);
			}
			
			print json_encode(['success' =>true,'passers' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public function getPassersByCourse($id,$year){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM (SELECT S.* , C.id as course_id,C.coursecode,(SELECT IFNULL(SUM(score),0) FROM result WHERE stud_id=S.studid) AS TotalScore
				FROM student S, courses C WHERE (SELECT SUM(score) FROM result WHERE stud_id=S.studid) >= C.passing_score 
				AND S.pref_course=$id) AS A WHERE A.studid IN (SELECT DISTINCT r.stud_id FROM result r WHERE YEAR(r.date) = '$year');";

			$result = $mysqli->query($query);
			$data = array();
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(['success' =>true,'passers' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public function getResultsSummary($student_id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{

			$data = array();
			$data2 = array();

			$query ="SELECT DISTINCT s.category_id,(SELECT name FROM category WHERE id=s.category_id LIMIT 1) as category_name FROM status s WHERE s.stud_id = '$student_id' ORDER BY s.id;";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$category_id = $row['category_id'];

				$query1 ="SELECT s.*,(SELECT content FROM question WHERE id = s.question_id LIMIT 1) AS questions,
    			(SELECT answer FROM choice WHERE id = s.choice_id LIMIT 1) AS yourchoice,
    			(SELECT answer FROM choice WHERE questionid = s.question_id AND choice = 'yes' LIMIT 1) AS correctans,
    			(SELECT id FROM choice WHERE questionid = s.question_id AND choice = 'yes' LIMIT 1) AS correctans_id
				FROM status s WHERE s.stud_id = '$student_id' AND s.category_id = $category_id ORDER BY s.id;";

				$result1 = $mysqli->query($query1);
				$data1 = array();
				while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
					if($row1['choice_id'] === $row1['correctans_id']){
						$row1['isCorrect'] = true;
					}else{
						$row1['isCorrect'] = false;
					}
					array_push($data1,$row1);
				}
				$row['quiz'] = $data1;
				array_push($data,$row);
			}

			$query2 ="SELECT c.*, (SELECT r.score FROM result r WHERE r.category_id=c.id AND r.stud_id='$student_id' LIMIT 1) AS score,(SELECT r.total FROM result r WHERE r.category_id=c.id AND r.stud_id='$student_id' LIMIT 1) AS total FROM category c;";
			$result2 = $mysqli->query($query2);
			while($row = $result2->fetch_array(MYSQLI_ASSOC)){
				array_push($data2,$row);
			}
			
			print json_encode(['success' =>true,'data' =>$data,'summary'=>$data2],JSON_PRETTY_PRINT);
		}
	}

	public function getResultsYear(){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
			print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
			return;
		} else {
			$query ="SELECT DISTINCT YEAR(r.date) as cYear FROM result r;";
			$result = $mysqli->query($query);
			if (!$result) {
				print json_encode(array('success' =>false,'msg' =>"Error executing query: " . $mysqli->error));
				return;
			} else {
				$data = array();
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					array_push($data,$row);
				}
				print json_encode(['success' =>true,'results_year' =>$data],JSON_PRETTY_PRINT);
			}
		}
	}
	// public function getResultsYear(){
	// 	$config= new Config();
	// 	$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
	// 	if ($mysqli->connect_errno) {
	// 	    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
	// 	    return;
	// 	}else{
	// 		$query ="SELECT DISTINCT YEAR(r.date) as cYear FROM entrance.result r;";
	// 		$result = $mysqli->query($query);
	// 		$data = array();
	// 		while($row = $result->fetch_array(MYSQLI_ASSOC)){
	// 			array_push($data,$row);
	// 		}
	// 		print json_encode(['success' =>true,'results_year' =>$data],JSON_PRETTY_PRINT);
	// 	}
	// }

}
?>