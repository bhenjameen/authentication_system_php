<?php
	session_start();
	require_once("functions/user.php");
	require_once("functions/alert.php");
	require_once("functions/redirect.php");
	require_once("functions/email.php");
	require_once("functions/token.php");
	$errorCount= 0;
	if(!is_user_loggedIN()){
		$token = $_POST["token"] !="" ? $_POST["token"] :$errorCount++;
			$_SESSION["token"] = $token;
	}
	
	$email = $_POST["email"] !="" ? $_POST["email"] : $errorCount++;
	$password = $_POST["password"] !="" ? $_POST["password"] : $errorCount++;
	

	$_SESSION["email"] = $email;
	
	if($errorCount > 0){
		$session_error = "you have ". $errorCount . " error";
		if($errorCount > 1){
			$session_error .="s";
			
		}
		$session_error .= " in your form submission";
		set_alert("error", $session_error);
			redirect_to("reset.php");		
		
		}else{
			$checkToken = is_user_loggedIN() ? true : find_token($email);
					
					if($checkToken){
						$userExists = find_user($email);
							if($userExists){
								$userObject = find_user($email);
								
								 $userObject ->password = password_hash($password, PASSWORD_DEFAULT);
								 unlink("db/users/".$currentUser); 
								 unlink("db/token/".$currentUser); 
								 
								 
								save_user($userObject);
								
								 
								set_alert("message", "Password Reset Succesful, you can now login");

									$subject= "Password Reset successful";
									$message =  " your account information has been changed, if you didn't do that, visit the site now!";
									send_mail($subject, $message,$email);

								redirect_to("login.php");
								 die();
												
							}	
				
			}
			set_alert("error","Token/ Email is invalid" );
			
			redirect_to(" reset.php");
			
		}
		
?>