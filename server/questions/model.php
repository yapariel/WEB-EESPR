<?php
require_once '../../server/connection.php';
include('../../server/pagination.php');

class Questions {

	function __construct(){
    }

    private function do_upload($name, $tmp_name){
       	$upload_dir =  "../../server/upload/choice/";

       	if (!file_exists($upload_dir)) {
		    self::mkdir_r($upload_dir, 0777);
		    self::mkdir_r($upload_dir.'thumbs/', 0777);
		}

		if (is_dir($upload_dir) && is_writable($upload_dir)) {
		    move_uploaded_file($tmp_name, $upload_dir . $name);
	        $src = $upload_dir.$name;
	        $dest = $upload_dir.'thumbs/'.$name;
	        self::make_thumb($src,$dest,300);
		} else {
		    return print json_encode(array('success' =>false,'msg'=>'Upload directory is not writable, or does not exist.'),JSON_PRETTY_PRINT);
		}
    }

	private function mkdir_r($dirName, $rights=0777){
	    $dirs = explode('/', $dirName);
	    $dir='';
	    foreach ($dirs as $part) {
	        $dir.=$part.'/';
	        if (!is_dir($dir) && strlen($dir)>0)
	            mkdir($dir, $rights);
	    }
	} 

    private function make_thumb($src, $dest, $desired_width) {

        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        $desired_height = floor($height * ($desired_width / $width));
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        imagecopyresized($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        imagejpeg($virtual_image, $dest);
    }


	public function create($data,$files){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$allow = array("jpg", "jpeg", "gif", "png");

			$category_id = $mysqli->real_escape_string($data['category_id']);
			$content = $data['content'];

			$answer = $mysqli->real_escape_string($data['answer']);
			$choice2 = $mysqli->real_escape_string($data['choice2']);
			$choice3 = $mysqli->real_escape_string($data['choice3']);
			$choice4 = $mysqli->real_escape_string($data['choice4']);

	  		$name_main_pic = isset($files["mainpic"]["name"]) ? $files["mainpic"]["name"] : "";
			$main_pic = isset($files["mainpic"]["tmp_name"]) ? $files["mainpic"]["tmp_name"] : "";

	  		$name_correct_pic = isset($files["correctpic"]["name"]) ? $files["correctpic"]["name"] : "";
	  		$correct_pic = isset($files["correctpic"]["tmp_name"]) ? $files["correctpic"]["tmp_name"] : "";

            $name_pic2 = isset($files["pic2"]["name"]) ? $files["pic2"]["name"] : "";
            $pic2 = isset($files["pic2"]["tmp_name"]) ? $files["pic2"]["tmp_name"] : "";

            $name_pic3 = isset($files["pic3"]["name"]) ? $files["pic3"]["name"] : "";
            $pic3 = isset($files["pic3"]["tmp_name"]) ? $files["pic3"]["tmp_name"] : "";

            $name_pic4 = isset($files["pic4"]["name"]) ? $files["pic4"]["name"] : "";
            $pic4 = isset($files["pic4"]["tmp_name"]) ? $files["pic4"]["tmp_name"] : "";

	  		if($name_main_pic){
			    $info = explode('.', strtolower($name_main_pic));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($main_pic);
		            if($size){
		            	self::do_upload($name_main_pic,$main_pic);
		            }else{
		                $name_main_pic = $data['tmp_main'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Content image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}

			if($name_correct_pic){
			    $info = explode('.', strtolower($name_correct_pic));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($correct_pic);
		            if($size){
		            	self::do_upload($name_correct_pic,$correct_pic);
		            }else{
		                $name_correct_pic = $data['tmp_correct'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Content image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}

			if($name_pic2){
			    $info = explode('.', strtolower($name_pic2));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($pic2);
		            if($size){
		            	self::do_upload($name_pic2,$pic2);
		            }else{
		                $name_pic2 = $data['tmp_pic2'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Choices image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}

			if($name_pic3){
			    $info = explode('.', strtolower($name_pic3));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($pic3);
		            if($size){
		            	self::do_upload($name_pic3,$pic3);
		            }else{
		                $name_pic3 = $data['tmp_pic3'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Choices image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}

			if($name_pic4){
			    $info = explode('.', strtolower($name_pic4));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($pic4);
		            if($size){
		            	self::do_upload($name_pic4,$pic4);
		            }else{
		            	$name_pic4 = $data['tmp_pic4'];
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Choices image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			        die();
			    }
			}
		

			$stmt = $mysqli->prepare("INSERT INTO question(content,file,category_id) VALUES(?,?,?)");
			$stmt->bind_param("sss", $content,$name_main_pic,$category_id);
			$stmt->execute();
			$last_id = $mysqli->insert_id;

			$stmt1 = $mysqli->prepare("INSERT INTO choice(questionid,choice,answer,file) VALUES(?,'yes',?,?)");
			$stmt1->bind_param("sss", $last_id,$answer,$name_correct_pic);
			$stmt1->execute();

			$stmt2 = $mysqli->prepare("INSERT INTO choice(questionid,choice,answer,file) VALUES(?,'no',?,?)");
			$stmt2->bind_param("sss", $last_id,$choice2,$name_pic2);
			$stmt2->execute();

			$stmt3 = $mysqli->prepare("INSERT INTO choice(questionid,choice,answer,file) VALUES(?,'no',?,?)");
			$stmt3->bind_param("sss", $last_id,$choice3,$name_pic3);
			$stmt3->execute();

			$stmt4 = $mysqli->prepare("INSERT INTO choice(questionid,choice,answer,file) VALUES(?,'no',?,?)");
			$stmt4->bind_param("sss", $last_id,$choice4,$name_pic4);
			$stmt4->execute();

			return print json_encode(array('success' =>true,'msg' =>'Record successfully saved '),JSON_PRETTY_PRINT);
			
		}        
	}

	public function read(){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query1 ="SELECT *,(SELECT name FROM category WHERE id=c.category_id LIMIT 1) AS category FROM question c;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(['success' =>true,'questions' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public function byCategory($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query1 ="SELECT * ,(SELECT name FROM category WHERE id=c.category_id LIMIT 1) AS category FROM question c WHERE c.category_id=$id;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(['success' =>true,'questions' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public function byCourse($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query1 ="SELECT * ,(SELECT name FROM category WHERE id=c.category_id LIMIT 1) AS category FROM question c WHERE c.course_id=$id;";
			$result1 = $mysqli->query($query1);
			$rows = $result1->num_rows;
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}
			print json_encode(['success' =>true,'questions' =>$data],JSON_PRETTY_PRINT);
		}
	}

	public function detail($id){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * ,(SELECT name FROM category WHERE id=c.category_id LIMIT 1) AS category FROM question c WHERE id=$id LIMIT 1;";
			$mysqli->set_charset("utf8");
			$result = $mysqli->query($query);

			$query2 ="SELECT * FROM choice c WHERE c.questionid=$id;";
			$mysqli->set_charset("utf8");
			$result1 = $mysqli->query($query2);
			$data = array();
			while($row = $result1->fetch_array(MYSQLI_ASSOC)){
				array_push($data,$row);
			}

			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				return print json_encode(array('success' =>true,'question' =>$row,'choices'=>$data),JSON_PRETTY_PRINT);
			}else{
				return print json_encode(array('success' =>false,'msg' =>"No record found!"),JSON_PRETTY_PRINT);
			}
		}
	}

	public function update($data,$files){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>"Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error));
		    return;
		}else{
			$allow = array("jpg", "jpeg", "gif", "png");

			$category_id = $mysqli->real_escape_string($data['category_id']);
			$content = $data['content'];
			$id = $data['question_id'];

			$answer = $mysqli->real_escape_string($data['answer']);
			$choice2 = $mysqli->real_escape_string($data['choice2']);
			$choice3 = $mysqli->real_escape_string($data['choice3']);
			$choice4 = $mysqli->real_escape_string($data['choice4']);

			$answerid = $data['answerid'];
            $choice2id = $data['choice2id'];
            $choice3id = $data['choice3id'];
            $choice4id = $data['choice4id'];

	        // Starts on null
	  		$name_main_pic = '';
			$main_pic = '';
			$name_correct_pic = '';
			$correct_pic = '';

			$name_pic2 = '';
			$pic2 = '';

			$name_pic3 = '';
			$pic3 = '';

			$name_pic4 = '';
			$pic4 = '';

			if(isset($files["mainpic"]["name"])){
				$name_main_pic = $files["mainpic"]["name"];
				$main_pic = $files["mainpic"]["tmp_name"];
				$name_correct_pic = $files["correctpic"]["name"];
				$correct_pic = $files["correctpic"]["tmp_name"];

				$name_pic2 = $files["pic2"]["name"];
				$pic2 = $files["pic2"]["tmp_name"];

				$name_pic3 = $files["pic3"]["name"];
				$pic3 = $files["pic3"]["tmp_name"];

				$name_pic4 = $files["pic4"]["name"];
				$pic4 = $files["pic4"]["tmp_name"];
			}
			else{
				$name_main_pic = '';
				$main_pic = '';
			}
		
	  		

			// end null
	  		if($name_main_pic){
			    $info = explode('.', strtolower($name_main_pic));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($main_pic);
		            if($size){
		            	self::do_upload($name_main_pic,$main_pic);
		            }else{
		                $name_main_pic = $data['tmp_main'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Content image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}else{
                $name_main_pic = $data['tmp_main'];   
            }

			if($name_correct_pic){
			    $info = explode('.', strtolower($name_correct_pic));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($correct_pic);
		            if($size){
		            	self::do_upload($name_correct_pic,$correct_pic);
		            }else{
		                $name_correct_pic = $data['tmp_correct'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Content image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}else{
                $name_correct_pic = $data['tmp_correct'];   
            }

			if($name_pic2){
			    $info = explode('.', strtolower($name_pic2));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($pic2);
		            if($size){
		            	self::do_upload($name_pic2,$pic2);
		            }else{
		                $name_pic2 = $data['tmp_pic2'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Choices image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}else{
                $name_pic2 = $data['tmp_pic2'];   
            }

			if($name_pic3){
			    $info = explode('.', strtolower($name_pic3));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($pic3);
		            if($size){
		            	self::do_upload($name_pic3,$pic3);
		            }else{
		                $name_pic3 = $data['tmp_pic3'];   
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Choices image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			    	die();
			    }
			}

			if($name_pic4){
			    $info = explode('.', strtolower($name_pic4));
			    if (in_array(end($info),$allow)){
			    	$size = getimagesize($pic4);
		            if($size){
		            	self::do_upload($name_pic4,$pic4);
		            }else{
		            	$name_pic4 = $data['tmp_pic4'];
		            }
			    }else{
			        return print json_encode(array('success' =>false,'msg' =>'Invalid file type for Choices image. Supported files allowed are JPG,JPEG,GIF,PNG.'),JSON_PRETTY_PRINT);
			        die();
			    }
			}else{
            	$name_pic4 = $data['tmp_pic4'];
            }
		

			$stmt = $mysqli->prepare("UPDATE question SET content=?,file=?,category_id=? WHERE id=?");
			$stmt->bind_param("ssss", $content,$name_main_pic,$category_id,$id);
			$stmt->execute();
			$last_id = $mysqli->insert_id;

			$stmt1 = $mysqli->prepare("UPDATE choice SET choice=?, file=? where id=?");
			$stmt1->bind_param("sss",$answer,$name_correct_pic,$answerid);
			$stmt1->execute();

			$stmt2 = $mysqli->prepare("UPDATE choice SET choice=?, file=? where id=?");
			$stmt2->bind_param("sss",$choice2,$name_pic2,$choice2id);
			$stmt2->execute();

			$stmt3 = $mysqli->prepare("UPDATE choice SET choice=?, file=? where id=?");
			$stmt3->bind_param("sss",$choice3,$name_pic3,$choice3id);
			$stmt3->execute();

			$stmt4 = $mysqli->prepare("UPDATE choice SET choice=?, file=? where id=?");
			$stmt4->bind_param("sss",$choice4,$name_pic4,$choice4id);
			$stmt4->execute();

			return print json_encode(array('success' =>true,'msg' =>'Record successfully saved '),JSON_PRETTY_PRINT);
		}
	}

	public function delete($id){
		$config= new Config();		
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare("DELETE FROM question WHERE id =?")){
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->close();
			print json_encode(array('success' =>true,'msg' =>'Record successfully deleted'),JSON_PRETTY_PRINT);
		}else{
			print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
		}
	}

	public function deleteQuestionFile($id,$file){
		$config= new Config();		
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare("UPDATE question SET file=null WHERE id =?")){
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->close();
			unlink('../upload/choice/'.$file);
			unlink('../upload/choice/thumbs/'.$file);

			print json_encode(array('success' =>true,'msg' =>'Record successfully deleted'),JSON_PRETTY_PRINT);
		}else{
			print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
		}
	}

	public function deleteChoiceFile($id,$file){
		$config= new Config();		
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if($stmt = $mysqli->prepare("UPDATE choice SET file=null WHERE id =?")){
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->close();
			unlink('../upload/choice/'.$file);
			unlink('../upload/choice/thumbs/'.$file);
			print json_encode(array('success' =>true,'msg' =>'Record successfully deleted'),JSON_PRETTY_PRINT);
		}else{
			print json_encode(array('success' =>false,'msg' =>"Error message: %s\n". $mysqli->error),JSON_PRETTY_PRINT);
		}
	}

	public static function check($field,$value){
		$config= new Config();
		$mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
		if ($mysqli->connect_errno) {
		    print json_encode(array('success' =>false,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
		    return;
		}else{
			$query ="SELECT * FROM question c WHERE LCASE(REPLACE(c.$field,' ','')) LIKE '$value%';";
			$result = $mysqli->query($query);
			if($row = $result->fetch_array(MYSQLI_ASSOC)){
				print json_encode(array('success' =>true,'msg' =>'Warning: Data already existed!!!'),JSON_PRETTY_PRINT);
			}else{
				print json_encode(array('success' =>false,'msg' =>'No record found!'),JSON_PRETTY_PRINT);
			}
			print_r(json_encode($query));
		}
	}

}
?>