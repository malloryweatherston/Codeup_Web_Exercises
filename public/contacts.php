<?

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=address_db', 'mallory', 'malmal');

//Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!empty($_POST['names'])) {

	$dbc = new PDO('mysql:host=127.0.0.1;dbname=address_db', 'mallory', 'malmal');

		//Tell PDO to throw exceptions on error
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $dbc->prepare("INSERT INTO names(names) VALUES (:names)");
		$stmt->bindValue(':names', $_POST['names'], PDO::PARAM_STR);

		 $stmt->execute();

} else {
	foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo "<h1>" . ucfirst($key) .  " is empty.</h1>";
    	}
    }
}

function getName($dbc) {
// Bring the $dbc variable into scope and Create Limit and offset
	$page = getOffset(); 
	$stmt = $dbc->prepare('SELECT * FROM names LIMIT :LIMIT OFFSET :OFFSET');
	$stmt->bindValue(':LIMIT' , 10, PDO::PARAM_INT);
    $stmt->bindValue(':OFFSET' , $page, PDO::PARAM_INT); 
    $stmt->execute(); 

    $stmt = $stmt->fetchAll((PDO::FETCH_ASSOC));
    return $stmt;
}

//Calling getAddress function 
$names = getName($dbc);

//Create Function to get an offset for each page 
function getOffset(){
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	return($page - 1) * 10;

}

$count = $dbc->query('SELECT COUNT(*) FROM names')->fetchColumn();
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
		<title>Names</title>
	</head>
		<body>
			<h1>Names</h1>
			<table>
			 <? foreach ($names as $key => $fields) : ?>
                <tr>
                    <? foreach ($fields as $value): ?>
                        <td><a href="new_address_book.php?names_id={$fields}"><?= htmlspecialchars(strip_tags($value));?></a></td>
                    <? endforeach; ?>
                </tr>
       		<? endforeach; ?>
     
   				</table>
			<h2>Add Name</h2>		

				<form method="POST" action="/contacts.php">
					
					<p>
						<label for="names">Name:</label>
						<input id="names" name="names" type="text" placeholder="Enter New Name Here">
					</p>
					<p>
						<button type="Submit">Add</button>
					</p>
				</form>
		</body>
</html>
