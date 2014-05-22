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
    			<form method="POST" action="/my_first_form.php">
    				<p>
        				<label for="username">Username:</label>
        				<input id="username" name="username" type="text"placeholder="Enter your username"autofocus>
    				</p>
    				<p>
        				<label for="password">Password:</label>
        				<input id="password" name="password" type="password"placeholder="Enter your password">
    				</p>
    				<p>
    					<label for=“remember”>Remember Me?</label>
						<input id =“remember name="memory" type="checkbox">
    				</p>
    				<p>
        				<button type="submit"> Log In</button>
    				</p>
				</form>
			</body>
	</html>