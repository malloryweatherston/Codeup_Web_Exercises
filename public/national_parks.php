<?php
// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'mallory', 'malmal');

//Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function getParks($dbc) {
    // Bring the $dbc variable into scope somehow
   //$page = getOffset();

    return $dbc->query('SELECT * FROM national_parks LIMIT 4 OFFSET ' . getOffset())->fetchAll(PDO::FETCH_ASSOC);
}

function getOffset(){
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	return($page - 1) * 4;

}

$count = $dbc->query('SELECT COUNT(*) FROM national_parks')->fetchColumn();
$numPages = ceil($count / 4); 

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;




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

     		</tr>
       <? foreach (getParks($dbc) as $row) : ?>
                <tr>
                    <? foreach($row as $park): ?>
                        <td><?= htmlspecialchars(strip_tags($park));?></td>
                    <? endforeach; ?>
                </tr>
      		 <? endforeach; ?>
			</table>
			<? if ($page >= 2) : ?>
			<a href="/national_parks.php?page=<?= $prevPage; ?>"> Previous</a>
			<? endif ?>
			<? if ($page < 3) : ?>
			<a href="/national_parks.php?page=<?= $nextPage;?>">Next</a>
			<? endif ?>
		</body>
</html> 