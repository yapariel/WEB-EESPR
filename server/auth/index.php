<?php
require_once '../server/connection.php';

/*** begin our session ***/
session_start();

/*** check if the users is already logged in ***/
if(isset( $_SESSION['entrance'] )){
    header("Location: main.php");
}

$message = '';

/*** check that both the username, password have been submitted ***/
if($_SERVER['REQUEST_METHOD'] =='POST'){

    if(!isset($_POST['username']) || empty($_POST['username']) || ($_POST['username'] == '')){
        $message = 'Please enter a valid username and password';
    }else if(!isset($_POST['password']) || empty($_POST['password']) || ($_POST['password'] == '')){
        $message = 'Please enter a valid password and password';
    }else{
        /*** if we are here the data is valid and we can insert it into database ***/
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        /*** now we can encrypt the password ***/
        $phpro_password = sha1($password);

        try{
            $config= new Config();
            $mysqli = new mysqli($config->host, $config->user, $config->pass, $config->db);
            if ($mysqli->connect_errno) {
                print json_encode(array('success' =>false,'status'=>400,'msg' =>'Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error));
                return;
            }else{

                $query1 ="SELECT id,username,email,mobileno,fname,lname,level FROM userdata WHERE username = '$username' AND password = '$phpro_password' LIMIT 1;";
                $result = $mysqli->query($query1);
                if ($result) {
                    if($row = $result->fetch_assoc()){
                        /*** set the session user_id variable ***/
                        $_SESSION['entrance'] = $row;
                        $_SESSION['Level'] = $row['level'];
                        /*** check if the user is an admin or a student ***/
                        if ($row['level'] == 'Admin') {
                            /*** set a form token for admin ***/
                            $form_token = md5( uniqid('admin', true) );
                           
                            /*** set the session form token for admin ***/
                            $_SESSION['form_token'] = $form_token;
                            
                            /*** redirect the user to the admin page ***/
                            header("Location: main.php");

                        } else if ($row['level'] == 'Student') {
                            /*** set a form token for student ***/
                            $form_token = md5( uniqid('student', true) );
                            /*** set the session form token for student ***/
                            $_SESSION['form_token'] = $form_token;
                            
                            /*** redirect the user to the student page ***/
                            header("Location: questions.php");
                        } else {
                            /*** unknown user level ***/
                            $message = 'Login Failed';
                        }


                        /*** set a form token ***/
                      //  $form_token = md5( uniqid('auth', true) );

                        /*** set the session form token ***/
                      //  $_SESSION['form_token'] = $form_token;

                        /*** tell the user we are logged in ***/
                       // header("Location: main.php");
                    }else{
                        $message = 'Login Failed';
                    }
                }else{
                    $message = 'Error with SQL' . $query1;
                }
            }
        }
        catch(Exception $e){
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }

    }
}

?>