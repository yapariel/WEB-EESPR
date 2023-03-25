<?php
	include('../../server/cors.php');
	include( __DIR__.'/controller.php');

	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
	$results_controller = new ResultsController();

	switch ($method) {
	  case 'GET':
	  	if(isset($request) && !empty($request) && $request[0] !== ''){
	  		if ($request[0] == 'results'){
	  			$studentid = $request[1];
				$results_controller->getResultsSummary($studentid);
			}else if ($request[0] == 'passers'){
				if (isset($request) && !empty($request) && isset($request[1])){
					$course_id = $request[1];
					$year = $request[2];
					$results_controller->getPassersByCourse($course_id,$year);
				}
			}else if ($request[0] == 'passers2'){
				if (isset($request) && !empty($request) && isset($request[1])){
					$year = $request[1];
					$results_controller->getPassers($year);
				}					
			}else if ($request[0] == 'year'){
				$results_controller->getResultsYear();
			}else{
				return print json_encode('ENTRANCE EXAMINATION SYSTEM WITH PROGRAM RECOMMENDATION');
				die();
			}
	  	}else{
	  		return print json_encode('ENTRANCE EXAMINATION SYSTEM WITH PROGRAM RECOMMENDATION');
	  		die();
	  	}
	    break;
	  default:
	    print json_encode('ENTRANCE EXAMINATION SYSTEM WITH PROGRAM RECOMMENDATION');
	    break;
	}
	exit();
	
?>