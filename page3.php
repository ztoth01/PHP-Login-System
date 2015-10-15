<?php
include'include/header.php';
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
			
			// displaying user's name if he or she is logged in 
			// include the log out link depending on the user's status
			
			if(isset($_SESSION['username']) && isset($_SESSION['login'])) {
				$title = ($_SESSION['username']);
				//echo Log out link
				echo'<a id="logOut" href="include/log_out_form.php?'.SID.'">Log out</a>
					<p id="userName">Hello again, '.ucfirst($title).'</p>';
				//if the user is logged in display her or his username
			} else {
				echo '<div id="buttons">
						<button id="singIn" class="butt">SIGN IN</button>
						<button id="singUp" class="butt">SIGN UP</button>
					</div>';
			}		
			?>
		
			</header>
			<div id="right"></div>
		
			<?php
			// if guest user, display a login request to see hidden content
			if(!isset($_SESSION['username']) && !isset($_SESSION['login'])) {
				echo '<div id="redThree" class="brickW">
						<p class="text">The content of this page is only available for registered, logged in users! Please log in</p>
					</div>';
			}else{
			//if singed in user, display hidden content 
				echo '<div id="redThree" class="brickW">
						<p class="text">Why don\'t you head over to GitHub to have a look at the code ?</p>
						<a id="git" href="https://github.com/ztoth01/PHP-Login"  target="_blank">GitHub</a>
					</div>';
			}
			?>
			
		</div><!--  ***********    END of WRAPPER ********************-->
	</body>
</html>


