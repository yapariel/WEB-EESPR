<?php
include( __DIR__.'/model.php');

class UsersController {

	public static function currentUser(){
		$users_model = new Users();
			$users_model->currentUser();
	}

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
		}else if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Username is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['password']) && empty($data['password'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Password is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['email']) && empty($data['email'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Email is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['fname']) && empty($data['fname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'First Name is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['lname']) && empty($data['lname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Last Name is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
				"username" => $data['username'],
				"password" => $data['password'],
				"email" => $data['email'],
				"mobileno" => $data['mobileno'],
				"fname" => $data['fname'],
				"lname" => $data['lname'],
				"level" => $data['level']
			];
			$users_model = new Users();
			$users_model->create($var);
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
			$users_model = new Users();
			$users_model->read();
		}
	}

	public static function detail($id){
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
			$users_model = new Users();
			$users_model->detail($id);
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
		}else if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Username is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['password']) && empty($data['password'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Password is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['email']) && empty($data['email'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Email is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['fname']) && empty($data['fname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'First Name is required'),JSON_PRETTY_PRINT);
			die();
		}else if(isset($data['lname']) && empty($data['lname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Last Name is required'),JSON_PRETTY_PRINT);
			die();
		}else{
			$var = [
				"username" => $data['username'],
				"password" => $data['password'],
				"email" => $data['email'],
				"mobileno" => $data['mobileno'],
				"fname" => $data['fname'],
				"lname" => $data['lname'],
				"level" => $data['level']
			];
			$users_model = new Users();
			$users_model->update($id,$var);
		}
	}

	public static function updateAccount($id,$data){
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
		}else if(isset($data['username']) && empty($data['username'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Username is required'),JSON_PRETTY_PRINT);
		}else if(isset($data['password']) && empty($data['password'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Password is required'),JSON_PRETTY_PRINT);
		}else{
			$var = [
				"username" => $data['username'],
				"password" => $data['password']
			];
			$users_model = new Users();
			$users_model->updateAccount($id,$var);
		}
	}

	public static function updateProfile($id,$data){
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
		}else if(isset($data['fname']) && empty($data['fname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'First Name is required'),JSON_PRETTY_PRINT);
		}else if(isset($data['lname']) && empty($data['lname'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Last Name is required'),JSON_PRETTY_PRINT);
		}else if(isset($data['email']) && empty($data['email'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Email Address is required'),JSON_PRETTY_PRINT);
		}else{
			$var = [
				"email" => $data['email'],
				"mobileno" => $data['mobileno'],
				"fname" => $data['fname'],
				"lname" => $data['lname'],
			];
			$users_model = new Users();
			$users_model->updateProfile($id,$var);
		}
	}

	public static function delete($id){
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
			$users_model = new Users();
			$users_model->delete($id);
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
			$users_model = new Users();
			$users_model->check($field,$value);
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
			$users_model = new Users();
			$users_model->checkName($lastname,$firstname);
		}
	}
}

?>