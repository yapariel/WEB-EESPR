<?php
include( __DIR__.'/model.php');

class CourseController {

	public static function create($data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else if(!isset($data['coursecode']) && empty($data['coursecode'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Course Code is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['coursename']) && empty($data['coursename'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Course Description is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['passing_score']) && empty($data['passing_score'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Passing Score Limit is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
				"coursecode" => $data['coursecode'],
				"coursename" => $data['coursename'],
				"passing_score" => $data['passing_score']
			];
			$courses_model = new Courses();
			$courses_model->create($var);
		}
	}


	public static function read(){
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
			$courses_model = new Courses();
			$courses_model->read();
		}
	}

	public static function readSignup(){
		$courses_model = new Courses();
			$courses_model->read();
	}

	public static function detail($id){
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
			$courses_model = new Courses();
			$courses_model->detail($id);
		}
	}

	public static function update($id,$data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
		}else if(!isset($data['coursecode']) && empty($data['coursecode'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Course Code is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['coursename']) && empty($data['coursename'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Course Description is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['passing_score']) && empty($data['passing_score'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Passing Score Limit is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
				"coursecode" => $data['coursecode'],
				"coursename" => $data['coursename'],
				"passing_score" => $data['passing_score']
			];
			$courses_model = new Courses();
			$courses_model->update($id,$var);
		}
	}

	public static function delete($id){
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
			$courses_model = new Courses();
			$courses_model->delete($id);
		}
	}

	public static function check($field,$value,$id){
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
			$courses_model = new Courses();
			$courses_model->check($field,$value,$id);
		}
	}
}

?>