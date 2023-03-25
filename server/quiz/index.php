<?php
	include('../../server/cors.php');
	include( __DIR__.'/controller.php');

	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

	switch ($method) {
	  case 'POST':
	    	QuizController::submitQuiz($_POST);
	    break;
	  case 'GET':
	  	if(isset($request) && !empty($request) && $request[0] !== ''){
	  		if ($request[0] == 'exam'){
				$id = $request[1];
				QuizController::getQuestionsByCategory($id);
			}else if ($request[0] == 'results'){
				QuizController::getQuizResults();
			}else if ($request[0] == 'resultsdetailed'){
				$category_id = $request[1];
				QuizController::getQuizDetails($category_id);
			}else if ($request[0] == 'checkexam'){
				$category_id = $request[1];
				QuizController::checkIfAlreadyExam($category_id);
			}else{
				$id = $request[0];
				QuizController::getQuestionDetail($id);
			}
	  	}else{
	  		print json_encode('ENTRANCE EXAMINATION SYSTEM WITH PROGRAM RECOMMENDATION');
	  	}
	    break;

	  default:
	    print json_encode('ENTRANCE EXAMINATION SYSTEM WITH PROGRAM RECOMMENDATION');
	    break;
	}
	exit();
	
?>