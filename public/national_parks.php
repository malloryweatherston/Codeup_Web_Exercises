<?php
// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'mallory', 'malmal');

//Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function getParks($dbc) {
// Bring the $dbc variable into scope somehow
	$page = getOffset(); 
	$stmt = $dbc->prepare('SELECT * FROM national_parks LIMIT :LIMIT OFFSET :OFFSET');
	$stmt->bindValue(':LIMIT' , 4, PDO::PARAM_INT);
    $stmt->bindValue(':OFFSET' , $page, PDO::PARAM_INT); 
    $stmt->execute(); 

    $stmt = $stmt->fetchAll((PDO::FETCH_ASSOC));
    return $stmt;

    //return $dbc->query('SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset())->fetchAll(PDO::FETCH_ASSOC);
}

function getOffset(){
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	return($page - 1) * 4;

}

$count = $dbc->query('SELECT COUNT(*) FROM national_parks')->fetchColumn();
$numPages = ceil($count / 4); 


//defining page variable 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;




$parks_array= getParks($dbc);


if (!empty($_POST['name']) && !empty($_POST['location']) && !empty($_POST['date_established']) && !empty($_POST['area_in_acres']) && !empty($_POST['description'])) {
	// Get new instance of PDO object
	$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'mallory', 'malmal');

	//Tell PDO to throw exceptions on error
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbc->prepare("INSERT INTO national_parks(name, location, date_established, area_in_acres, description) VALUES (:name, :location, :date_established, :area_in_acres, :description)");


	//foreach ($national_parks as $national_park) {
		$stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
		$stmt->bindValue(':location', $_POST['location'], PDO::PARAM_STR);
		$stmt->bindValue(':date_established', $_POST['date_established'], PDO::PARAM_STR);
		$stmt->bindValue(':area_in_acres', $_POST['area_in_acres'], PDO::PARAM_INT);
		$stmt->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		
	   
	    $stmt->execute();
	//}

} else {
		foreach ($_POST as $key => $value) 
	       if (empty($value)) {
	            echo "<h1>" . ucfirst($key) .  " is empty.</h1>";
	    	}
	
}


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>National Parks</title>
	</head>
		<body>
			<h2>National Parks</h2>
			<table>
				<table border='1'>
     		<tr>
       			<td>ID</td>
       			<td>Name</td>
       			<td>Location</td>
       			<td>Date Established</td>
       			<td>Area in Acres</td>
       			<td>Description</td>

     		</tr>
       <? foreach ($parks_array as $row) : ?>
                <tr>
                    <? foreach($row as $park): ?>
                        <td><?= htmlspecialchars(strip_tags($park));?></td>
                    <? endforeach; ?>
                </tr>
      		 <? endforeach; ?>
			</table>
			<? if ($page > 1) : ?>
			<a href="/national_parks.php?page=<?= $prevPage; ?>"> Previous</a>
			<? endif ?>
			<? if ($page < $numPages) : ?>
			<a href="/national_parks.php?page=<?= $nextPage;?>">Next</a>
			<? endif ?>
			<h2>Add a National Park</h2>

			<form method="POST" action="/national_parks.php">
				<p>
					<label for="name">Name:</label>
					<input id="name" name="name" type="text" placeholder="Enter Name">
				</p>
				<p>
					<label for="location">Location:</label>
					<input id="location" name="location" type="text" placeholder="Enter Location"> 
				</p>
				<p>
					<label for="date_established">Date Established:</label>
					<input id="date_established" name="date_established" type="text" placeholder="Enter Date Established"> 
				</p>
				<p>
					<label for="area_in_acres">Area in Acres:</label>
					<input id="area_in_acres" name="area_in_acres" type="text" placeholder="Enter Area in Acres"> 
				</p>
				<p>
					<label for="description">Description:</label>
					<input id="description" name="description" type="text" placeholder="Enter Description"> 
				</p>
				<p>
					<button type="Submit">Add</button>
				</p>
			</form>
		
		</body>
</html> 