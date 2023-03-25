<?php
require_once '../../server/connection.php';
require_once('../../server/pagination.php');
// require_once '../../server/sms/model.php';

class Student {

	function __construct(){
    }

	public function create($data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$studid = $mysqli->real_escape_string($data['studid']);
			$fname = $mysqli->real_escape_string($data['fname']);
			$lname = $mysqli->real_escape_string($data['lname']);
			$mobileno = $mysqli->real_escape_string($data['mobileno']);
			$email = $mysqli->real_escape_string($data['email']);
			$level = $mysqli->real_escape_string($data['level']);
			$address = $mysqli->real_escape_string($data['address']);
			$birthdate = $mysqli->real_escape_string($data['birthdate']);
			$graduated = $mysqli->real_escape_string($data['graduated']);
			$last_school = $mysqli->real_escape_string($data['last_school']);
			$pref_course = $mysqli->real_escape_string($data['pref_course']);
			$gender = $mysqli->real_escape_string($data['gender']);

			$username = $mysqli->real_escape_string($data['username']);
			$password2 = sha1($mysqli->real_escape_string($data['password']));
			$password = $mysqli->real_escape_string($data['password']);
			

			$stmt2 = $mysqli->prepare('INSERT INTO userdata(username,password,str_password,fname,lname,email,mobileno,level) VALUES(?,?,?,?,?,?,?,?)');
			$stmt2->bind_param("ssssssss", $username,$password2,$password,$fname,$lname,$email,$mobileno,$level);
			$stmt2->execute();
			$user_id = $mysqli->insert_id;				

			if ($stmt = $mysqli->prepare('INSERT INTO student(studid,fname,lname,mobileno,email,address,birthdate,graduated,last_school,pref_course,gender,user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)')){
				print json_encode(array('success' =>true,'msg' =>'Record successfully saved'),JSON_PRETTY_PRINT);
				$stmt->bind_param("ssssssssssss", $studid,$fname,$lname,$mobileno,$email,$address,$birthdate,$graduated,$last_school,$pref_course,$gender,$user_id);
				$stmt->execute();
				
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n" . $mysqli->error),JSON_PRETTY_PRINT);
			}
		}        
	}

	public function signup($data){
		$config= new Config();
		$func= new Functions();

		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$studid = $mysqli->real_escape_string($data['studid']);
			$fname = $mysqli->real_escape_string($data['fname']);
			$lname = $mysqli->real_escape_string($data['lname']);
			$mobileno = $mysqli->real_escape_string($data['mobileno']);
			$username = $mysqli->real_escape_string($data['username']);
			$email = $mysqli->real_escape_string($data['email']);
			$gender = $mysqli->real_escape_string($data['gender']);
			$address = $mysqli->real_escape_string($data['address']);
			$birthdate = $mysqli->real_escape_string($data['birthdate']);
			$gradschool = $mysqli->real_escape_string($data['gradschool']);
			$graduated = $mysqli->real_escape_string($data['graduated']);
			$course = $mysqli->real_escape_string($data['course']);

			$level = $mysqli->real_escape_string($data['level']);

			$password = $func->generatePassword(7,1);

			$stmt2 = $mysqli->prepare('INSERT INTO userdata(username,password,str_password,fname,lname,email,mobileno,level) VALUES (?,?,?,?,?,?,?,?);');
			$stmt2->bind_param("ssssssss", $username,sha1($password),$password,$fname,$lname,$email,$mobileno,$level);
			$stmt2->execute();
			$user_id = $mysqli->insert_id;		

			if ($stmt = $mysqli->prepare('INSERT INTO student(studid,fname,lname,mobileno,email,gender,address,birthdate,graduated,last_school,pref_course,user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)')){
				$stmt->bind_param("ssssssssssss", $studid,$fname,$lname,$mobileno,$email,$gender,$address,$birthdate,$graduated,$gradschool,$course,$user_id);
				$stmt->execute();

				$message = 'Hello there! Thank you for using our mobile app. Your App Password: ' . $password. ' .';
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
				$response = $config->sms_response($result);

				print json_encode(array('success' =>true,'msg' =>'Record successfully saved'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n" . $mysqli->error),JSON_PRETTY_PRINT);
			}
		}        
	}

	public function read(){
		$limit = 10;
		$adjacent = 3;
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{

			$query1 ="SELECT c.*, (SELECT coursecode FROM courses WHERE id=c.pref_course LIMIT 1) AS pref_course1 FROM student c;";
			$result1 = $mysqli->query($query1);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			
			print json_encode(['success' =>true,'student' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT c.*,u.username FROM student c INNER JOIN userdata u ON c.user_id = u.id WHERE c.id=$id LIMIT 1;";
			$mysqli->set_charset("utf8");
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'student' =>$row),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"No record found!"),JSON_PRETTY_PRINT);
			}
		}
	}

	public function checkID($studentID){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM student c WHERE studid=$studentID LIMIT 1;";
			$mysqli->set_charset("utf8");
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'msg' =>'Student already existed'),JSON_PRETTY_PRINT);
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
			$studid = $mysqli->real_escape_string($data['studid']);
			$fname = $mysqli->real_escape_string($data['fname']);
			$lname = $mysqli->real_escape_string($data['lname']);
			$mobileno = $mysqli->real_escape_string($data['mobileno']);
			$email = $mysqli->real_escape_string($data['email']);
			$address = $mysqli->real_escape_string($data['address']);
			$birthdate = $mysqli->real_escape_string($data['birthdate']);
			$graduated = $mysqli->real_escape_string($data['graduated']);
			$last_school = $mysqli->real_escape_string($data['last_school']);
			$pref_course = $mysqli->real_escape_string($data['pref_course']);
			$gender = $mysqli->real_escape_string($data['gender']);

			$newid = explode('-',$id);
		
			if ($stmt = $mysqli->prepare('UPDATE student SET studid=?,fname=?,lname=?,mobileno=?,email=?,address=?,birthdate=?,graduated=?,last_school=?,pref_course=?,gender=? WHERE id=?')){
				$stmt->bind_param("ssssssssssss", $studid,$fname,$lname,$mobileno,$email,$address,$birthdate,$graduated,$last_school,$pref_course,$gender,$newid[0]);
				$stmt->execute();

				$stmt = $mysqli->prepare('UPDATE userdata SET fname=?,lname=?,email=?,mobileno=? WHERE id=?');
				$stmt->bind_param("sssss", $fname,$lname,$email,$mobileno,$newid[1]);
				$stmt->execute();

				print json_encode(array('success' =>true,'msg' =>'Profile successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public function updateAccount($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$username = $mysqli->real_escape_string($data['username']);
			$password = $mysqli->real_escape_string($data['password']);
			$password2 = sha1($mysqli->real_escape_string($data['password']));
			$newid = explode('-',$id);
			
			if ($stmt = $mysqli->prepare('UPDATE userdata SET username=?,password=?,str_password=? WHERE id=?')){
				$stmt->bind_param("ssss", $username,$password2,$password,$newid[1]);
				$stmt->execute();

				$query1 ="SELECT u.id,u.username,u.email,u.mobileno,u.fname,u.lname,u.level,s.studid FROM userdata u LEFT JOIN student s ON u.id = s.user_id WHERE u.id = $id;";
	            $result = $mysqli->query($query1);
	            if ($result) {
	                if($row = $result->fetch_assoc()){
	                    /*** set the session user_id variable ***/
	                    if (isset($_SESSION['entrance_student'])) {
	                    	$_SESSION['entrance_student'] = $row;
	                    }	                    

        				$message = 'Hello there! You have successfully changed your password. Your New App Password: ' . $password. ' .';
						$url = 'https://www.itexmo.com/php_api/api.php';
						$itexmo = array('1' => $row['mobileno'], '2' => $message, '3' => $config->sms_api_code);
						$param = array(
						    'http' => array(	
						        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						        'method'  => 'POST',
						        'content' => http_build_query($itexmo),
						    ),
						);
						$context  = stream_context_create($param);
						$result = file_get_contents($url, false, $context);
						$response = $config->sms_response($result);
	                }
	            }

				print json_encode(array('success' =>true,'msg' =>'User Account successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public function updateProfile($id,$data){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$mobileno = $mysqli->real_escape_string($data['mobileno']);
			$email = $mysqli->real_escape_string($data['email']);

			if ($stmt = $mysqli->prepare('UPDATE student SET mobileno=?,email=? WHERE user_id=?')){
				$stmt->bind_param("sss", $mobileno,$email,$id);
				$stmt->execute();

				$stmt1 = $mysqli->prepare('UPDATE userdata SET mobileno=?,email=? WHERE id=?');
				$stmt1->bind_param("sss", $mobileno,$email,$id);
				$stmt1->execute();

				$query1 ="SELECT u.id,u.username,u.email,u.mobileno,u.fname,u.lname,u.level,s.studid FROM userdata u LEFT JOIN student s ON u.id = s.user_id WHERE u.id = $id;";
	            $result = $mysqli->query($query1);
	            if ($result) {
	                if($row = $result->fetch_assoc()){
	                    /*** set the session user_id variable ***/
	                    $_SESSION['entrance_student'] = $row;
	                }
	            }

				print json_encode(array('success' =>true,'msg' =>'User Profile successfully updated'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
			}
		}
	}

	public function delete($id){
		$config= new Config();		
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare("DELETE FROM student WHERE id =?")){
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->close();
			print json_encode(array('success' =>true,'msg' =>'Record successfully deleted'),JSON_PRETTY_PRINT);
		}else{
			print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
		}
	}

	public function auth($username,$phpro_password){
		$config= new Config();
        $mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
        if ($mysqli->connect_errno) {
            print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
            return;
        }else{
            $query1 ="SELECT u.id,u.username,u.email,u.mobileno,u.fname,u.lname,u.level,s.studid FROM userdata u LEFT JOIN student s ON u.id = s.user_id WHERE u.username = '$username' AND u.password = '$phpro_password' LIMIT 1;";
            $result = $mysqli->query($query1);
            if ($result) {
                if($row = $result->fetch_assoc()){
                	session_start();
                    /*** set the session user_id variable ***/
                    $_SESSION['entrance_student'] = $row;
                    /*** set a form token ***/
                    $form_token = md5( uniqid('auth', true) );

                    /*** set the session form token ***/
                    $_SESSION['form_token'] = $form_token;
                    /*** tell the user we are logged in ***/
                    
                    print json_encode(array('success' =>true,'form_token' =>$form_token,'url'=>'main.php'),JSON_PRETTY_PRINT);
                }else{
                    print json_encode(array('success' =>false,'msg' =>'Login Failed'),JSON_PRETTY_PRINT);
                }
            }else{
                print json_encode(array('success' =>false,'msg' =>'Error with SQL' . $query1),JSON_PRETTY_PRINT);
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
			$query ="SELECT * FROM student c WHERE LCASE(REPLACE(c.$field,' ','')) LIKE '%$value%';";
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
			$query ="SELECT * FROM student c WHERE ((LCASE(REPLACE(c.lname,' ','')) LIKE '%$lastname%') AND (LCASE(REPLACE(c.fname,' ','')) LIKE '%$firstname%'));";
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'msg' =>'Warning: Student already existed!!!'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'No record found!'),JSON_PRETTY_PRINT);
			}
		}
	}

	public static function checkAccount($field,$value){
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
}
?>
