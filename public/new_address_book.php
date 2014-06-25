<?

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=address_db', 'mallory', 'malmal');

//Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




if (!empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zipcode'])) {
	$dbc = new PDO('mysql:host=127.0.0.1;dbname=address_db', 'mallory', 'malmal');

		//Tell PDO to throw exceptions on error
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $dbc->prepare("INSERT INTO addresses(address, city, state, zipcode) VALUES (:address, :city, :state, :zipcode)");


		$stmt->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
		$stmt->bindValue(':city', $_POST['city'], PDO::PARAM_STR);
		$stmt->bindValue(':state', $_POST['state'], PDO::PARAM_STR);
		$stmt->bindValue(':zipcode', $_POST['zipcode'], PDO::PARAM_INT);

		
	   
	    $stmt->execute();

} else {
	foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo "<h1>" . ucfirst($key) .  " is empty.</h1>";
    	}
    }
}

function getAddress($dbc) {
// Bring the $dbc variable into scope and Create Limit and offset
	$page = getOffset(); 
	$stmt = $dbc->prepare('SELECT * FROM addresses LIMIT :LIMIT OFFSET :OFFSET');
	$stmt->bindValue(':LIMIT' , 10, PDO::PARAM_INT);
    $stmt->bindValue(':OFFSET' , $page, PDO::PARAM_INT); 
    $stmt->execute(); 

    $stmt = $stmt->fetchAll((PDO::FETCH_ASSOC));
    return $stmt;
}

//Calling getAddress function 
$address = getAddress($dbc);

//Create Function to get an offset for each page 
function getOffset(){
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	return($page - 1) * 10;

}

$count = $dbc->query('SELECT COUNT(*) FROM addresses')->fetchColumn();
$numPages = ceil($count / 10); 


//defining page variable 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Address Book</title>
	</head>
	<body>
		<h1>Address Book</h1>
			<table border='1'>
     		<tr>
       			<td>Name</td>
       			<td>Address</td>
       			<td>City</td>
       			<td>State</td>
       			<td>Zip</td>

     		</tr>
       <? foreach ($address as $key => $fields) : ?>
                <tr>
                    <? foreach ($fields as $value): ?>
                        <td><?= htmlspecialchars(strip_tags($value));?></td>
                    <? endforeach; ?>
                </tr>
       <? endforeach; ?>
     
   </table>
		<h2>Add Name</h2>		

			<form method="POST" action="/address_book.php">
				<p>
					<label for="Add_Name">Name:</label>
					<input id="Add_Name" name="Add_Name" type="text" placeholder="Enter Name Here">
				</p>
			</form>


		<h2>Add a New Entry to the Address Book</h2>

			<form method="POST" action="/new_address_book.php">
				
				<p>
					<label for="address">Address:</label>
					<input id="address" name="address" type="text" placeholder="Enter Address Here"> 
				</p>
				<p>
					<label for="city">City:</label>
					<input id="city" name="city" type="text" placeholder="Enter City Here"> 
				</p>
				<p>
					<label for="state">State:</label>
					<input id="state" name="state" type="text" placeholder="Enter State Here"> 
				</p>
				<p>
					<label for="zipcode">Zip:</label>
					<input id="zipcode" name="zipcode" type="text" placeholder="Enter Zip Here"> 
				</p>
				<p>
					<button type="Submit">Add</button>
				</p>
			</form>
		
	</body>
</html>