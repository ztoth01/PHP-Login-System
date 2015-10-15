<?php

// this form is based on the from.php from hands on excecise 12

// State variables
$form_is_submitted = false;
$errors_detected = false;
$user_exist = false;
// Arrays to gather data
$clean = array();
$errors = array();
$msgToDisplay = '<div id="phpResult" class="animated zoomIn"><div class="close"></div>';
// Validate form if it was submitted
if (isset($_POST['submitdetails'])) {
    
    $form_is_submitted = true;
    
    //User name is a required field
    if (isset($_POST['username'])) {
        $name_in = trim($_POST['username']);
        $length = strlen($name_in);
        if ($length >= 1) {
            $clean['username'] = $name_in;
            $_SESSION['username'] = $name_in; 
        } else {
            $errors_detected = true;
            $errors[] = 'Username is required';
        }
    } else {
        $errors_detected = true;
        $errors[] = 'Username is not submitted';
    }
    
    // Password
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        if ($password){
            $clean['password'] = $password;
            $_SESSION['password'] = $password; 
        } else {
            $errors_detected = true;
            $errors[] = 'Password is required';
        }
    } else {
        $errors_detected = true;
        $errors[] = 'Password not submitted';
    }

}

//*****checking password and user name******

if($form_is_submitted === true){

	$handle = fopen('data/usernames.txt','r'); //open the file to read
	if($handle === false){
		$errors_detected = true;
		// displaying an error message if no data found
		$errors[] = 'System error';
	}else if ( 4 >= filesize('data/usernames.txt')){
		$errors[] = 'Error, no data found! Please register';
		$errors_detected = true;
	}else{
		while(!feof($handle)){                       
	    	$line = fgets($handle); 	                                
	        $data = explode(',',$line); 
	        if(empty($line)){
	        	break;
	        }          
	        $userName = trim($data[2]);                 
	        $passWord = trim($data[3]);                
	
	        //checking the username and the password if they match and exist in the .txt file   
	        if( $userName === $_POST['username'] &&  $passWord === $_POST['password']){
	        	$_SESSION['login'] = true;
	        	$errors_detected = false;
	        	break;
	        }else{
	        	$errors_detected = true;
	       	}   
	     }
	 }
     fclose($handle);
     //if no match found displaying an error message
	if($errors_detected === true && $_POST['username']!=="" && $_POST['password']!==""){
		$errors[] = 'Invalid username or password';
	}
}
	
// Decide whether to process data or (re)display form
if ($form_is_submitted === true && $errors_detected === false) {
    
	$msgToDisplay .= '<p>Thanks, you\'re now logged in!</p></div>';
	echo($msgToDisplay);
    // Submission was OK, so display thank-you message
   
} else {
    
    // Display error messages, if there are any
    if ($errors_detected === true) {
			//echo '<h3>Invalid inputs are: </h3>';
			foreach ($errors as $error => $value) {
				$msgToDisplay .= "<p> $value</p>";
			}
			$msgToDisplay .= '</p></div>';
			echo($msgToDisplay);	
		} 
    
   
    
    // Sanitise the current URL for use in the "action" attribute of form
    $self = htmlentities($_SERVER['PHP_SELF']);

    // display the form

    echo '<form action="'.$self.'" method="post" id="signInForm" class="forms">
            <div class="close"></div>
            <fieldset>
				<legend>Login form</legend>
                
                <div class="controlgruop">
                    <label for="fn">Username:</label>
                    <input type="text" name="username" id="fn" value="" />
                </div>

                <div class="controlgruop">
                    <label for="fav">Password:</label>
                    <input type="password" name="password" id="fav" value="" />
                </div>

                <input type="submit" name="submitdetails" value="Login" />
                <button class="reset" type="reset">Reset form</button>
            </fieldset>
        </form>';
     
}

?>