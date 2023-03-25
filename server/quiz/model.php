<?php
require_once '../../server/connection.php';
include('../../server/pagination.php');

class Quiz {

	function __construct(){
    }

	public function submitQuiz($data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$c = isset($data['question']) ? json_decode($data['question']) : 0;
			$category_id = $data['category_id'];
			$student_id = $_SESSION['entrance_student']['studid'];
			$questions = json_decode($data['question']);
			$mobileno = $_SESSION['entrance_student']['mobileno'];
			$totalScore = 0;
			$coverage = 0;
			$score = 0;
        	$message = 'EXAM Results are :'. "\r\n";
            $row = count($c);
			$var = array();
			$var1 = array();
			$var2 = array();

            for($i = $row; $i > 0; $i--){
                $ans = isset($data['ans'.$i]) ? $data['ans'.$i] : 'null';
                $ques = $questions[$i-1];
				$result = $mysqli->query("SELECT * FROM choice c WHERE c.id=$ans and choice='yes';");
				if($result->num_rows == 1){
                    $score++;   
                }
                $mysqli->query("INSERT INTO status VALUES (null,'$student_id',$ques,$category_id,$ans,1)");
            }
            $mysqli->query("INSERT INTO result VALUES (null,$category_id,'$student_id',$score,$row,NOW())");



			$query ="SELECT c.`name`,r.* FROM result r INNER JOIN category c ON r.category_id = c.id WHERE r.stud_id='$student_id';";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$total= $row['score'] / $row['total'];
				$p = $total * 100;
				$totalScore += $row['score'];
				$coverage += $row['total'];
				$row['percent'] = number_format($p,2).'%';

				array_push($var,$row);
			}
			$message .= 'TOTAL SCORE: '.$totalScore .'/'. $coverage . "\r\n";

			$query1 ="SELECT C.id as course_id,C.coursecode,C.coursename FROM student S, courses C WHERE (SELECT SUM(score) FROM result WHERE stud_id=S.studid) >= C.passing_score AND S.studid='$student_id';";
			$result1 = $mysqli->query($query1);
			while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($var1,$row1);
				array_push($var2,$row1['coursecode']);
			}
			$message .= 'COURSE SUGGESTIONS: ['. implode(", ",$var2) ."]\r\n";

			$url = 'https://www.itexmo.com/php_api/api.php';
			$itexmo = array('1' => $mobileno, '2' => $message, '3' => $config->sms_api_code);
			$param = array(
			    'http' => array(	
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($itexmo),
			    ),
			);
			$context  = stream_context_create($param);
			$result = file_get_contents($url, false, $context);
			// $response = $config->sms_response($result);            

			print_r(json_encode(array('success' =>true,'status'=>200,'category_id'=>$category_id,'result'=>$score,'msg'=>'Thank you for participating the examination'),JSON_PRETTY_PRINT));
		}        
	}

	public function getQuizResults(){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    return print json_encode(array('success' =>false,'status'=>400,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    die();
		}else{
			$data = array();
			$data1 = array();
			$data2 = array();
			$studid = $_SESSION['entrance_student']['studid'];
			$mobileno = $_SESSION['entrance_student']['mobileno'];
			$totalScore = 0;
			$coverage = 0;
        	$message = 'EXAM Results :'. "\r\n";

        	$query ="SELECT c.`name`,r.* FROM result r INNER JOIN category c ON r.category_id = c.id WHERE r.stud_id='$studid';";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$total= $row['score'] / $row['total'];
				$p = $total * 100;
				$totalScore += $row['score'];
				$coverage += $row['total'];
				$row['percent'] = number_format($p,2).'%';

				array_push($data,$row);
				// $message .= '* '.$row['name'].' - '. $row['score'].'/'.$row['total'] . "\r\n";
			}
			$message .= 'TOTAL SCORE: '.$totalScore .'/'. $coverage . "\r\n";
			
        	$query1 ="SELECT C.id as course_id,C.coursecode,C.coursename FROM student S, courses C WHERE (SELECT SUM(score) FROM result WHERE stud_id=S.studid) >= C.passing_score AND S.studid='$studid';";
			$result1 = $mysqli->query($query1);
			while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data1,$row1);
				array_push($data2,$row1['coursecode']);
			}
			$message .= 'COURSE SUGGESTIONS: ['. implode(", ",$data2) ."]\r\n";
			

			$url = 'https://www.itexmo.com/php_api/api.php';
			$itexmo = array('1' => $mobileno, '2' => $message, '3' => $config->sms_api_code);
			$param = array(
			    'http' => array(	
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($itexmo),
			    ),
			);
			$context  = stream_context_create($param);
			$result = file_get_contents($url, false, $context);
			//$response = $config->sms_response($result);

			print json_encode(array('success' =>true,'status'=>200,'results' =>$data,'suggest_course'=>$data1),JSON_PRETTY_PRINT);
			// print json_encode(array('success' =>true,'status'=>200,'results' =>$data),JSON_PRETTY_PRINT);
		}
	}

		public function getQuestionsByCategory($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    return print json_encode(array('success' =>false,'status'=>400,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    die();
		}else{
			$data = array();
			$query ="SELECT * FROM question c WHERE c.category_id=$id;";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$data1 = array();
				$query1 ="SELECT * FROM choice c WHERE c.questionid=".$row['id'];
				$result1 = $mysqli->query($query1);
				while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
					array_push($data1,$row1);
					shuffle($data1);
				}				
				$row['choices'] = $data1;
				array_push($data,$row);			
			}
			print json_encode(array('success' =>true,'status'=>200,'category'=>$id,'quiz' =>$data),JSON_PRETTY_PRINT);
		}
	}

	public function getQuizDetails($category_id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$data = array();
			$studid = $_SESSION['entrance_student']['studid'];
			$query ="SELECT s.*, (SELECT content FROM question WHERE id=s.question_id LIMIT 1) AS questions,
				(SELECT answer FROM choice WHERE id=s.choice_id LIMIT 1) AS yourchoice, (SELECT answer FROM choice WHERE questionid=s.question_id AND choice='yes' LIMIT 1) AS correctans
				FROM status s WHERE s.category_id=$category_id AND s.stud_id='$studid' ORDER BY s.id;";
				
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);			
			}
			print json_encode(array('success' =>true,'status'=>200,'results' =>$data),JSON_PRETTY_PRINT);
		}
	}


	public function checkIfAlreadyExam($category_id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$stud_id = $_SESSION['entrance_student']['studid'];
			$query ="SELECT * FROM result c WHERE c.category_id=$category_id AND c.stud_id='$stud_id' LIMIT 1;";
			$mysqli->set_charset("utf8");
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'msg' =>'Student is already done taking exam on this category.'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"No record found!"),JSON_PRETTY_PRINT);
			}
		}
	}

}
?>