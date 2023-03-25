<?php
include( __DIR__.'/model.php');

class QuestionsController {

	public static function create($data,$files){
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
		}elseif(isset($data['content']) && empty($data['content'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Content is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['category_id']) && empty($data['category_id'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Category is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['answer']) && empty($data['answer'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Questions correct answer is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['choice2']) && empty($data['choice2'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'2nd Choice is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['choice3']) && empty($data['choice3'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'3rd Choice is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['choice4']) && empty($data['choice4'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'4th Choice is required'),JSON_PRETTY_PRINT);
			die();		
		}else{
			$var = [
				"content" => $data['content'],
				"category_id" => $data['category_id'],
				"answer" => $data['answer'],
				"choice2" => $data['choice2'],
				"choice3" => $data['choice3'],
				"choice4" => $data['choice4'],
				"tmp_main" => $data['tmp_main'],
				"tmp_correct" => $data['tmp_correct'],
				"tmp_pic2" => $data['tmp_pic2'],
				"tmp_pic3" => $data['tmp_pic3'],
				"tmp_pic4" => $data['tmp_pic4']
			];

			if(isset($files['mainpic'])){
				$file['mainpic'] = $files['mainpic'];
			}else{
				$file['mainpic'] = null;
			}

			if(isset($files['correctpic'])){
				$file['correctpic'] = $files['correctpic'];
			}else{
				$file['correctpic'] = null;
			}

			if(isset($files['pic2'])){
				$file['pic2'] = $files['pic2'];
			}else{
				$file['pic2'] = null;
			}

			if(isset($files['pic3'])){
				$file['pic3'] = $files['pic3'];
			}else{
				$file['pic3'] = null;
			}

			if(isset($files['pic4'])){
				$file['pic4'] = $files['pic4'];
			}else{
				$file['pic4'] = null;
			}

			$questions_model = new Questions();
			$questions_model->create($var,$file);
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
			$questions_model = new Questions();
			$questions_model->read();
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
			$questions_model = new Questions();
			$questions_model->detail($id);
		}
	}

	public static function update($data,$files){
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
		}elseif(isset($data['content']) && empty($data['content'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Content is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['category_id']) && empty($data['category_id'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Category is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['answer']) && empty($data['answer'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'Questions correct answer is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['choice2']) && empty($data['choice2'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'2nd Choice is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['choice3']) && empty($data['choice3'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'3rd Choice is required'),JSON_PRETTY_PRINT);
			die();		
		}elseif(isset($data['choice4']) && empty($data['choice4'])){
			return print json_encode(array('success'=>false,'status'=>200,'msg'=>'4th Choice is required'),JSON_PRETTY_PRINT);
			die();		
		}else{
			$var = [
				"content" => $data['content'],
				"category_id" => $data['category_id'],
				"question_id" => $data['question_id'],
				"answer" => $data['answer'],
				"choice2" => $data['choice2'],
				"choice3" => $data['choice3'],
				"choice4" => $data['choice4'],
				"answerid" => $data['answerid'],
				"choice2id" => $data['choice2id'],
				"choice3id" => $data['choice3id'],
				"choice4id" => $data['choice4id'],
				"tmp_main" => $data['tmp_main'],
				"tmp_correct" => $data['tmp_correct'],
				"tmp_pic2" => $data['tmp_pic2'],
				"tmp_pic3" => $data['tmp_pic3'],
				"tmp_pic4" => $data['tmp_pic4']
			];

			if(isset($files['mainpic'])){
				$file['mainpic'] = $files['mainpic'];
			}else{
				$file['mainpic'] = null;
			}

			if(isset($files['correctpic'])){
				$file['correctpic'] = $files['correctpic'];
			}else{
				$file['correctpic'] = null;
			}

			if(isset($files['pic2'])){
				$file['pic2'] = $files['pic2'];
			}else{
				$file['pic2'] = null;
			}

			if(isset($files['pic3'])){
				$file['pic3'] = $files['pic3'];
			}else{
				$file['pic3'] = null;
			}

			if(isset($files['pic4'])){
				$file['pic4'] = $files['pic4'];
			}else{
				$file['pic4'] = null;
			}

			$questions_model = new Questions();
			$questions_model->update($var,$file);
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
			$questions_model = new Questions();
			$questions_model->delete($id);
		}
	}

	public static function deleteQuestionFile($id,$file){
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
			$questions_model = new Questions();
			$questions_model->deleteQuestionFile($id);
		}
	}

	public static function deleteChoiceFile($id,$file){
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
			$questions_model = new Questions();
			$questions_model->deleteChoiceFile($id,$file);
		}
	}

	public static function check($field,$value){
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
			$value = strtolower($value);
			$value = preg_replace('/\s+/', '', $value);
			$questions_model = new Questions();
			$questions_model->check($field,$value);
		}
	}
}

?>