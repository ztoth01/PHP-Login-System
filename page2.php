<?php
include'include/header.php';
//include menu.php to avoid code repetition		
?>
	<div id="overlay-back"></div>
		<div id="wrapper">	
			<header id="header">
				<?php include'include/menu.php';
				// displaying a message if someone has logged out and has been redirected back to the index page
			
			if (!empty($_GET['msg'])){
				echo '<div id="phpResult" class="animated zoomIn"><div class="close"></div><p>' . base64_decode(urldecode($_GET['msg'])) . '<p></div>';
				/*
				pass the message as a URL parameter from the log_out_form. Use header to re-direct, 
				use base64_encode to shorten the text in the url, and url_encode 
				to make sure that the URL doesn't get junked up.
				*/
			}
	
			// include the login form depending on the user's status
			
			if(!isset($_SESSION['login'])){
				require 'include/log_in_form.php';
				require 'include/register.php';
			}
			
			// displaying user's name if he or she is logged in OR displaying a greeting message
			// include the log out link depending on the user's status
			
			if(isset($_SESSION['username']) && isset($_SESSION['login'])) {
				$title = ($_SESSION['username']);
				//echo Log out link
				echo '<a id="logOut" href="include/log_out_form.php?'.SID.'">Log out</a>
							<p id="userName">Hello again, '.ucfirst($title).'</p>';
			} else {
				echo '<div id="buttons">
						<button id="singIn" class="butt">SIGN IN</button>
						<button id="singUp" class="butt">SIGN UP</button>
					</div>';
			}		
			?>
			</header>
					<div id="blue" class="brickW">
						<div class="text des2">
							<p>The PHP Login System is a simple web application written in PHP that demonstrates a basic login system.</p>
							<p>There are three pages on the site: Home, Info and Code. All users are able to access the home and info page however; accessing the Code page requires registration. Once a registered user is singed in then he or she is able to access the code page as well. Singed in user is also able to browse between pages while maintaining their singed in status, regardless of their browser settings.</p>	
						</div>
					</div>
					<div id="redTwo" class="brickW">
						<div class="text des3">
							<p>As this site serves demonstration purpose only, the user details such as name, username, email and password are saved in a simple .txt file, which is, of course, not the safest way to store sensitive data. However, security can be easily improved by using database like MySQL.</p>
						</div>	
					</div>
				
				<div id="right"></div>
				<div id="yellowTwo" class="brickH"></div>
		</div><!--  ***********    END of WRAPPER ********************-->
	</body>
</html>