<?php
include( __DIR__.'/model.php');

class ScheduleController {

	public static function create($data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['description']) && empty($data['description'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Exam Schedule Description is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['start_date']) && empty($data['start_date'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Start Date for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['end_date']) && empty($data['end_date'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'End Date for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['start_time']) && empty($data['start_time'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Start Time for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['end_time']) && empty($data['end_time'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'End Time for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
				"description" => $data['description'],
				"start_date" => $data['start_date'],
				"end_date" => $data['end_date'],
				"start_time" => $data['start_time'],
				"end_time" => $data['end_time']
			];
			$schedules_model = new Schedules();
			$schedules_model->create($var);
		}
	}


	public static function read(){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else{
			$schedules_model = new Schedules();
			$schedules_model->read();
		}
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
			$schedules_model = new Schedules();
			$schedules_model->detail($id);
		}
	}

	public static function update($id,$data){
		session_start();
		$headers = apache_request_headers();	
		$token = $headers['X-Auth-Token'];

		if(!$headers['X-Auth-Token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if($token != $_SESSION['form_token']){
			header('Invalid CSRF Token', true, 401);
			return print json_encode(array('success'=>false,'status'=>400,'msg'=>'Invalid CSRF Token / Bad Request / Unauthorized ... Please Login again'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['description']) && empty($data['description'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Exam Schedule Description is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['start_date']) && empty($data['start_date'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Start Date for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['end_date']) && empty($data['end_date'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'End Date for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['start_time']) && empty($data['start_time'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Start Time for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else if(!isset($data['end_time']) && empty($data['end_time'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'End Time for the Exam is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
				"description" => $data['description'],
				"start_date" => $data['start_date'],
				"end_date" => $data['end_date'],
				"start_time" => $data['start_time'],
				"end_time" => $data['end_time']
			];
			$schedules_model = new Schedules();
			$schedules_model->update($id,$var);
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
			$schedules_model = new Schedules();
			$schedules_model->delete($id);
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
			$schedules_model = new Schedules();
			$schedules_model->check($field,$value);
		}
	}
}

?>