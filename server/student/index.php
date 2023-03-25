<?php
	include('../../server/cors.php');
	include( __DIR__.'/controller.php');

	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

	switch ($method) {
	  	case 'PUT':
  			$data=parse_str( file_get_contents( 'php://input' ), $_PUT );
			foreach ($_PUT as $key => $value){
					unset($_PUT[$key]);
					$_PUT[str_replace('amp;', '', $key)] = $value;
			}
			$_REQUEST = array_merge($_REQUEST, $_PUT);

		
			if(isset($request) && !empty($request) && $request[0] !== ''){
				if ($request[0] == 'account'){
					if(isset($request[1]) && !empty($request[1])){
						$_REQUEST['id'] = $request[1];
						StudentController::updateAccount($_REQUEST);
					}else{
						StudentController::updateAccount($_REQUEST);
					}
				}else if ($request[0] == 'profile'){
					StudentController::updateProfile($_REQUEST);
				}else{
					$id = $request[0];
					StudentController::update($id,$_REQUEST);
				}
			}else{
				header('Route Not Found', true, 404);
			}
	    	break;
	  	case 'POST':
	  		if(isset($request) && !empty($request) && $request[0] !== ''){
				if ($request[0] == 'signup'){
					StudentController::signup($_POST);
				}else if($request[0] == 'auth'){
					StudentController::auth($_POST);
				}
			}else{
				StudentController::create($_POST);
			}
	    	break;
	  	case 'GET':
		  	if(isset($request) && !empty($request) && $request[0] !== ''){
		  		if ($request[0] == 'check'){
					$field = $request[1];
					$value = $request[2];
		  			StudentController::check($field,$value);
				}else if ($request[0] == 'checkName'){
					$lastname = $request[1];
					$firstname = $request[2];
		  			StudentController::checkName($lastname,$firstname);
				}else if ($request[0] == 'signcheck'){
					$field = $request[1];
					$value = $request[2];
		  			StudentController::sign_check($field,$value);
				}else if ($request[0] == 'checkaccount'){
					$field = $request[1];
					$value = $request[2];
		  			StudentController::checkAccount($field,$value);
				}else if ($request[0] == 'signcheckName'){
					$lastname = $request[1];
					$firstname = $request[2];
		  			StudentController::sign_checkName($lastname,$firstname);
				}else{
					$id = $request[0];
	  				StudentController::detail($id);
	  			}
		  	}else{
		  		StudentController::read();
		  	}
		    break;
	  	case 'DELETE':			
		  	if(isset($request) && !empty($request) && $request[0] !== ''){
		  		$id = $request[0];
				StudentController::delete($id);
		  	}  
		    break;
	  	default:
	    	print json_encode('ENTRANCE EXAMINATION SYSTEM WITH PROGRAM RECOMMENDATION');
	    	break;
	}
	exit();
	
?>
