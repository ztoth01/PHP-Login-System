<?php

		include'include/header.php';
		
		
		//include header.php to avoid code repetition
		

		?>
		<div id="overlay-back"></div>
			<div id="wrapper">	
				<div id="yellow" class="brickH"></div>
				<header id="header">
					<?php include'include/menu.php'; ?><?php
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
				?>
				<?php
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
			
			
			
				<div id="title" class="brickW">
					<div id="titleBox" class="text">
						<h1>Welcome to My</h1>
						<h1><span>PHP</span> Login System</h1>
					</div>
				</div>
			
			
				<div id="red" class="brickH">
					<div class="text des">
						<p>This is my demo PHP Login System site packed up with cool functionality and spiced up with some advanced CSS3</p>
						<p class="question"><span>Do you want to know what the site does?</p><p class="answer">Head over to the <a href="page2.php" class="link">INFO </a>page</p>
						<p class="question">Do you want to know how the site works?</p><p class="answer"> Have a look at <a href="page3.php" class="link">CODE</a> page</p>
						<p>Don't forget to sing in first or sing up if you haven't registered yet to be albe to have access to the Code page!
						Have a look around, I hope you will enjoy your staying!</p>
					</div>
				</div>
			
	
				<div id="right"></div>
			
		</div><!--  ***********    END of WRAPPER ********************-->
	</body>
</html>