<?php
        
        //This function trims and uses the htmlentities built in function to clean the input data
        
		function clean($data){
	        	$trimmed = trim($data);
	        	$trimmedData = htmlentities($trimmed);
	        	return $trimmedData;
        	}
        	
        // end of clean function
        
		$page = htmlentities($_SERVER['PHP_SELF']);	
		$valid = array('plain','html');
		$form_is_submitted = false;
		$errors_detected = false;
       	$cleanData = array();
       	$errors = array();
       	$msgToDisplay = '<div id="phpResult" class="animated zoomIn"><div class="close"></div>';
       	// !!! validation starts here !!! 
       	
		if (isset($_POST['submit'])) {
		
			$form_is_submitted = true;
			$fullname = clean($_POST['fname']);
			$email = clean($_POST['email']);
			$username = clean($_POST['uname']);
			$password = clean($_POST['pword']);
			
			// full name validation
			
			if (isset($fullname)) {
				if ($fullname!="") {
					if (strlen($fullname) < 150) {
						$fullname = explode(' ', $fullname);
						if(count($fullname)>1){
							if ((strlen($fullname[0]) > 1) && (strlen($fullname[1]) > 1)) {
									if ((ctype_alpha($fullname[0])) && (ctype_alpha($fullname[1]))) {
										$upc_name = ucfirst($fullname[0]).' '.ucfirst($fullname[1]);
										$cleanData['Full name'] = $upc_name;
									} else {
										$errors_detected = true;
										$errors['Full name'] = 'Not allowed characters. Only alphabetic characters or space.';
									}
							} else {
								$errors_detected = true;	
								$errors['Full name'] = 'First and last name should be at least 2 characters long each, with space between them.'; 
							}
						}else{
							$errors_detected = true;	
								$errors['Full name'] = 'Please make sure you enter your first and last name.'; 
						}
					} else {
						$errors_detected = true;
						$errors['Full name'] = 'First and last name should not be more than 150 characters long.';
					} 
				} else {
					$errors_detected = true;
					$errors['Full name field'] = ' empty.';
				}	
			} else {
				$errors_detected = true;
				$errors['Full name'] = 'not a field in the form. Please report this problem at errors@forms.com';
			}	
			
			//email validation
			
			$email = $_POST['email'];
			if (isset($email)) {
				if ($email!="") {
					$email = clean($email);
					if(filter_var($email,FILTER_VALIDATE_EMAIL)){
						$cleanData['Email'] = $email;	  
					} else {
						$errors_detected = true;
						$errors['Email'] = 'Not valid email address format! e.g. someone@example.com.'; 
					}
				} else {
					$errors_detected = true;
					$errors['Email'] = 'The field is empty! e.g. someone@example.com.';
				}
			}
			
			//username validation
			
			if (isset($username)) {
				if ($username!="") {
					if (strlen($username) < 20) {
						if(count($username)< 2 ){
							if (ctype_alnum($username)) {
								$username = clean($username);
								$cleanData['Username'] = $username;
							} else {
								$errors_detected = true;
								$errors['Username'] = 'Not allowed characters. Only alphnumeric characters with no spaces, e.g. username12 ';
							}
						}else{
							$errors_detected = true;	
								$errors['Username'] = 'Please make sure you enter the username with no spaces.'; 
						}
					} else {
						$errors_detected = true;
						$errors['Username'] = 'Username should not be more than 20 alphanumeric characters long.';
					} 
				} else {
					$errors_detected = true;
					$errors['Username field'] = ' empty.';
				}	
			} else {
				$errors_detected = true;
				$errors['Username'] = 'not a field in the form. Please report this problem at errors@forms.com';
			}
			
			//Password validation
			
			if (isset($password)) {
				if ($password!="") {
					if (strlen($password) > 5) {
						if (strlen($password) < 20) {
							if(count($password)< 2 ){
								if (ctype_alnum($password)) {
									$password = clean($password);
									$cleanData['Password'] = $password;
								} else {
									$errors_detected = true;
									$errors['Password'] = 'Not allowed characters. Only alphnumeric characters with no spaces, e.g. Password12 ';
								}
							}else{
								$errors_detected = true;	
								$errors['Password'] = 'Please make sure you enter the password with no spaces as one word.'; 
							}//after this
						} else {
							$errors_detected = true;
							$errors['Password'] = 'Password should not be more then 20 characters long, e.g. Password12.';
						}	
					} else {
						$errors_detected = true;
						$errors['Password'] = 'Password should be at least 6 characters long, e.g. Password12.';
					} 
				} else {
					$errors_detected = true;
					$errors['Password field'] = ' empty.';
				}	
			} else {
				$errors_detected = true;
				$errors['Password'] = 'not a field in the form. Please report this problem at errors@forms.com';
			}
			
			/*Checking if the file is empty with the "filesize" function, it returns the size of 
			the file which should be 0 if it's empty. For some unknown reason my empty file varies
			between 1 byte  and 3 bytes . So I write if it's less then or equal to four.
			*/ 
			//if (0 >=  filesize('data/usernames.txt')){}
				// open the .txt file to retrieve data
				
				$handle = fopen('data/usernames.txt','r') or die ('Cannot open file');

				while(!feof($handle)){					   
					$line = fgets($handle);
					// if empty line, break out from the loop! 
				
					if(empty($line)){
						break;
					}									  
					$data = explode(',',$line);			  
					$fullName = strtolower(trim($data[0]));				  
					$emailAddress = trim($data[1]);			  
					//checking the username and the password if they match and exist in the .txt file   
					if($emailAddress == $_POST['email']){
						$errors_detected = true;
						$errors['Email'] = 'User already registered with this email address, please try a different one.'; 
					}	
					if($fullName == $_POST['fname']){
						$errors_detected = true;
						$errors['Name'] = 'User already registered with this full name, please try a different one.'; 
						
					}
				}
				fclose($handle);
				/*
				if($errors_detected === true && $_POST['fname']!=="" && $_POST['email']!=="" && $_POST['uname']!=="" && $_POST['pword']!==""){
					$errors['Error!'] = 'User already registered with this email address, please try a different one.';
				}
				*/
			
		}
				
		// !!! end of validation !!!
		
		//writing data
		if ($form_is_submitted === true && $errors_detected === false){
			
			// !!! process data !!!
			
			$fullname = htmlentities($cleanData['Full name']);
			$email = htmlentities($cleanData['Email']);
			$username = htmlentities($cleanData['Username']);
			$_SESSION['username'] = $username;
			$password = htmlentities($cleanData['Password']);
			
			 
			//writing new user's data
			$handle = fopen('data/usernames.txt', 'a') or die('Cannot open file');
			
			$new_user = "$fullname,$email,$username,$password\n";
			
			$result = fwrite($handle, $new_user);
			
				if($result === false){
					$msgToDisplay .= '<p>Opps! data not written</p></div>';
				}else{
					$_SESSION['login'] = true;
					$msgToDisplay .= '<p>You have been registered.</p></div>';
				}
			fclose($handle);
			echo($msgToDisplay);
			//end of writing data	
			
		} else {
		
		
		//check for correct form entries and save them for the resubmission, appart from the password field.
			if(isset($cleanData['Full name'])){
				$fullname = htmlentities($cleanData['Full name']);
			}else{
				$fullname = '';
			}
			if(isset($cleanData['Email'])){
				$email = $cleanData['Email'];
			}else{
				$email = ''; 
			}
			if(isset($cleanData['Username'])){
				$username = htmlentities($cleanData['Username']);
			}else{
				$username = '';
			}
			
			// Display error messages, if there are any
			
			if ($errors_detected === true) {
				$msgToDisplay .= "Invalid inputs are:";
				foreach ($errors as $error => $value) {
					$msgToDisplay .=  "<p>$error is: $value</p>";
				}	
				$msgToDisplay .= '</div>';
				echo($msgToDisplay);
			} 
			
		// (re)display form
		
			echo '<form action="'.$page.'" method="post" id="signUpForm" class="forms">
					<div class="close"></div>
					<fieldset>
					<legend>Register</legend>
						<div class="controlgruop">
							<label class="form-input" for="fullname">Full Name</label>
							<input class="form-label" value ="'.$fullname.'" type="text" name="fname" id="fullname" />
						</div>
						<div class="controlgruop">            
							<label class="form-input" for="email">Email</label>
							<input class="form-label" value ="'.$email.'" type="text" name="email" id="email" />
						</div>
						<div class="controlgruop">
							<label class="form-input" for="username">Username</label>
							<input class="form-label" value ="'.$username.'" type="text" name="uname" id="username" />
						</div>
						<div class="controlgruop">
							<label class="form-input" for="password">Password</label>
							<input class="form-label" type="password" name="pword" id="password" />
						</div>
						
						<div>            
							<input id="submitPhp" type="submit" name="submit" value="Submit" />
							<button class="reset" type="reset">Reset form</button>
						</div>
						</fieldset>
				</form>';
		}		
		?>