<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Form!</title>
		</head>
			<body>
				<?php
        			var_dump($_GET);
        			var_dump($_POST);
    			?>
    		<h2>User Login</h2>
    			<form method="POST" action="/my_first_form.php">
    				<p>
        				<label for="username">Username:</label>
        				<input id="username" name="username" type="text" placeholder="Enter your username"autofocus>
    				</p>
    				<p>
        				<label for="password">Password:</label>
        				<input id="password" name="password" type="password" placeholder="Enter your password">
    				</p>
    				<p>
    					<label for="remember">Remember Me?</label>
						<input id ="remember" name="memory" type="checkbox">
    				</p>
    				<p>
        				 <button type="submit"> Log In</button>
    				</p>
				</form>
			<h2>Compose an Email</h2>
				<form method="POST">
					<p>
						<label for="email">To:</label>
						<input id="email" name="email" type="email" placeholder="Enter Recipient Email"> 
					</p>
					<p>
						<label for="email">From:</label>
						<input id="email" name="email2" type="email" placeholder="Enter Your Email"> 
					</p>
					<p>
						<textarea id="email_body" name="email_body" rows="5" cols="40">Enter Content Here</textarea>
					</p>
					<p>
						 <button type="submit">Send</button>
					</p>
			</body>
	</html>