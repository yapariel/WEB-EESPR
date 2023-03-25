<?php
include( __DIR__.'/model.php');

class StudentController {

	public static function create($data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'1msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['studid']) && empty($data['studid'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee IDis required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['fname']) && empty($data['fname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee Firstname is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['lname']) && empty($data['lname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee Lastname is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['mobileno']) && empty($data['mobileno'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Mobile No. is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['email']) && empty($data['email'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Email Address is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Username is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['password']) && empty($data['password'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Password is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
		    	'studid' => $data['studid'],
		    	'fname' => $data['fname'],
		    	'lname' => $data['lname'],
		    	'mobileno' => $data['mobileno'],
		    	'username' => $data['username'],
		    	'password' => $data['password'],
		    	'email' => $data['email'],
		    	'address' => $data['address'],
		    	'birthdate' => $data['birthdate'],
		    	'graduated' => $data['graduated'],
		    	'last_school' => $data['last_school'],
		    	'pref_course' => $data['pref_course'],
		    	'gender' => $data['gender'],
		    	'level'=> 'Student'
		    ];
			$student_model = new Student();
			$student_model->create($var);
		}
	}

	public static function signup($data){
		if(isset($data['studid']) && empty($data['studid'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee ID is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['fname']) && empty($data['fname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee Firstname is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['lname']) && empty($data['lname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee Lastname is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['mobileno']) && empty($data['mobileno'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Mobile No. is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['email']) && empty($data['email'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Email Address is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Username is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
		    	'studid' => $data['studid'],
		    	'fname' => $data['fname'],
		    	'lname' => $data['lname'],
		    	'mobileno' => $data['mobileno'],
		    	'username' => $data['username'],
		    	'email' => $data['email'],
		    	'gender' => $data['gender'],
		    	'address' => $data['address'],
		    	'birthdate' => $data['birthdate'],
		    	'gradschool' => $data['gradschool'],
		    	'graduated' => $data['graduated'],
		    	'course' => $data['course'],
		    	'level'=> 'Student'
		    ];
			$student_model = new Student();
			$student_model->signup($var);
		}
	}


	public static function read(){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'1msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else{
			$student_model = new Student();
			$student_model->read();
		}
	}

	public static function detail($id){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'1msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else{
			$student_model = new Student();
			$student_model->detail($id);
		}
	}

	public static function update($id,$data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'1msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['studid']) && empty($data['studid'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee ID is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['fname']) && empty($data['fname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee Firstname is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['lname']) && empty($data['lname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Examinee Lastname is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['mobileno']) && empty($data['mobileno'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Mobile No. is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['email']) && empty($data['email'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Email Address is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
		    	'studid' => $data['studid'],
		    	'fname' => $data['fname'],
		    	'lname' => $data['lname'],
		    	'mobileno' => $data['mobileno'],
		    	'email' => $data['email'],
		    	'address' => $data['address'],
		    	'birthdate' => $data['birthdate'],
		    	'graduated' => $data['graduated'],
		    	'last_school' => $data['last_school'],
		    	'pref_course' => $data['pref_course'],
		    	'gender' => $data['gender']
		    ];
			$student_model = new Student();
			$student_model->update($id,$var);
		}
	}

	public static function delete($id){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'1msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else{
			$student_model = new Student();
			$student_model->delete($id);
		}
	}

	public static function auth($data){
		if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Please enter a valid username'),JSON_PRETTY_PRINT);
		}else if(isset($data['password']) && empty($data['password'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Please enter a valid password'),JSON_PRETTY_PRINT);
		}else{
			$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

	        /*** now we can encrypt the password ***/
	        $phpro_password = sha1($password);

	        $student_model = new Student();
			$student_model->auth($username,$phpro_password);	
		}
	}

	public static function updateAccount($data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'1msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Please enter a valid username'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['password']) && empty($data['password'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Please enter a valid password'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['password2']) && empty($data['password2'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Please enter a valid confirmed password'),JSON_PRETTY_PRINT);
			die();
		}else{
			$id = $data['id'];
			$student_model = new Student();
			$student_model->updateAccount($id,$data);
		}
		
	}

	public static function updateProfile($data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'1msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else{
			$id = $_SESSION['entrance_student']['id'];
			$student_model = new Student();
			$student_model->updateProfile($id,$data);
		}
	}


	public static function check($field,$value){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else{
			$value = strtolower($value);
			$value = preg_replace('/\s+/', '', $value);
			$student_model = new Student();
			$student_model->check($field,$value);
		}
	}

	public static function checkName($lastname,$firstname){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else{
			$lastname = strtolower($lastname);
			$lastname = preg_replace('/\s+/', '', $lastname);

			$firstname = strtolower($firstname);
			$firstname = preg_replace('/\s+/', '', $firstname);
			$student_model = new Student();
			$student_model->checkName($lastname,$firstname);
		}
	}


	public static function sign_check($field,$value){
		$value = strtolower($value);
		$value = preg_replace('/\s+/', '', $value);
		$student_model = new Student();
			$student_model->check($field,$value);
	}

	public static function sign_checkName($lastname,$firstname){
		$lastname = strtolower($lastname);
		$lastname = preg_replace('/\s+/', '', $lastname);

		$firstname = strtolower($firstname);
		$firstname = preg_replace('/\s+/', '', $firstname);
		$student_model = new Student();
			$student_model->checkName($lastname,$firstname);		
	}

	public static function checkAccount($field,$value){
		$value = strtolower($value);
		$value = preg_replace('/\s+/', '', $value);
		$student_model = new Student();
			$student_model->checkAccount($field,$value);
	}
}

?>