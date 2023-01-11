<?php
    include_once 'dbconn.php';

    switch ($_REQUEST['method']){
        case 'reg':
            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['pass'];
            registration($name, $email, $password, $conn);
                break;
        case 'log':
            $email = $_REQUEST['email'];
            $password = $_REQUEST['pass'];
            login($email, $password, $conn);
                break;
    }

    function login($email, $password, $conn) {

        $data['success'] = true;

            // prevent sql injections/ clear user invalid inputs
            $email = trim($email);
            $email = strip_tags($email);
            $email = htmlspecialchars($email);

            $pass = trim($password);
            $pass = strip_tags($pass);
            $pass = htmlspecialchars($pass);
            // prevent sql injections / clear user invalid inputs

            if(empty($email)){
                $data['success']  = false;
                $data['error_msg'] = "Please enter your email address.";
                echo json_encode($data);
                return true;
            } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
                $data['success']  = false;
                $data['error_msg'] = "Please enter valid email address.";
                echo json_encode($data);
                return true;
            }

            if(empty($pass)){
                $data['success']  = false;
                $data['error_msg'] = "Please enter your password.";
                echo json_encode($data);
                return true;
            }

            // if there's no error, continue to login
            if ($data['success']) {

                $password = hash('sha256', $pass); // password hashing using SHA256

                $sql = "SELECT * FROM members WHERE email='$email'";
                $result = mysqli_query($conn,$sql); //or die(mysqli_error());
                $count = mysqli_num_rows($result);
                $row=mysqli_fetch_array($result);

                if( $count == 1 &&    $row['password']==$password ) {
                    $data["username"] = $row["name"];
                    $data["success"] = true;
                    echo json_encode($data);
                    return true;
                } else {
                    $data['success']  = false;
                    $data['error_msg'] = "Incorrect Information, Try again...";
                    echo json_encode($data);
                    return true;
                }

            }


        return false;

    }

function registration($name, $email, $password, $conn) {

        $data['success'] = true;

            // prevent sql injections/ clear user invalid inputs
            $name = trim($name);
            $name = strip_tags($name);
            $name = htmlspecialchars($name);

            $email = trim($email);
            $email = strip_tags($email);
            $email = htmlspecialchars($email);

            $pass = trim($password);
            $pass = strip_tags($pass);
            $pass = htmlspecialchars($pass);
            // prevent sql injections / clear user invalid inputs

            if(empty($email)){
                $data['success']  = false;
                $data['error_msg'] = "Please enter your email address.";
                echo json_encode($data);
                return true;
            } else if (empty($name)) {
                $data['success']  = false;
                $data['error_msg'] = "Please enter your name";
                echo json_encode($data);
                return true;
            } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
                $data['success']  = false;
                $data['error_msg'] = "Please enter valid email address.";
                echo json_encode($data);
                return true;
            }

            if(empty($pass)){
                $data['success']  = false;
                $data['error_msg'] = "Please enter your password.";
                echo json_encode($data);
                return true;
            }

            // if there's no error, continue to login
            if ($data['success']) {

                $password = hash('sha256', $pass); // password hashing using SHA256

                $sql = "SELECT * FROM members WHERE email='$email'";
                $result = mysqli_query($conn,$sql); //or die(mysqli_error());
                $count = mysqli_num_rows($result);
                if($count == 1){
                    $data['success']  = false;
                    $data['error_msg'] = "Sorry.. Email already exists";
                    echo json_encode($data);
                    return true;
                }
                $sql = "INSERT INTO members (name, email, password) VALUES ('$name', '$email', '$password')";
                $result = mysqli_query($conn,$sql); //or die(mysqli_error())

                if($result) {
                    $data["username"] = $name;
                    $data["success"] = true;
                    echo json_encode($data);
                    return true;
                } else {
                    $data['success']  = false;
                    $data['error_msg'] = "Incorrect Information, Try again...";
                    echo json_encode($data);
                    return true;
                }

            }


        return false;

    }





/*
include_once("db.php");
session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['email'])){
		

		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		$password = md5($password);
		$pass = $_POST['password'];
		

		

		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$sql = "SELECT * FROM users WHERE email = '$email'";	
			    $result = mysqli_query($con,$sql);
			    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			    $count = mysqli_num_rows($result);
				

				
				if($count >= 1) {
					if($password == $row['password']){
						if($row['active_status']=='active'){	
							if($row['account_block']=='no'){
								$_SESSION['user_id'] = $row['user_id'];
								$_SESSION['email'] = $row['email'];
								$_SESSION['username'] = $row['username'];
								$user_id = trim($row['user_id']);
								
								$sql = "SELECT * FROM user_info WHERE info_id = '$user_id'";
								$result = mysqli_query($con,$sql);
								$row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
								
								$_SESSION['branch'] = $row1['branch'];
								$_SESSION['class'] = $row1['class'];
								$_SESSION['roll'] = $row1['roll'];
								 header("location: ../user_profile.php");
							}else{
								$_SESSION['error_from_lauth'] = "Account is blocked due to maximum login attempts please try with forget password";
								header('Location: ../login.php');
							}
						}else{
								$_SESSION['error_from_lauth'] = "Account is not activated";
								header('Location: ../login.php');
						}
					}else{
						if(!$_SESSION['count']){
							$_SESSION['count']=1;
						} else {
							$_SESSION['count'] +=1;
						}
							$_SESSION['error_from_lauth'] = " password is invalid";
							
							if($_SESSION['count']>=5){
									$query = "UPDATE `users` 
									 SET `account_block`='yes'
									 WHERE email = '$email'";
									$result = mysqli_query($con,$query);
									if(mysqli_num_rows($result)>=1){
										$_SESSION['count']=0;
										$_SESSION['error_from_lauth'] = "Your account is blocked!!<br>Please try with forget password";
									}
							}
							
							header('Location: ../login.php');
					}
						

			  	}else {
					$_SESSION['error_from_lauth'] = "Please enter a valid username or password";
					header('Location: ../login.php');

 
				}
		}else{
			$_SESSION['error_from_lauth'] = " Email is invalid";
			header('Location: ../login.php');
		}
	}
*/
