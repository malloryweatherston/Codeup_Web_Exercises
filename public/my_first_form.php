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
						<textarea id="email_body" name="email_body" rows="10" cols="100" placeholder="Enter Content Here"></textarea>
					</p>
					<p>
						<label for="mailing_list">Would you like to save a copy to your send folder?</label>
    					<input type="checkbox" id="mailing_list" name="mailing_list" value="yes" checked>
					<p>
						 <button type="submit">Send</button>
					</p>
			<h2>Multiple Choice Test</h2>
				<form method="POST">
					<p>Where do you live?</p>
						<label for="q1a">
							<input type="radio" id="q1a" name="q1" value="Austin">
    						Austin
    					</label>
    					<label for="q1b">
    						<input type="radio" id="q1b" name="q1" value="San Antonio">
    						San Antonio
						</label>
						<label for="q1c">
    						<input type="radio" id="q1c" name="q1" value="Other">
    						Other
						</label>
					<p>What is your gender?</p>
						<label for="q2a">
    						<input type="radio" id="q2a" name="q2" value="Male">
    						Male
						</label>
						<label for="q2b">
    						<input type="radio" id="q2b" name="q2" value="Female">
    						Female
						</label>
						<label for="q2c">
    						<input type="radio" id="q2c" name="q2" value="Other">
    						Other
						</label>
					<p>Which types of food do you like? (Check all that apply)</p>
						<label for="food1">
							<input type="checkbox" id="food1" name="food[]" value="Asian"> Asian</label>
						<label for="food2">
							<input type="checkbox" id="food2" name="food[]" value="Mexican"> Mexican</label>
						<label for="food3">
							<input type="checkbox" id="food3" name="food[]" value="American"> American</label>
						<label for="food4">
							<input type="checkbox" id="food4" name="food[]" value="Italian"> Italian</label>	
					<p>
						<button type="submit">Submit</button>
					</p>
				</form>
			</body>
	</html>